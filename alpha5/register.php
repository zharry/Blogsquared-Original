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
<!DOCTYPE html>
<html>

	<head>
	<script src="includes/showhide.js" type="text/javascript"></script>
	<link rel="stylesheet" type="text/css" href="styles/default.css">
	<title>Blog Squared</title>
	</head>
	
	<body>
	<div class="container">
		<div id="Admin_ShowHide_Button"><button onclick="hideadmin()">Hide Admin Panel</button></div>
		<div id="Admin_Section"  class="Admin_Section">
<a href="login.php">Back to Login</a>
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
		</div>
		<div class="Posts_Section">
		<?php
mysql_connect($host,$username,$password) or die('<hr/><center><h2>ERROR</h2><hr/><br/>Cannot connect : ' . mysql_error() . '<br/><br/>Make sure your connection details are correct and you have MySQL5.5+ and PHP5.3+ <small>(Not Tested with before versions.)<small><hr/></center>');
mysql_select_db($dbname);

$data = mysql_query("SELECT * FROM posts") or die(mysql_error());

$info = mysql_fetch_array( $data );

while($info = mysql_fetch_array( $data ))
{
echo "<hr/><br/>Date of Post: " . $info['postdate'] . "<br/>User who posted: " . $info['postuser'] . "<br/>Post Name: " . $info['postname'] . "<br/><b>Post:</b><br/>" . $info['post'] . "<br/><hr/><br/>";
}
?>
		</div>
	</div>
</body>
</html>