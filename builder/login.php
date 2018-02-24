<?php

session_start();

require 'constants.php';
require 'builder.php';
require 'user.php';

if (isset($_POST['btn'])) {
    $user = new User($_POST['username'], $_POST['password'], $_POST['password_again']);
    $result = $user->log();
    if ($result == true) {
        echo " <script language=\"JavaScript\">window.location.href = document.location.origin + \"/builder/home.php\"</script>";
    } else {
        echo "<script>alert(\"Неверный логин или пароль!\");</script>";
        echo " <script language=\"JavaScript\">window.location.href = document.location.origin + \"/builder/login.php\"</script>";
    }
}
?>

<link href="css/custom.css" rel="stylesheet">
<div class="container1 mlogin">
    <div id="login">
        <h1>Вход</h1>
        <form action="login.php" id="loginform" method="post" name="loginform">
            <p><label for="user_login"> Имя пользователя <br>
                <div class="form-group">
                    <input class="input" id="username" name="username" size="20" type="text" placeholder=""
                           required>
                </div>
                </label></p>
            <p><label for="user_pass">Пароль<br>
                <div class="form-group">
                    <input class="input" id="password" name="password" size="20" type="password" required>
                </div>
                </label>
            </p>
            <p class="submit"><input name="btn" class="button" type="submit" value="Войти"></p>
            <p><a href="reg.php" class="reg">Регистрация</a></p>
        </form>
    </div>
</div>



