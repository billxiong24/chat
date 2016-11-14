<?php
include 'ChatManager.class.php';
include 'DataBase.class.php';
include 'ChatLine.class.php';
include 'ChatUser.class.php';
include 'Display.class.php';
session_start();
if(isset($_SESSION['user']) && isset($_POST['chatID'])){
	DataBase::init();
	//TODO make more efficient
	$chat = ChatManager::load_chats();
	$curr = "";
	while($curr = mysqli_fetch_assoc($chat)){
		if($curr['id'] == $_POST['chatID'])
			break;
	}
	$manager = new ChatManager($curr['id'], $curr['name'], explode(",", $curr['users']));
	$title = Display::change_title($curr);
	$messages = Display::change_messages($manager);
	$_SESSION['id'] = array($curr['id'], $curr['name'], explode(",", $curr['users']));
	echo json_encode(array("title"=>$title, "messages"=>$messages));

}




?>
