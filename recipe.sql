CREATE DATABASE food;
USE food;

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) UNIQUE,
    password VARCHAR(255),
    role ENUM('admin','user') DEFAULT 'user'
);

CREATE TABLE recipes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(100),
    ingredients TEXT,
    instructions TEXT,
    image_url VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Admin account (password: admin123)
INSERT INTO users (username, password, role)
VALUES (
  'admin',
  '$2y$10$2b2x3p0Xh4c2O3M1yHczheZsO8RrX.Pm0uP5YjO0T6zZpZ2eW1b2S',
  'admin'
);
