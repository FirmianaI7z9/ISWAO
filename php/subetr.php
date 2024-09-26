<?php
require_once "default.php";
require_once "db_connect.php";
require_once "functions.php";
session_start();

$raw = file_get_contents('php://input');
$data = json_decode($raw);

$type = -1;
if ($data->id == 0) {
  $type = 3;
}
else if ($data->id == 1) {
  $type = 1;
}

if ($type != -1) {
  $pre = $pdo->prepare("UPDATE `editorials` SET `text` = :t, `status` = :s WHERE `id` = :i;");
  $pre->bindValue(":t", $data->text, PDO::PARAM_STR);
  $pre->bindValue(":s", $type, PDO::PARAM_INT);
  $pre->bindValue(":i", $_SESSION['editorial_id']);
  $pre->execute();
}
