<?php

session_start();

$aResult = array();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the JSON data from the request body
    $putData = file_get_contents('php://input');
    $requestData = json_decode($putData, true);

    if (isset($requestData['usertype'])) {
        $_SESSION['usertype'] = $requestData['usertype'];
        $aResult['message'] = 'User type set to ' . $_SESSION['usertype'];
    } else {
        $aResult['error'] = 'Missing usertype in request';
    }

    // Set the response content type to JSON
    header('Content-Type: application/json');

    // Send the JSON-encoded result
    echo json_encode($aResult);
} else {
    $aResult['error'] = 'Invalid request method';
    // Set the response content type to JSON
    header('Content-Type: application/json');
    // Send the JSON-encoded result
    echo json_encode($aResult);
}
?>
