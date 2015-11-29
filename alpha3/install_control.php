<?php

//Get mysql data
$mysql_host_value = $_POST['mysql_host'];
$mysql_user_value = $_POST['mysql_user'];
$mysql_pass_value = $_POST['mysql_pass'];
$mysql_database_value = $_POST['mysql_database'];

//Insert Mysql data
$path='common.php';
$content = file_get_contents($path);
$content = str_replace("xuserx",$mysql_user_value,$content);
file_put_contents($path,$content);
$content = file_get_contents($path);
$content = str_replace("xpassx",$mysql_pass_value,$content);
file_put_contents($path,$content);
$content = file_get_contents($path);
$content = str_replace("xhostx",$mysql_host_value,$content);
file_put_contents($path,$content);
$content = file_get_contents($path);
$content = str_replace("xdbx",$mysql_database_value,$content);
file_put_contents($path,$content);

//Include Database Connections
include 'common.php';

// Create connection and Close if No Connection
$connection=mysql_connect($host,$username,$password,$dbname) or die('<hr/><center><h2>ERROR</h2><hr/><br/>Cannot connect : ' . mysql_error() . '<br/><br/>Make sure your connection details are correct and you have MySQL5.5+ and PHP5.3+ <small>(Not Tested with before versions.)<small><hr/></center>');

// Create Table Users
$sqlcreateusers = "CREATE TABLE `users`( 
	`id` int(11) NOT NULL AUTO_INCREMENT, 
	`username` varchar(255) COLLATE utf8_unicode_ci NOT NULL, 
	`password` char(64) COLLATE utf8_unicode_ci NOT NULL, 
	`salt` char(16) COLLATE utf8_unicode_ci NOT NULL, 
	`email` varchar(255) COLLATE utf8_unicode_ci NOT NULL, 
	PRIMARY KEY(`id`), 
	UNIQUE KEY `username` (`username`), 
	UNIQUE KEY `email` (`email`)); ";
mysql_select_db( $dbname );
$retvaltableusers = mysql_query( $sqlcreateusers, $connection );
if(! $retvaltableusers )
{
  die('Could not create table "users": ' . mysql_error());
}

// Create Table Posts
$sqlcreateposts = "CREATE TABLE `posts`( 
	`postid` int(11) NOT NULL AUTO_INCREMENT, 
	`postdate` varchar(50) NOT NULL, 
	`postuser` varchar(255) NOT NULL, 
	`postname` varchar(50) NOT NULL, 
	`post` varchar(2048) NOT NULL, 
	PRIMARY KEY (`postid`)); ";
mysql_select_db( $dbname );
$retvaltableposts = mysql_query( $sqlcreateposts, $connection );
if(! $retvaltableposts )
{
  die('Could not create table "posts": ' . mysql_error());
}

//Insert admin login to `users`
if(!empty($_POST)) {
        if(empty($_POST['admin_user']))
        {
            //This is terrible Harry, I'm gonna fix this later
			//It's ok im going to copy this code for the installer :)
			//Thanks!
            die("Please enter a username.");
        }
        
        if(empty($_POST['admin_pass']))
        {
            die("Please enter a password.");
        }
        
        if(!filter_var($_POST['admin_email'], FILTER_VALIDATE_EMAIL))
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
            ':username' => $_POST['admin_user']
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
            ':email' => $_POST['admin_email']
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
        $passwordx = hash('sha256', $_POST['admin_pass'] . $salt);
        
        // Hash the value 65536 more times :)
        for($round = 0; $round < 65536; $round++)
        {
            $passwordx = hash('sha256', $passwordx . $salt);
        }
        
        // Prep to insert into table
        $query_params = array(
            ':username' => $_POST['admin_user'],
            ':password' => $passwordx,
            ':salt' => $salt,
            ':email' => $_POST['admin_email']
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
		
		
        $queryinsertpost = "
            INSERT INTO `posts` (
				postuser,
				postdate,
                postname,
                post
            ) VALUES (
				'user',
				'date',
                'postname',
                'post'
            )";
		$retvalqueryinsertpost = mysql_query( $queryinsertpost, $connection );
		if(! $retvalqueryinsertpost )
		{
		die('Opps, something went wrong. Try again:' . mysql_error());
		}
    }

// Close Connection
mysql_close($connection);
echo "<center><b>Thanks for using Blog Squared! You are an Alpha Tester, thank you very very much.</b><br/>";
echo "MySQL Database Connections have been set.<br/>";
echo "MySQL Tables have been created.<br/>";
echo "MySQL Admin Login details have been added to tables.<br/>";
echo "Once again thanks for Alpha Testing and hope you enyoy Blog Squared!<br/>";
echo "Close this tab and Open your blog's index page and login through the Admin Panel!<br/></center>";
?>