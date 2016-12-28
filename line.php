<?php
include 'ChatManager.class.php';
include 'DataBase.class.php';
include 'ChatLine.class.php';
include 'ChatUser.class.php';
	session_start();
	if(isset($_POST['text']) && isset($_SESSION['user']) && isset($_SESSION['manager'])){
		DataBase::init();

		$manager = $_SESSION['manager'];
        
        //$test = $manager->chat_exists();
        if($manager->chat_exists()){
		    echo json_encode(array("deleted"=>false));
		    $manager->submit_chat($_POST['text']);
        }
        else{
		    echo json_encode(array("deleted"=>true));
        }
	}
	else{
		//TODO some error checking
	}
?>
