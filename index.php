<?php
// index.php - Form for both Add and Edit
include 'db.php';

// Check if editing existing student
$id = $_GET['id'] ?? '';
$name = $address = $class_id = $subject_id = '';

if ($id) {
    $res = mysqli_query($conn, "SELECT * FROM student WHERE student_id = $id");
    $row = mysqli_fetch_assoc($res);
    $name       = $row['student_name'];
    $address    = $row['address'];
    $class_id   = $row['class_id'];
    $subject_id = $row['subject_id'];
}

// Fetch lists for dropdowns
$classes  = mysqli_query($conn, "SELECT * FROM def_class");
$subjects = mysqli_query($conn, "SELECT * FROM def_subject");
?>

<!DOCTYPE html>
<html>
<head><title>Student Form</title></head>
<body>

<h2><?php echo $id ? "Edit" : "Add"; ?> Student</h2>
<a href="view.php">View All Students</a><br><br>

<form action="save.php" method="POST">
    <!-- Hidden input stores student_id when editing -->
    <input type="hidden" name="student_id" value="<?php echo $id; ?>">

    Name: <br>
    <input type="text" name="student_name" value="<?php echo $name; ?>" required><br><br>

    Address: <br>
    <textarea name="address" required><?php echo $address; ?></textarea><br><br>

    Class: <br>
    <select name="class_id" required>
        <option value="">-- Select Class --</option>
        <?php while ($c = mysqli_fetch_assoc($classes)) { ?>
            <option value="<?php echo $c['class_id']; ?>" <?php if ($c['class_id'] == $class_id) echo 'selected'; ?>>
                <?php echo $c['class_name']; ?>
            </option>
        <?php } ?>
    </select><br><br>

    Subject: <br>
    <select name="subject_id" required>
        <option value="">-- Select Subject --</option>
        <?php while ($s = mysqli_fetch_assoc($subjects)) { ?>
            <option value="<?php echo $s['subject_id']; ?>" <?php if ($s['subject_id'] == $subject_id) echo 'selected'; ?>>
                <?php echo $s['subject_name']; ?>
            </option>
        <?php } ?>
    </select><br><br>

    <input type="submit" value="<?php echo $id ? "Update" : "Save"; ?>">
</form>

</body>
</html>
