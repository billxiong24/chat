<?php
include 'ChatManager.class.php';
include 'DataBase.class.php';
include 'ChatLine.class.php';
include 'ChatUser.class.php';
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
	$title = change_title($curr);
	$messages = change_messages($manager);
	$_SESSION['id'] = array($curr['id'], $curr['name'], explode(",", $curr['users']));
	echo json_encode(array("title"=>$title, "messages"=>$messages));

}


function change_title(array $curr){
	return '<small class="pull-right text-muted">Last message:  Mon Jan 26 2015 - 18:39:23</small>'
                            .$curr["name"] . ' (' . $curr['users'] . ')<a style="margin-left: 20px">Add user</a><a style="margin-left: 20px">Leave chat</a>';
}

function change_messages($manager){
	$lines = $manager->load_chat_lines();
	$message = "";
    while($row = mysqli_fetch_assoc($lines)){
	         $message .= '<div class="chat-message left">
	        <img class="message-avatar" src="img/a1.jpg" alt="" >
	        <div class="message">
	            <a class="message-author" href="#">'.$row['username'].'</a>
	            <span class="message-date"> Mon Jan 26 2015 - 18:39:23 </span>
	            <span class="message-content">'
	            . $row['text'] .
	            '</span>
	        </div>
	    </div>';
	}
	return $message;

}


?>