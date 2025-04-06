<?php
$host = "localhost";
$username = "root";
$password = "";
$database = "registration_db";

try {
    $conn = new PDO("mysql:host=$host;dbname=$database", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if (isset($_GET['age'])) {
        $age = $_GET['age'];

        // Delete records with the entered age
        $stmt = $conn->prepare("DELETE FROM users WHERE age = ?");
        $stmt->execute([$age]);

        echo "<h2>Records after deletion:</h2>";

        // Fetch and display the remaining records
        $stmt = $conn->query("SELECT * FROM users");
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

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
            echo "<p>No records found.</p>";
        }
    } else {
        echo "No age provided for deletion.";
    }
} catch (PDOException $e) {
    die("Error: " . $e->getMessage());
}
?>
