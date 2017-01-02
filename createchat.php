<?php
include 'ChatManager.class.php';
include_once 'DataBase.class.php';
include_once 'ChatLine.class.php';
include_once 'ChatUser.class.php';
session_start();

//works now apparen;y
if(isset($_POST['create']) && isset($_SESSION['user'])){
    DataBase::init();
    //TODO HASHING FUNCTION 
    $numbers = range(1, 1000);
    shuffle($numbers);
/*		echo $numbers[0];
    echo $_POST['chatname'];
    echo $_POST['user'];*/
    if(add_new_chat($numbers))
        header('Location: home.php');
    else
        header('Location: addchat.php');
}
else{
    //TODO some error cechking here
}

function add_new_chat($numbers){
    if(ChatUser::check_user_exists($_POST['user'])){
        $chat = new ChatManager($numbers[0], $_POST['chatname'], array($_SESSION['user'], $_POST['user']));
        $chat->add_chat();
        return true;
    }
    else{
        //TODO real error checking
        return false;
    }
}

function init_notifs($users){
    //$notifs = $users->fetch_notifications();
    //array_push($notifs, 0);
    //$users->update_notifications($notifs);
}
?>
