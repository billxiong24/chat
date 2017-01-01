<?php
include_once 'Controller.class.php';

class UserController extends Controller{

    public function __construct(ChatManager $manager){
        parent::__construct($manager);
    }
    public function add_user($session_user, $new_user){
        DataBase::init();
        $joined = false;
        $chat_id = parent::get_manager()->get_id();
        $name = parent::get_manager()->get_name();
        $people = parent::get_manager()->get_users(); 

        if(strpos(join(" ", $people), $new_user) == false && $new_user !== $session_user){
            $joined = true;               
            
            if(ChatUser::check_user_exists($new_user))
                parent::get_manager()->add_user($new_user);
            else
                $joined = false;

            $new_title = Display::change_title(parent::get_manager()); 
            return array("duplicate"=> $joined, "new_title"=>$new_title);
        }
        else{
            return array("duplicate"=>false);
        }
    }

    public function change_chat($chat_id){
        DataBase::init();
        $curr = ChatManager::load_chat_id($chat_id);
        $_SESSION['last_chat_id'] = $curr['id'];
        $new_users = ChatManager::load_chat_users($curr['id']);
        $this->set_manager_attributes($curr['id'], $curr['name'], $new_users);
        $manager = parent::get_manager();
        
        //Get rid of setmanager for notifications
        $_SESSION['notifs']->set_manager($manager);
        //need to update last message id since we switched a chat
        $_SESSION['last_message_id'] = $manager->load_last_id()['line_id']; 
        $title = Display::change_title($manager);

        /**
         * TODO find a way to cache the messages so we don't 
         * have to reload them everytime user changes chats. 
         */
        $messages = Display::change_messages($manager);
        return array("title"=>$title, "messages"=>$messages[0]);
    }

    public function submit_chat($text){
		DataBase::init();

		$manager = parent::get_manager(); 
        //TODO inefficient, find a better way?
        if($manager->chat_exists()){
		    $manager->submit_chat($text);
		    return array("deleted"=>false);
        }
        else{
		    return array("deleted"=>true);
        }
    }
}
?>
