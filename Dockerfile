# PHP와 Apache가 포함된 기본 이미지 사용
FROM php:apache

# 컨테이너 내부에서 작업할 디렉토리를 설정 (기본 경로)
WORKDIR /var/www/html

# 현재 디렉토리의 모든 파일을 컨테이너의 작업 디렉토리로 복사
COPY . .

# PHP MySQL 확장 설치 (데이터베이스 연동용)
RUN docker-php-ext-install mysqli

# 포트 80번 개방 (기본 HTTP 포트)
EXPOSE 80

# Apache 서버를 실행 (기본 CMD)
CMD ["apache2-foreground"]
