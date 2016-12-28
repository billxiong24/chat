<?php
include 'ChatManager.class.php';
include 'Notification.class.php';
include 'DataBase.class.php';
include 'ChatLine.class.php';
include 'ChatUser.class.php';
include 'Display.class.php';
session_start();
if(isset($_SESSION['user'])){
    DataBase::init();
    $notif_manager = $_SESSION['notifs'];
    
	$manager = $_SESSION['manager'];
    $last_id = $manager->load_last_id(); 

    if($_SESSION['last_message_id'] != $last_id['line_id']){
        $_SESSION['last_message_id'] = $last_id['line_id'];
        $manager->update_timestamp();  

        $num_messages = $notif_manager->get_num_new_messages();
        $messages = Display::display_latest_message($last_id['username'], $last_id['text']);
        $chats = Display::change_chat_list($chat);
        
        echo json_encode(array("change"=>true, "messages"=>$messages, "chats"=>$chats));
    }
    else{
        echo json_encode(array("change"=>false));
    }
}

?>
