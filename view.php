<?php
// view.php - Displays all records in HTML table using JOIN
include 'db.php';

$sql = "SELECT student.*, def_class.class_name, def_subject.subject_name 
        FROM student 
        JOIN def_class ON student.class_id = def_class.class_id 
        JOIN def_subject ON student.subject_id = def_subject.subject_id 
        ORDER BY student.student_id DESC";

$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html>
<head><title>Student List</title></head>
<body>

<h2>Student Records</h2>
<a href="index.php">Add New Student</a><br><br>

<table border="1" cellpadding="8">
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Address</th>
        <th>Class</th>
        <th>Subject</th>
        <th>Actions</th>
    </tr>

    <?php while ($row = mysqli_fetch_assoc($result)) { ?>
    <tr>
        <td><?php echo $row['student_id']; ?></td>
        <td><?php echo $row['student_name']; ?></td>
        <td><?php echo $row['address']; ?></td>
        <td><?php echo $row['class_name']; ?></td>
        <td><?php echo $row['subject_name']; ?></td>
        <td>
            <a href="index.php?id=<?php echo $row['student_id']; ?>">Edit</a> | 
            <a href="delete.php?id=<?php echo $row['student_id']; ?>" onclick="return confirm('Delete record?')">Delete</a>
        </td>
    </tr>
    <?php } ?>
</table>

</body>
</html>
