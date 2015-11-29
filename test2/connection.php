<?php
    $mysql_hostname = "mysql7.000webhost.com";
    $mysql_user = "a5475551_server";
    $mysql_password = "mysqladmin1";
    $mysql_database = "a5475551_server";
    $prefix = "";
    $bd = mysql_connect($mysql_hostname, $mysql_user, $mysql_password) or die("Could not connect database");
    mysql_select_db($mysql_database, $bd) or die("Could not select database");
?>