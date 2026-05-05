-- Database Setup Script for EduConnect Application
-- Run this script in your educonnect2 database to create all required tables

-- Create user table (noms de colonnes alignés sur UserService / UserSchemaService Java)
CREATE TABLE IF NOT EXISTS user (
    id INT AUTO_INCREMENT PRIMARY KEY,
    firstName VARCHAR(50) NOT NULL,
    lastName VARCHAR(50) NOT NULL,
    age INT NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    role ENUM('USER', 'ADMIN') NOT NULL DEFAULT 'USER',
    photo_path VARCHAR(255),
    reset_code VARCHAR(10) DEFAULT NULL,
    reset_code_expiry DATETIME DEFAULT NULL,
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
INSERT INTO user (firstName, lastName, age, email, password, role) 
VALUES ('Admin', 'User', 25, 'admin@educonnect.com', 'admin123', 'ADMIN')
ON DUPLICATE KEY UPDATE firstName = VALUES(firstName);

-- Insert sample regular user (you can change the password)
INSERT INTO user (firstName, lastName, age, email, password, role) 
VALUES ('John', 'Doe', 20, 'john@educonnect.com', 'user123', 'USER')
ON DUPLICATE KEY UPDATE firstName = VALUES(firstName);

-- Show the created tables
SHOW TABLES LIKE '%user%';
SHOW TABLES LIKE '%forum_votes%';

-- Show sample data
SELECT * FROM user WHERE email IN ('admin@educonnect.com', 'john@educonnect.com');
