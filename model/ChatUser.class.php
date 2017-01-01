<?php
class ChatUser{
    private $first, $last, $username, $password;
    private $notifications;

    public function __construct($first, $last, $user, $password){
        $this->first = $first;
        $this->last = $last;
        $this->username = $user;
        $this->password = $password;
        $this->notifications = array();
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
    public function fetch_notifications(){
        $query = "SELECT notifs FROM notifications WHERE user = '".$this->username."'";
        $result = DataBase::make_query($query);
        $row = mysqli_fetch_assoc($result);
        $this->notifications = explode(",", $row['notifs']);
        return $this->notifications;
    }

    public function update_notifications(array $new_notifs){
        $update = join(",", $new_notifs);
        echo $update;
        $query = "UPDATE notifications SET notifs = '".$update."' WHERE user = '".$this->username."'";
        DataBase::make_query($query);
        $this->notifications = $new_notifs;
        return $this->notifications;
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
