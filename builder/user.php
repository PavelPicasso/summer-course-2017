<?php

require 'constants.php';

class User {

    private $username, $password, $password_again, $avatar;

    public function __construct($username, $password, $password_again, $ava = null) {
        $this->username = $username;
        $this->password = md5($password);
        $this->password_again = md5($password_again);
        $this->avatar = $ava;
    }

    public function reg() {
        $types = array('image/gif', 'image/png', 'image/jpeg');

        $avatar = $_FILES['file']['name'];
        $getMime = explode('.', $avatar);
        $mime = "." . strtolower(end($getMime));
        $profile = $this->username . $mime;

        $errors = array();
        $query_builder = new Query_builder();
        $array = [
            'username' => $this->username,
            'password' => $this->password,
            'avatar' => $profile
        ];
        if ($this->password != $this->password_again) {
            $errors[] = "Пароли не совпадают";
        }
        $result = $query_builder->select("users", null, 'username = "' . $this->username . '"');
        if ($result) {
            $errors[] = "Пользователь с таки логином существует";
        }
        if (!in_array($_FILES['file']['type'], $types)) {
            $errors[] = "Запрещённый тип файла!";
        }
        if (empty($errors)) {
            $query_builder->insert("users", $array);
            move_uploaded_file($_FILES['file']['tmp_name'], 'images/profile/' . $this->username . $mime);
            return true;
        } else {
            foreach ($errors as $error) {
                echo $error . '<br/>';
            }
            return false;
        }
    }

    public function log() {
        $query_builder = new Query_builder();
        $result = $query_builder->select("users", null, 'username = "' . $this->username . '" AND password = \'' . $this->password . "' LIMIT 1");
        if ($result) {
            $dbusername = $result[0][1];
            $dbpassword = $result[0][2];
            if ($this->username == $dbusername && $this->password == $dbpassword) {
                $_SESSION['session_username'] = $this->username;
                return true;
            } else {
                return false;
            }
        }
    }
}



