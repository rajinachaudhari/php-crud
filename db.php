<?php
// db.php (PDO Style )
try {
    $conn = new PDO("mysql:host=localhost;dbname=student_db", "root", "");
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection Failed: " . $e->getMessage());
}
?>

