<?php
// index.php (PDO Style - Form for both Add and Edit)
include 'db.php';

$id = $_GET['id'] ?? '';
$name = $address = $class_id = $subject_id = '';

if ($id) {
    $stmt = $conn->prepare("SELECT * FROM student WHERE student_id = ?");
    $stmt->execute([$id]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $name       = $row['student_name'];
    $address    = $row['address'];
    $class_id   = $row['class_id'];
    $subject_id = $row['subject_id'];
}

$classes  = $conn->query("SELECT * FROM def_class")->fetchAll(PDO::FETCH_ASSOC);
$subjects = $conn->query("SELECT * FROM def_subject")->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
<head><title>Student Form (PDO)</title></head>
<body>

<h2><?php echo $id ? "Edit" : "Add"; ?> Student (PDO)</h2>
<a href="view.php">View All Students</a><br><br>

<form action="save.php" method="POST">
    <input type="hidden" name="student_id" value="<?php echo $id; ?>">

    Name: <br>
    <input type="text" name="student_name" value="<?php echo $name; ?>" required><br><br>

    Address: <br>
    <textarea name="address" required><?php echo $address; ?></textarea><br><br>

    Class: <br>
    <select name="class_id" required>
        <option value="">-- Select Class --</option>
        <?php foreach ($classes as $c) { ?>
            <option value="<?php echo $c['class_id']; ?>" <?php if ($c['class_id'] == $class_id) echo 'selected'; ?>>
                <?php echo $c['class_name']; ?>
            </option>
        <?php } ?>
    </select><br><br>

    Subject: <br>
    <select name="subject_id" required>
        <option value="">-- Select Subject --</option>
        <?php foreach ($subjects as $s) { ?>
            <option value="<?php echo $s['subject_id']; ?>" <?php if ($s['subject_id'] == $subject_id) echo 'selected'; ?>>
                <?php echo $s['subject_name']; ?>
            </option>
        <?php } ?>
    </select><br><br>

    <input type="submit" value="<?php echo $id ? "Update" : "Save"; ?>">
</form>

</body>
</html>
