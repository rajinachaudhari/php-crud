<?php
// index.php - Form for both Add and Edit
include 'db.php';

$id = $_GET['id'] ?? '';
$name = $address = $class_name = $subject_name = '';

if ($id) {
    $res = mysqli_query($conn, "SELECT * FROM student WHERE student_id = $id");
    $row = mysqli_fetch_assoc($res);
    $name         = $row['student_name'];
    $address      = $row['address'];
    $class_name   = $row['class_name'];
    $subject_name = $row['subject_name'];
}
?>

<!DOCTYPE html>
<html>
<head><title>Student Form</title></head>
<body>

<h2><?php echo $id ? "Edit" : "Add"; ?> Student</h2>
<a href="view.php">View All Students</a><br><br>

<form action="save.php" method="POST">
    <input type="hidden" name="student_id" value="<?php echo $id; ?>">

    Name: <br>
    <input type="text" name="student_name" value="<?php echo $name; ?>" required><br><br>

    Address: <br>
    <textarea name="address" required><?php echo $address; ?></textarea><br><br>

    Class: <br>
    <input type="text" name="class_name" value="<?php echo $class_name; ?>" required><br><br>

    Subject: <br>
    <input type="text" name="subject_name" value="<?php echo $subject_name; ?>" required><br><br>

    <input type="submit" value="<?php echo $id ? "Update" : "Save"; ?>">
</form>

</body>
</html>
