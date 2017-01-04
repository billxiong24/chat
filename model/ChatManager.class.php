<?php
include_once 'ChatUser.class.php';
include_once 'DataBase.class.php';
include_once 'Manager.class.php';
include_once 'Notification.class.php';
class ChatManager extends Manager{
    
    private $exists;
    private $notif_manager;
    private $chat_user_manager;
    public function __construct($id, $name = "Chat", $people = array()){
        parent::__construct($id, $name, $people);
        $this->notif_manager = new Notification();
        $this->chat_user_manager = new ChatUser(null, null, null, null);
        $this->exists = true;
    }
    public function get_session_last_notifs(){
        return $_SESSION['last_notifs'];
    }

    public function set_attributes($id, $name, $people){
        parent::set_chat_id($id);
        parent::set_chat_name($name);
        parent::set_chat_users($people);
    }

    public function add_chat(){ 
        //TODO real error handling
        if(!isset($_SESSION['user'])){
            echo "Not logged in";
            return;
        }
        //TODO rehash or something idk
        if($this->check_duplicate_chats()){
            return;
        }
        DataBase::init();
        $this->chat_user_manager->add_chat(parent::get_users(), parent::get_id(), parent::get_name());
    }
    public static function load_chat_id($chat_id){
        $user = $_SESSION['user'];
        if(!isset($user)){
            return;
        }
        $query = "SELECT * FROM chat_updates WHERE users = '".$user."' AND id = '".$chat_id."'";
        $result = DataBase::make_query($query);
        return mysqli_fetch_assoc($result);
    }
    public static function load_chats(){
        if(!isset($_SESSION['user'])){
            return;
        }         
        $query = "SELECT * FROM chat_updates AS up JOIN chats AS ch on up.id = ch.id WHERE users = '".$_SESSION['user']."' ORDER by ch.timestamp DESC";
        return DataBase::make_query($query);
    }
    public static function load_chat_users($chat_id){
        $names = "SELECT users FROM chat_updates WHERE id = '".$chat_id."'";
        $name_results = DataBase::make_query($names);
        $users = array();
        while($row = mysqli_fetch_assoc($name_results)){
            array_push($users, $row['users']);
        }
        return $users;
            
    }

