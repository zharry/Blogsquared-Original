<!DOCTYPE html>
<html>

<head>
<title>Blog Squared Installer</title>
<link rel="stylesheet" type="text/css" href="styles.css">
<!--IE Compatability-->
<!--[if lte IE 8]>
<script src="../includes/jquery-1.11.1.js"></script>
	<![endif]-->
	<!--[if gte IE 9]>
<script src="../includes/jquery-2.1.1.js"></script>
	<![endif]-->
	<!--[if !IE]><!-->
<script src="../includes/jquery-2.1.1.js"></script>
	<!--<![endif]-->
<link rel="stylesheet" type="text/css" href="../themes/Lightness/jquery-ui.css">
</head>

<body>
<center><h2>Blog Squared Engine Installer</h2>

<center>
<form action="install_control.php" method="post">
<div id="install">
	<ul>
		<li><a href="#tabs-1">Database Information</a></li>
		<li><a href="#tabs-2">Admin Account</a></li>
		<li><a href="#tabs-3">Blogsquared Config</a></li>
		<li><a href="#tabs-4">Confirm</a></li>
		<li><a href="#tabs-5">Install Requirements</a></li>
	</ul>
	<div id="tabs-1">
		Host: <input type="text" name="mysql_host"><br/>
		Username: <input type="text" name="mysql_user"><br/>
		Password: <input type="password" name="mysql_pass"><br/>
		Database: <input type="text" name="mysql_database"><br/>
	</div>
	<div id="tabs-2">
		Username: <input type="text" name="admin_user"><br/>
		Email: <input type="text" name="admin_email"><br/>
		Password: <input type="password" name="admin_pass"><br/>
	</div>
	<div id="tabs-3">
		Site Title: <input type="text" name="bs_title"><br/>
	</div>
	<div id="tabs-4">
		Are you ready to complete the installation?<br/>
		<input type="submit" value="Install!"><br/>
	</div>
	<div id="tabs-5">
		<i>Blogsquared System Requirements:</i><br/>
		<u>PHP: 5.3.8</u><br/>
		<u>MySQL: 5.1.56</u><br/>
		<u>Disk Space: 10MB</u><br/>
	</div>
</div>
</form>
</center>

<script src="../themes/Lightness/jquery-ui.js"></script>
<script>
$("#install").tabs();
</script>

</body>
</html>