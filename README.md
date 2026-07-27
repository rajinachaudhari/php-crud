# Ultra-Simplified PHP + MySQL CRUD (Exam-Ready)

This version is designed specifically to be **short, easy to memorize, and quick to write in Notepad** for beginners.

---

## 📁 Files Summary

| File | Purpose | Lines of Code |
|---|---|---|
| `db.php` | Connect to MySQL | ~4 lines |
| `delete.php` | Delete student & redirect | ~6 lines |
| `save.php` | Add & Update logic | ~17 lines |
| `view.php` | Display table with JOIN | ~35 lines |
| `index.php` | Add/Edit Form | ~50 lines |

---

## 📄 Complete Exam-Ready Code

### 1. `db.php`
```php
<?php
$conn = mysqli_connect("localhost", "root", "", "student_db");
if (!$conn) {
    die("Connection Failed: " . mysqli_connect_error());
}
?>
```

---

### 2. `delete.php`
```php
<?php
include 'db.php';

$id = $_GET['id'];

mysqli_query($conn, "DELETE FROM student WHERE student_id = $id");

header("Location: view.php");
?>
```

---

### 3. `save.php`
```php
<?php
include 'db.php';

$id         = $_POST['student_id'];
$name       = $_POST['student_name'];
$address    = $_POST['address'];
$class_id   = $_POST['class_id'];
$subject_id = $_POST['subject_id'];

if ($id) {
    $sql = "UPDATE student 
            SET student_name='$name', address='$address', class_id='$class_id', subject_id='$subject_id' 
            WHERE student_id=$id";
} else {
    $sql = "INSERT INTO student (student_name, address, class_id, subject_id) 
            VALUES ('$name', '$address', '$class_id', '$subject_id')";
}

mysqli_query($conn, $sql);
header("Location: view.php");
?>
```

---

### 4. `view.php`
```php
<?php
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
```

---

### 5. `index.php`
```php
<?php
include 'db.php';

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
```
