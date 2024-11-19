<?php
include 'db.php';

if (!isset($_GET['id'])) {
    header('Location: index.php');
    exit;
}

$id = $_GET['id'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $stmt = $conn->prepare("UPDATE users SET firstname = ?, middlename = ?, lastname = ?, age = ?, address = ?, course_section = ? WHERE id = ?");
    $stmt->execute([
        $_POST['firstname'],
        $_POST['middlename'],
        $_POST['lastname'],
        $_POST['age'],
        $_POST['address'],
        $_POST['course_section'],
        $id
    ]);
    header('Location: index.php');
    exit;
}

$stmt = $conn->prepare("SELECT * FROM users WHERE id = ?");
$stmt->execute([$id]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);
if (!$user) {
    header('Location: index.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Edit User</h1>
        <form method="POST">
            <input type="text" name="firstname" value="<?= htmlspecialchars($user['firstname']) ?>" required>
            <input type="text" name="middlename" value="<?= htmlspecialchars($user['middlename']) ?>" required>
            <input type="text" name="lastname" value="<?= htmlspecialchars($user['lastname']) ?>" required>
            <input type="number" name="age" value="<?= htmlspecialchars($user['age']) ?>" required>
            <input type="text" name="address" value="<?= htmlspecialchars($user['address']) ?>" required>
            <input type="text" name="course_section" value="<?= htmlspecialchars($user['course_section']) ?>" required>
            <button type="submit" class="btn">Update</button>
        </form>
    </div>
</body>
</html>
