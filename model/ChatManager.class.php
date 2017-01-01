<?php
class ChatManager{
    
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

    public function chat_exists(){
        $query = "SELECT id FROM chats WHERE id = '".$this->chat_id."'";
        $result = DataBase::make_query($query);
        $this->exists = $result->num_rows != 0; 
        return $this->exists;
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
    public function remove_chat(){
        $query = "DELETE FROM chats WHERE id = '".$this->chat_id."'"; 
        DataBase::make_query($query);
        $delete_lines = "DELETE FROM chat_lines WHERE chat_id = '".$this->chat_id."'";
        DataBase::make_query($delete_lines);

        $delete_updates = "DELETE FROM chat_updates WHERE id = '".$this->chat_id."'";
        DataBase::make_query($delete_updates);
        $this->exists = false;
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
        $chat_line = new ChatLine($chat, $_SESSION['user'], $this->chat_id);
        $chat_line->insert_line();  
         
        //TODO add html to display chat on frontend 
    
    }
    public function add_user($user){
        //TODO error checking
        array_push($this->users, $user);
        $query = "INSERT INTO chat_updates (id, users, name) VALUES ('".$this->chat_id."', '".$user."', '".$this->chat_name."')"; 
        DataBase::make_query($query);
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
