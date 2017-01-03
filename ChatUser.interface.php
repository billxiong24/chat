<?php
/**
 * API for ChatUser, provides set of functions to use in managing
 * user interaction with chat elements.
 */

interface ChatUserInterface{

    /**
     * Add existing user to the chat
     * who is not already in the chat
     */
    function add_chat_user($new_user, $id, $name);

    /**
     * Add chat to the database with a unique
     * id.
     */
    function add_chat(array $users, $id, $name);

    /**
     * Add new chat line to the database,
     * whenever user submits a message
     */
    function submit_chat($chat, $id);
}
?>
