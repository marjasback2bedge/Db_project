<body>
    <nav>
        <ul>
			<li><a href="../user">back</a></li>
        </ul>
    </nav>
</body>
<?php
include '../../conn.php';

if ($conn->connect_error) {
    die("error: " . $conn->connect_error);
} 

$ID = $_GET['ID'];

$select_sql = "SELECT * FROM user WHERE ID = \"$ID\";";
$result = $conn->query($select_sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    
    echo "<form method='POST' action='doedit.php'>";
    echo "<input type='hidden' name='ID' value='" . $row["ID"] . "'>";
    echo "<table>";

    echo "<tr><th>ID</th><td><input type='text' name='ID_display' value='" . $row["ID"] . "' readonly></td></tr>";

    echo "<tr><th>name</th><td><input type='text' name='name' value='" . $row["name"] . "'></td>";
    echo "<th colspan='2'><input type='submit' name='name_edit' value='審核'/></th></tr>";
    
    echo "<tr><th>Contact</th><td><input type='text' name='contact' value='" . $row["contact"] . "'></td>";
    echo "<th colspan='2'><input type='submit' name='cont_edit' value='審核'/></th></tr>";
    
    echo "</table>";
    echo "</form>";

}
else{
    echo "edit fault";
    header('Location: index.php');
}			
?>

