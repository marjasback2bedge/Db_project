<body>
    <nav>
        <ul>
			<li><a href="..">home</a></li>
        </ul>
    </nav>
</body>

<table>
	<thead>
		<tr>
			<th>#</th>
			<th>校區</th>
			<th>建築</th>
			<th>名稱</th>
            <!-- <th><a href='insert.php'>新增</a></th></tr><br> -->
		</tr>
	</thead>
	<?php 
		include '../../conn.php';

		$i = 1;
		$sql = "SELECT *
			FROM department
			ORDER BY campus ASC, building DESC, name ASC";
		$result = $conn->query($sql);

		if ($result === false) {
			die("error: " . $conn->error);
		}

		if ($result->num_rows > 0) {
			while ($row = $result->fetch_assoc()) {
				echo "<tr>";
				echo "<td>" . $i++ . "</td>";
				echo "<td>" . $row['campus'] . "</td>";
				echo "<td>" . $row['building'] . "</td>";
				echo "<td>" . $row['name'] . "</td>";
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