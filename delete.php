<?php
// delete.php (PDO Style - Delete record using Prepared Statement)
include 'db.php';

$id = $_GET['id'];

$stmt = $conn->prepare("DELETE FROM student WHERE student_id = ?");
$stmt->execute([$id]);

header("Location: view.php");
?>
