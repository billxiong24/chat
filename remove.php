<?php
include 'ChatManager.class.php';
include 'DataBase.class.php';
include 'ChatLine.class.php';
include 'ChatUser.class.php';
include 'Display.class.php';
session_start();
if(isset($_SESSION['user']) && isset($_POST['removeID'])){
    DataBase::init();
    $curr = ChatManager::load_chat_id($_POST['removeID']);

    $manager = new ChatManager($curr['id'], $curr['name'], ChatManager::load_chat_users());
    $manager->remove_chat();
    $chats = ChatManager::load_chats(); 
    echo json_encode(array("list"=>Display::reload_delete($chats)));
}

?>
