
# Dockerized PHP-MySQL Web Application

This project is a PHP-MySQL web application designed to run in a Dockerized environment. The setup includes a web server with PHP and a MySQL database, all managed through Docker Compose.

---

## Prerequisites

Before starting, ensure you have the following installed:

- **Git**: To clone the project repository.
- **Docker**: To build and run containerized services.
- **Docker Compose**: To manage multi-container Docker applications.

---

## Getting Started

### 1. Clone the Repository

Clone the project from the GitHub repository:

```bash
git clone https://github.com/username/project.git
cd project
```

### 2. Project Structure

Ensure the project directory contains the following files:

```
project/
├── Dockerfile
├── docker-compose.yml
├── init.sql
├── index.php
├── db_connect.php
└── Other project files (HTML, CSS, JS, etc.)
```

### 3. Docker Configuration

#### Dockerfile
The `Dockerfile` is set up to use a PHP-Apache image and includes `mysqli` support:

```dockerfile
FROM php:apache
WORKDIR /var/www/html
COPY . .
RUN docker-php-ext-install mysqli
```

#### docker-compose.yml
The `docker-compose.yml` defines two services: `web` (PHP-Apache server) and `db` (MySQL database):

```yaml
version: '3.8'

services:
  web:
    build: .
    ports:
      - "8080:80"
    volumes:
      - .:/var/www/html
    depends_on:
      - db

  db:
    image: mysql:5.7
    environment:
      MYSQL_ROOT_PASSWORD: root
      MYSQL_DATABASE: adm
      MYSQL_USER: user
      MYSQL_PASSWORD: password
    ports:
      - "3306:3306"
    volumes:
      - db_data:/var/lib/mysql
      - ./init.sql:/docker-entrypoint-initdb.d/init.sql

volumes:
  db_data:
```

#### init.sql
The `init.sql` file initializes the MySQL database and creates a `users` table:

```sql
CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL,
    password VARCHAR(255) NOT NULL,
    email VARCHAR(100),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
```

---

## How to Run

### 1. Build and Start the Containers

Run the following commands to build and start the containers:

```bash
docker-compose down --volumes  # Clean up any existing volumes
docker-compose up --build
```

### 2. Access the Application

- Open your web browser and navigate to [http://localhost:8080](http://localhost:8080).
- The application should be running.

### 3. Access the MySQL Database

To interact with the database:

```bash
docker exec -it mysql mysql -u root -p
```

Enter the password `root` (as specified in the `docker-compose.yml` file).

#### Verify Database and Tables
Run the following commands to verify the setup:

```sql
SHOW DATABASES;
USE adm;
SHOW TABLES;
```

You should see a `users` table in the `adm` database.

---

## Troubleshooting

### 1. Check Docker Logs
If the application is not working, check the logs:

```bash
docker-compose logs
```

### 2. Debug Inside Containers
To debug inside a container, use:

- **Web container**:
  ```bash
  docker exec -it web bash
  ```
- **Database container**:
  ```bash
  docker exec -it mysql mysql -u root -p
  ```

---

## Clean Up

To stop and remove all containers, networks, and volumes:

```bash
docker-compose down --volumes
docker container prune -f
docker volume prune -f
```

---

## Notes

- Ensure `init.sql` is properly mapped in `docker-compose.yml` for database initialization.
- The default ports are `8080` for the web application and `3306` for MySQL.

---

This `README.md` should provide clear instructions for setting up and running your Dockerized web application. 🚀
