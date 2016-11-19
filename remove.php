<?php
include 'ChatManager.class.php';
include 'DataBase.class.php';
include 'ChatLine.class.php';
include 'ChatUser.class.php';
include 'Display.class.php';
session_start();
if(isset($_SESSION['user']) && isset($_POST['removeID'])){
    DataBase::init();
    $chat = ChatManager::load_chats();
    $curr = "";
    while($curr = mysqli_fetch_assoc($chat)){
        if($curr['id'] == $_POST['removeID'])
            break;
    
    }
    $manager = new ChatManager($curr['id'], $curr['name'], explode(",", $curr['users']));
    $manager->remove_chat();
    $chats = ChatManager::load_chats();  
    echo json_encode(array("list"=>reload_delete($chats)));

}
function reload_delete($chats){
    mysqli_data_seek($chats, 0);
    $html = "";
    while($row = mysqli_fetch_assoc($chats)){
        $html .= '<div class="chat-user">
                <form class="change-chat" '. 'id=' . $row["id"] .' method = "post" action="change.php">
                <img class="chat-avatar" src="img/a4.jpg" alt="" >
                <div class="chat-user-name">
                    <input class = "btn" type="submit" name = "chatname"' .' value="'. $row["name"] .'">
                </div>
                </form>
                <form class="remove-chat" method="post" action="remove.php" id='.$row["id"].'>
                <button class="small-buttons pull-right" type="submit" style="margin-top: -35px"><i class="fa fa-trash"></i></button>
                </form>
                </div>';
    }
    return $html;
}
?>
