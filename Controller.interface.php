<?php
    interface ControllerInterface{

        /**
         * implementing classes should have a manager instance variable
         * and set its properties
         */
        function set_manager_attributes($id, $name, array $users);
    }
?>
