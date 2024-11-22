<?php
require_once 'db_connect.php';

$sql = "SELECT * FROM reviews ORDER BY created_at DESC";
$result = $conn->query($sql);

$reviews = array();
while($row = $result->fetch_assoc()) {
    $reviews[] = $row;
}

header('Content-Type: application/json');
echo json_encode($reviews);
?>