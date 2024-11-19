<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $stmt = $conn->prepare("INSERT INTO users (firstname, middlename, lastname, age, address, course_section) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->execute([
        $_POST['firstname'],
        $_POST['middlename'],
        $_POST['lastname'],
        $_POST['age'],
        $_POST['address'],
        $_POST['course_section']
    ]);
    header('Location: index.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create User</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Create New User</h1>
        <form method="POST">
            <input type="text" name="firstname" placeholder="First Name" required>
            <input type="text" name="middlename" placeholder="Middle Name" required>
            <input type="text" name="lastname" placeholder="Last Name" required>
            <input type="number" name="age" placeholder="Age" required>
            <input type="text" name="address" placeholder="Address" required>
            <input type="text" name="course_section" placeholder="Course/Section" required>
            <button type="submit" class="btn">Create</button>
        </form>
    </div>
</body>
</html>
