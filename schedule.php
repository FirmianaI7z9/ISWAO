<?php
  require_once "php/default.php";
  require_once "php/db_connect.php";
  require_once "php/functions.php";
  session_start();

  $now = new DateTime();

  $pre = $pdo->prepare("SELECT * FROM schedules WHERE finish_at >= :n ORDER BY start_at ASC;");
  $params = array(":n" => $now->format("Y-m-d 00:00:00"));
  $pre->execute($params);
  $schedules = $pre->fetchAll();
?>

<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1">
  <meta name="description" content="学術オリンピックや競技科学に関する様々な情報をまとめた非公式サイトのホームページ">
  <meta property="og:url" content="https://acaoly-inofficial.com/index.php">
  <meta property="og:type" content="website">
  <meta property="og:site_name" content="学術オリンピック非公式まとめサイト">
  <meta property="og:image" content="https://acaoly-inofficial.com/img/comp_site_thumbnail.png">
  <meta property="og:title" content="ホーム">
  <meta name="twitter:card" content="summary">
  <meta name="twitter:site" content="@acaoly_notifi">
  <link rel="shortcut icon" type="image/x-icon" href="/img/favicon.ico">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@100..900&family=Roboto+Condensed:wght@500&display=swap" rel="stylesheet">
  <title>ホーム | 学術オリンピック非公式まとめサイト</title>
  <link rel="stylesheet" href="/css/common.css">
  <link rel="stylesheet" href="/css/colors.css">
  <link rel="stylesheet" href="/css/schedule.css">
  <link rel="stylesheet" href="/css/past.css">
  <script src="/js/schedule_resize.js"></script>
</head>

<body>
  <?php echo default_header(); ?>
  <h2 class="h2">Schedule</h2>

  <div class="basic-container-flex">
    <?php echo format_schedule_with_month(implode('', array_map('format_schedule', $schedules)), true); ?>
  </div>

  <?php echo default_footer(); ?>
</body>

</html>