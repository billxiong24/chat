<?php
include_once 'DataBase.class.php';
include_once 'ChatManager.interface.php';
abstract class Manager implements ChatManagerInterface{

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
    protected function add_to_users($user){
        array_push($this->users, $user);
    }

    /**
     * Different subclasses may implement "setter" differently, 
     * hence abstract methods
     */
    public abstract function set_attributes($id, $name, $users);

    /**
     * Interface methods for subclass to implement.
     */
    public abstract function add_chat();
    public abstract function load_last_id();
    public abstract function update_timestamp();
    public abstract function load_chat_lines();
    public abstract function submit_chat($chat);
    public abstract function add_user($new_user);
    public abstract function change_chat($chat_id);
    public abstract function refresh_messages();
    public abstract function refresh_chat_list();
    public abstract function remove_chat($remove_id);
    public abstract function increment_notifications();
    public abstract function retrieve_notifications();
    public abstract function reset_notifications();
    public abstract function compare_notifications(array $old, array $new);
    public abstract function leave_chat();    
}
?>
