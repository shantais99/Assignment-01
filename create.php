<?php
require 'StudentManager.php';

$manager = new StudentManager('students.json');
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $data = [
        'id'     => time(), // simple unique id
        'name'   => $_POST['name'],
        'email'  => $_POST['email'],
        'phone'  => $_POST['phone'],
        'status' => $_POST['status']
    ];

    if ($manager->create($data)) {
        header('Location: index.php');
        exit;
    } else {
        $error = 'Something went wrong (invalid email or duplicate ID)';
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Student</title>
</head>
<body>

<h2>Add New Student</h2>

<?php if ($error): ?>
<p style="color:red;"><?= $error ?></p>
<?php endif; ?>

<form method="post">
    <p>
        Name: <br>
        <input type="text" name="name" required>
    </p>

    <p>
        Email: <br>
        <input type="email" name="email" required>
    </p>

    <p>
        Phone: <br>
        <input type="text" name="phone" required>
    </p>

    <p>
        Status: <br>
        <select name="status">
            <option value="Active">Active</option>
            <option value="On Leave">On Leave</option>
            <option value="Graduated">Graduated</option>
            <option value="Inactive">Inactive</option>
        </select>
    </p>

    <button type="submit">Save</button>
</form>

<br>
<a href="index.php">⬅ Back to list</a>

</body>
</html>
