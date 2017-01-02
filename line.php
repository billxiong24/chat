<?php
include 'UserController.class.php';
	session_start();
	if(isset($_POST['text']) && isset($_SESSION['user'])){
        echo json_encode($_SESSION['user_controller']->submit_chat($_POST['text']));
	}
?>
