<?php
include_once 'DataBase.class.php';
abstract class Manager{

    private $id;
    private $name;
    private $users;

    public function __construct($chat_id, $name, array $users){
        $this->id = $chat_id;
        $this->name = $name;
        $this->users = $users;
        DataBase::init();
    }
    public function get_id(){
        return $this->id;
    }
    public function get_name(){
        return $this->name;
    }
    public function get_users(){
        return $this->users;
    }
    protected function set_chat_id($id){
        $this->id = $id;
    }
    protected function set_chat_name($name){
        $this->name = $name;
    }
    protected function set_chat_users(array $users){
        $this->users = $users;
    }

    /**
     * Different subclasses may implement "setter" differently, 
     * hence abstract methods
     */
    public abstract function set_attributes($id, $name, $users);

}
?>
