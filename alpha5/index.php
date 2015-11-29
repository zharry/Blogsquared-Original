<?php
include("common.php");
mysql_connect($host,$username,$password) or die('<hr/><center><h2>ERROR</h2><hr/><br/>Cannot connect : ' . mysql_error() . '<br/><br/>Make sure your connection details are correct and you have MySQL5.5+ and PHP5.3+ <small>(Not Tested with before versions.)<small><hr/></center>');
mysql_select_db($dbname);
$data = mysql_query("SELECT * FROM posts") or die(mysql_error());
$info = mysql_fetch_array( $data );
echo '<a href="admin.php">Admin Panel Access</a>';
while($info = mysql_fetch_array( $data ))
{
echo "<center><hr/><br/>Date of Post: " . $info['postdate'] . "<br/>User who posted: " . $info['postuser'] . "<br/>Post Name: " . $info['postname'] . "<br/><b>Post:</b><br/>" . $info['post'] . "<br/><hr/><br/></center>";
}
?>