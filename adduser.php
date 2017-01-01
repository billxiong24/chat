<?php
include_once 'ChatUser.class.php';
include_once 'ChatManager.class.php';
include_once 'DataBase.class.php';
include_once 'Display.class.php';
include_once 'ChatLine.class.php';
include 'Controller.class.php';
session_start();

//TODO change works now
if(isset($_SESSION['user']) && isset($_POST['useradd'])){
    //DataBase::init();
    //
    //$manager = $_SESSION['manager'];

    //$chat_id = $manager->get_id();
    //$name = $manager->get_name();
    //$people = $manager->get_users(); 
    //
    //$joined = false; 

    //if(strpos(join(" ", $people), $_POST['useradd']) == false && $_POST['useradd'] !== $_SESSION['user']){
    //    $joined = true;               
    //    
    //    if(ChatUser::check_user_exists($_POST['useradd']))
    //        $manager->add_user($_POST['useradd']);
    //    else
    //        $joined = false;

    //    $new_title = Display::change_title($manager); 
    //    echo json_encode(array("duplicate"=> $joined, "new_title"=>$new_title));
    //}
    //else{
    //    echo json_encode(array("duplicate"=>false));
    //}
    echo json_encode($_SESSION['user_controller']->add_user($_SESSION['user'], $_POST['useradd']));

}
?>
