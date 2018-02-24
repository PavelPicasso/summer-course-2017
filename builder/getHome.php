<?php

session_start();

require("constants.php");
require 'builder.php';

$query_builder = new Query_builder();
$result1 = $query_builder->select("users", null, 'username = "' . $_SESSION['session_username'] . '" LIMIT 1');
if (!empty($_FILES['file']['name'])) {
    $avatar = $_FILES['file']['name'];
    $getMime = explode('.', $avatar);
    $mime = "." . strtolower(end($getMime));
}
$array = [
    'first_name' => $_POST['first_name'],
    'name' => $_POST['name'],
];

if (isset($_POST['del'])) {
    $query_builder->delete("users", "id = " . $_POST['id']);
    unlink('images/profile/' . $_POST['delFile']);
    echo "<script>alert(\"Пользователь удален!\");</script>";
    echo " <script language=\"JavaScript\">window.location.href = document.location.origin + \"/builder/home.php\"</script>";
}

if (isset($_POST['insert'])) {
    $errors = array();
    $result = $query_builder->select("users", null, 'username = "' . $_POST['username'] . '"');
    if ($result) {
        $errors[] = "Пользователь с таким логином существует!";
    } else {
        $array['username'] = $_POST['username'];
    }
    if (!empty($_POST['password'])) {
        $array['password'] = md5($_POST['password']);
    }
    if (!empty($_FILES['file']['name'])) {
        $avatar = $_FILES['file']['name'];
        $getMime = explode('.', $avatar);
        $mime = "." . strtolower(end($getMime));
        $array['avatar'] = $_POST['username'] . $mime;
    }
    if (empty($errors)) {
        $query_builder->insert("users", $array);
        move_uploaded_file($_FILES['file']['tmp_name'], 'images/profile/' . $_POST['username'] . $mime);
        echo "<script>alert(\"Пользователь добавлен!\");</script>";
        echo " <script language=\"JavaScript\">window.location.href = document.location.origin + \"/builder/home.php\"</script>";
    } else {
        foreach ($errors as $error) {
            echo $error . '<br/>';
        }
    }
}
if (isset($_POST['button']) && $result1[0][3] == "1") {
    $result = $query_builder->select("users", "id", 'username = "' . $_POST['username'] . '"');
    $array['username'] = $_POST['username'];
    if (!empty($_POST['password'])) {
        $array['password'] = md5($_POST['password']);
    }
    if (!empty($_FILES['file']['name'])) {
        $avatar = $_FILES['file']['name'];
        $getMime = explode('.', $avatar);
        $mime = "." . strtolower(end($getMime));
        $array['avatar'] = $result[0][0] . $mime;
    }
    $query_builder->update("users", $array, "id = " . $_POST['id']);
    move_uploaded_file($_FILES['file']['tmp_name'], 'images/profile/' . $result[0][0] . $mime);
    echo "<script>alert(\"Данные изменены!\");</script>";
    echo " <script language=\"JavaScript\">window.location.href = document.location.origin + \"/builder/home.php\"</script>";
} else {
    if (isset($_POST['button'])) {
        if (!empty($_FILES['file']['name'])) {
            $avatar = $_FILES['file']['name'];
            $getMime = explode('.', $avatar);
            $mime = "." . strtolower(end($getMime));
            $array['avatar'] = $result1[0][0] . $mime;
        }
        $query_builder->update("users", $array, "id = " . $result1[0][0]);
        move_uploaded_file($_FILES['file']['tmp_name'], 'images/profile/' . $result1[0][0] . $mime);
        echo "<script>alert(\"Данные изменены!\");</script>";
        echo " <script language=\"JavaScript\">window.location.href = document.location.origin + \"/builder/home.php\"</script>";
    }
}