CREATE DATABASE scholarship_management;
USE scholarship_management;

-- 1️⃣ Table: Admin (Predefined Username & Password)
CREATE TABLE admin (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL
);

-- Insert predefined admin credentials (Replace `your_hashed_password` with an actual hashed password)
INSERT INTO admin (username, password) VALUES ('admin', 'your_hashed_password');

-- 2️⃣ Table: Students (Student Registration & Login)
CREATE TABLE students (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL, -- Stored as a hashed password (MD5, bcrypt, etc.)
    phone VARCHAR(15) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- 3️⃣ Table: Password Reset (For "Forgot Password" Feature)
CREATE TABLE password_reset (
    id INT AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(100) NOT NULL,
    token VARCHAR(255) NOT NULL, -- Unique reset token
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
