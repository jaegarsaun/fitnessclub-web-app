<?php


$conn = require $_SERVER['DOCUMENT_ROOT'] . '/config.php'; // require conn

if ($_SERVER['REQUEST_METHOD'] == "POST") { // request from the server
    // get form variables
    $name = $_POST['name'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $role = $_POST['role'];

    // prepare sql
    $sql = "INSERT INTO users (name, username, password, role) VALUES ('$name', '$username', '$password', '$role')";

    // run sql
    $result = $conn->query($sql);

    // Check if the delete operation was successful
    if ($result) {
        $affectedRows = $conn->affected_rows;
        if ($affectedRows > 0) {
            http_response_code(200); // OK - The request was successful
        } else {
            http_response_code(400); // Bad request
        }
    } else {
        http_response_code(500); // Internal Server Error
    }


}
