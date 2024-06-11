<?php
include '../../conn.php';
if ($_SERVER["REQUEST_METHOD"] == "POST"){
    $ID = $_POST['ID'];

    if(isset($_POST['edit'])){

        $selectedState = $_POST['type'];
        $stateMap = [
            "失物尋找" => 0,
            "拾獲招領" => 1,
        ];

        $state = isset($stateMap[$selectedState]) ? $stateMap[$selectedState] : null;
        $sql = "UPDATE post SET type = '$state' WHERE ID = '$ID'";
        
        if($conn->query($sql) === TRUE){
            $selectedloc = $_POST['location'];
            if(!empty($selectedloc)){
                $parts = explode("-", $selectedloc);
                $campus = trim($parts[0]);
                $building = trim($parts[1]);
                $name = trim($parts[2]);
                
                $select_sql = "SELECT ID FROM department WHERE campus = '$campus' AND building = '$building' AND name = '$name';";
                $result = $conn->query($select_sql);
                if ($result->num_rows > 0){
                    $row = $result->fetch_assoc();
                    $deptID = $row['ID'];
                    $check_sql = "SELECT * FROM postlocate WHERE postID = '$ID';";
                    $check = $conn->query($check_sql);
                    if ($check->num_rows > 0){
                        $sql2 = "UPDATE postlocate SET deptID = '$deptID' WHERE postID = '$ID'";
                    }
                    else{
                        $sql2 = "INSERT INTO `postlocate` (`postID`, `deptID`) VALUES ('$ID', '$deptID');";
                    }
                    if ($conn->query($sql2) === TRUE) {
                        echo "Record updated successfully";
                        header('Location: index.php');
                        exit;
                    }
                }
            }
        }
    }
    elseif(isset($_POST['removeimg'])){
        $sql = "UPDATE item SET photo = NULL WHERE ID = '$ID'";
        if ($conn->query($sql) === TRUE) {
            echo "Record updated successfully";
            header('Location: index.php');
            exit;
        }
    }

    echo "Error updating record: " . $conn->error;
    header('Location: index.php');
    
    $conn->close();
}
?>
