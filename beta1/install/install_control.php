<?php

//Gets the Data from the post and turns it into variables
$mysql_host_value = $_POST['mysql_host'];
$mysql_user_value = $_POST['mysql_user'];
$mysql_pass_value = $_POST['mysql_pass'];
$mysql_database_value = $_POST['mysql_database'];
$admin_user_value = $_POST['admin_user'];
$admin_email_value = $_POST['admin_email'];
$admin_pass_value = $_POST['admin_pass'];
$bs_title_value = $_POST['bs_title'];

//Creates install.log
$installlocation = 'install.log';
$textinput = file_get_contents($installlocation);
$textinput .= "Install initialized on" . $date . "!\n";
file_put_contents($installlocation, $textinput);

//Inputs to config.php and writes to install.log
$configlocation = '../config/mysql.php';
$configtext = file_get_contents($configlocation);
$configtext .= "<?php\n";
$configtext .= "$";
$configtext .= "username = \"" . $mysql_user_value . "\";\n";
$configtext .= "$";
$configtext .= "password = \"" . $mysql_pass_value . "\";\n";
$configtext .= "$";
$configtext .= "host = \"" . $mysql_host_value . "\";\n";
$configtext .= "$";
$configtext .= "dbname = \"" . $mysql_database_value . "\";\n";
$configtext .= "?>";
file_put_contents($configlocation, $configtext);
$installlocation = 'install.log';
$textinput = file_get_contents($installlocation);
$textinput .= "MySQL Data Successfully inserted into mysql.php\n";
file_put_contents($installlocation, $textinput);

//Receive MySQL connection details
include '../config/mysql.php';

//Connect to MySQL and Revert install if failed
$connection=mysql_connect($host,$username,$password);
if (!$connection) {
	$installlocation = 'install.log';
	$textinput = file_get_contents($installlocation);
	$textinput .= "Failed to connect to MySQL: " . mysql_error() . ", Reverting install...\n";
	file_put_contents($installlocation, $textinput);
	//Reverts Install
	$configlocation = '../config/mysql.php';
	$configtext = file_get_contents($configlocation);
	$configtext = "";
	file_put_contents($configlocation, $configtext);
	echo "<center>Oops, something went wrong with the installation!<br/>";
	echo "Please check <a href='install.log'>the install log</a> to see what went wrong.<br/>";
	echo "Make sure that MySQL connection details were set correctly, as that is likely what went wrong.<br/>";
	echo "Click <a href='index.php'>here</a> to return to the installer and try again.<br/></center>";
	$installlocation = 'install.log';
	$textinput = file_get_contents($installlocation);
	$textinput .= "Install Reverted!\n";
	file_put_contents($installlocation, $textinput);
	die();
}

//Continue to MySQL if succeeded and create the table users
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
  $textinput .= 'Could not create table "users": ' . mysql_error();
}

// Create the table posts
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
  $textinput .= 'Could not create table "posts": ' . mysql_error();
}

//Insert admin into users
if(!empty($_POST)) {
        if(empty($_POST['admin_user']))
        {
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
            global $db;
            global $stmt;
            $stmt = $db->prepare($query);
            $result = $stmt->execute($query_params);
        }
        catch(PDOException $ex)
        {
            // Get Rid Of This Later When We Are Done
            die("Failed to run query: " . $ex->getMessage());
        }
        
        global $stmt;
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
            global $db;
            global $stmt;
            $stmt = $db->prepare($query);
            $result = $stmt->execute($query_params);
        }
        catch(PDOException $ex)
        {
            die("Failed to run query: " . $ex->getMessage());
        }
        
        global $stmt;
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
            global $db;
            global $stmt;
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
?>