    public function load_last_id(){
        $username = $_SESSION['user'];
        if(!isset($_SESSION['user'])){
            return;
        }         
         
        //$query = "SELECT LAST FROM chat_lines WHERE chat_id = '".parent::get_id()."'";
        $query1 = "SELECT @last_id := MAX(line_id) FROM chat_lines WHERE chat_id = '".parent::get_id()."'";
        DataBase::make_query($query1);
        
        
        $query2 = "SELECT * FROM chat_lines WHERE line_id = @last_id"; 
        $result = DataBase::make_query($query2);
        $row = mysqli_fetch_assoc($result);
        return $row;
    }
    public function update_timestamp(){
        if(!isset($_SESSION['user'])){
            return;
        }         
        $query = "UPDATE chats SET timestamp=now() WHERE id='".parent::get_id()."'";
        DataBase::make_query($query);
    }
    public function load_chat_lines(){
        if(!isset($_SESSION['user'])){
            return;
        }         
        $query = "SELECT * FROM chat_lines WHERE chat_id = '".parent::get_id()."'";
        return DataBase::make_query($query);
    }
    public function submit_chat($chat){
        //TODO throw some sort of error here.
        if(!isset($_SESSION['user'])) 
            return;
        if(!$chat){
            return;
        }
        DataBase::init();
        if($this->chat_exists()){
            $this->chat_user_manager->submit_chat($chat, parent::get_id());
            return true;
        }
        return false; 
    }
    public function add_user($new_user){
        //TODO error checking
        DataBase::init(); 
        $people = parent::get_users();

        if(strpos(join(" ", $people), $new_user) == false && $new_user !== $_SESSION['user'] && ChatUser::check_user_exists($new_user)){
            parent::add_to_users($new_user);
            $this->chat_user_manager->add_chat_user($new_user, parent::get_id(), parent::get_name());
            return true;
        }

        return false;
    } 
    public function change_chat($chat_id){
        DataBase::init();
        $curr = self::load_chat_id($chat_id);
        $_SESSION['last_chat_id'] = $curr['id'];
        $new_users = self::load_chat_users($curr['id']);

        //update manager attributes
        $this->set_attributes($curr['id'], $curr['name'], $new_users);
        $_SESSION['last_message_id'] = $this->load_last_id()['line_id'];
    }
    public function refresh_messages(){
        DataBase::init();
        $last_id = $this->load_last_id();
        if($_SESSION['last_message_id'] != $last_id['line_id']){
            $_SESSION['last_message_id'] = $last_id['line_id'];
            $this->update_timestamp();
            return $last_id;
        }
        return null;
    }
    public function refresh_chat_list(){
        DataBase::init();
        $result = self::load_chats();
        $num_chats = mysqli_num_rows($result);
        $last_message_diffs = $this->check_last_messages($result);
        if($num_chats != count($_SESSION['chat_ids']) || $last_message_diffs){
            $_SESSION['chat_ids'] = array();
            mysqli_data_seek($result, 0);
            while($row = mysqli_fetch_assoc($result)){
                array_push($_SESSION['chat_ids'], $row['id']);
            }
            return $result;
        }
        return null;
    }
    public function remove_chat($remove_id){
        DataBase::init();
        $curr = self::load_chat_id($remove_id);
        $manager = new ChatManager($curr['id'], $curr['name'], ChatManager::load_chat_users());
        $manager->remove_chat_query();
        return self::load_chats(); 
    }
    public function leave_chat(){
        DataBase::init();
        $id = parent::get_id();
        $this->chat_user_manager->remove_from_chat($id, $_SESSION['user']);
    }

    /**
     * Notification methods
     *
     */
    public function increment_notifications(){
        return $this->notif_manager->increment_notifications(parent::get_id());

    }
    public function retrieve_notifications(){
        return $this->notif_manager->retrieve_notifications();
    }
    public function reset_notifications(){
        $this->notif_manager->reset_notifications(parent::get_id());
    }

    public function compare_notifications(array $old_arr, array $new_arr){
        return $this->notif_manager->compare_notifications($old_arr, $new_arr);
    }

    private function check_last_messages($result){
        mysqli_data_seek($result, 0);
        $different = false;
        $new_arr = array();
        while($row = mysqli_fetch_assoc($result)){
            $manager = new ChatManager($row['id']);
            $message = $manager->load_last_id();
            $new_arr[$row['id']] = $message;
            if($_SESSION['last_messages'][$row['id']]['line_id'] != $message['line_id']){
                $different = true;
            }
        }
        if($different){
            $_SESSION['last_messages'] = $new_arr;
        }
        return $different; 
    }
    private function remove_chat_query(){
        $query = "DELETE FROM chats WHERE id = '".parent::get_id()."'"; 
        DataBase::make_query($query);
        $delete_lines = "DELETE FROM chat_lines WHERE chat_id = '".parent::get_id()."'";
        DataBase::make_query($delete_lines);

        $delete_updates = "DELETE FROM chat_updates WHERE id = '".parent::get_id()."'";
        DataBase::make_query($delete_updates);
        $this->exists = false;
    }
    private function chat_exists(){
        $query = "SELECT id FROM chats WHERE id = '".parent::get_id()."'";
        $result = DataBase::make_query($query);
        $this->exists = $result->num_rows != 0; 
        return $this->exists;
    }

    private function check_duplicate_chats(){
        $query = "SELECT * FROM chats WHERE id = '".parent::get_id()."'";
        $res = DataBase::make_query($query);
        $count = 0; 
        while($row = mysqli_fetch_assoc($res)){
            $count++;
        }
        return $count;
    }    
}
?>
