<?php
include 'ChatController.class.php';
session_start();
if(isset($_SESSION['user'])){
    echo json_encode($_SESSION['chat_controller']->refresh_chat_list());
}
?>
