<?php
/**
 * API for ChatManager object, provides set of functions to use
 * in managing chat functions, etc.
 */

interface ChatManagerInterface{
    
    /**
     * Add a new chat to the database with random id
     * void method
     */
    function add_chat();

    /**
     * Select most current chat line with manager's chat id
     * return associative array containing most current chat line
     */
    function load_last_id();

    /**
     * update the timestamp to current timestamp of manager's chat id
     * void method
     */
    function update_timestamp();

    /**
     * Load all chat lines of manager's chat ids
     * void method
     */
    function load_chat_lines();

    /**
     * Add chat line to chat_line table- i.e. adding message
     * to database. Return true if successful, else return false.
     */
    function submit_chat($chat);

    /**
     * Add a new user to the chat with manager's chat id
     * Return true if successful, else return false.
     */
    function add_user($new_user);

    /**
     * switches manager's attributes to reflect user
     * switching to a new chat. void method
     */
    function change_chat($chat_id);

    /**
     * check if the last message id is different from the
     * current one- if so, update it, and update the chat
     * timestamp. Return last message id if different, else
     * return null.
     */
    function refresh_messages();

    /**
     * Check if current number of chats is different from 
     * previous session variable. If so, update sessino variable,
     * and return array of new chats
     */
    function refresh_chat_list($last_messages, $chat_ids);

    /**
     * Remove all elements of chat with remove_id from database.
     * returns array of remaining chats
     */
    function remove_chat($remove_id);
    
    /**
     * Increment notifications for users except
     * current session user
     */
    function increment_notifications();

    /**
     * Get notifications for all users in the current
     * chat id
     */
    function retrieve_notifications();

    /**
     * reset all notifications for all users in current
     * chat id
     */
    function reset_notifications(); 

    /**
     * Returns true if old number of notifs for all users
     * is the same, else false if different from current
     * number of notifs for all users
     */
    function compare_notifications(array $old, array $new);
}

?>
