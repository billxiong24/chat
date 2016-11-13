<?php
include 'ChatManager.class.php';
include 'DataBase.class.php';
include 'ChatLine.class.php';
include 'ChatUser.class.php';
	session_start();
	if(isset($_POST['create']) && isset($_SESSION['user'])){
		DataBase::init();
		$numbers = range(1, 100);
		shuffle($numbers);
		echo $numbers[0];
		echo $_POST['chatname'];
		echo $_POST['user'];
		$chat = new ChatManager($numbers[0], $_POST['chatname'], array($_SESSION['user'], $_POST['user']));
		$chat->add_chat();
	}
	else{
		echo "wowowo";
	}
	header('Location: home.php');
?>