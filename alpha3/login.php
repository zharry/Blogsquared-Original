<?php

    require("common.php");
    
    $submitted_username = '';
    

    if(!empty($_POST))
    {
        // This query retreives the user's information from the database using
        // their username.
        $query = "
            SELECT
                id,
                username,
                password,
                salt,
                email
            FROM users
            WHERE
                username = :username
        ";
        
        // The parameter values
        $query_params = array(
            ':username' => $_POST['username']
        );
        
        try
        {
            // Execute the query
            $stmt = $db->prepare($query);
            $result = $stmt->execute($query_params);
        }
        catch(PDOException $ex)
        {
            // Get Rid Of This Later
            die("Failed to run query: " . $ex->getMessage());
        }
        
        // Test variable for successful login
        $login_ok = false;
        
        // Fetch user info from database
        $row = $stmt->fetch();
        if($row)
        {
            // Check Password
            $check_password = hash('sha256', $_POST['password'] . $row['salt']);
            for($round = 0; $round < 65536; $round++)
            {
                $check_password = hash('sha256', $check_password . $row['salt']);
            }
            
            if($check_password === $row['password'])
            {
                // If they do, then we flip this to true
                $login_ok = true;
            }
        }
        
        // If the user logged in succesfully, redirect
        // Otherwise, we display a login failed message and show the login form again
        if($login_ok)
        {
            // Remove salt and password from array
            unset($row['salt']);
            unset($row['password']);
            
            // Set session
            $_SESSION['user'] = $row;
            
            // Redirect the user after succesful login
            header("Location: admin.php");
            die("Redirecting to: admin.php");
        }
        else
        {
            // Tell the user they failed
            print("Login Failed.");
            
            // Show username again
            $submitted_username = htmlentities($_POST['username'], ENT_QUOTES, 'UTF-8');
        }
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
<h1>Login</h1>
<form action="login.php" method="post">
    Username:<br />
    <input type="text" name="username" value="<?php echo $submitted_username; ?>" />
    <br /><br />
    Password:<br />
    <input type="password" name="password" value="" />
    <br /><br />
    <input type="submit" value="Login" />
</form>
<a href="register.php">Register</a>
		</div>
		<div class="Posts_Section">
		<?php
include 'common.php';

// Create connection and Close if No Connection
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