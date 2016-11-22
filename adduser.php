<?php
include 'ChatUser.class.php';
include 'ChatManager.class.php';
include 'DataBase.class.php';
include 'Display.class.php';
include 'ChatLine.class.php';
session_start();
if(isset($_SESSION['user']) && isset($_POST['useradd'])){
    DataBase::init();
    $chat_id = $_SESSION['id'][0]; 
    $name = $_SESSION['id'][1];
    $people = $_SESSION['id'][2]; 
    $joined = false; 
    if(strpos(join(",", $people), $_POST['useradd']) !== false){
        $joined = true;               
    }
    $manager = new ChatManager($chat_id, $name, $people); 
    $manager->add_user($_POST['useradd']);
    $arr = array("name"=>$name, "users"=>join(",", $manager->get_users()));
    $new_title = Display::change_title($arr); 
    echo json_encode(array("duplicate"=> $joined, "new_title"=>$new_title));
}
?>
