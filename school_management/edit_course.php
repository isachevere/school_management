<?php
include 'database.php';
if (isset($_GET['crn'])) {
    $crn = $_GET['crn'];

    // Get the current data for this course
    $stmt = $conn->prepare("SELECT * FROM course WHERE crn = ?");
    $stmt->execute([$crn]);
    $course = $stmt->fetch();

    if (!$course) {
        echo "Course not found.";
        exit;
    }

    if (isset($_POST['update'])) {
        $new_days = $_POST['days'];
        $new_time = $_POST['time'];

        // Update the days and time
        $update_stmt = $conn->prepare("UPDATE course SET days = ?, time = ? WHERE crn = ?");
        if ($update_stmt->execute([$new_days, $new_time, $crn])) {
            echo "<p>Course schedule updated successfully!</p>";
        } else {
            echo "<p>Error updating course schedule.</p>";
        }
        // Refresh to show updated data
        header("Location: courses.php");
        exit;
    }
} else {
    echo "No course CRN provided.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Course</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Edit Course Schedule</h1>
    <form method="post">
        <label>Instructor ID: <?php echo $course['instructor']; ?></label><br>
        <label>Classroom ID: <?php echo $course['classroom']; ?></label><br>
        <label>Days: <input type="text" name="days" value="<?php echo $course['days']; ?>" required></label><br>
        <label>Time: <input type="text" name="time" value="<?php echo $course['time']; ?>" required></label><br>
        <input type="submit" name="update" value="Update Schedule">
    </form>
</body>
</html>
