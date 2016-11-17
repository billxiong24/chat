<?php
class ChatLine{
    private $text;
    private $username;
    private $chat_id;
    public function __construct($text, $user, $chat_id){
        $this->text = DataBase::escape($text);
        $this->username = $user;
        $this->chat_id = $chat_id; 
    }
    public function insert_line(){
        //TODO query database here for chat name
        $chat_name = "name";
        $time = time();
        $query = "INSERT INTO chat_lines (chat_id, chat_name, username, text) ";
        $query .= "VALUES ('".$this->chat_id."', '".$chat_name."', '".$this->username."', '".$this->text."')"; 
        DataBase::make_query($query);
        
    }


}
?>
