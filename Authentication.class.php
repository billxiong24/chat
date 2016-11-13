<?php
class Authentication{
    public static function login($username, $password){
        $auth = "SELECT password FROM users WHERE (username = '".$username."' AND password = '".$password."')";   
        $result = DataBase::make_query($auth);
        $count = 0;
        while($row = mysqli_fetch_assoc($result)){
            $count++;
        } 
        //if there is a match, authentication was correct
        return $count ? true : false;
    }
    public static function logout($username){
     
    
    }
?>
