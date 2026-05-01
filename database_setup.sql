-- Database Setup Script for EduConnect Application
-- Run this script in your educonnect2 database to create all required tables

-- Create user table
CREATE TABLE IF NOT EXISTS user (
    id INT AUTO_INCREMENT PRIMARY KEY,
    first_name VARCHAR(50) NOT NULL,
    last_name VARCHAR(50) NOT NULL,
    age INT NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    role ENUM('USER', 'ADMIN') NOT NULL DEFAULT 'USER',
    photo_path VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Create forum_votes table for one-vote-per-user functionality
CREATE TABLE IF NOT EXISTS forum_votes (
    user_id INT NOT NULL,
    message_id INT NOT NULL,
    vote_type ENUM('up', 'down') NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (user_id, message_id),
    FOREIGN KEY (user_id) REFERENCES user(id) ON DELETE CASCADE,
    FOREIGN KEY (message_id) REFERENCES forum_message(id_forum_message) ON DELETE CASCADE
);

-- Insert sample admin user (you can change the password)
INSERT INTO user (first_name, last_name, age, email, password, role) 
VALUES ('Admin', 'User', 25, 'admin@educonnect.com', 'admin123', 'ADMIN')
ON DUPLICATE KEY UPDATE first_name = VALUES(first_name);

-- Insert sample regular user (you can change the password)
INSERT INTO user (first_name, last_name, age, email, password, role) 
VALUES ('John', 'Doe', 20, 'john@educonnect.com', 'user123', 'USER')
ON DUPLICATE KEY UPDATE first_name = VALUES(first_name);

-- Show the created tables
SHOW TABLES LIKE '%user%';
SHOW TABLES LIKE '%forum_votes%';

-- Show sample data
SELECT * FROM user WHERE email IN ('admin@educonnect.com', 'john@educonnect.com');
