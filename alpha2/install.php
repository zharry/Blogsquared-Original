<?php

echo "<center><h2>Random-Blog Engine Installer</h2>";

// Include Database Connections
include 'connection.php';

// Create connection and Close if No Connection
$connection=mysql_connect($host,$username,$password,$dbname) or die('<hr/><center><h2>ERROR</h2><hr/><br/>Cannot connect : ' . mysql_error() . '<br/><br/>Make sure your connection details are correct and you have MySQL5.5+ and PHP5.3+ <small>(Not Tested with before versions.)<small><hr/></center>');
echo "MySQL Connection Started";

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
echo "<br/>Table 'users' created successfully\n";

// Create Table Posts
$sqlcreateposts = "CREATE TABLE `posts`( 
	`user` varchar(50) NOT NULL, 
	`postid` int(10) NOT NULL, 
	`date` varchar(50) NOT NULL, 
	`postname` varchar(50) NOT NULL, 
	`post` varchar(1000) NOT NULL, 
	PRIMARY KEY (`user`)); ";
mysql_select_db( $dbname );
$retvaltableposts = mysql_query( $sqlcreateposts, $connection );
if(! $retvaltableposts )
{
  die('Could not create table "posts": ' . mysql_error());
}
echo "<br/>Table 'posts' created successfully\n";

// Close Connection
mysql_close($connection);
echo "<br/>MySQL Connection Closed";
echo "<br/><hr/>Have Fun with your Blog!<br/>-Blog Squared Dev Team (Harry and Eric)</center>";
?>