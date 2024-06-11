<?php
include '../../conn.php';
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['edit'])) {
    $ID = $_POST['ID'];
    $campus = $_POST['campus'];
    $building = $_POST['building'];
    $name = $_POST['name'];        
    $sql = "UPDATE department SET campus = '$campus', name = '$name', building = '$building' WHERE ID = '$ID'";

    if ($conn->query($sql) === TRUE) {
        echo "Record updated successfully";
        header('Location: index.php');
        exit;
    } else {
        echo "Error updating record: " . $conn->error;
        header('Location: index.php');
    }

    $conn->close();
}
?>
