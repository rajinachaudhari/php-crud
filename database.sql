-- SQL Script to create database and tables for Student CRUD Application

-- Create database if it does not exist
CREATE DATABASE IF NOT EXISTS `student_db`;
USE `student_db`;

-- Create table for students using direct class and subject values
CREATE TABLE IF NOT EXISTS `student` (
    `student_id` INT AUTO_INCREMENT PRIMARY KEY,
    `student_name` VARCHAR(100) NOT NULL,
    `address` TEXT NOT NULL,
    `class_name` VARCHAR(100) NOT NULL,
    `subject_name` VARCHAR(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
