<?php

define('DB_SERVER', '192.168.0.2'); //Database IP
define('DB_USERNAME', 'root'); //Database username
define('DB_PASSWORD', 'EAYyMZUJJrB3A9'); //Database password
define('DB_NAME', 'PRO1000'); //Database name
 
// Try to connect to DB
$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
 
// Check connection, return error if failed
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
?>