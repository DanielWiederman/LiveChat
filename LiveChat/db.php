<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "livechat";

// Create connection
$mysqli = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$mysqli) {
    die("Connection failed: " . mysqli_connect_error());
}
//echo "Connected successfully";

?> 