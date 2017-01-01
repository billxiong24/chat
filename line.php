<?php
include 'ChatManager.class.php';
include 'DataBase.class.php';
include 'ChatLine.class.php';
include 'ChatUser.class.php';
include 'Controller.class.php';
	session_start();
	if(isset($_POST['text']) && isset($_SESSION['user'])){
        echo json_encode($_SESSION['user_controller']->submit_chat($_POST['text']));
	}
?>
