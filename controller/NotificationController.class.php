<?php
include_once 'Controller.class.php';
include_once 'ChatManager.class.php';
include_once 'Notification.class.php';

class NotificationController extends Controller{
    
    public function __construct(ChatManager $manager){
        parent::__construct($manager);
    }
    public function increment_notifications(){
        DataBase::init();
        parent::get_manager()->increment_notifications();            
    }
    public function reset_notifications(){
        DataBase::init();
        parent::get_manager()->reset_notifications();
    }
    public function refresh_notifications($last_notifs){
        DataBase::init();
        $notifications = parent::get_manager()->retrieve_notifications();
        if(!parent::get_manager()->compare_notifications($last_notifs, $notifications)){
            $_SESSION['last_notifs'] = $notifications;
            return array("changed"=>true, "notifications"=>$notifications);
        }
        else{
            return array("changed"=>false);
        }
    }
}
?>
