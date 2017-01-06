<?php
include 'SessionController.class.php';
session_start();
if(isset($_SESSION['user'])){
    echo json_encode($_SESSION['session_controller']->get_chat_controller()->refresh_chat_list());
}
?>
