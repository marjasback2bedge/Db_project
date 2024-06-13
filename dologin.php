<?php
session_start();
include "conn.php";

if (!$conn->set_charset("utf8")) {
    printf("Error loading character set utf8: %s\n", $conn->error);
    exit();
}

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$name = $_POST['name'];
$passwd = $_POST['password'];

if ($name && $passwd) {
    $sql = "SELECT * FROM user WHERE name='$name' AND password = '$passwd'";

    $result = $conn->query($sql);

    if ($result->num_rows) {
        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);

        $_SESSION['name'] = $row['name'];
        $_SESSION['user_id'] = $row['ID'];
        $_SESSION['type'] = $row['type'];
        $_SESSION['contact'] = $row['contact'];

        // Check roles
        if ($_SESSION['type'] == 0) {
            $_SESSION['login'] = TRUE;
            header('Location: admin');
        } else {
            $_SESSION['login'] = TRUE;
            
                // Redirect to a default page if the 'serial_no' parameter is not present
                header("Location: user");
        }

    } else {
        $_SESSION['login'] = FALSE;
        $_SESSION['msg'] = '登入失敗，請確認使用者名稱及密碼!!';
        header('Location: index.php');
    }
} else {
    $_SESSION['msg'] = '請輸入使用者名稱及密碼!!';
    //header('Location: login.html');
}
//session_unset();
?>