<?php
include 'Authentication.class.php';
include 'ChatUser.class.php';
if(isset($_POST['user-signup']) && isset($_POST['password-signup'])){
    DataBase::init();
    //check if username already exists
        $new_user = new ChatUser("test", "test", $_POST['user-signup'], $_POST['password-signup']);
        $test = $new_user->add_user();
        if($test){
            session_start();
            $_SESSION['user'] = $_POST['user-signup'];
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
