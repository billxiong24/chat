<?php
include 'ChatManager.class.php';
include 'Notification.class.php';
include 'DataBase.class.php';
include 'ChatLine.class.php';
include 'ChatUser.class.php';
include 'Display.class.php';
include 'Controller.class.php';
session_start();
//supposedly works now

if(isset($_SESSION['user']) && isset($_POST['chatID'])){
    echo json_encode($_SESSION['user_controller']->change_chat($_POST['chatID']));
}
else{
    echo "error here";
}

?>
