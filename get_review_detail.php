<?php
require_once 'db_connect.php';

$id = $_GET['id'];
$sql = "SELECT * FROM reviews WHERE id = ?";

$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$review = $result->fetch_assoc();

header('Content-Type: application/json');
echo json_encode($review);
?>