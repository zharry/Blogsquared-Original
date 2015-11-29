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
	<b>Hello <?php echo htmlentities($_SESSION['user']['username'], ENT_QUOTES, 'UTF-8'); ?>!</b><br />
<a href="post.php">Make a post</a><br />
<a href="edit-account.php">Edit Account</a><br />
<a href="release_log.php">Release Log</a><br />
<a href="logout.php">Logout</a>
		</div>
		<div class="Posts_Section">
		<?php
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