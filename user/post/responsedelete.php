<?php
include '../../conn.php';

$ID = $_GET['ID'];
$time = $_GET['time'];

if (isset($ID)) {
    $delete_sql = "DELETE FROM response WHERE userID = '$ID' AND time = '$time';";

	if ($conn->query($delete_sql) === TRUE) {
        header('Location: index.php');
        exit; 
    }
}
echo "delete fault";
header('Location: index.php');

?>