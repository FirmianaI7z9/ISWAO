<?php
require_once "default.php";
require_once "db_connect.php";
require_once "functions.php";
session_start();

// get posted datas
// page: the index of the page we're going to display
// max: the number of information items
// genre: the genre of information
$raw = file_get_contents('php://input');
$data = json_decode($raw);

if ($data->genre == 'all') {
  $pre = $pdo->prepare("SELECT * FROM information ORDER BY created_at DESC LIMIT :x OFFSET :y;");
  $pre->bindValue(":x", min(($data->page + 1) * 20, $data->max), PDO::PARAM_INT);
  $pre->bindvalue(":y", max($data->page * 20, 0), PDO::PARAM_INT);
  $pre->execute();
  $res = $pre->fetchAll();
}
else {
  $pre = $pdo->prepare("SELECT * FROM information WHERE tags LIKE :l ORDER BY created_at DESC;");
  $pre->bindValue(":l", '"'.$data['genre'].'"', PDO::PARAM_STR);
  $pre->execute();
  $res = $pre->fetchAll();
}

$value = implode('', array_map('format_info', $res));

echo json_encode($value);