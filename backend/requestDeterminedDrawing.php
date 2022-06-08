<?php
require 'db_key.php';
$conn = connect_db();

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM drawings";
$result = $conn->query($sql);

header("Content-Type: application/json; charset=UTF-8");
$obj = json_decode($_GET["x"], false);

$stmt = $conn->prepare("SELECT structure FROM drawings WHERE id = ?");
$stmt->bind_param("s", $obj->id);
$stmt->execute();
$result = $stmt->get_result();
$outp = $result->fetch_all(MYSQLI_ASSOC);

echo json_encode($outp);
