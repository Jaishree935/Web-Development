<?php
$host = "localhost";
$username = "root";
$password = "";
$database = "registration_db";

try {
    $conn = new PDO("mysql:host=$host;dbname=$database", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if (isset($_GET['skill'])) {
        $skill = $_GET['skill'];

        // Fetch users with the selected skill
        $stmt = $conn->prepare("SELECT * FROM users WHERE FIND_IN_SET(?, skills)");
        $stmt->execute([$skill]);
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        echo "<h2>Users with Skill: $skill</h2>";

        if (count($results) > 0) {
            echo "<style>
                    table {
                        width: 80%;
                        border-collapse: collapse;
                        margin: 20px 0;
                        font-size: 18px;
                        text-align: left;
                    }
                    th, td {
                        padding: 12px;
                        border-bottom: 1px solid #ddd;
                    }
                    th {
                        background-color: #4CAF50;
                        color: white;
                    }
                    tr:hover {
                        background-color: #f5f5f5;
                    }
                  </style>";

            echo "<table>";
            echo "<tr><th>Name</th><th>Email</th><th>Phone</th><th>Age</th><th>Gender</th><th>Skills</th></tr>";
            foreach ($results as $row) {
                echo "<tr>
                        <td>{$row['name']}</td>
                        <td>{$row['email']}</td>
                        <td>{$row['phone']}</td>
                        <td>{$row['age']}</td>
                        <td>{$row['gender']}</td>
                        <td>{$row['skills']}</td>
                    </tr>";
            }
            echo "</table>";
        } else {
            echo "<p>No users found with this skill.</p>";
        }
    } else {
        echo "No skill selected.";
    }
} catch (PDOException $e) {
    die("Error: " . $e->getMessage());
}
?>
