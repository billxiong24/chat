<?php
include 'SessionController.class.php';
session_start();
if(isset($_SESSION['user']) && isset($_POST['removeID'])){
    echo json_encode($_SESSION['session_controller']->get_chat_controller()->remove_chat($_POST['removeID']));
}

?>
