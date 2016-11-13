<?php
//FOLLOWS SINGLETON DESIGN PATTERN, so that there is only 1 instance of database;
class DataBase{
    private static $instance;
    private $database;
    private function __construct(){
        $this->database = mysqli_connect('localhost', 'root', 'bill1313', 'chat');
        if(!$this->database){
            die("Error connecting to database");
        }
    }   

    public static function init(){
        if(!self::$instance){
            self::$instance = new self();
        }
        return self::$instance;     
    }
    public static function get_database(){
        return self::$instance->database;
    }
    public static function make_query($query){
        $database = self::$instance->database; 
        $result = mysqli_query($database, $query);
        if(!$result){
            die("Query failed" . mysqli_error($database)); 
        }
        return $result;
    }
}
?>
