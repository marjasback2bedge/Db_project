<?php
session_start(); // Ensure the session is started
include '../../conn.php';

// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

if (!$conn->set_charset("utf8")) {
    printf("Error loading character set utf8: %s\n", $conn->error);
    exit();
}

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['insert'])) {
    
    // Ensure session user_id is set
    if (!isset($_SESSION['user_id'])) {
        die("User ID is not set in the session.");
    }

    $userID = $_SESSION['user_id'];
    $type = $_POST['type'];
    $occurtime = $_POST['occurtime'];

    // Sanitize input
    $userID = $conn->real_escape_string($userID);
    $type = $conn->real_escape_string($type);
    $occurtime = $conn->real_escape_string($occurtime);

    // Insert into post
    $sql = "INSERT INTO post (`occurtime`, `type`, `userID`) VALUES ('$occurtime', '$type', '$userID');";
    
    if ($conn->query($sql) === TRUE) {
        echo "Record updated successfully";
        header('Location: index.php');
        exit;
    } else {
        echo "Error: " . $conn->error;
        echo "<a href='../user'>back</a>";
    }

    $conn->close();
}
?>
