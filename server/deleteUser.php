<?php
$conn = require $_SERVER['DOCUMENT_ROOT'] . '/config.php'; // require conn

if($_SERVER['REQUEST_METHOD'] == "POST"){ // request from the server
    // get userid from request
    $userid = $_POST['userid'];

    // prepare sql
    $sql = "DELETE FROM users WHERE userid = CAST('$userid' AS SIGNED);";

    // run sql
    $result = $conn->query($sql);

    // Check if the delete operation was successful
    if ($result) {
        $affectedRows = $conn->affected_rows;
        if ($affectedRows > 0) {
            http_response_code(200); // OK - The request was successful
        } else {
            http_response_code(404); // Not Found - No user found with the given userid
        }
    } else {
        http_response_code(500); // Internal Server Error
    }



}