<?php
session_start();
include "../../conn.php";

// Enable error reporting
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
    
    $postID = $_POST['postID'];
    $content = $_POST['content'];
    $userID = $_SESSION['user_id'];

    // Check if user_id is set in session
    if (!isset($userID)) {
        die("User ID is not set in the session.");
    }

    // Sanitize input
    $postID = $conn->real_escape_string($postID);
    $content = $conn->real_escape_string($content);
    $userID = $conn->real_escape_string($userID);

    // Check for duplicate response
    $check_sql = "SELECT count(*) AS count FROM response WHERE postID = '$postID' AND userID = '$userID';";
    $result = $conn->query($check_sql);
    if ($result === false) {
        die("error: " . $conn->error);
    }
    $row = $result->fetch_assoc();
    if ($row['count'] > 0) {
        echo "Error: Duplicate values</br>";
        echo "<a href='../post'>back</a>";
    } else {
        $sql = "INSERT INTO response (`postID`, `userID`, `content`) VALUES ('$postID', '$userID', '$content');";
        
        if ($conn->query($sql) === TRUE) {
            echo "Record updated successfully";
            header('Location: index.php');
            exit;
        } else {
            echo "Error: " . $conn->error;
            echo "<a href='../post'>back</a>";
        }
    }
    $conn->close();
}
?>
