<?php
include 'ChatManager.class.php';
include 'DataBase.class.php';
include 'ChatLine.class.php';
include 'ChatUser.class.php';
	session_start();
	if(isset($_POST['text']) && isset($_SESSION['user']) && isset($_SESSION['manager'])){
		DataBase::init();
		echo json_encode(array("user"=>$_SESSION['user'], "message"=>$_POST['text']));
		$manager = $_SESSION['manager'];
		$manager->submit_chat($_POST['text']);
	}
	else{
		//TODO some error checking
	}
?>
