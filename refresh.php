<?php
include 'ChatManager.class.php';
include 'DataBase.class.php';
include 'ChatLine.class.php';
include 'ChatUser.class.php';
include 'Display.class.php';
session_start();
if(isset($_SESSION['user'])){
    DataBase::init();
    //TODO make session variable to store current chat id
    
     
	$manager = new ChatManager($_SESSION['id'][0], $_SESSION['id'][1], explode(",", $_SESSION['id'][2]));

    $last_id = $manager->load_last_id(); 
    if($_SESSION['last_message_id'] != $last_id){
        $_SESSION['last_message_id'] = $last_id;

        $message_info = Display::change_messages($manager);
        $messages = $message_info[0];
        $lines = $message_info[1];
        $chats = Display::change_chat_list($chat);

        $_SESSION['lines'] = $lines;
        $change = true;
        echo json_encode(array("lastid"=>$last_id, "change"=>true, "messages"=>$messages, "chats"=>$chats));
    }
    else{
        echo json_encode(array("change"=>false));
    }
    
}

?>
