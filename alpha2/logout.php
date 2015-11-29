<?php

    require("common.php");
    
    // Remove User From Session
    unset($_SESSION['user']);
    
    // Redirect
    header("Location: login.php");
    die("Redirecting to: login.php"); 