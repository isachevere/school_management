<?php
include 'database.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Instructors</title>
    <link rel="stylesheet" href="style.css">
    <script>
        function goBack() {
            window.history.back();
        }
    </script>
</head>
<body>
    <h1>Instructor Records</h1>
    <p>Page loaded on: <?php echo date("Y-m-d H:i:s"); ?></p>

    <h2>Instructor List</h2>
    <table border="1">
        <tr>
            <th>ID</th><th>First Name</th><th>Last Name</th><th>Specialty</th>
        </tr>
        <?php
        $stmt = $conn->query("SELECT * FROM instructor");
        while ($row = $stmt->fetch()) {
            echo "<tr><td>{$row['employee_id']}</td><td>{$row['first_name']}</td><td>{$row['last_name']}</td><td>{$row['specialty']}</td></tr>";
        }
        ?>
    </table>

    <h2>Add New Instructor</h2>
    <form method="post">
        <label>First Name: <input type="text" name="first_name" required></label><br>
        <label>Last Name: <input type="text" name="last_name" required></label><br>
        <label>Specialty: <input type="text" name="specialty" required></label><br>
        <input type="submit" name="submit" value="Add Instructor">
    </form>

    <?php
    if (isset($_POST['submit'])) {
        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];
        $specialty = $_POST['specialty'];

        $sql = "INSERT INTO instructor (first_name, last_name, specialty) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);
        if ($stmt->execute([$first_name, $last_name, $specialty])) {
            echo "<p>New instructor added successfully!</p>";
        } else {
            echo "<p>Error adding instructor.</p>";
        }
        header("Refresh:0"); // Refresh to show the new instructor
    }
    ?>

    <!-- Go Back Button at the Bottom -->
    <div class="back-button-container">
        <button onclick="goBack()">Go Back</button>
    </div>
    
</body>
</html>
