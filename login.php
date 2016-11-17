<?php
include 'Authentication.class.php';
    echo "hey";
    if(isset($_POST['username']) && isset($_POST['password'])){
        echo "worked";
        DataBase::init();
        if(Authentication::login($_POST['username'], $_POST['password'])){
            session_start();
            $_SESSION['user'] = $_POST['username'];
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
