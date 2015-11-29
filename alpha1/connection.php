<?php
    $mysql_hostname = "localhost";
    $mysql_user = "rblog_system";
    $mysql_password = "myrandomblog";
    $mysql_database = "rblog_system";
    $prefix = "rblog_";
    $bd = mysql_connect($mysql_hostname, $mysql_user, $mysql_password) or die("Could not connect database");
    mysql_select_db($mysql_database, $bd) or die("Could not select database");
?>