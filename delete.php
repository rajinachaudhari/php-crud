<?php
// delete.php - Deletes student record and redirects
include 'db.php';

$id = $_GET['id'];

mysqli_query($conn, "DELETE FROM student WHERE student_id = $id");

header("Location: view.php");
?>
