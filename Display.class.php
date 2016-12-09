<?php
class Display{
    public static function change_title(array $curr){
        return '<small class="pull-right text-muted">Last message:  Mon Jan 26 2015 - 18:39:23</small>'
                                .$curr["name"] . ' (' . $curr['users'] . ')';  
    }

    


    //manager is an instance of ChatManager, reloads all messages
    //TODO track last message ID to avoid reloading all messages
    public static function change_messages($manager){
        $lines = $manager->load_chat_lines();
        $message = "";
        $line_count = 0;
        while($row = mysqli_fetch_assoc($lines)){
            $line_count++;
                 $message .= '<div class="chat-message left">
                <img class="message-avatar" src="img/a1.jpg" alt="" >
                <div class="message">
                    <a class="message-author" href="#">'.$row['username'].'</a>
                    <span class="message-date"> Mon Jan 26 2015 - 18:39:23 </span>
                    <span class="message-content">'
                    . $row['text'] .
                    '</span>
                </div>
            </div>';
        }
        return array($message, $line_count);

    }
    public static function change_chat_list($chats){
        $message = "";
        mysqli_data_seek($chats, 0);
        while($row = mysqli_fetch_assoc($chats)){
            $message .='<form class="chat-user" '. 'id=' . $row["id"] .' method = "post" action="change.php">
                     <img class="chat-avatar" src="img/a4.jpg" alt="" >
                         <div class="chat-user-name">
                            <input class = "btn" type="submit" name = "chatname"' .' value="'. $row["name"] .'">
                         </div>
                  </form>';
        }
        return $message;    
    }

}
?>
