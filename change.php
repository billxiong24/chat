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

    //need to update last message id since we switched a chat
    $_SESSION['last_message_id'] = $manager->load_last_id()['line_id']; 
	$title = Display::change_title($curr);

    /**
     * TODO find a way to cache the messages so we don't 
     * have to reload them everytime user changes chats. 
     */
	$messages = Display::change_messages($manager);
	$_SESSION['id'] = array($curr['id'], $curr['name'], explode(",", $curr['users']));
	echo json_encode(array("title"=>$title, "messages"=>$messages[0]));

}




?>
