<?php
include_once 'ChatManager.class.php';
include_once 'ChatUser.class.php';
include_once 'Display.class.php';
include_once 'Notification.class.php';
include_once 'Controller.class.php';
include_once 'NotificationController.class.php';
include_once 'UserController.class.php';
include_once 'ChatController.class.php';
include_once 'SessionControllerBuilder.class.php';
/**
 * Loader class loads the initial page and assigns necessary session variables.
 * This class is used only when the page is first loaded- all updating is done
 * in other classes. 
 */
class Loader{

    private $manager;
    private $chats;
    private $title;
    private $session_controller;      

    public function __construct(){
        DataBase::init();
        $this->init();
    }
    public function __destruct(){
        unset($this->manager);
        unset($this->notif_manager);
        unset($this->chats);
        unset($this->title);
    }

    public function load_first_name(){
        $query = "SELECT first FROM users WHERE username='".$_SESSION['user']."'";
        $name = DataBase::make_query($query);
        $row = mysqli_fetch_assoc($name);
        return $row['first'];
    }

    public function load_title(){
        return $this->title;     
    }
    private function init(){
        $this->chats = ChatManager::load_chats();
        $curr_chat = mysqli_fetch_assoc($this->chats);
        $users = ChatManager::load_chat_users($curr_chat['id']);
        $this->manager = new ChatManager($curr_chat['id'], $curr_chat['name'], $users);
        
        /**
         * TODO get rid of session variables, other classes/functions depend
         * on them too much.
         * USING a lot of parallel arrays, coalesce them into an object
         */
        $userc =  new UserController($this->manager);
        $notifc =  new NotificationController($this->manager);
        $chatc =  new ChatController($this->manager);
        $lci = DataBase::escape($curr_chat['id']);
        $ln = $this->manager->retrieve_notifications();

        $_SESSION['user'] = DataBase::escape($_SESSION['user']);
        $_SESSION['last_chat_id'] = DataBase::escape($curr_chat['id']);
        $_SESSION['last_notifs'] = $this->manager->retrieve_notifications();
        //$_SESSION['manager'] = $this->manager;
        $_SESSION['chat_ids'] = array();
        $_SESSION['last_messages'] = array();

        $builder = new SessionControllerBuilder($_SESSION['user'], $userc, $notifc, $chatc);
        $builder->last_chat_id($lci)->last_notifs($ln)->chat_ids()->last_messages()->last_message_id($_SESSION['last_message_id']);

        $session_controller = $builder->create_session_controller();
        $this->session_controller = $session_controller;
        $this->title = Display::load_title($curr_chat['name'], $users);
        mysqli_data_seek($chats, 0);
         
    }
    public function set_controller(){
        $_SESSION['session_controller'] = $this->session_controller;
    }

    public function load_chat_list(){
        //move mysql pointer to beginning, just in case
        mysqli_data_seek($this->chats, 0);
        
        $chat_list = "";
        while($row = mysqli_fetch_assoc($this->chats)){
            array_push($_SESSION['chat_ids'], $row['id']);
            $manager = new ChatManager($row['id']);
            //TODO optimize multiple queries
            $message = $manager->load_last_id();
            $message2 = $manager->load_very_last_id();
            $_SESSION['last_messages'][$row['id']] = $message;
            $chat_list .= Display::display_single_chat($row, $_SESSION['last_notifs'], $message2);
        }
        return $chat_list;

    }
    public function load_chat_lines(){
        $chat_lines = "";
        $lines = $this->manager->load_chat_lines();
        $line_count = 0;
        $last_message_id;
        while($row = mysqli_fetch_assoc($lines)){
            if($row['username'] !== $_SESSION['user']){
                $last_message_id = $row['line_id'];
            }
            $line_count++;
            $chat_lines .= Display::display_latest_message($row['username'], $row['text'], $row['timestamp']);
        }
        $_SESSION['last_message_id'] = DataBase::escape($last_message_id);
        $this->session_controller->set_last_message_id(DataBase::escape($last_message_id));
        return $chat_lines;
    }
}
?>
