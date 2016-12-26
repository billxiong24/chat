<?php

class Notification{
    
    private $chats;
    private $last_ids; 
    public function __construct(array $chat_ids){
        DataBase::init();
        $this->chats = $chat_ids; 
        $this->last_ids = array();
        $this->init_last_ids();
    }

    public function init_last_ids(){
        foreach($this->chats as $chat_id){
            $this->load_id($chat_id);
        }
    }
    public function get_chats(){
        return $this->chats;
    }

    public function get_last_ids(){
        return $this->last_ids;
    }
    
    private function load_id($chat_id){
        $manager = new ChatManager($chat_id);
        $last_id = $manager->load_last_id()['line_id'];
        $this->last_ids[$chat_id] = $last_id;
    }

    public function add_chat($chat_id){
        array_push($_SESSION['chat_ids'], $chat_id);
        array_push($this->chats, $chat_id);
        $this->load_id($chat_id);
    }

    public function get_num_new_messages(){
        $num_new_messages = array();

        foreach($this->chats as $chat_id){
            $manager = new ChatManager($chat_id);
            $new_id = $manager->load_last_id()['line_id'];
            $num_new_messages[$chat_id] = $new_id - $this->last_ids[$chat_id];
            $this->last_id[$chat_id] = $new_id;
        }

        return $num_new_messages;
    }
}
?>
