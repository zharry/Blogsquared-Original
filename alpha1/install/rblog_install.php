<?php

echo "<center><h2>Random-Blog Engine Installer</h2>";

// Include Database Connections
include 'rblog_connection.php';

// Create connection and Close if No Connection
$connection=mysql_connect($host,$username,$password,$dbname) or die('<hr/><center><h2>ERROR</h2><hr/><br/>Cannot connect : ' . mysql_error() . '<br/><br/>Make sure your connection details are correct and you have MySQL5.5+ and PHP5.3+ <small>(Not Tested with before versions.)<small><hr/></center>');
echo "MySQL Connection Started";

// Create Table Users
$sqlcreateusers = "CREATE TABLE users( "."username VARCHAR(50) NOT NULL, "."password VARCHAR(100) NOT NULL, "."email VARCHAR(100) NOT NULL, "."PRIMARY KEY ( username )); ";
mysql_select_db( $dbname );
$retvaltableusers = mysql_query( $sqlcreateusers, $connection );
if(! $retvaltableusers )
{
  die('Could not create table "users": ' . mysql_error());
}
echo "<br/>Table 'users' created successfully\n";

// Create Table Posts
$sqlcreateposts = "CREATE TABLE posts( "."user VARCHAR(50) NOT NULL, "."date VARCHAR(50) NOT NULL, "."post VARCHAR(1000) NOT NULL, "."PRIMARY KEY ( user )); ";
mysql_select_db( $dbname );
$retvaltableposts = mysql_query( $sqlcreateposts, $connection );
if(! $retvaltableposts )
{
  die('Could not create table "posts": ' . mysql_error());
}
echo "<br/>Table 'posts' created successfully\n";

// Put into Table
mysql_query("INSERT INTO `users`(`username`, `password`, `email`) VALUES ('Admin','Password','Admin@Domain.Com')");
echo "<br/>Admin Login Credentials Instered into Database.";

// Close Connection
mysql_close($connection);
echo "<br/>MySQL Connection Closed";
echo "<br/><hr/>Have Fun with your Blog!<br/>-Random-Blog Dev Team (Harry and Eric)</center>";
?>