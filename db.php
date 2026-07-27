<?php
// db.php - Database connection (Only 4 lines to memorize!)
$conn = mysqli_connect("localhost", "root", "", "student_db");
if (!$conn) {
    die("Connection Failed: " . mysqli_connect_error());
}
?>
