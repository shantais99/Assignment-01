<?php
require 'StudentManager.php';

$manager = new StudentManager('students.json');
$students = $manager->getAllStudents();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Student List</title>

    <style>
    body {
        font-family: Arial, sans-serif;
        background: #f4f6f8;
        padding: 30px;
    }
    h1 {
        margin-bottom: 10px;
        color: #4f46e5;
        text-align: center;
    }

    a {
        text-decoration: none;
        color: #4f46e5;
        font-weight: bold;
    }

      .top-bar {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .add-btn {
            background: #4f46e5;
            color: white;
            padding: 8px 14px;
            text-decoration: none;
            border-radius: 6px;
            font-size: 14px;
        }

    table {
        width: 100%;
        border-collapse: collapse;
        background: white;
        margin-top: 15px;
    }

    th {
        background: #4f46e5;
        color: white;
        padding: 10px;
    }

    td {
        padding: 10px;
        border-bottom: 1px solid #ddd;
    }

    tr:hover {
        background: #f1f1f1;
    }

    .status {
        padding: 4px 8px;
        border-radius: 6px;
        font-size: 12px;
        color: white;
        /*padding: 4px 10px;
        border-radius: 12px;
        font-size: 12px;
        color: white;
        display: inline-block;*/

    }

    .Active {
        background: green;
    }

    .Inactive {
        background: red;
    }

    .Graduated {
        background: gray;
    }

    .On\ Leave {
            background: orange;
    }

    .action a {
            margin-right: 10px;
            text-decoration: none;
            font-weight: bold;
    }
    
    .edit {
            color: #2563eb;
    }

    .delete {
            color: red;
    }
    
    </style>

</head>

<body>

<h1>Student List</h1>

<a href="create.php">➕ Add Student</a>

<table border="1" cellpadding="8">
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Email</th>
        <th>Phone</th>
        <th>Status</th>
        <th>Actions</th>
    </tr>

    <?php foreach ($students as $student): ?>
    <tr>
        <td><?= $student['id'] ?></td>
        <td><?= $student['name'] ?></td>
        <td><?= $student['email'] ?></td>
        <td><?= $student['phone'] ?></td>
        <td><?= $student['status'] ?></td>
        <td>
            <a href="edit.php?id=<?= $student['id'] ?>">Edit</a>
            |
            <a href="delete.php?id=<?= $student['id'] ?>">Delete</a>
        </td>
    </tr>
    <?php endforeach; ?>

</table>

</body>
</html>  
