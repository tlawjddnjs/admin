CREATE DATABASE IF NOT EXISTS adm;
USE adm;

-- 데이터베이스의 문자 집합을 UTF-8로 설정
CREATE DATABASE IF NOT EXISTS adm CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

-- UTF-8 문자 집합으로 users 테이블 생성
CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL,
    password VARCHAR(255) NOT NULL,
    email VARCHAR(100),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

-- UTF-8 문자 집합으로 reviews 테이블 생성
CREATE TABLE IF NOT EXISTS reviews (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    content TEXT NOT NULL,
    rating INT,
    title VARCHAR(255),
    game_title VARCHAR(255),
    author VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
