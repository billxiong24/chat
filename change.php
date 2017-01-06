<?php
include 'ChatController.class.php';
include 'NotificationController.class.php';
include 'UserController.class.php';
include 'SessionController.class.php';
session_start();
//supposedly works now

if(isset($_SESSION['user']) && isset($_POST['chatID'])){
        DataBase::init();
        $curr = ChatManager::load_chat_id($_POST['chatID']);
        $_SESSION['last_chat_id'] = $curr['id'];
        $new_users = ChatManager::load_chat_users($curr['id']);
        $_SESSION['session_controller']->change_controller_attributes($curr['id'], $curr['name'], $new_users);
        echo json_encode($_SESSION['session_controller']->get_user_controller()->change_chat($_POST['chatID']));
}
else{
    echo "error here";
}

?>
