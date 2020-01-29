<?php

/**
 * Filename: connection.php
 * Description: Weekly Registered New Users Dashboard
 * Author: Amish Trivedi
 * Date developed: 27-Jan-2019
 * Version: 1.0
 */

//database
define('DB_HOST', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', 'root');
define('DB_NAME', 'diary');

//get connection
$mysqli = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);

//check connection
if(!$mysqli){
  die("Connection failed: " . $mysqli->error);
}
  
?>