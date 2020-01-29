<?php

/**
 * Filename: data.php
 * Description: Weekly Registered New Users Dashboard
 * Author: Amish Trivedi
 * Date developed: 27-Jan-2019
 * Version: 1.0
 */

//setting header to json
header('Content-Type: application/json');
 
include("connection.php");

$query = sprintf("SELECT COUNT(*) AS 'Users', WEEK(createdDate, 1) AS 'Week'
                  FROM USERS 
                  GROUP BY Week");

//execute query
$result = $mysqli->query($query);

//loop through the returned data
$data = array();
foreach ($result as $row) {
  $data[] = $row;
}

//free memory associated with result
$result->close();

//close connection
$mysqli->close();

//now print the data
print json_encode($data);

?>
