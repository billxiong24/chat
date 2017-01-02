<?php
include 'UserController.class.php';
session_start();

//TODO change works now
if(isset($_SESSION['user']) && isset($_POST['useradd'])){
    echo json_encode($_SESSION['user_controller']->add_user($_POST['useradd']));
}
?>
