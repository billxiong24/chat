<?php
'include ChatManager.class.php';
/**
 * TODO ELIMINATE CHATMANAGER DEPENDENCY BAD DESIGN
 */
class Notification{
    
    private $manager;
    private $notif_ids; 

    //TODO change parameter to interface, instead of passing in entire class
    //Takes in ChatManager object
    public function __construct(ChatManager $manager){
        DataBase::init();
        $this->manager= $manager; 
    }
    public function set_manager($new_manager){
        $this->manager = $new_manager;
    }
    public function get_manager(){
        return $this->manager;
    }

    public function increment_notifications(){
        //TODO error?
        if(!isset($_SESSION['user'])){
            return;
        }
        $man = $this->manager;
        $curr_id = $man->get_id();
        //TODO fix possible sql injection
        $query = "UPDATE chat_updates SET notifications = notifications + 1 WHERE id = '".$curr_id."' AND users <> '".$_SESSION['user']."'";
        DataBase::make_query($query);
        return $man;
    }
    public function retrieve_notifications(){
        if(!isset($_SESSION['user'])){
            return;
        }
        $notifications = array();
        $query = "SELECT id, notifications FROM chat_updates WHERE users = '".$_SESSION['user']."'";
        $res = DataBase::make_query($query);

        while($row = mysqli_fetch_assoc($res)){
            $notifications[$row['id']] = $row['notifications'];
        }
        return $notifications;
    }
    public function reset_notifications(){
        if(!isset($_SESSION['user'])){
            return;
        }
        $curr_id = $this->manager->get_id();

        $query = "UPDATE chat_updates SET notifications = 0 WHERE id = '".$curr_id."' AND users = '".$_SESSION['user']."'";
        DataBase::make_query($query);
    }
    public function compare_notifications(array $old_arr, array $new_arr){
        if(!isset($_SESSION['user'])){
            return;
        }
        if(count($old_arr) != count($new_arr)){
            return false;
        }
        foreach($new_arr as $element=>$value){
            if(!array_key_exists($element, $old_arr)){
                return false;
            }
            if($value != $old_arr[$element])
                return false;
        }
        return true;
    }
     

}
?>
