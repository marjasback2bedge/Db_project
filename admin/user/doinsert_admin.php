<?php
include '../../conn.php';
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['signup'])) {
    
    $name = $_POST['name'];
    $password = $_POST['password'];

    $sql = "INSERT INTO user (`type`, `name`, `password`) VALUES (0, '$name', '$password');";
  
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
