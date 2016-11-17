<?php
class ChatUser{
    private $first, $last, $username, $password;
    public function __construct($first, $last, $user, $password){
        $this->first = $first;
        $this->last = $last;
        $this->username = $user;
        $this->password = $password;
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
        return true;
    }
    
    
}
?>
