<?php
$conn = require $_SERVER['DOCUMENT_ROOT'] . '/config.php'; // require conn

if ($_SERVER['REQUEST_METHOD'] == "POST") { // request from the server
    // get form variables
    $scheduleid = $_POST['scheduleid'];
    $userid = $_POST['userid'];
    $status = $_POST['status'];


    // set statusBool to true or false based on the option selected
    if($status == 'booked'){
        $statusBool = 1;
    }else if($status == 'notbooked'){
        $statusBool = 0;
    }



    // Prepare SQL statement
    $sql = "";
    if($userid == ''){
        $sql = "UPDATE sessions SET userid = NULL, status = '$statusBool' WHERE scheduleid = '$scheduleid'";
    }else{
        $sql = "UPDATE sessions SET userid = '$userid', status = '$statusBool' WHERE scheduleid = '$scheduleid'";
    }

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

