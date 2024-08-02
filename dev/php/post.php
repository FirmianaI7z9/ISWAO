<?php
require_once "../../php/default.php";
require_once "../../php/db_connect.php";
require_once "../../php/functions.php";
session_start();

$raw = file_get_contents('php://input');
$data = json_decode($raw);

function format_num($item) {
  if (is_string($item)) {
    return "'".$item."'";
  }
  else {
    return $item;
  }
}

$sql = '';
for ($i = 0; $i < count($data->arg); $i++) {
  $keys = implode(',', array_keys((array)($data->arg[$i])));
  $values = implode(',', array_map('format_num', array_values((array)($data->arg[$i]))));
  $sql .= 'INSERT INTO '.$data->table.' ('.$keys.') VALUES ('.$values.');';
}
$pre = $pdo->prepare($sql);
$pre->execute();
echo json_decode($sql);