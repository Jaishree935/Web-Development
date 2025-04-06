<?php
// Database connection
$host = 'localhost';
$dbname = 'registration_db';
$username = 'root';
$password = '';

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

if (isset($_GET['email'])) {
    $email = $_GET['email'];

    // Fetch user details
    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$user) {
        echo "<script>alert('No record found for this email!'); window.location.href = 'register.html';</script>";
        exit();
    }
} else {
    echo "<script>alert('Invalid request!'); window.location.href = 'register.html';</script>";
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update'])) {
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $age = $_POST['age'];
    $gender = $_POST['gender'];
    $skills = implode(", ", $_POST['skills']);

    $stmt = $conn->prepare("UPDATE users SET name = ?, phone = ?, age = ?, gender = ?, skills = ? WHERE email = ?");
    $stmt->execute([$name, $phone, $age, $gender, $skills, $email]);

    echo "<script>alert('Record Updated Successfully!'); window.location.href = 'register.html';</script>";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Form</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h2>Update Form</h2>
        <form action="" method="post">
            <input type="hidden" name="email" value="<?= $user['email'] ?>">
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" value="<?= $user['name'] ?>">
            </div>
            <div class="form-group">
                <label for="phone">Phone:</label>
                <input type="number" id="phone" name="phone" value="<?= $user['phone'] ?>">
            </div>
            <div class="form-group">
                <label for="age">Age:</label>
                <input type="number" id="age" name="age" value="<?= $user['age'] ?>">
            </div>
            <div class="form-group">
                <label>Gender:</label>
                <div class="radio-group">
                    <input type="radio" name="gender" value="Male" <?= ($user['gender'] == 'Male') ? 'checked' : '' ?>> Male
                    <input type="radio" name="gender" value="Female" <?= ($user['gender'] == 'Female') ? 'checked' : '' ?>> Female
                </div>
            </div>
            <div class="form-group">
                <label>Skills:</label>
                <div class="checkbox-group">
                    <?php 
                    $user_skills = explode(", ", $user['skills']);
                    ?>
                    <input type="checkbox" name="skills[]" value="Java" <?= in_array("Java", $user_skills) ? "checked" : "" ?>> Java
                    <input type="checkbox" name="skills[]" value="C++" <?= in_array("C++", $user_skills) ? "checked" : "" ?>> C++
                    <input type="checkbox" name="skills[]" value="Python" <?= in_array("Python", $user_skills) ? "checked" : "" ?>> Python
                </div>
            </div>
            <button type="submit" name="update">Update</button>
        </form>
    </div>
</body>
</html>
