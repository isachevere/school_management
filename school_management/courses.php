<?php
// Include database connection
include 'database.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Course Records</title>
    <link rel="stylesheet" href="style.css">
    
    <!-- JavaScript for "Go Back" button functionality -->
    <script>
        function goBack() {
            window.history.back();
        }
    </script>
</head>
<body>
    <h1>Course Records</h1>
    
    <!-- Course Records Table -->
    <table border="1">
        <tr>
            <th>CRN</th>
            <th>Instructor</th>
            <th>Classroom</th>
            <th>Days</th>
            <th>Time</th>
            <th>Edit</th>
        </tr>
        
        <?php
        // Fetch and display course records
        $stmt = $conn->query("SELECT * FROM course");
        while ($row = $stmt->fetch()) {
            echo "<tr>
                    <td>{$row['crn']}</td>
                    <td>{$row['instructor']}</td>
                    <td>{$row['classroom']}</td>
                    <td>{$row['days']}</td>
                    <td>{$row['time']}</td>
                    <td><a href='edit_course.php?crn={$row['crn']}'>Edit</a></td>
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

