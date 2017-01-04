<?php
include_once 'Controller.class.php';

class UserController extends Controller{

    public function __construct(ChatManager $manager){
        parent::__construct($manager);
    }
    public function add_user($new_user){
        if(parent::get_manager()->add_user($new_user)){
            $new_title = Display::load_title(parent::get_manager()->get_name(), parent::get_manager()->get_users()); 
            return array("duplicate"=> true, "new_title"=>$new_title, "test"=>parent::get_manager()->get_users());
        }
        else{
            return array("duplicate"=>false);
        }
    }

    public function change_chat($chat_id){
        $manager = parent::get_manager();
        parent::get_manager()->change_chat($chat_id);
        $title = Display::load_title($manager->get_name(), $manager->get_users());

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

    public function leave_chat(){
        parent::get_manager()->leave_chat();
    }
}
?>
