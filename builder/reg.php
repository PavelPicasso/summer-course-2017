<?php

session_start();

require 'constants.php';
require 'builder.php';
require 'user.php';
if (isset($_POST['btn'])) {
    $user = new User($_POST['username'], $_POST['password'], $_POST['password_again'], $_FILES['file']);
    $result = $user->reg();
    if ($result == true) {
        echo "<script>alert(\"Вы зарегистрированы!\");</script>";
        echo " <script language=\"JavaScript\">window.location.href = document.location.origin + \"/builder/login.php\"</script>";
    } else {
        echo "<script>alert(\"Пароли не совпадают!\");</script>";
        echo " <script language=\"JavaScript\">window.location.href = document.location.origin + \"/builder/reg.php\"</script>";
    }
}
?>
<head>
    <link href="css/custom.css" rel="stylesheet">
    <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
</head>
<div class="container1 mlogin">
    <div id="login">
        <h1>Регистрация</h1>
        <form method="post" enctype="multipart/form-data" action="reg.php" role="form" id="form_register"
              name="loginform">
            <p><label> Имя пользователя <br>
                    <input class="input" type="text" name="username" placeholder="Имя" required/>
                </label>
            </p>
            <p><label>Пароль<br>
                    <input class="input" type="password" name="password" placeholder="Введите пароль" required/>
                </label>
            </p>
            <p><label>Повторить Пароль<br>
                    <input class="input" type="password" name="password_again" placeholder="Повторите пароль" required/>
                </label>
            </p>
            <p>
            <div class="avatar">
                <div id="preview">
                    <img style="border-radius: 100px;" src="http://placehold.it/170x170" alt="...">
                </div>

                <div class="change">
                    <div class="file-upload ">
                        <label>
                            <input type="file" id="the-photo-file-field" name="file" required>
                            <span>Выберите файл</span>
                        </label>
                    </div>
                </div>
            </div>
            <p class="submit"><input name="btn" class="button_center" type="submit" value="Завершить регистрацию"></p>
        </form>
    </div>
</div>

<script>
    if (window.File && window.FileReader && window.FileList && window.Blob) {
        function renderImage(file) {
            var reader = new FileReader();
            reader.onload = function (event) {
                the_url = event.target.result
                $('#preview').html("<img style=\"width: 170px; height: 170px; border-radius: 200px; border: 1px solid white;\" src='" + the_url + "' />")
            }
            reader.readAsDataURL(file);
        }

        $("#the-photo-file-field").change(function () {
            renderImage(this.files[0])
        });
    } else {
        alert('The File APIs are not fully supported in this browser.');
    }
</script>