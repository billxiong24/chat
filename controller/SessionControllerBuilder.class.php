<?php
include 'SessionController.class.php';

/* 
 * Builder class for SessionController- use
 * this for constructing the SessionController
 */
class SessionControllerBuilder{
    private $user;
    private $last_chat_id;
    private $last_notifs;
    private $chat_ids;
    private $last_messages;
    private $last_message_id;

    private $user_controller;
    private $notif_controller;
    private $chat_controller;
    
    public function __construct($user, $userc, $notifc, $chatc){
        $this->user = $user;
        $this->user_controller = $userc;
        $this->notif_controller = $notifc;
        $this->chat_controller = $chatc;
    }
    public function last_chat_id($id){
        $this->last_chat_id = $id;
        return $this;
    }
    public function last_notifs($notifs){
        $this->last_notifs = $notfs;
        return $this;
    }
    public function chat_ids($id = array()){
        $this->chat_ids = $id;
        return $this;
    }
    public function last_messages($messages = array()){
        $this->last_messages = $messages;
        return $this;
    }
    public function last_message_id($id){
        $this->last_message_id = $id;
        return $this;
    }
    public function create_session_controller(){
        return new SessionController($this->user,
                                     $this->last_chat_id,
                                     $this->last_notifs,
                                     $this->chat_ids,
                                     $this->last_messages,
                                     $this->last_message_id,
                                     $this->user_controller,
                                     $this->notif_controller,
                                     $this->chat_controller
                                    );
    }
    

}
?>
