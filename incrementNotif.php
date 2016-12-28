<?php
include 'ChatManager.class.php';
include 'Notification.class.php';
include 'DataBase.class.php';
include 'Display.class.php';

session_start();

if(isset($_SESSION['user'])){
    DataBase::init();
     $_SESSION['notifs']->increment_notifications();
    echo json_encode(array());
}


?>
