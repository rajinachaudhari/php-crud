<?php
// save.php - Handles both Insert and Update
include 'db.php';

$id           = $_POST['student_id'];
$name         = $_POST['student_name'];
$address      = $_POST['address'];
$class_name   = $_POST['class_name'];
$subject_name = $_POST['subject_name'];

if ($id) {
    $sql = "UPDATE student SET student_name='$name', address='$address', class_name='$class_name', subject_name='$subject_name' WHERE student_id=$id";
} else {
    $sql = "INSERT INTO student (student_name, address, class_name, subject_name) VALUES ('$name', '$address', '$class_name', '$subject_name')";
}

mysqli_query($conn, $sql);
header("Location: view.php");
?>
