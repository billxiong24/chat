<?php
include 'ChatManager.class.php';
include 'Notification.class.php';
include 'DataBase.class.php';
include 'ChatLine.class.php';
include 'ChatUser.class.php';
include 'Display.class.php';
session_start();
//supposedly works now

if(isset($_SESSION['user']) && isset($_POST['chatID'])){
	DataBase::init();
	//TODO make more efficient
    $curr = ChatManager::load_chat_id($_POST['chatID']);
	$manager = new ChatManager($curr['id'], $curr['name'], ChatManager::load_chat_users($curr['id']));

    $_SESSION['last_chat_id'] = $curr['id'];
    unset($_SESSION['manager']);
    $_SESSION['manager'] = $manager;
    $_SESSION['notifs']->set_manager($manager);
    //need to update last message id since we switched a chat
    $_SESSION['last_message_id'] = $manager->load_last_id()['line_id']; 
	$title = Display::change_title($manager);

    /**
     * TODO find a way to cache the messages so we don't 
     * have to reload them everytime user changes chats. 
     */
	$messages = Display::change_messages($manager);
	echo json_encode(array("title"=>$title, "messages"=>$messages[0]));
}

?>
