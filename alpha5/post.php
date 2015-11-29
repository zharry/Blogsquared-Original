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
	
	$connection=mysql_connect($host,$username,$password,$dbname) or die('<hr/><center><h2>ERROR</h2><hr/><br/>Cannot connect : ' . mysql_error() . '<br/><br/>Make sure your connection details are correct and you have MySQL5.5+ and PHP5.3+ <small>(Not Tested with before versions.)<small><hr/></center>');
	
    if(!empty($_POST))
    {
        if(empty($_POST['postname']))
        {
            //This is terrible Harry, I'm gonna fix this later
			//I'm also going to use this for the posting page, your the best! :) :)
            die("Please enter a postname.");
        }
        if(empty($_POST['post']))
        {
            die("Write something instead of leaving it blank! Also don't write one letter, or two. You get what I mean.");
        }
        $query_params = array(
            ':postname' => $_POST['postname'],
            ':post' => $_POST['post']
        );
		// Add rows to database
        $query = "
            INSERT INTO `posts` (
				postuser,
				postdate,
                postname,
                post
            ) VALUES (
				'$_POST[postuser]',
				'$_POST[postdate]',
                '$_POST[postname]',
                '$_POST[post]'
            )";
			mysql_select_db( $dbname );
$retvalquery = mysql_query( $query, $connection );
if(! $retvalquery )
{
  die('Opps, something went wrong. Try again:' . mysql_error());
}
mysql_close($connection);
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
<a href="admin.php">Back</a>
	<h1>Post</h1>
<form action="post.php" method="post">
	<input type="hidden" name="postuser" value="<?php echo htmlentities($_SESSION['user']['username'], ENT_QUOTES, 'UTF-8'); ?>" />
	<input type="hidden" name="postdate" value="<?php echo date("Y-m-d"); ?>" />
    Post Name:<input type="text" name="postname"/>
    <br /><br />
    Post:<br />
    <textarea rows="10" cols="35" name="post"></textarea>
    <br /><br />
    <input type="submit" value="Submit Post!" />
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
echo "<center><hr/><br/>Date of Post: " . $info['postdate'] . "<br/>User who posted: " . $info['postuser'] . "<br/>Post Name: " . $info['postname'] . "<br/><b>Post:</b><br/>" . $info['post'] . "<br/><hr/><br/></center>";
}
?>
		</div>
	</div>
</body>
</html>