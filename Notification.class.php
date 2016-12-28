<?php
'include ChatManager.class.php';
class Notification{
    
    private $manager;
    private $notif_ids; 

    //TODO change parameter to interface, instead of passing in entire class
    //Takes in ChatManager object
    public function __construct($manager){
        DataBase::init();
        $this->manager= $manager; 
    }
    public function set_manager($new_manager){
        $this->manager = $new_manager;
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
        $query = "SELECT notifications FROM chat_updates WHERE users = '".$_SESSION['user']."'";
        $res = DataBase::make_query($query);

        while($row = mysqli_fetch_assoc($res)){
            array_push($notifications, $row['notifications']);
        }
        return $notifications;
    }
     

}
?>
