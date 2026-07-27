<?php
// save.php (PDO Style - Insert & Update with Prepared Statements)
include 'db.php';

$id         = $_POST['student_id'];
$name       = $_POST['student_name'];
$address    = $_POST['address'];
$class_id   = $_POST['class_id'];
$subject_id = $_POST['subject_id'];

if ($id) {
    $stmt = $conn->prepare("UPDATE student SET student_name=?, address=?, class_id=?, subject_id=? WHERE student_id=?");
    $stmt->execute([$name, $address, $class_id, $subject_id, $id]);
} else {
    $stmt = $conn->prepare("INSERT INTO student (student_name, address, class_id, subject_id) VALUES (?, ?, ?, ?)");
    $stmt->execute([$name, $address, $class_id, $subject_id]);
}

header("Location: view.php");
?>
