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
    $notifications = $notif_manager->retrieve_notifications(); 
    $display = Display::display_notifications($notifications);
    echo json_encode(array("notifs"=>$display));
}

?>
