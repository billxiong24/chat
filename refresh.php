<?php
include 'SessionController.class.php';

session_start();
if(isset($_SESSION['user'])){
    echo json_encode($_SESSION['session_controller']->get_chat_controller()->refresh_messages());
}
else{
    echo json_encode(array("logged_in"=>false));
}

?>
