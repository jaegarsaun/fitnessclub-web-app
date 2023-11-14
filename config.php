<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "finalproject";

// Connect to db
$conn = new mysqli($servername, $username, $password, $dbname);

if($conn->connect_error){
    die("\nConnection Not Successful: " . $conn->connect_error);
}

return $conn;
?>