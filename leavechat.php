<?php
include 'SessionController.class.php';
session_start();
if(isset($_SESSION['user'])){
    $_SESSION['session_controller']->get_user_controller()->leave_chat();
    echo json_encode(array());
}


?>
