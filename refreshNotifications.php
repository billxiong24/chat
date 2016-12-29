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
    if(!$notif_manager->compare_notifications($_SESSION['last_notifs'], $notifications)){
        $_SESSION['last_notifs'] = $notifications;
        echo json_encode(array("changed"=>true, "notifications"=>$notifications));
    }
    else{
        echo json_encode(array("changed"=>false));
    }
}

?>
