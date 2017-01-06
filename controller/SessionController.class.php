<?php
include_once 'ChatController.class.php';
include_once 'NotificationController.class.php';
include_once 'UserController.class.php';
class SessionController{
    
    private $user;
    private $last_chat_id;
    private $last_notifs;
    private $chat_ids;
    private $last_messages;
    private $last_message_id;

    private $user_controller;
    private $notif_controller;
    private $chat_controller;

    public function __construct($user, 
                                   $last_chat_id, 
                                   $last_notifs,
                                   $chat_ids,
                                   $last_messages,
                                   $last_message_id,
                                   $user_controller,
                                   $notif_controller,
                                   $chat_controller){
        $this->user = $user;
        $this->last_chat_id = $last_chat_id;
        $this->last_notifs = $last_notifs;
        $this->chat_ids = $chat_ids;
        $this->last_messages = $last_messages;
        $this->last_message_id = $last_message_id;
        $this->user_controller = $user_controller;
        $this->notif_controller = $notif_controller;
        $this->chat_controller = $chat_controller;
    }
    
    public function change_controller_attributes($id, $name, array $new_users){
        $this->user_controller->set_manager_attributes($id, $name, $new_users);
        $this->notif_controller->set_manager_attributes($id, $name, $new_users);
        $this->chat_controller->set_manager_attributes($id, $name, $new_users);
    }
    /* Getters */
    public function get_user(){
        return $this->user; 
    }
    public function get_last_chat_id(){
        return $this->last_chat_id;
    }
    public function get_last_notifs(){
        return $this->last_notifs; 
    }
    public function get_chat_ids(){
        return $this->chat_ids; 
    }
    public function get_last_messages(){
        return $this->last_messages; 
    }
    public function get_last_message_id(){
        return $this->last_message_id; 
    }
    public function get_user_controller(){
        return $this->user_controller; 
    }
    public function get_notif_controller(){
        return $this->notif_controller; 
    }
    public function get_chat_controller(){
        return $this->chat_controller; 
    }
    
    /* Setters */
    public function set_last_chat_id($id){
        $this->last_chat_id = $id;
    }
    public function set_last_notifs($notifs){
        $this->last_notifs = $notfs;
    }
    public function set_chat_ids(array $id){
        $this->chat_ids = $id;
    }
    public function set_last_messages(array $messages){
        $this->last_messages = $messages;
    }
    public function set_last_message_id($id){
        $this->last_message_id = $id;
    }
    
}
?>
