<?php
// view.php - Displays all records in HTML table
include 'db.php';

$sql = "SELECT * FROM student ORDER BY student_id ASC";
$result = mysqli_query($conn, $sql);
$sn = 1;
?>

<!DOCTYPE html>
<html>
<head><title>Student List</title></head>
<body>

<h2>Student Records</h2>
<a href="index.php">Add New Student</a><br><br>

<table border="1" cellpadding="8">
    <tr>
        <th>S.N.</th>
        <th>ID</th>
        <th>Name</th>
        <th>Address</th>
        <th>Class</th>
        <th>Subject</th>
        <th>Actions</th>
    </tr>

    <?php while ($row = mysqli_fetch_assoc($result)) { ?>
    <tr>
        <td><?php echo $sn++; ?></td>
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
