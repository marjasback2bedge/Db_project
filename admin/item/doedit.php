<?php
include '../../conn.php';
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['edit'])) {
    $ID = $_POST['ID'];

    $category = $_POST['Category'];
    $name = $_POST['name'];

    $selectedState = $_POST['state'];
    $stateMap = [
        "尋找中" => 0,
        "待領取" => 1,
        "已解決" => 2
    ];
    $state = isset($stateMap[$selectedState]) ? $stateMap[$selectedState] : null;
    $sql = "UPDATE item SET kind = '$category', name = '$name', state = '$state' WHERE ID = '$ID'";
    
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
                $check_sql = "SELECT * FROM itemlocate WHERE itemID = '$ID';";
                $check = $conn->query($check_sql);
                if ($check->num_rows > 0){
                    $sql2 = "UPDATE itemlocate SET deptID = '$deptID' WHERE itemID = '$ID'";
                }
                else{
                    $sql2 = "INSERT INTO `itemlocate` (`itemID`, `deptID`) VALUES ('$ID', '$deptID');";
                }
                if ($conn->query($sql2) === TRUE) {
                    echo "Record updated successfully";
                    header('Location: index.php');
                    exit;
                }
            }
        }
    }

    echo "Error updating record: " . $conn->error;
    header('Location: index.php');
    
    $conn->close();
}
?>
