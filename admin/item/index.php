<body>
    <nav>
        <ul>
			<li><a href="..">home</a></li>
        </ul>
    </nav>
</body>
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
			<th>貼文ID</th>
			<th>名稱</th>
			<th>分類</th>
			<th>狀態</th>
			<th>位置</th>
			<th></th>
		</tr>
	</thead>
	<?php 
		include '../../conn.php';

		$i = 1;
		$sql = "SELECT *
			FROM post INNER JOIN item ON post.ID = item.postID
			ORDER BY post.posttime DESC";
		$result = $conn->query($sql);

		if ($result === false) {
			die("error: " . $conn->error);
		}

		if ($result->num_rows > 0) {
			$defaultimg = base64_encode(file_get_contents(base_url . "admin/img/defaultimg.png"));
			while ($row = $result->fetch_assoc()) {
				echo "<tr>";
				echo "<td>" . $i++ . "</td>";
				echo "<td>" . $row['ID'] . "</td>";
				echo "<td><a href='../post/edit.php?ID={$row['postID']}'>{$row['postID']}</a></td>";
				echo "<td>" . $row['name'] . "</td>";
				echo "<td>" . $row['kind'] . "</td>";
				echo "<td>";
				if ($row['state'] == 0) {
					echo "尋找中";
				} 
				elseif ($row['state'] == 1){
					echo "待領取";
				}
				else{
					echo "已解決";
				}
				echo "</td>";

				$sql2 = "SELECT department.name AS name, item.ID
				FROM (item INNER JOIN itemlocate ON item.ID = itemlocate.itemID)
					INNER JOIN department ON department.ID = itemlocate.deptID
				WHERE item.ID =\"" . $row['ID'] . "\";";
				$result2 = $conn->query($sql2);
				if ($result2->num_rows > 0){
					$row2 = $result2->fetch_assoc();
					echo "<td>" . $row2['name'] . "</td>";
				}
				else echo "<td></td>";

                echo "<td>";
                if($row["photo"] == NULL){
                    echo '<img src="data:image/jpeg;base64,' . $defaultimg . '" />';
                }
                else{
                    $imageBase64 = base64_encode($row["photo"]);
                    echo '<img src="data:image/jpeg;base64,' . $imageBase64 . '" />';
                }
                echo "</td>";

				echo "<td><a href='edit.php?ID={$row['ID']}'>編輯</a></td>";
				echo "<td><a href='delete.php?ID={$row['ID']}'>刪除</a></td>";
	
				echo "</tr><br>";
			}
		} else {
			echo "<tr><td colspan='6'>0 results</td></tr>";
		}
		$conn->close();
	?>
</table>