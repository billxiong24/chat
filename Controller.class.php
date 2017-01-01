<?php
include_once 'ChatUser.class.php';
include_once 'ChatManager.class.php';
include_once 'DataBase.class.php';
include_once 'Display.class.php';
include_once 'ChatLine.class.php';

/**
 * This class does the actual controlling between frontend and backend.
 * Executes necessary queries, updates information, and passes to frontend.
 * TODO MOVE ALL SESSION STUFF TO MODEL 
 */
class Controller{
    
    private $manager;

    /**
     * Takes in ChatManager object
     */
    public function __construct($manager){
        DataBase::init();
        $this->manager = $manager;
    }
    public function get_manager(){
        return $this->manager;
    }
    public function set_manager_attributes($id, $name, $users){
        $this->manager->set_id($id);
        $this->manager->set_name($name);
        $this->manager->set_users($users);
    }
    public function add_user($session_user, $new_user){
        DataBase::init();
        $joined = false;
        $chat_id = $this->manager->get_id();
        $name = $this->manager->get_name();
        $people = $this->manager->get_users(); 

        if(strpos(join(" ", $people), $new_user) == false && $new_user !== $session_user){
            $joined = true;               
            
            if(ChatUser::check_user_exists($new_user))
                $this->manager->add_user($new_user);
            else
                $joined = false;

            $new_title = Display::change_title($this->manager); 
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
        $manager = $this->manager;
        
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

		$manager = $this->manager; 
        //TODO inefficient, find a better way?
        if($manager->chat_exists()){
		    $manager->submit_chat($text);
		    return array("deleted"=>false);
        }
        else{
		    return array("deleted"=>true);
        }
    }
    public function refresh_messages($old_last_id){
        DataBase::init();
        $manager = $this->manager;
        $last_id = $manager->load_last_id();
        
        if($old_last_id != $last_id['line_id']){
            $_SESSION['last_message_id'] = $last_id['line_id'];
            $manager->update_timestamp();
            $messages = Display::display_latest_message($last_id['username'], $last_id['text'], $last_id['timestamp']);
            
           return array("logged_in"=>true, "change"=>true, "messages"=>$messages);
        }
        else{
            return array("logged_in"=>true, "change"=>false);
        }
    } 
    public function refresh_chat_list($num_curr){
        DataBase::init();
        $result = ChatManager::load_chats();
        $num_chats = mysqli_num_rows($result);
        if($num_chats != $num_curr){
            $_SESSION['chat_ids'] = array();
            mysqli_data_seek($result, 0);
            while($row = mysqli_fetch_assoc($result)){
                array_push($_SESSION['chat_ids'], $row['id']);
            }
            $list = Display::change_chat_list($result);
            return array("change"=>true, "newList"=>$list);
        }
        else{
            return array("change"=>false);
        }
    }
}
?>
