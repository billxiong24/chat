<?php
include 'SessionController.class.php';
	session_start();
	if(isset($_POST['text']) && isset($_SESSION['user'])){
        echo json_encode($_SESSION['session_controller']->get_user_controller()->submit_chat($_POST['text']));
	}
?>
