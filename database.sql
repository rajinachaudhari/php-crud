-- SQL Script to create database and tables for Student CRUD Application

-- Create database if it does not exist
CREATE DATABASE IF NOT EXISTS `student_db`;
USE `student_db`;

-- 1. Create table for Class Definitions
CREATE TABLE IF NOT EXISTS `def_class` (
    `class_id` INT AUTO_INCREMENT PRIMARY KEY,
    `class_name` VARCHAR(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- 2. Create table for Subject Definitions
CREATE TABLE IF NOT EXISTS `def_subject` (
    `subject_id` INT AUTO_INCREMENT PRIMARY KEY,
    `subject_name` VARCHAR(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- 3. Create table for Students with Foreign Keys
CREATE TABLE IF NOT EXISTS `student` (
    `student_id` INT AUTO_INCREMENT PRIMARY KEY,
    `student_name` VARCHAR(100) NOT NULL,
    `address` TEXT NOT NULL,
    `class_id` INT NOT NULL,
    `subject_id` INT NOT NULL,
    CONSTRAINT `fk_student_class` FOREIGN KEY (`class_id`) REFERENCES `def_class` (`class_id`) ON DELETE CASCADE ON UPDATE CASCADE,
    CONSTRAINT `fk_student_subject` FOREIGN KEY (`subject_id`) REFERENCES `def_subject` (`subject_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Insert sample data into def_class table
INSERT INTO `def_class` (`class_name`) VALUES 
('Class 9'),
('Class 10'),
('Class 11'),
('Class 12');

-- Insert sample data into def_subject table
INSERT INTO `def_subject` (`subject_name`) VALUES 
('Mathematics'),
('Science'),
('English'),
('Computer Science'),
('Physics');
