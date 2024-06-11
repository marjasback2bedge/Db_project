<?php
include '../../conn.php';
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['insert'])) {
    
    $campus = $_POST['campus'];
    $building = $_POST['building'];
    $name = $_POST['name'];
    $check_sql = "SELECT count(ID) AS count FROM department WHERE campus = '$campus' AND building = '$building' AND name = '$name';";
    $conn->query($check_sql);
    $result = $conn->query($check_sql);
    if ($result === false) {
        die("error: " . $conn->error);
    }
    $row = $result->fetch_assoc();
    if($row['count'] > 0){
        echo "Error: Duplicate values";
        echo "<a href='../dept'>back</a>";
    }
    else{
        $sql = "INSERT INTO department (`name`, `campus`, `building`) VALUES ('$name', '$campus', '$building');";
        
        if ($conn->query($sql) === TRUE) {
            echo "Record updated successfully";
            header('Location: index.php');
            exit;
        } else {
            echo "Error: " . $conn->error;
            echo "<a href='../user'>back</a>";
        }
    }
    $conn->close();
}
?>
