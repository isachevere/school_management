<?php
// Include database connection
include 'database.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Enrolled Records</title>
    <link rel="stylesheet" href="style.css"> <!-- Link to your CSS file for styling -->

    <!-- JavaScript for "Go Back" button functionality -->
    <script>
        function goBack() {
            window.history.back();
        }
    </script>
</head>
<body>
    <h1>Enrolled Records</h1>
    <p>Page loaded on: <?php echo date("Y-m-d H:i:s"); ?></p>

    <h2>Enrolled Students in Courses</h2>
    <table border="1">
        <tr>
            <th>Student ID</th>
            <th>Student Name</th>
            <th>Course CRN</th>
            <th>Course Name</th>
        </tr>
        
        <?php
        // Fetch all records from the enrolled table with student and course details
        $stmt = $conn->query("
            SELECT enrolled.student AS student_id, student.first_name, student.last_name,
                   enrolled.course AS course_crn, course.days AS course_name
            FROM enrolled
            JOIN student ON enrolled.student = student.student_id
            JOIN course ON enrolled.course = course.crn
        ");
        
        if ($stmt->rowCount() > 0) {
            while ($row = $stmt->fetch()) {
                echo "<tr>
                        <td>{$row['student_id']}</td>
                        <td>{$row['first_name']} {$row['last_name']}</td>
                        <td>{$row['course_crn']}</td>
                        <td>{$row['course_name']}</td>
                      </tr>";
            }
        } else {
            echo "<tr><td colspan='4'>No enrollment records found.</td></tr>";
        }
        ?>
    </table>

    <!-- Go Back Button at the Bottom -->
    <div class="back-button-container">
        <button onclick="goBack()">Go Back</button>
    </div>

</body>
</html>
