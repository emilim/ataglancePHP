<?php
require 'db_key.php';
$conn = connect_db();

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

//$sql = "SELECT * FROM drawings";
//$result = $conn->query($sql);

header("Content-Type: application/json; charset=UTF-8");
$obj = json_decode($_GET["x"], false);

$stmt = $conn->prepare("SELECT * FROM drawings WHERE username = ?");
$stmt->bind_param("s", $obj->name);
$stmt->execute();
$result = $stmt->get_result();
$outp = $result->fetch_all(MYSQLI_ASSOC);

echo json_encode($outp);
/*
if ($result->num_rows > 0) {
    // output data of each row
    while ($row = $result->fetch_assoc()) {
        echo "id: " . $row["id"] . " - Name: " . $row["name"] . " - Structure:  " . $row["structure"] . "<br>";
    }
} else {
    echo "0 results";
}

while ($row = $result->fetch_assoc()) {
    print_r($result->num_rows . json_encode($result->fetch_assoc()));
}

$data = new stdClass();
if ($result->num_rows > 0) {
    // output data of each row
    while ($row = $result->fetch_assoc()) {
        $data->id = $row["id"];
        $data->age = $row["name"];
    }
} else {
    echo "0 results";
}
echo json_encode($data);
*/
$conn->close();
