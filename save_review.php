<?php
ob_start(); // 출력 버퍼링 시작
session_start(); // 세션 시작
require_once 'db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // 로그인 여부 확인
    if (!isset($_SESSION['username'])) {
        echo "로그인이 필요합니다.";
        exit();
    }

    $game_title = $_POST['game_title'];
    $title = $_POST['title'];
    $rating = $_POST['rating'];
    $content = $_POST['content'];
    $author = $_SESSION['username']; // 실제 로그인한 사용자 이름으로 변경

    $sql = "INSERT INTO reviews (game_title, title, rating, content, author) 
            VALUES (?, ?, ?, ?, ?)";
    
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssiss", $game_title, $title, $rating, $content, $author);
    
    if ($stmt->execute()) {
        header("Location: reviews.html");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>