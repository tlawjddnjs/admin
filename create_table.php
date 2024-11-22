<?php
require_once 'db_connect.php';

$sql = "CREATE TABLE IF NOT EXISTS reviews (
    id INT AUTO_INCREMENT PRIMARY KEY,
    game_title VARCHAR(255) NOT NULL,
    title VARCHAR(255) NOT NULL,
    rating INT NOT NULL,
    content TEXT NOT NULL,
    author VARCHAR(100) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";

if ($conn->query($sql) === TRUE) {
    echo "리뷰 테이블이 성공적으로 생성되었습니다.";
} else {
    echo "테이블 생성 중 오류가 발생했습니다: " . $conn->error;
}

$conn->close();
?>