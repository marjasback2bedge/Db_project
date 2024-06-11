<body>
    <nav>
        <ul>
			<li><a href="..">back</a></li>
        </ul>
    </nav>
</body>
<?php
include '../../conn.php';

if ($conn->connect_error) {
    die("error: " . $conn->connect_error);
} 

$ID = $_GET['ID'];

$select_sql = "SELECT * FROM department WHERE ID = \"$ID\";";
$result = $conn->query($select_sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    
    echo "<form method='POST' action='doedit.php'>";
    echo "<input type='hidden' name='ID' value='" . $row["ID"] . "'>";
    echo "<table>";

    echo "<tr><th>ID</th><td><input type='text' name='ID_display' value='" . $row["ID"] . "' readonly></td></tr>";

    echo "<tr><th>name</th><td><input type='text' name='campus' value='" . $row["campus"] . "'></td>"; 
    echo "<tr><th>name</th><td><input type='text' name='building' value='" . $row["building"] . "'></td>"; 
    echo "<tr><th>name</th><td><input type='text' name='name' value='" . $row["name"] . "'></td>"; 
    
    echo "<tr><th colspan='2'><input type='submit' name='edit' value='編輯'/></th></tr>";
    
    echo "</table>";
    echo "</form>";

}
else{
    echo "edit fault";
    header('Location: index.php');
}			
?>

