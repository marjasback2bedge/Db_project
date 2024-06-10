<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>登入</title>
    <link rel="stylesheet" href="assets/css/login.css">
</head>

<body>
    <div class="box">

        <div class="background">
            <!-- hehe -->
        </div>

        <!-- <?php
        session_start();
        $sn = isset($_GET['serial_no']) ? $_GET['serial_no'] : '';
        echo $sn;
        ?> -->

        <form action="dologin.php" method="post">
            <div class="log_in_box">
                <input type="hidden" name="serial_no" value="<?php echo $sn; ?>">
                <br><br>
                <h2>登入您的帳號</h2>
                <br>
                <p>使用者名稱：<input type="name" class="only_underline" name="name" required="required" /></p>
                <p>密碼：<input type="password" class="only_underline" name="password" required="required" /></p>
                <?php
                if (isset($_SESSION['msg'])) {
                    echo "<p><font color='#FF0000'>{$_SESSION['msg']}</font></p>";
                    unset($_SESSION['msg']);
                }
                //session_unset();
                ?>
                <br>
                <button class="login_button" type="submit">登入</button>
                <br>
                <a href="signup.php" . target='_self' class='signup_pos'>
                    沒有帳號嗎? </a>
            </div>
        </form>

    </div>
</body>

</html>