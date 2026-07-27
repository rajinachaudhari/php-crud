<?php
// save.php - Handles both Insert and Update
include 'db.php';

$id         = $_POST['student_id'];
$name       = $_POST['student_name'];
$address    = $_POST['address'];
$class_id   = $_POST['class_id'];
$subject_id = $_POST['subject_id'];

// If $id exists -> UPDATE, else -> INSERT
if ($id) {
    $sql = "UPDATE student 
            SET student_name='$name', address='$address', class_id='$class_id', subject_id='$subject_id' 
            WHERE student_id=$id";
} else {
    $sql = "INSERT INTO student (student_name, address, class_id, subject_id) 
            VALUES ('$name', '$address', '$class_id', '$subject_id')";
}

mysqli_query($conn, $sql);

// Redirect to view page
header("Location: view.php");
?>
