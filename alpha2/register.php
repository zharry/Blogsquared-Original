<?php

    require("common.php");
    
    if(!empty($_POST))
    {
        if(empty($_POST['username']))
        {
            //This is terrible Harry, I'm gonna fix this later
            die("Please enter a username.");
        }
        
        if(empty($_POST['password']))
        {
            die("Please enter a password.");
        }
        
        if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL))
        {
            die("Invalid E-Mail Address");
        }
        
        // SQL Query
        $query = "
            SELECT
                1
            FROM users
            WHERE
                username = :username
        ";
        
        // Protects Against SQL Injections
        $query_params = array(
            ':username' => $_POST['username']
        );
        
        try
        {
            // Run Query
            $stmt = $db->prepare($query);
            $result = $stmt->execute($query_params);
        }
        catch(PDOException $ex)
        {
            // Get Rid Of This Later When We Are Done
            die("Failed to run query: " . $ex->getMessage());
        }
        
        $row = $stmt->fetch();
        
        // Check if username exists
        if($row)
        {
            die("This username is already in use");
        }
        
        // Same thing for email
        $query = "
            SELECT
                1
            FROM users
            WHERE
                email = :email
        ";
        
        $query_params = array(
            ':email' => $_POST['email']
        );
        
        try
        {
            $stmt = $db->prepare($query);
            $result = $stmt->execute($query_params);
        }
        catch(PDOException $ex)
        {
            die("Failed to run query: " . $ex->getMessage());
        }
        
        $row = $stmt->fetch();
        
        if($row)
        {
            die("This email address is already registered");
        }
        
        // Add rows to database
        $query = "
            INSERT INTO users (
                username,
                password,
                salt,
                email
            ) VALUES (
                :username,
                :password,
                :salt,
                :email
            )
        ";
        
        // Salt Generation Here, Protects against Rainbow table attacks
        $salt = dechex(mt_rand(0, 2147483647)) . dechex(mt_rand(0, 2147483647));
        
        // Hash password to store securely in database
        $password = hash('sha256', $_POST['password'] . $salt);
        
        // Hash the value 65536 more times :)
        for($round = 0; $round < 65536; $round++)
        {
            $password = hash('sha256', $password . $salt);
        }
        
        // Prep to insert into table
        $query_params = array(
            ':username' => $_POST['username'],
            ':password' => $password,
            ':salt' => $salt,
            ':email' => $_POST['email']
        );
        
        try
        {
            // Execute the query to create the user
            $stmt = $db->prepare($query);
            $result = $stmt->execute($query_params);
        }
        catch(PDOException $ex)
        {
            // Get Rid Of This Too, Later
            die("Failed to run query: " . $ex->getMessage());
        }
        
        // This redirects the user back to the login page after they register
        header("Location: login.php");
        
        // IMPORTANT!
        die("Redirecting to login.php");
    }
    
?>
<h1>Register</h1>
<form action="register.php" method="post">
    Username:<br />
    <input type="text" name="username" value="" />
    <br /><br />
    E-Mail:<br />
    <input type="text" name="email" value="" />
    <br /><br />
    Password:<br />
    <input type="password" name="password" value="" />
    <br /><br />
    <input type="submit" value="Register" />
</form>
<h2>Registration Not Available in Alpha 1.0</h2>