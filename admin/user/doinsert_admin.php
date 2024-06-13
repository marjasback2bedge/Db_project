<?php
include '../../conn.php';
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['signup'])) {
    
    $name = $_POST['name'];
    $password = $_POST['password'];
    $contact = $_POST['contact'];

    $sql = "INSERT INTO user (`type`, `name`, `password`, `contact`) VALUES ('0', '$name', '$password', '$contact');";
  
    if ($conn->query($sql) === TRUE) {
        echo "Record updated successfully";
        header('Location: index.php');
        exit;
    } else {
        echo "Error: " . $conn->error;
        echo "<br><a href='../user'>back</a>";
    }

    $conn->close();
}
?>
