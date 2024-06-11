<?php
include '../../conn.php';

$ID = $_GET['ID'];

if (isset($ID)) {
    $delete_sql = "DELETE FROM itemlocate WHERE itemID = '$ID';";

	if ($conn->query($delete_sql) === TRUE) {
        $delete_sql = "DELETE FROM item WHERE ID = '$ID';";
        if ($conn->query($delete_sql) === TRUE){
           	header('Location: index.php');
		    exit; 
        }

    }
}
echo "delete fault";
header('Location: index.php');

?>