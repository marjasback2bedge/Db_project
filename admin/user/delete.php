<?php
include '../../conn.php';

$ID = $_GET['ID'];

if (isset($ID)) {
    $delete_sql = "DELETE FROM user WHERE ID = '$ID' and type = 1;";

    if ($conn->query($delete_sql) === TRUE) {
        header('Location: index.php');
        exit;
    }
}
echo "delete fault<br>";
echo "<a href='../user'>back</a>";
?>