<?php
include 'Display.class.php';
session_start();
if(isset($_SESSION['user']) && isset($_POST['text'])){
    $time = date();
    $message = Display::display_latest_message($_SESSION['user'], $_POST['text'], $time);
    echo json_encode(array("message"=>$message, "original"=>$_POST['text']));
}
?>
