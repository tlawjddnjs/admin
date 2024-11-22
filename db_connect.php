<?php
$servername = "mysql";  // MySQL 컨테이너 이름
$username = "root";     // MySQL 사용자 이름
$password = "root";     // docker-compose.yml에서 설정한 MYSQL_ROOT_PASSWORD
$dbname = "adm";        // docker-compose.yml에서 설정한 MYSQL_DATABASE

// 데이터베이스 연결 생성
$conn = new mysqli($servername, $username, $password, $dbname);

// 연결 확인
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// 한글 깨짐 방지
$conn->set_charset("utf8mb4");
?>
