<?php
// database.php
$servername = "localhost";
$username = "root";
$password = ""; // Default password for MySQL on XAMPP is empty
$dbname = "school_management";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>
