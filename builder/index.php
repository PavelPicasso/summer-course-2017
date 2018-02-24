<?php
define("DB_SERVER", "localhost");
define("DB_USER", "root");
define("DB_PASS", "");
define("DB_NAME", "Base");
require 'builder.php';

$query_builder = new Query_builder();


/**
 * query_builder SELECT
 */
//print_r($query_builder->select('dbtest', 'username', 'username = "sos"'));


/**
 * query_builder INSERT
 */
//$array = [
//    'username' => 'sos'
//];
//print_r($query_builder->insert('dbtest', $array). "<br>");
//print_r($query_builder->select('dbtest', 'username', 'username = "' . $array['username'] . '"'));


/**
 * query_builder UPDATE
 *  where 'id = 1' || where ''
 */
//$array = [
//    'username' => 'test'
//];
//print_r($query_builder->update('dbtest', $array, 'id = 1'). "<br>");
//print_r($query_builder->select('dbtest', null, 'id = 1'));


/**
 * query_builder DELETE
 */

//print_r($query_builder->delete('dbtest',  'id = 75'). "<br>");
//print_r($query_builder->select('dbtest', null, null));