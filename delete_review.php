<?php
session_start();
require_once 'db_connect.php';

if (!isset($_SESSION['username'])) {
    die('로그인이 필요합니다.');
}

if (!isset($_POST['review_id'])) {
    die('리뷰 ID가 필요합니다.');
}

$review_id = $_POST['review_id'];
$username = $_SESSION['username'];

// 먼저 리뷰 작성자 확인
$check_sql = "SELECT author FROM reviews WHERE id = ?";
$check_stmt = $conn->prepare($check_sql);
$check_stmt->bind_param("i", $review_id);
$check_stmt->execute();
$result = $check_stmt->get_result();
$review = $result->fetch_assoc();

if (!$review || $review['author'] !== $username) {
    die('삭제 권한이 없습니다.');
}

// 리뷰 삭제
$delete_sql = "DELETE FROM reviews WHERE id = ? AND author = ?";
$delete_stmt = $conn->prepare($delete_sql);
$delete_stmt->bind_param("is", $review_id, $username);

if ($delete_stmt->execute()) {
    echo "success";
} else {
    echo "삭제 실패: " . $conn->error;
}

$check_stmt->close();
$delete_stmt->close();
$conn->close();
?>