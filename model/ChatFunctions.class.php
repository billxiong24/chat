<?php

class ChatFunctions{

    public function __construct(){
        DataBase::init();
    }    
    public function update_timestamp($id){
        $query = "UPDATE chats SET timestamp=now() WHERE id='".$id."'";
        DataBase::make_query($query);
    }
    public function check_last_message($last_id){
        if($_SESSION['last_message_id'] != $last_id['line_id']){
            $_SESSION['last_message_id'] = $last_id['line_id'];
            return $last_id;
        }
        return null;
    }
    public function check_chat_list($num_chats, $last_message_diffs, $result, $chat_ids){
        if($num_chats != count($chat_ids) || $last_message_diffs){
            $chat_ids = array();
            mysqli_data_seek($result, 0);
            while($row = mysqli_fetch_assoc($result)){
                array_push($chat_ids, $row['id']);
            }
            mysqli_data_seek($result, 0);
            return array($result, $chat_ids, $last_message_diffs);
        }
        return array(null, null);
    }
    public function load_last_message_id($id){
        $query1 = "SELECT @last_id := MAX(line_id) FROM chat_lines WHERE chat_id = '".$id."' AND username <> '".$_SESSION['user']."'";
        return $this->load_last($query1);
    }
    public function load_very_last_message_id($id){
        $query1 = "SELECT @last_id := MAX(line_id) FROM chat_lines WHERE chat_id = '".$id."'"; 
        return $this->load_last($query1);
    }
    private function load_last($query1){
        DataBase::make_query($query1);
        $query2 = "SELECT * FROM chat_lines WHERE line_id = @last_id"; 
        $result = DataBase::make_query($query2);
        $row = mysqli_fetch_assoc($result);
        return $row;
    }
}
?>
