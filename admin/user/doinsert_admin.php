<?php
include '../../conn.php';
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['signup'])) {
    
    $name = $_POST['name'];
    $password = $_POST['password'];
    $contact = $_POST['contact'];

    $check_sql = "SELECT count(ID) AS count FROM user WHERE name = '$name';";
    $conn->query($check_sql);
    $result = $conn->query($check_sql);
    if ($result === false) {
        die("error: " . $conn->error);
    }
    $row = $result->fetch_assoc();
    if($row['count'] > 0){
        echo "Error: Duplicate name</br>";
        echo "<a href='../user'>back</a>";
    }
    else{
        $sql = "INSERT INTO user (`type`, `name`, `password`, `contact`) VALUES ('0', '$name', '$password', '$contact');";
    
        if ($conn->query($sql) === TRUE) {
            echo "Record updated successfully";
            header('Location: index.php');
            exit;
        } else {
            echo "Error: " . $conn->error;
            echo "<br><a href='../user'>back</a>";
        }
    }
    $conn->close();
}
?>
