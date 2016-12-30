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
    $result = ChatManager::load_chats();
    $num_chats = mysqli_num_rows($result);
    $num_curr = count($_SESSION['chat_ids']);
    if($num_curr != $num_chats){
        $_SESSION['chat_ids'] = array();
        mysqli_data_seek($result, 0);
        while($row = mysqli_fetch_assoc($result)) {
            array_push($_SESSION['chat_ids'], $row['id']);
        }
        $list = Display::change_chat_list($result);
        echo json_encode(array("change"=>true, "newList"=>$list));

    }
    else{
        echo json_encode(array("change"=>false));
    }
}
?>
