<?php

session_start();

require 'constants.php';
require 'builder.php';

if ($_POST) {
    $id = $_POST['id'];
    $query_builder = new Query_builder();
    $result = $query_builder->select("users", null, 'id = ' . $id);
    $response = [
        'first_name' => $result[0][4],
        'name' => $result[0][5],
        'username' => $result[0][1],
        'avatar' => $result[0][6]
    ];
    echo json_encode($response);
}
