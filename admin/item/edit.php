<body>
    <nav>
        <ul>
			<li><a href="../item">back</a></li>
        </ul>
    </nav>
</body>

<style>
    img {
        height: auto;
        width: 100px;
    }
</style>

<?php
include '../../conn.php';

$ID = $_GET['ID'];

$select_sql = "SELECT * FROM item WHERE ID = \"$ID\";";
$result = $conn->query($select_sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $defaultimg = base64_encode(file_get_contents(base_url . "admin/img/defaultimg.png"));
    
    echo "<form method='POST' action='doedit.php'>";
    echo "<input type='hidden' name='ID' value='" . $row["ID"] . "'>";
    echo "<table>";
    echo "<tr><th>ID</th><td><input type='text' name='item ID' value='" . $row["ID"] . "' readonly></td></tr>";
    echo "<tr><th>貼文ID</th><td><a href='../post/edit.php?ID={$row['postID']}'><input type='text' name='post ID' value='" . $row["postID"] . "' readonly></td></a></tr>";
    echo "<tr><th>名稱</th><td><input type='text' name='name' value='" . $row["name"] . "'></td>";
    echo "<tr><th>類別</th><td><input type='text' name='Category' value='" . $row["kind"] . "'></td>";
    
    $stateMap = [
        0 => "尋找中",
        1 => "待領取",
        2 => "已解決"
    ];
    
    $state = isset($stateMap[$row['state']]) ? $stateMap[$row['state']] : "未知狀態";
    $options = array_values($stateMap);
    $currentValue = $state;
    
    echo "<tr><th>狀態</th><td><select name='state'>";
    foreach ($options as $option) {
        echo "<option value='$option'";
        if ($option == $currentValue) echo " selected";
        echo ">$option</option>";
    }
    echo "</select></td></tr>";

    $sql2 = "SELECT department.campus AS campus, department.building AS building, department.name AS name
        FROM (item INNER JOIN itemlocate ON item.ID = itemlocate.itemID)
        INNER JOIN department ON department.ID = itemlocate.deptID
    WHERE item.ID =\"" . $row['ID'] . "\";";
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

    echo "<tr><td></td><td style='display: flex; align-items: center;'>";
    if($row["photo"] == NULL){
        echo '<img src="data:image/jpeg;base64,' . $defaultimg . '" />';
    }
    else{
        $imageBase64 = base64_encode($row["photo"]);
        echo '<img src="data:image/jpeg;base64,' . $imageBase64 . '" />';
    }
    echo "<input type='submit' name='removeimg' value='審核'/></th>";
    echo "</td></tr>";

    
    
    
    echo "</table>";
    echo "</form>";

}
else{
	echo "edit fault";
    header('Location: index.php');
}			
?>
