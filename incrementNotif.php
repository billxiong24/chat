<?php
include 'SessionController.class.php';
session_start();

if(isset($_SESSION['user'])){
    $_SESSION['session_controller']->get_notif_controller()->increment_notifications();
    echo json_encode(array());
}


?>
