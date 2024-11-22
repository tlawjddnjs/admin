<?php
session_start();
require_once 'db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT id, username, password FROM users WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            echo "<script>
                sessionStorage.setItem('username', '".$user['username']."');
                sessionStorage.setItem('user_id', '".$user['id']."');
                window.location.href = 'reviews.html';
            </script>";
        } else {
            echo "비밀번호가 일치하지 않습니다.";
        }
    } else {
        echo "존재하지 않는 사용자입니다.";
    }
}
?>