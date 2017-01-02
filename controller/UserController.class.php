<?php
include_once 'Controller.class.php';

class UserController extends Controller{

    public function __construct(ChatManager $manager){
        parent::__construct($manager);
    }
    public function add_user($new_user){
        if(parent::get_manager()->add_user($new_user)){
            $new_title = Display::change_title(parent::get_manager()); 
            return array("duplicate"=> true, "new_title"=>$new_title);
        }
        else{
            return array("duplicate"=>false);
        }
    }

    public function change_chat($chat_id){
        $manager = parent::get_manager();
        parent::get_manager()->change_chat($chat_id);
        $title = Display::change_title($manager);

        /**
         * TODO find a way to cache the messages so we don't 
         * have to reload them everytime user changes chats. 
         */
        $messages = Display::change_messages($manager);
        return array("title"=>$title, "messages"=>$messages[0]);
    }

    public function submit_chat($text){
		$manager = parent::get_manager(); 
        return array("deleted"=>!$manager->submit_chat($text));
    }
}
?>
