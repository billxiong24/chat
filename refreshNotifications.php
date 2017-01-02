<?php
include 'NotificationController.class.php';
session_start();
if(isset($_SESSION['user'])){
    echo json_encode($_SESSION['notif_controller']->refresh_notifications($_SESSION['last_notifs']));

}

?>
