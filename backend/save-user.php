<?php
// Load the database configuration file
require_once 'db_key.php';
$conn = connect_db();
// Get and decode the POST data
$userData = json_decode($_POST['userData']);

if (!empty($userData)) {
    // The user's profile info
    $clientId  = !empty($userData->clientId) ? $userData->clientId : '';
    $credential = !empty($userData->credential) ? $userData->credential : '';

    // Check whether the user data already exist in the database
    $query = "SELECT * FROM users WHERE clientId='$clientId'";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        // Update user data if already exists
        $query = "UPDATE users SET clientId='$clientId', credential='$credential' WHERE clientId='$clientId'";
        $update = $conn->query($query);
    } else {
        // Insert user data
        $query = "INSERT INTO users (clientId, credential) VALUES ('$clientId', '$credential')";
        $insert = $conn->query($query);
    }

    return $clientId;
}
