<?php
require 'StudentManager.php';

$manager = new StudentManager('students.json');

$id = $_GET['id'];
$student = $manager->getStudentById($id);

if (!$student) {
    die('Student not found');
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $data = [
        'name'   => $_POST['name'],
        'email'  => $_POST['email'],
        'phone'  => $_POST['phone'],
        'status' => $_POST['status']
    ];

    $manager->update($id, $data);
    header('Location: index.php');
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Student</title>
</head>
<body>

<h2>Edit Student</h2>

<form method="post">
    <p>
        Name: <br>
        <input type="text" name="name" value="<?= $student['name'] ?>" required>
    </p>

    <p>
        Email: <br>
        <input type="email" name="email" value="<?= $student['email'] ?>" required>
    </p>

    <p>
        Phone: <br>
        <input type="text" name="phone" value="<?= $student['phone'] ?>" required>
    </p>

    <p>
        Status: <br>
        <select name="status">
            <?php
            $statuses = ['Active','On Leave','Graduated','Inactive'];
            foreach ($statuses as $status):
            ?>
                <option value="<?= $status ?>" 
                    <?= $student['status'] === $status ? 'selected' : '' ?>>
                    <?= $status ?>
                </option>
            <?php endforeach; ?>
        </select>
    </p>

    <button type="submit">Update</button>
</form>

<br>
<a href="index.php">⬅ Back to list</a>

</body>
</html>
