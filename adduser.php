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
    
    $manager = $_SESSION['manager'];

    $chat_id = $manager->get_id();
    $name = $manager->get_name();
    $people = $manager->get_users(); 
    
    $joined = false; 

    if(strpos(join(",", $people), $_POST['useradd']) == false){
        $joined = true;               

        if(ChatUser::check_user_exists($_POST['useradd']))
            $manager->add_user($_POST['useradd']);
        else
            $joined = false;

        $arr = array("name"=>$name, "users"=>join(",", $manager->get_users()));
        $new_title = Display::change_title($arr); 
        echo json_encode(array("duplicate"=> $joined, "new_title"=>$new_title));
    }
    else{
        echo json_encode(array("duplicate"=>false));
    }

}
?>
