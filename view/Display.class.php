<?php
class Display{
    public static function load_title($name, $users){
        $title = "";
        $prepend = '<span class="message-title"><small class="pull-right text-muted">Last message:  Mon Jan 26 2015 - 18:39:23</small>';
        foreach($users as $user){
            $title .= '<span class = "success user-title">'.$user.'</span>';
        }
        $chat_name = '<span class = "chat-name">'.$name.'</span>';
        return $prepend .$chat_name. $title. '</span>';

    }
    //TODO remove logic from this method
    private static function get_message($user, $message, $timestamp){

         if(strcmp($user, $_SESSION['user']) != 0){
             return '<div class="left">
             <div class="author-name" id="mess">
                <div class="date-chat">'.$timestamp.' </div>
                <a class="author-name" href="#">'.$user.'</a>
            </div>
                <div class="chat-message">'
                .$message.
                '</div>
        </div>';
         }
         else{
             return '<div class="right">
             <div class="author-name" id="mess">
                <div class="date-chat">'.$timestamp.' </div>
                <a class="author-name" href="#">'.$user.'</a>
            </div>
                <div class="chat-message active" style="text-align: left">'
                .$message.
                '</div>
        </div>';

         }
    }
    


    //manager is an instance of ChatManager, reloads all messages
    //TODO track last message ID to avoid reloading all messages
    public static function change_messages($manager){
        $lines = $manager->load_chat_lines();
        $message = "";
        $line_count = 0;
        while($row = mysqli_fetch_assoc($lines)){
            $line_count++;
            $message .= self::get_message($row['username'], $row['text'], $row['timestamp']);
        }
        return array($message, $line_count);

    }
    public static function display_latest_message($user, $text, $timestamp){
        return self::get_message($user, $text, $timestamp);
    }
    public static function display_generic_message($text){

    }
    public static function reload_delete($chats){
        mysqli_data_seek($chats, 0);
        $html = "";
        while($row = mysqli_fetch_assoc($chats)){
            $html .= '<div class="chat-user">
                    <form class="change-chat" '. 'id=' . $row["id"] .' method = "post" action="change.php">
                    <img class="chat-avatar" src="img/a4.jpg" alt="" >
                    <div class="chat-user-name">
                        <input class = "btn" type="submit" name = "chatname"' .' value="'. $row["name"] .'">
                    </div>
                    </form>
                    <form class="remove-chat" method="post" action="remove.php" id='.$row["id"].'>
                    <button class="small-buttons pull-right" type="submit" style="margin-top: -35px"><i class="fa fa-trash"></i></button>
                    </form>
                    </div>';
        }
        return $html;
    }
    public static function display_single_chat($row, $session_last_notifs, $last_messages){
        $message = "";
        if(!is_null($last_messages)){
            $message = $last_messages['username'] .  ': '. $last_messages['text'];
        }

        $disp = 'inline-block';
        if($session_last_notifs[$row['id']] == 0){
            $disp = 'none';
        }
        return '<div class="" style="width: 100%">
                <form class="change-chat" '. 'id=' . $row["id"] .' method = "post" action="change.php">
                <div class="chat-user-name">
                    <input class = "btn" type="submit" name = "chatname"' .' value="'. $row["name"] .'">
                    <div class="label-warning notif" style="display: '.$disp.'">'.$session_last_notifs[$row['id']].'</div> 
                '.$message.'
                </div>
                </form>
                <form class="remove-chat" method="post" action="remove.php" id='.$row["id"].'>
                <button class="small-buttons pull-right" type="submit" style="margin-top: -35px"><i class="fa fa-trash"></i></button>
                </form>
                </div>';
    }
    public static function display_info(){
        
    } 
    public static function display_notifications(array $notifications){
        $notif_arr = array();
        foreach($notifications as $key=>$value){
            $notif_arr[$key] = '<div class="label-warning notif">'.$value.'</div>';
        }
        return $notif_arr;     
    }

}
?>
