<?php
include 'database.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Get the current data for this classroom
    $stmt = $conn->prepare("SELECT * FROM classroom WHERE id = ?");
    $stmt->execute([$id]);
    $classroom = $stmt->fetch();

    if (!$classroom) {
        echo "Classroom not found.";
        exit;
    }

    // Update the room number if form is submitted
    if (isset($_POST['update'])) {
        $new_room = $_POST['room'];
        $update_stmt = $conn->prepare("UPDATE classroom SET room = ? WHERE id = ?");
        
        if ($update_stmt->execute([$new_room, $id])) {
            echo "<p>Room number updated successfully!</p>";
        } else {
            echo "<p>Error updating room number.</p>";
        }
        
        // Redirect to the classrooms list page
        header("Location: classrooms.php");
        exit;
    }
} else {
    echo "No classroom ID provided.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Classroom</title>
    <link rel="stylesheet" href="style.css">
    
    <!-- JavaScript for "Go Back" button functionality -->
    <script>
        function goBack() {
            window.history.back();
        }
    </script>
</head>
<body>
    <h1>Edit Classroom Room Number</h1>
    
    <!-- Edit Classroom Form -->
    <form method="post">
        <label>Building: <?php echo htmlspecialchars($classroom['building']); ?></label><br>
        <label>Floor: <?php echo htmlspecialchars($classroom['floor']); ?></label><br>
        <label>Room: <input type="text" name="room" value="<?php echo htmlspecialchars($classroom['room']); ?>" required></label><br>
        <input type="submit" name="update" value="Update Room">
    </form>

    <!-- Go Back Button at the Bottom -->
    <div class="back-button-container">
        <button onclick="goBack()">Go Back</button>
    </div>

</body>
</html>
