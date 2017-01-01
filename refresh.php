<?php
include 'ChatManager.class.php';
include 'DataBase.class.php';
include 'ChatLine.class.php';
include 'ChatUser.class.php';
include 'Display.class.php';
include 'Controller.class.php';
session_start();
if(isset($_SESSION['user'])){
    echo json_encode($_SESSION['user_controller']->refresh_messages($_SESSION['last_message_id']));
}
else{
    echo json_encode(array("logged_in"=>false));
}

?>
