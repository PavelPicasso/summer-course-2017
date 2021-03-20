<?php

session_start();
require("constants.php");
require 'builder.php';

if (isset($_SESSION["session_username"])) {
    $query_builder = new Query_builder();
    $result = $query_builder->select("users", null, 'username = "' . $_SESSION['session_username'] . '" LIMIT 1');
} else {
    echo "<script>alert(\"Вам сюда нельзя!\");</script>";
    echo " <script language=\"JavaScript\">window.location.href = document.location.origin + \"/builder/login.php\"</script>";
}
?>

<head>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="css/home.css">
    <link href="css/custom.css" rel="stylesheet">
    <link href="css/custom.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
</head>

<body>
<header>
    <div class="container">
        <div class="row">
            <ul>
                <div class="left">
                    <li><a href=""><?= $result[0][1] ?></a></li>
                    <li><a href=""><?php
                            if ($result[0][3] == "0")
                                echo "Пользователь";
                            if ($result[0][3] == "1")
                                echo "Админ";
                            ?></a></li>
                    <li><a href="logout.php">Выход</a></li>
                    <li><a href="">4</a></li>
                    <li><a href="">5</a></li>
                </div>
            </ul>
        </div>
    </div>
</header>

<div class="container_box container1">
    <form method="post" enctype="multipart/form-data" action="getHome.php" role="form" id="form_register" name="loginform">
        <div class="avatar img_avatar">
            <div id="preview">
                <img id="images" style="border-radius: 100px;" name="avatar"
                     src="<?= "images/profile/" . $result[0][6] ?>" alt="...">
                <input name="delFile" id="delFile" type="hidden" value="">
            </div>
            <div class="change">
                <div class="file-upload ">
                    <label>
                        <input type="file" id="the-photo-file-field" name="file">
                        <span>Выберите файл</span>
                    </label>
                </div>
            </div>
        </div>
        <?php
        if ($result[0][3] == "1") {
            $result1 = $query_builder->select("users", "id, username", null);
        ?>
            <p><label> Выберите пользователя <br>
                <select class="input" name="id" id="mySelect" onchange="myFunction()">
                    <option>Создать пользователя</option>
                    <?php
                    $i = 0;
                    foreach ($result1 as $value[$i]) {
                        if ($i == 0) {
                            echo "<option selected='selected' value='" . $value[$i][0] . "'>" . $value[$i][1] . "</option>";
                        } else {
                            echo "<option value='" . $value[$i][0] . "'>" . $value[$i][1] . "</option>";
                        }
                        $i++;
                    }
                    ?>
                </select>
                </label>
            </p>
            <?php
        }
        ?>
        <p><label> Фамилия <br>
                <input class="input" value="<?= $result[0][4] ?>" type="text" name="first_name" placeholder="Введите фамилию" id="first_name"/>
           </label>
        </p>
        <p><label>Имя<br>
                <input class="input" value="<?= $result[0][5] ?>" type="text" name="name" placeholder="Введите имя" id="name"/>
           </label>
        </p>
        <?php
        if ($result[0][3] == "1") {
            ?>
            <p><label> Логин <br>
                    <input class="input" value="<?= $result[0][1] ?>" type="text" placeholder="Введите логин" name="username" id="username"/>
               </label>
            </p>
            <p><label>Пароль<br>
                    <input class="input" value="" type="password" name="password" placeholder="Изменить пароль"/>
               </label>
            </p>
            <p id="del"><input name="del" class="reg button" type="submit" value="Удалить"></p>
            <p id="insert"><input name="insert" class="reg button" type="submit" value="Добавить"></p>
            <input name="delete" id="delete" type="hidden" value="<?= $result[0][0] ?>">
        <?php
        }
        ?>
        <p class="submit"><input id="button" name="button" class="button" type="submit" value="Сохранить"></p>
    </form>

    <script>
        function myFunction() {

            var val = document.getElementById("mySelect").value;
            $.post("getUser.php", {id: '' + val}).done(function (res) {
                object = JSON.parse(res);
                $('#first_name').val(object.first_name);
                $('#name').val(object.name);
                $('#username').val(object.username);
                var scr = 'images/profile/' + object.avatar;
                $('#delFile').val(object.avatar);
                if (val == "Создать пользователя") {
                    var per = 'http://placehold.it/160x160';
                    $('#images').attr("src", per);
                } else {
                    $('#images').attr("src", scr);
                }
            });

            var myid = document.getElementById("delete").value;
            if (val == myid) {
                $("#del").css("display", "none");
            } else {
                $("#del").css("display", "block");
            }

            if (val == "Создать пользователя") {
                $("#del").css("display", "none");
                $("#insert").css("display", "block");
                $("#button").css("display", "none");
            } else {
                $("#insert").css("display", "none");
                $("#button").css("display", "block");
            }
        }

        if (window.File && window.FileReader && window.FileList && window.Blob) {
            function renderImage(file) {
                var reader = new FileReader();
                reader.onload = function (event) {
                    the_url = event.target.result;
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

        $(function () {
            var val = document.getElementById("mySelect").value;
            var myid = document.getElementById("delete").value;
            if (val == myid) {
                $("#del").css("display", "none");
            } else {
                $("#del").css("display", "block");
            }
        })
    </script>
</div>
</body>