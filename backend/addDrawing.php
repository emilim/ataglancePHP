<?php
require 'db_key.php';
$conn = connect_db();

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$id = $_POST['id'];
$name = $_POST['name'];
$structure = $_POST['structure'];
$username = $_POST['username'];

$verify = $conn->query("SELECT * FROM drawings WHERE id = '$id'");

if ($verify->num_rows == 0) { //nuovo
    $sql = "INSERT INTO drawings (id, name, structure, username) VALUES ('$id', '$name', '$structure', '$username')";

    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
if ($verify->num_rows == 1) { //esistente
    $sql = "UPDATE drawings SET name = '$name', structure = '$structure' WHERE id = '$id'";

    if ($conn->query($sql) === TRUE) {
        echo "Saved!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}



$conn->close();
