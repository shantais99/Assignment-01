<?php
require 'StudentManager.php';

$manager = new StudentManager('students.json');

$id = $_GET['id'];

$manager->delete($id);

header('Location: index.php');
exit;
