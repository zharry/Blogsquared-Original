<?php

    require("common.php");
    
    // Check if logged in
    if(empty($_SESSION['user']))
    {
        // Redirect if not logged in
        header("Location: login.php");
        
        // IMPORTANT
        die("Redirecting to login.php");
    }
    
    // Secured Below
?>
Hello <?php echo htmlentities($_SESSION['user']['username'], ENT_QUOTES, 'UTF-8'); ?>!<br />
<a href="memberlist.php">Memberlist</a>Not Avaliable Yet.<br />
<a href="edit-account.php">Edit Account</a><br />
<a href="logout.php">Logout</a>