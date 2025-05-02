<?php
require_once "../../php/default.php";
require_once "../../php/db_connect.php";
require_once "../../php/functions.php";
session_start();

$raw = file_get_contents('php://input');
$data = json_decode($raw);

$pre = $pdo->prepare(
  "UPDATE `problems`
  SET `difficulty` =
    CASE `correct_rate`
      WHEN -1 THEN 0
      ELSE ROUND((:a - 1.00) * POWER(1.00 - `correct_rate` * 0.01, :p) + 1.00, 0)
    END
  WHERE `problem_id` LIKE :i AND CAST(SUBSTRING(`problem_id`, 7, 4) AS INT) BETWEEN :b AND :e;
  ");
$pre->bindValue(":a", $data->max, PDO::PARAM_INT);
$pre->bindValue(":p", $data->power, PDO::PARAM_STR);
$pre->bindValue(":i", $data->genre.'-'.$data->contest.'-%', PDO::PARAM_STR);
$pre->bindValue(":b", intval($data->beginwith), PDO::PARAM_INT);
$pre->bindValue(":e", intval($data->endwith), PDO::PARAM_INT);
$pre->execute();