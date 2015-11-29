<?php

    require("common.php");
    
    // Check if User Logged in
    if(empty($_SESSION['user']))
    {
        // Redirect if not logged in
        header("Location: login.php");
        
        // IMPORTANT
        die("Redirecting to login.php");
    }
    
    // If form submitted
    if(!empty($_POST))
    {
        // Validate Email
        if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL))
        {
            die("Invalid E-Mail Address");
        }
        
        // Check for database conflicts
        if($_POST['email'] != $_SESSION['user']['email'])
        {
            // Define our SQL query
            $query = "
                SELECT
                    1
                FROM users
                WHERE
                    email = :email
            ";
            
            // Define our query parameter values
            $query_params = array(
                ':email' => $_POST['email']
            );
            
            try
            {
                // Execute the query
                $stmt = $db->prepare($query);
                $result = $stmt->execute($query_params);
            }
            catch(PDOException $ex)
            {
                // Get Rid of Later
                die("Failed to run query: " . $ex->getMessage());
            }
            
            // Display if conflicts occur
            $row = $stmt->fetch();
            if($row)
            {
                die("This E-Mail address is already in use");
            }
        }
        
        // Generate Salt for New Password
        if(!empty($_POST['password']))
        {
            $salt = dechex(mt_rand(0, 2147483647)) . dechex(mt_rand(0, 2147483647));
            $password = hash('sha256', $_POST['password'] . $salt);
            for($round = 0; $round < 65536; $round++)
            {
                $password = hash('sha256', $password . $salt);
            }
        }
        else
        {
            // Password stays the same if unchanged
            $password = null;
            $salt = null;
        }
        
        // Initial query parameter values
        $query_params = array(
            ':email' => $_POST['email'],
            ':user_id' => $_SESSION['user']['id'],
        );
        
        // New parameter values for salt and password
        if($password !== null)
        {
            $query_params[':password'] = $password;
            $query_params[':salt'] = $salt;
        }
        
        // First Part of the query
        $query = "
            UPDATE users
            SET
                email = :email
        ";
        
        // If password is being changed, select the password and salt tokens as well.
        if($password !== null)
        {
            $query .= "
                , password = :password
                , salt = :salt
            ";
        }
        
        // Finish Query By Selecting only the current user id
        $query .= "
            WHERE
                id = :user_id
        ";
        
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
        
        // Refresh the session
        $_SESSION['user']['email'] = $_POST['email'];
        
        // Redirect
        header("Location: admin.php");
        
        // IMPORTANT, STOPS SCRIPT
        die("Redirecting to admin.php");
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
	<h1>Edit Account</h1>
<form action="edit-account.php" method="post">
    Username:<br />
    <b><?php echo htmlentities($_SESSION['user']['username'], ENT_QUOTES, 'UTF-8'); ?></b>
    <br /><br />
    E-Mail Address:<br />
    <input type="text" name="email" value="<?php echo htmlentities($_SESSION['user']['email'], ENT_QUOTES, 'UTF-8'); ?>" />
    <br /><br />
    Password:<br />
    <input type="password" name="password" value="" /><br />
    <i>(leave blank if you do not want to change your password)</i>
    <br /><br />
    <input type="submit" value="Update Account" />
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