<?php
include 'NotificationController.class.php';
session_start();

if(isset($_SESSION['user'])){
    $_SESSION['notif_controller']->increment_notifications();
    echo json_encode(array());
}


?>
