<?php
require_once "../../php/default.php";
require_once "../../php/db_connect.php";
require_once "../../php/functions.php";
session_start();

$raw = file_get_contents('php://input');
$data = json_decode($raw);

function format($key, $value) {
  return $key.' = '.(is_string($value) ? "'".$value."'" : $value);
}

$values = array_map('format', array_keys((array)($data->arg[0])), array_values((array)($data->arg[0])));
$sql = 'UPDATE '.$data->table.' SET '.implode(',', $values).' WHERE id = '.strval($data->id);
$pre = $pdo->prepare($sql);
$pre->execute();
echo json_decode($sql);