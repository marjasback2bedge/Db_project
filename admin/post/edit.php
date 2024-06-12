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
    echo "<tr><th>發布時間</th><td><input type='text' name='post ID' value='" . date("Y-m-d H:i:s", strtotime($row['posttime'])) . "' readonly></td></tr>";
    echo "<tr><th>發生時間</th><td><input type='text' name='post ID' value='" . date("Y-m-d H:i:s", strtotime($row['occurtime'])) . "' readonly></td></tr>";
    
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

<style>
    img {
        height: 30px;
        width: auto;
    }
</style>
<table>
	<thead>
		<tr>
			<th>#</th>
			<th>ID</th>
			<th>名稱</th>
			<th>分類</th>
			<th>狀態</th>
			<th>位置</th>
			<th></th>
		</tr>
	</thead>
	<?php 
		$i = 1;
		$sqli = "SELECT *
			FROM item
            WHERE postID = '$ID';";
		$resulti = $conn->query($sqli);

		if ($resulti === false) {
			die("error: " . $conn->error);
		}

		if ($resulti->num_rows > 0) {
            $defaultimg = base64_encode(file_get_contents(base_url . "admin/img/defaultimg.png"));
			while ($rowi = $resulti->fetch_assoc()) {
				echo "<tr>";
				echo "<td>" . $i++ . "</td>";
				echo "<td>" . $rowi['ID'] . "</td>";
				echo "<td>" . $rowi['name'] . "</td>";
				echo "<td>" . $rowi['kind'] . "</td>";
				echo "<td>";
				if ($rowi['state'] == 0) {
					echo "尋找中";
				} 
				elseif ($rowi['state'] == 1){
					echo "待領取";
				}
				else{
					echo "已解決";
				}
				echo "</td>";

				$sqli2 = "SELECT department.name AS name, item.ID
				FROM (item INNER JOIN itemlocate ON item.ID = itemlocate.itemID)
					INNER JOIN department ON department.ID = itemlocate.deptID
				WHERE item.ID =\"" . $rowi['ID'] . "\";";
				$resulti2 = $conn->query($sqli2);
				if ($resulti2->num_rows > 0){
					$rowi2 = $resulti2->fetch_assoc();
					echo "<td>" . $rowi2['name'] . "</td>";
				}
				else echo "<td></td>";

                echo "<td>";
                if($rowi["photo"] == NULL){
                    echo '<img src="data:image/jpeg;base64,' . $defaultimg . '" />';
                }
                else{
                    $imageBase64 = base64_encode($rowi["photo"]);
                    echo '<img src="data:image/jpeg;base64,' . $imageBase64 . '" />';
                }
                echo "</td>";

				echo "<td><a href='" . base_url . "admin/item/edit.php?ID={$rowi['ID']}'>編輯</a></td>";
				echo "<td><a href='" . base_url . "admin/item/delete.php?ID={$rowi['ID']}&back=post'>刪除</a></td>";
	
				echo "</tr><br>";
			}
		} else {
			echo "<tr><td colspan='6'>0 results</td></tr>";
		}
	?>
</table>

<!-- time datetime NOT NULL DEFAULT current_timestamp(),
    userID BIGINT(30), /* foreign key用戶ID*/
    postID BIGINT(30), /* foreign key貼文ID*/
    content text, -->
<table>
	<thead>
		<tr>
			<th>#</th>
			<th>發布時間</th>
			<th>發布用戶</th>
			<th>內容</th>
			<th></th>
		</tr>
	</thead>
	<?php 
		$i = 1;
		$sqlr = "SELECT *
			FROM response
            WHERE postID = '$ID';";
		$resultr = $conn->query($sqlr);

		if ($resultr === false) {
			die("error: " . $conn->error);
		}
        
		if ($resultr->num_rows > 0) {
			while ($rowr = $resultr->fetch_assoc()) {
				echo "<tr>";
				echo "<td>" . $i++ . "</td>";
				echo "<td>" . date("Y-m-d H:i:s", strtotime( $rowr['time'])) . "</td>";
				echo "<td>" . $rowr['userID'] . "</td>";
				echo "<td>" . $rowr['content'] . "</td>";

				echo "<td><a href='" . base_url . "admin/post/responsedelete.php?ID={$rowr['userID']}&time={$rowr['time']}'>刪除</a></td>";
				echo "</tr><br>";
			}
		} else {
			echo "<tr><td colspan='6'>0 results</td></tr>";
		}
		$conn->close();
	?>
</table>