<body>
    <nav>
        <ul>
			<li><a href="..">home</a></li>
        </ul>
    </nav>
</body>

<table>
	<tr>
		<th>#</th>
		<th>ID</th>
		<th>發布時間</th>
		<th>用戶名稱</th>
		<th>用途</th>
		<th>物品</th>
	</tr><br>
	<?php 
	include '../../conn.php';

	$i = 1;
	$sql = "SELECT user.name, post.*
		FROM post INNER JOIN user ON post.userID = user.ID
		ORDER BY post.type ASC, post.posttime DESC";
	$result = $conn->query($sql);

	if ($result === false) {
		die("error: " . $conn->error);
	}

	if ($result->num_rows > 0) {
		while ($row = $result->fetch_assoc()) {
			echo "<tr>";
			echo "<td>" . $i++ . "</td>";
			echo "<td>" . $row['ID'] . "</td>";
			echo "<td>" . date("Y-m-d H:i:s", strtotime($row['posttime'])) . "</td>";
			echo "<td>" . $row['name'] . "</td>";
			echo "<td>";
			if ($row['type'] == 0) {
				echo "失物尋找";
			} else {
				echo "拾獲招領";
			}
			echo "</td>";

			$qry2 = $conn->query("SELECT *
				FROM post INNER JOIN item ON post.ID = item.postID
				WHERE post.ID = \"" . $row['ID'] . "\";");

			if ($qry2 === false) {
				echo "<td>error: " . $conn->error . "</td>";
			}
			else{
				echo "<td>";
				while ($row2 = $qry2->fetch_assoc()) {
					echo $row2['name'] . "\t";
				}
				echo "</td>";
			}
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