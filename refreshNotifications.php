<?php
include 'SessionController.class.php';
session_start();
if(isset($_SESSION['user'])){
    echo json_encode($_SESSION['session_controller']->get_notif_controller()->refresh_notifications($_SESSION['last_notifs']));
}

?>
