<?php 
session_start();
        $_SESSION['user_id'] = NULL;
        $_SESSION['user_name'] = NULL;
        $_SESSION['user_email'] = NULL;
        $_SESSION['user_contact'] = NULL;
        $_SESSION['user_address'] = NULL;
header('location: signin.php');
 ?>