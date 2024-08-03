<?php
  require_once "php/default.php";
  require_once "php/db_connect.php";
  require_once "php/functions.php";
  session_start();
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
  <link rel="stylesheet" href="/css/information.css">
  <link rel="stylesheet" href="/css/past.css">
  <script src=""></script>
</head>

<body>
  <?php echo default_header(); ?>
  <h2 class="h2">Contact</h2>

  <div class="basic-container">
    <h3 class="basic-h3">Twitter アカウント</h3>
    <p class="basic-text"><b>公式 Twitter アカウントの DM から</b> : <a href="https://twitter.com/acaoly_notifi">https://twitter.com/acaoly_notifi</a></p>
    <p class="basic-text"><b>運営者の Twitter アカウントの DM から</b> : <a href="https://twitter.com/FirmianaSim4104">https://twitter.com/FirmianaSim4104</a></p>
    
    <hr>

    <h3 class="basic-h3">マシュマロ (いわゆる質問箱)</h3>
    <p class="basic-text"><b>公式のマシュマロ</b> : <a href="https://marshmallow-qa.com/952sk6bo8cuiych">https://marshmallow-qa.com/952sk6bo8cuiych</a></p>
    <p class="basic-text"><b>運営者のマシュマロ</b> : <a href="https://marshmallow-qa.com/sj8pny6wh7j9c6k">https://marshmallow-qa.com/sj8pny6wh7j9c6k</a></p>

    <hr>

    <h3 class="basic-h3">Google フォーム</h3>
    <p class="basic-text"><b>不具合報告用</b> : <a href=""></a></p>
    <p class="basic-text"><b>要望送信用</b> : <a href=""></a></p>
    <p class="basic-text"><b>学術オリンピック用語投稿用</b> : <a href=""></a></p>

    <hr>

    <h3 class="basic-h3">メール</h3>
    <p class="basic-text">contact@acaoly-inofficial.com</p>
  </div>

  <?php echo default_footer(); ?>
</body>

</html>