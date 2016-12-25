<?php
class ChatManager{
    
    private $chat_id;
    private $chat_name;
    private $users;
    public function __construct($id, $name = "Chat", $people = array()){
        $this->chat_id = $id;
        $this->users = $people; 
        $this->chat_name = $name;
    }
    public function get_name(){
        return $this->chat_name;
    }
    public function get_users(){
        return $this->users;
    }
    public function add_chat(){ 
        //TODO real error handling
        echo "adding chat";
        if(!isset($_SESSION['user'])){
            echo "Not logged in";
            return;
        }
        //TODO rehash or something idk
        if($this->check_duplicate_chats()){
            echo "duplicate chats";
            return;
        }
        $joined_users = join(",", $this->users);
        $query = "INSERT INTO chats (id, name, users) VALUES ('".$this->chat_id."','".$this->chat_name."' ,'".$joined_users."')"; 
        DataBase::make_query($query);
    }
    public function remove_chat(){
        $query = "DELETE FROM chats WHERE id = '".$this->chat_id."'"; 
        DataBase::make_query($query);
        $delete_lines = "DELETE FROM chat_lines WHERE chat_id = '".$this->chat_id."'";
        DataBase::make_query($delete_lines);
    }
    public static function load_chats(){
        $username = $_SESSION['user'];
        if(!isset($_SESSION['user'])){
            return;
        }         
        $query = "SELECT * FROM chats WHERE users LIKE '%{$username}%'"; 
        return DataBase::make_query($query);
    }
    public function load_last_id(){
        $username = $_SESSION['user'];
        if(!isset($_SESSION['user'])){
            return;
        }         
         
        //$query = "SELECT LAST FROM chat_lines WHERE chat_id = '".$this->chat_id."'";
        $query1 = "SELECT @last_id := MAX(line_id) FROM chat_lines WHERE chat_id = '".$this->chat_id."'";
        DataBase::make_query($query1);
        
        
        $query2 = "SELECT line_id FROM chat_lines WHERE line_id = @last_id"; 
        $result = DataBase::make_query($query2);
        $row = mysqli_fetch_assoc($result);
        return $row['line_id'];
    }
    public function load_chat_lines(){
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
        $joined_users = join(",", $this->users);
        $query = "UPDATE chats SET users='".$joined_users."' WHERE id='".$this->chat_id."'";
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
