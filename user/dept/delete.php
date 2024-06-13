<?php
include '../../conn.php';

$ID = $_GET['ID'];

if (isset($ID)) {
    $delete_sql = "DELETE FROM department WHERE ID = '$ID';";

    if ($conn->query($delete_sql) === TRUE) {
        header('Location: index.php');
        exit;
    }
}
echo "delete fault<br>";
echo "<a href='../dept'>back</a>";
?>