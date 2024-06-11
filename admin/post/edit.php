<body>
    <nav>
        <ul>
			<li><a href="../post">back</a></li>
        </ul>
    </nav>
</body>
<?php
include '../../conn.php';

$ID = $_GET['ID'];

$select_sql = "SELECT * FROM post WHERE ID = \"$ID\";";
$result = $conn->query($select_sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    
    echo "<form method='POST' action='doedit.php'>";
    echo "<input type='hidden' name='ID' value='" . $row["ID"] . "'>";
    echo "<table>";
    echo "<tr><th>ID</th><td><input type='text' name='post ID' value='" . $row["ID"] . "' readonly></td></tr>";
    echo "<tr><th>用戶ID</th><td><a href='../user/edit.php?ID={$row['userID']}'><input type='text' name='user ID' value='" . $row["userID"] . "' readonly></td></a></tr>";
    
    $stateMap = [
        0 => "失物尋找",
        1 => "拾獲招領",
    ];     
    $state = isset($stateMap[$row['type']]) ? $stateMap[$row['type']] : "未知狀態";
    $options = array_values($stateMap);
    $currentValue = $state;
    
    echo "<tr><th>用途</th><td><select name='type'>";
    foreach ($options as $option) {
        echo "<option value='$option'";
        if ($option == $currentValue) echo " selected";
        echo ">$option</option>";
    }
    echo "</select></td></tr>";

    $sql2 = "SELECT department.campus AS campus, department.building AS building, department.name AS name
        FROM (post INNER JOIN postlocate ON post.ID = postlocate.postID)
        INNER JOIN department ON department.ID = postlocate.deptID
    WHERE post.ID =\"" . $row['ID'] . "\";";
    $result2 = $conn->query($sql2);
    if ($result2->num_rows > 0){
        $row2 = $result2->fetch_assoc();
        $loc = "{$row2['campus']} - {$row2['building']} - {$row2['name']}";
    }
    else $loc = "";

    $loc_options = [""];
    $sql3 = "SELECT * FROM department
        ORDER BY campus ASC, building DESC, name ASC;";
    $result3 = $conn->query($sql3);
    
    if ($result3->num_rows > 0){
        while ($row3 = $result3->fetch_assoc()) {
            array_push($loc_options, "{$row3['campus']} - {$row3['building']} - {$row3['name']}");
        }
    }
    echo "<tr><th>位置</th><td><select name='location'>";
    foreach ($loc_options as $option) {
        echo "<option value='$option'";
        if ($option == $loc) echo " selected";
        echo ">$option</option>";
    }
    echo "</select></td></tr>";

    echo "<tr><th colspan='2'><input type='submit' name='edit' value='編輯'/></th></tr>";
    
    
    echo "</table>";
    echo "</form>";

}
else{
	echo "edit fault";
    header('Location: index.php');
}			
?>
