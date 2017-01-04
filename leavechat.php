<?php
include 'UserController.class.php';
session_start();
if(isset($_SESSION['user'])){
    $_SESSION['user_controller']->leave_chat();
    echo json_encode(array());
}


?>
