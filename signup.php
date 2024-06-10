<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>註冊</title>
    <link rel="stylesheet" href="assets/css/signup.css">
</head>

<body>
    <div class="box">

        <div class="background">
            <!-- hehe -->
        </div>

        <div>
            <nav class="navbar">
                <a href="index.php" target="_self" class="return_indexpage_pos">回到首頁</a>
            </nav>
        </div>

        <!-- <?php
        session_start();
        include "conn.php";
        ?> -->

        <div>
            <form action="dosignup.php" method="post">
                <div class="sign_up_box">
                    <h2>建立您的帳號</h2>
                    <p>使用者名稱：<input type="text" class="only_underline" name="name" required="required" /></p>

                    <p>電子郵件：<input type="email" class="only_underline" name="email" required="required"
                            pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" /></p>

                    <p>密碼：<input type="password" class="only_underline" name="password" required="required"
                            id="InputPassword" /></p>

                    <p>確認密碼：<input type="password" class="only_underline" name="ConfirmPassword" required="required"
                            id="ConfirmPassword" oninput="setCustomValidity('');"
                            onchange="if(document.getElementById('InputPassword').value != document.getElementById('ConfirmPassword').value){setCustomValidity('密碼不吻合');}" />
                    </p>
                    <?php
                    if (isset($_SESSION['msg'])) {
                        echo "<p><font color='#FF0000'>{$_SESSION['msg']}</font></p>";
                        unset($_SESSION['msg']);
                    }
                    else
                    {
                        echo "<br>";
                    }
                    //session_unset();
                    ?>
                    <button class="register_button" type="submit">註冊</button>
                </div>
            </form>
        </div>
    </div>
</body>

</html>