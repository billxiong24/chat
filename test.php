<?php
include 'ChatManager.class.php';
include 'DataBase.class.php';
include 'ChatLine.class.php';
include 'ChatUser.class.php';
DataBase::init();
$user = new ChatUser("bill", "xiong", "wwx", "password");
$user2 = new ChatUser("harry", "wang", "hw12", "pass");
$_SESSION['user'] = "wwx";

$user->add_user();
$user2->add_user();
$chat = new ChatManager(16, "Group chat 2", array("wwx"));
$chat->add_chat();
$chat->add_user("hw12");

//$chat->submit_chat("hello world test chatting :)");
$arr = $chat->load_chat_lines();
while($row = mysqli_fetch_assoc($arr)){
    echo $row['username'] . ": " . $row['text'] . '<br/>';
}
//$chatline = new ChatLine("howdy", "william", 24);
//$chatline->insert_line();

echo "hey";
?>
