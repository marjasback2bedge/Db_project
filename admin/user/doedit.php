<?php
include '../../conn.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $ID = $_POST['ID'];

    if(isset($_POST['cont_edit'])){
        $sql = "UPDATE user SET contact = '' WHERE ID = '$ID'";
    }
    elseif(isset($_POST['name_edit'])){
        $sql = "UPDATE user SET name = 'defaultUser$ID' WHERE ID = '$ID'";
    }

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
