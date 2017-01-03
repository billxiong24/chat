<?php
include_once 'ChatLine.class.php';
include_once 'DataBase.class.php';
include_once 'ChatUser.interface.php';
class ChatUser implements ChatUserInterface{
    private $first, $last, $username, $password;

    public function __construct($first, $last, $user, $password){
        $this->first = $first;
        $this->last = $last;
        $this->username = $user;
        $this->password = $password;
    }
    public function add_chat_user($new_user, $id, $name){
        $query = "INSERT INTO chat_updates (id, users, name) VALUES ('".$id."', '".$new_user."', '".$name."')"; 
        DataBase::make_query($query);
    } 
    public function add_chat(array $users, $id, $name){
        $query = "INSERT INTO chats (id) VALUES ('".$id."')"; 
        DataBase::make_query($query);

        foreach($users as $user){
            $query2 = "INSERT INTO chat_updates (id, name, users) VALUES ('".$id."', '".$name."', '".$user."')";
            DataBase::make_query($query2);
        }

    }
    public function submit_chat($chat, $id){
        $chat_line = new ChatLine($chat, $_SESSION['user'], $id);
        $chat_line->insert_line();  
    }
    public function add_user(){
        $check = "SELECT * FROM users WHERE username = '".$this->username."'";
        $res = DataBase::make_query($check);
        $count = 0;
        while($row = mysqli_fetch_assoc($res)){
            $count++;
        }
        //user exists
        if($count){
           return false;
        }

        $query = "INSERT INTO users (username, password, first, last) ";
        $query .= "VALUES ('".$this->username."','".$this->password."', '".$this->first."', '".$this->last."')"; 
        DataBase::make_query($query);     

        /* insert into notifications database, empty notifications first*/
        $notif_query = "INSERT INTO notifications (user, notifs) VALUES ('".$this->username."', '')";
        DataBase::make_query($notif_query);

        return true;
    }
    public static function check_user_exists($user){
        $check = "SELECT * FROM users WHERE username = '".$user."'";
        $res = DataBase::make_query($check);
        $count = 0;
        while($row = mysqli_fetch_assoc($res)){
            $count++;
        }
        return $count;
    }    
    
}
?>
