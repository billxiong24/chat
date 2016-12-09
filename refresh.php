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
    $curr_chat = $_SESSION['id'][0];
    $chat = ChatManager::load_chats();
    $curr = "";
    while($curr = mysqli_fetch_assoc($chat)){
        if($curr['id'] == $curr_chat)
            break;
    }
   
     
	$manager = new ChatManager($curr['id'], $curr['name'], explode(",", $curr['users']));
	$message_info = Display::change_messages($manager);
    $messages = $message_info[0];
    $lines = $message_info[1];
    $chats = Display::change_chat_list($chat);

    $scroll = false;
    if($_SESSION['lines'] < $lines)
        $scroll = true;
    $_SESSION['lines'] = $lines;
    echo json_encode(array("messages"=>$messages, "chats"=>$chats, "toScroll"=>$scroll));
}

?>
