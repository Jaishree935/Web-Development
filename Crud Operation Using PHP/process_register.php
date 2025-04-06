<?php
$host = "localhost";
$username = "root";
$password = "";
$database = "registration_db";

try {
    $conn = new PDO("mysql:host=$host;dbname=$database", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $age = $_POST['age'];
    $gender = $_POST['gender'];
    $skills = isset($_POST['skills']) ? implode(", ", $_POST['skills']) : "";

    // Check if Email Already Exists
    $check = $conn->prepare("SELECT COUNT(*) FROM users WHERE email = ?");
    $check->execute([$email]);
    $emailExists = $check->fetchColumn();

    if ($emailExists > 0) {
        // Redirect with error message
        header("Location: register.html?message=" . urlencode("Error: Email already exists!"));
        exit();
    } else {
        $stmt = $conn->prepare("INSERT INTO users (name, email, phone, age, gender, skills) VALUES (?, ?, ?, ?, ?, ?)");
        if ($stmt->execute([$name, $email, $phone, $age, $gender, $skills])) {
            header("Location: register.html?message=" . urlencode("Registration Successful!"));
        } else {
            header("Location: register.html?message=" . urlencode("Error: Something went wrong!"));
        }
        exit();
    }
}
?>
