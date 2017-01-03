<?php
include_once 'Notification.class.php';
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
            $list = $this->render_chats($result);
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

    private function render_chats($result){
        mysqli_data_seek($result, 0);
        $list = "";
        while($row = mysqli_fetch_assoc($result)){
            $list .= Display::display_single_chat($row, parent::get_manager()->get_session_last_notifs());
        }
        return $list; 
    }
}
?>
