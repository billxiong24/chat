<?php
include 'Authentication.class.php';
include 'ChatUser.class.php';
if(isset($_POST['user-signup']) && isset($_POST['password-signup'])){
    DataBase::init();
    //check if username already exists
        $first = $_POST['firstname-signup'];
        $last = $_POST['lastname-signup'];
        $user=$_POST['user-signup'];
        $pass=$_POST['password-signup'];
        
        $new_user = new ChatUser($first, $last, $user, $pass);
        $test = $new_user->add_user();
        if($test){
            session_start();
            $_SESSION['user'] = $user;
            header("Location: home.php");
        }
        else{
            header("Location: index.php");
        }
}
else{
    header("Location: index.php");
}


?>
