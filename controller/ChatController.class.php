<?php
include_once 'ChatManager.class.php';
include_once 'Notification.class.php';
include_once 'DataBase.class.php';
include_once 'ChatLine.class.php';
include_once 'ChatUser.class.php';
include_once 'Display.class.php';
include_once 'Controller.class.php';

class ChatController extends Controller{
    
    public function __construct(ChatManager $manager){
        parent::__construct($manager);
    }

    public function refresh_messages(){
        if($last_id = parent::get_manager()->refresh_messages()){
            $messages = Display::display_latest_message($last_id['username'], $last_id['text'], $last_id['timestamp']);
            
           return array("logged_in"=>true, "change"=>true, "messages"=>$messages);
        }
        else{
            return array("logged_in"=>true, "change"=>false);
        }
    } 
    public function refresh_chat_list(){
        if($result = parent::get_manager()->refresh_chat_list()){
            $list = Display::change_chat_list($result);
            return array("change"=>true, "newList"=>$list);
        }
        else{
            return array("change"=>false);
        }
    }
    public function remove_chat($remove_id){
        $chats = parent::get_manager()->remove_chat($remove_id);
        return array("list"=>Display::reload_delete($chats));
    }
}
?>
