<?php
require_once "default.php";
require_once "db_connect.php";
require_once "functions.php";
session_start();

$pre = $pdo->prepare("SELECT COUNT(*) AS count FROM information;");
$pre->execute();
$res = $pre->fetch();
echo json_encode($res);