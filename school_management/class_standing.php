<?php
// Include database connection
include 'database.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Class Standing Records</title>
    <link rel="stylesheet" href="style.css"> <!-- Link to your CSS file for styling -->

    <!-- JavaScript for "Go Back" button functionality -->
    <script>
        function goBack() {
            window.history.back();
        }
    </script>
</head>
<body>
    <h1>Class Standing Records</h1>
    <p>Page loaded on: <?php echo date("Y-m-d H:i:s"); ?></p>

    <h2>Class Standing List</h2>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Class</th>
            <th>Maximum Credits</th>
            <th>Minimum Credits</th>
        </tr>
        
        <?php
        // Fetch all records from the class_standing table
        $stmt = $conn->query("SELECT * FROM class_standing");
        if ($stmt->rowCount() > 0) {
            while ($row = $stmt->fetch()) {
                echo "<tr>
                        <td>{$row['id']}</td>
                        <td>{$row['class']}</td>
                        <td>{$row['max_credits']}</td>
                        <td>{$row['min_credits']}</td>
                      </tr>";
            }
        } else {
            echo "<tr><td colspan='4'>No class standing records found.</td></tr>";
        }
        ?>
    </table>

    <!-- Go Back Button at the Bottom -->
    <div class="back-button-container">
        <button onclick="goBack()">Go Back</button>
    </div>

</body>
</html>

