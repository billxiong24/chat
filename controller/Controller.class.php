<?php
include_once 'ChatUser.class.php';
include_once 'ChatManager.class.php';
include_once 'DataBase.class.php';
include_once 'Display.class.php';
include_once 'ChatLine.class.php';
include 'Controller.interface.php';

/**
 * This class does the actual controlling between frontend and backend.
 * Executes necessary queries, updates information, and passes to frontend.
 * TODO MOVE ALL SESSION STUFF TO MODEL 
 */
class Controller implements ControllerInterface{
    
    private $manager;

    /**
     * Takes in ChatManager object
     */
    public function __construct(ChatManager $manager){
        DataBase::init();
        $this->manager = $manager;
    }
    //make this protected
    public function get_manager(){
        return $this->manager;
    }
    public function set_manager_attributes($id, $name, array $users){
        $this->manager->set_attributes($id, $name, $users);
    }
}
?>
