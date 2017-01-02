<?php
include_once 'ChatManager.class.php';
include_once 'ChatUser.class.php';
include_once 'Display.class.php';
include_once 'Notification.class.php';
include_once 'Controller.class.php';
include_once 'NotificationController.class.php';
include_once 'UserController.class.php';
include_once 'ChatController.class.php';
/**
 * Loader class loads the initial page and assigns necessary session variables.
 * This class is used only when the page is first loaded- all updating is done
 * in other classes. 
 */
class Loader{

    private $manager;
    private $notif_manager;
    private $chats;
    private $title;
      
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
        $this->notif_manager = new Notification($this->manager);
        
        /**
         * TODO get rid of session variables, other classes/functions depend
         * on them too much.
         */
        $_SESSION['user'] = DataBase::escape($_SESSION['user']);
        $_SESSION['last_chat_id'] = DataBase::escape($curr_chat['id']);
        $_SESSION['last_notifs'] = $this->notif_manager->retrieve_notifications();
        //$_SESSION['manager'] = $this->manager;
        $_SESSION['chat_ids'] = array();
        $_SESSION['user_controller'] = new UserController($this->manager);
        $_SESSION['notif_controller'] = new NotificationController($this->manager);
        $_SESSION['chat_controller'] = new ChatController($this->manager);

        $this->title = Display::load_title($curr_chat['name'], $users);
        mysqli_data_seek($chats, 0);
         
    }

    public function load_chat_list(){
        //move mysql pointer to beginning, just in case
        mysqli_data_seek($this->chats, 0);
        $notif_obj = $this->notif_manager;
        
        $chat_list = "";
        while($row = mysqli_fetch_assoc($this->chats)){
            array_push($_SESSION['chat_ids'], $row['id']);
            $chat_list .= Display::display_single_chat($row, $_SESSION['last_notifs']);
        }
        return $chat_list;

    }
    public function load_chat_lines(){
        $chat_lines = "";
        $lines = $this->manager->load_chat_lines();
        $line_count = 0;
        $last_message_id;
        while($row = mysqli_fetch_assoc($lines)){
             $last_message_id = $row['line_id'];
             $line_count++;
             echo Display::display_latest_message($row['username'], $row['text'], $row['timestamp']);
        }
        $_SESSION['last_message_id'] = DataBase::escape($last_message_id);
        return $chat_lines;
    }
}
?>
