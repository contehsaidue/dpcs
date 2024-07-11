<?php
    session_start(); // starting a session
   // Add database connection
   require 'connection.php';

// creating a function to validate admin's input
if(isset($_POST['username']) && isset($_POST['password'])){
    function validate($data){
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
}


?>