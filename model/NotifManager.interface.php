<?php
/**
 * API for Notification, provides set of functions to use
 * in managing notification functions, etc.
 *
 */

interface NotifManagerInterface{

    /**
     * increment notifications of participants in a chat
     * with id except for the person who sent the messagee
     * void method.
     */
    function increment_notifications($id);

    /**
     * Get all notifications of all chats corresponding to 
     * current session user, return array of ints.
     */
    function retrieve_notifications();

    /**
     * reset notifications of chat with id to zero
     */
    function reset_notifications($id);

    /**
     * compares array of old number of notifications to 
     * new number notifications, return true if different, 
     * else false.
     */
    function compare_notifications(array $old_arr, array $new_arr);
}

?>
