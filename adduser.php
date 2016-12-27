<?php
include 'ChatUser.class.php';
include 'ChatManager.class.php';
include 'DataBase.class.php';
include 'Display.class.php';
include 'ChatLine.class.php';
session_start();
//TODO change works now
if(isset($_SESSION['user']) && isset($_POST['useradd'])){
    DataBase::init();
    
    $manager = $_SESSION['manager'];

    $chat_id = $manager->get_id();
    $name = $manager->get_name();
    $people = $manager->get_users(); 
    
    $joined = false; 

    if(strpos(join(" ", $people), $_POST['useradd']) == false && $_POST['useradd'] !== $_SESSION['user']){
        $joined = true;               
        
        if(ChatUser::check_user_exists($_POST['useradd']))
            $manager->add_user($_POST['useradd']);
        else
            $joined = false;

        $arr = array("name"=>$name, "users"=>join(",", $manager->get_users()));
        $new_title = Display::change_title($manager); 
        echo json_encode(array("duplicate"=> $joined, "new_title"=>$new_title));
    }
    else{
        echo json_encode(array("duplicate"=>false));
    }

}
?>
