<?php
include 'ChatController.class.php';
session_start();
if(isset($_SESSION['user']) && isset($_POST['removeID'])){
    echo json_encode($_SESSION['chat_controller']->remove_chat($_POST['removeID']));
}

?>
