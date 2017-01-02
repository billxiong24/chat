<?php
include_once 'Controller.class.php';
include_once 'Notification.class.php';

class NotificationController extends Controller{
    
    private $notif_manager;
    public function __construct(ChatManager $manager){
        parent::__construct($manager);
        $this->notif_manager = new Notification($manager);
    }
    public function increment_notifications(){
        DataBase::init();
        $this->notif_manager->increment_notifications();            
    }
    public function reset_notifications(){
        DataBase::init();
        $this->notif_manager->reset_notifications();
    }
    public function refresh_notifications($last_notifs){
        DataBase::init();
        $notifications = $this->notif_manager->retrieve_notifications();
        if(!$this->notif_manager->compare_notifications($last_notifs, $notifications)){
            $_SESSION['last_notifs'] = $notifications;
            return array("changed"=>true, "notifications"=>$notifications);
        }
        else{
            return array("changed"=>false);
        }
    }
}
?>
