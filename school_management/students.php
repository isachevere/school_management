<?php
include 'database.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Student Records</title>
    <link rel="stylesheet" href="style.css">
    <script>
        function goBack() {
            window.history.back();
        }
    </script>
</head>
<body>
    <h1>Student Records</h1>
    <p>Page loaded on: <?php echo date("Y-m-d H:i:s"); ?></p>

    <h2>Student List</h2>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Street</th>
            <th>City</th>
            <th>State</th>
            <th>ZIP</th>
            <th>Class Standing</th>
            <th>Major</th>
        </tr>
        <?php
        // Fetch all records from the student table
        $stmt = $conn->query("SELECT * FROM student");
        if ($stmt->rowCount() > 0) {
            while ($row = $stmt->fetch()) {
                echo "<tr><td>{$row['student_id']}</td><td>{$row['first_name']}</td><td>{$row['last_name']}</td><td>{$row['street']}</td><td>{$row['city']}</td><td>{$row['state']}</td><td>{$row['zip']}</td><td>{$row['class_standing']}</td><td>{$row['major']}</td></tr>";
            }
        } else {
            echo "<tr><td colspan='9'>No student records found.</td></tr>";
        }
        ?>
    </table>

    <h2>Add New Student</h2>
    <form method="post">
        <label>First Name: <input type="text" name="first_name" required></label><br>
        <label>Last Name: <input type="text" name="last_name" required></label><br>
        <label>Street: <input type="text" name="street" required></label><br>
        <label>City: <input type="text" name="city" required></label><br>
        <label>State: <input type="text" name="state" required></label><br>
        <label>ZIP: <input type="text" name="zip" required></label><br>
        <label>Class Standing: <input type="number" name="class_standing" required></label><br>
        <label>Major: <input type="text" name="major" required></label><br>
        <input type="submit" name="submit" value="Add Student">
    </form>

    <?php
    if (isset($_POST['submit'])) {
        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];
        $street = $_POST['street'];
        $city = $_POST['city'];
        $state = $_POST['state'];
        $zip = $_POST['zip'];
        $class_standing = $_POST['class_standing'];
        $major = $_POST['major'];

        $sql = "INSERT INTO student (first_name, last_name, street, city, state, zip, class_standing, major) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        if ($stmt->execute([$first_name, $last_name, $street, $city, $state, $zip, $class_standing, $major])) {
            echo "<p>New student added successfully!</p>";
        } else {
            echo "<p>Error adding student.</p>";
        }
        header("Refresh:0"); // Refresh to show the new student
    }
    ?>

    <!-- Go Back Button at the Bottom -->
    <div class="back-button-container">
        <button onclick="goBack()">Go Back</button>
    </div>
    
</body>
</html>
