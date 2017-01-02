<?php
include_once 'ChatUser.class.php';
include_once 'DataBase.class.php';
include_once 'ChatManager.interface.php';
class ChatManager implements ChatManagerInterface{
    
    private $chat_id;
    private $chat_name;
    private $users;
    private $exists;

    public function __construct($id, $name = "Chat", $people = array()){
        $this->chat_id = $id;
        $this->users = $people; 
        $this->chat_name = $name;
        $this->exists = true;
    }
    public function get_id(){
        return $this->chat_id;
    }
    public function get_name(){
        return $this->chat_name;
    }
    public function get_users(){
        return $this->users;
    }
    public function set_id($id){
        $this->chat_id = $id;
    }
    public function set_name($name){
        $this->chat_name = $name;
    }
    public function set_users($users){
        $this->users = $users;
    }

    public function add_chat(){ 
        //TODO real error handling
        if(!isset($_SESSION['user'])){
            echo "Not logged in";
            return;
        }
        //TODO rehash or something idk
        if($this->check_duplicate_chats()){
            echo "duplicate chats";
            return;
        }
        
        $query = "INSERT INTO chats (id) VALUES ('".$this->chat_id."')"; 
        DataBase::make_query($query);

        foreach($this->users as $user){
            $query2 = "INSERT INTO chat_updates (id, name, users) VALUES ('".$this->chat_id."', '".$this->chat_name."', '".$user."')";
            DataBase::make_query($query2);
        }
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
         
        //$query = "SELECT LAST FROM chat_lines WHERE chat_id = '".$this->chat_id."'";
        $query1 = "SELECT @last_id := MAX(line_id) FROM chat_lines WHERE chat_id = '".$this->chat_id."'";
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
        $query = "UPDATE chats SET timestamp=now() WHERE id='".$this->chat_id."'";
        DataBase::make_query($query);
    }
    public function load_chat_lines(){
        if(!isset($_SESSION['user'])){
            return;
        }         
        $query = "SELECT * FROM chat_lines WHERE chat_id = '".$this->chat_id."'";
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
            $chat_line = new ChatLine($chat, $_SESSION['user'], $this->chat_id);
            $chat_line->insert_line();  
            return true;
        }
        return false; 
    }
    public function add_user($new_user){
        //TODO error checking
        DataBase::init(); 
        $people = $this->users;

        if(strpos(join(" ", $people), $new_user) == false && $new_user !== $_SESSION['user'] && ChatUser::check_user_exists($new_user)){
            array_push($this->users, $new_user);
            $query = "INSERT INTO chat_updates (id, users, name) VALUES ('".$this->chat_id."', '".$new_user."', '".$this->chat_name."')"; 
            DataBase::make_query($query);
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
        $this->set_id($curr['id']);
        $this->set_name($curr['name']);
        $this->set_users($new_users);
        
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
        if($num_chats != count($_SESSION['chat_ids'])){
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
    private function remove_chat_query(){
        $query = "DELETE FROM chats WHERE id = '".$this->chat_id."'"; 
        DataBase::make_query($query);
        $delete_lines = "DELETE FROM chat_lines WHERE chat_id = '".$this->chat_id."'";
        DataBase::make_query($delete_lines);

        $delete_updates = "DELETE FROM chat_updates WHERE id = '".$this->chat_id."'";
        DataBase::make_query($delete_updates);
        $this->exists = false;
    }
    private function chat_exists(){
        $query = "SELECT id FROM chats WHERE id = '".$this->chat_id."'";
        $result = DataBase::make_query($query);
        $this->exists = $result->num_rows != 0; 
        return $this->exists;
    }

    private function check_duplicate_chats(){
        $query = "SELECT * FROM chats WHERE id = '".$this->chat_id."'";
        $res = DataBase::make_query($query);
        $count = 0; 
        while($row = mysqli_fetch_assoc($res)){
            $count++;
        }
        return $count;
    }    
}
?>
