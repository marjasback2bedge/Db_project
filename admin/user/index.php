<body>
    <nav>
        <ul>
            <li><a href="..">回首頁</a></li>
        </ul>
    </nav>
</body>

<form method="post">
    <button type="submit" name="user_button">使用者</button>
    <button type="submit" name="admin_button">管理員</button>
</form>

<table>
    <tr>
        <th>ID</th>
        <th>名稱</th>
        <th>資訊</th>
    <?php
    include '../../conn.php';

    if (isset($_POST['admin_button'])){
        // echo "<th><a href='insert_admin.php'>新增管理員</a></th></tr><br>";
        $sql = "SELECT * FROM user WHERE user.type = 0;";
        $result = $conn->query($sql);
    
        if ($result === false) {
            die("error: " . $conn->error);
        }
    
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row['ID'] . "</td>";
                echo "<td>" . $row['name'] . "</td>";
                if(!empty($row['contact'])){
                    echo "<td>" . $row['contact'] . "</td>";
                }
                else echo "<td></td>";
                echo "</tr><br>";
            }
        } else {
            echo "<tr><td colspan='6'>0 results</td></tr>";
        }
    }
    else{
        echo "</tr><br>";
        $sql = "SELECT * FROM user WHERE user.type = 1;"; 
        $result = $conn->query($sql);
    
        if ($result === false) {
            die("error: " . $conn->error);
        }
    
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row['ID'] . "</td>";
                echo "<td>" . $row['name'] . "</td>";
                if(!empty($row['contact'])){
                    echo "<td>" . $row['contact'] . "</td>";
                }
                else echo "<td></td>";
                echo "<td><a href='edit.php?ID={$row['ID']}'>審核</a></td>";
                echo "<td><a href='delete.php?ID={$row['ID']}'>刪除</a></td>";
                echo "</tr><br>";
            }
        } else {
            echo "<tr><td colspan='6'>0 results</td></tr>";
        }
    }

    $conn->close();
    ?>
</table>
