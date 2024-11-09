<?php
// Include database connection
include 'database.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Classroom Records</title>
    <link rel="stylesheet" href="style.css">
    
    <!-- JavaScript for "Go Back" button functionality -->
    <script>
        function goBack() {
            window.history.back();
        }
    </script>
</head>
<body>
    <h1>Classroom Records</h1>
    
    <!-- Classroom Records Table -->
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Building</th>
            <th>Floor</th>
            <th>Room</th>
            <th>Edit</th>
        </tr>
        
        <?php
        // Fetch and display classroom records
        $stmt = $conn->query("SELECT * FROM classroom");
        while ($row = $stmt->fetch()) {
            echo "<tr>
                    <td>{$row['id']}</td>
                    <td>{$row['building']}</td>
                    <td>{$row['floor']}</td>
                    <td>{$row['room']}</td>
                    <td><a href='edit_classroom.php?id={$row['id']}'>Edit</a></td>
                  </tr>";
        }
        ?>
    </table>

    <!-- Go Back Button at the Bottom -->
    <div class="back-button-container">
        <button onclick="goBack()">Go Back</button>
    </div>

</body>
</html>


