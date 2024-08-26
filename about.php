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
  <h2 class="h2">About</h2>

  <div class="basic-container">
    <p class="basic-text">このウェブサイト「学術オリンピック非公式まとめサイト (ISWAO; Inofficial Summary Website of Academic Olympiad)」は、より多くの人が競技科学を知ることができるように、より多くの競技に多くの人が参加できるように、そして今後ますます学術オリンピック・競技科学の世界が発展できるように、その一助となることを目指して運営されているものです。</p>
    <p class="basic-text">運営は、一般学生の <a class="username" href="/user/index.php?user=Fernweh" style="color:#0078b8;">Fernweh</a> が自費で行っています。至らないところも多いと思いますが、何卒よろしくお願いします。</p>
    <p class="basic-text">私の趣味として運営している側面もありますので、今のところ情報提供以外の一切の支援 (少なくとも金銭や物資による支援) はお受けしない方針です。また、本ウェブサイト及び関連する Twitter アカウントの収益化も一切行っていませんし、今後するつもりもありません。さらに、現状共同運営者の募集もしておりません。ご理解のほどよろしくお願いします。</p>
    <hr>
    <p class="basic-text">注：以下は全て運営用のアカウントです。またこれ以外のアカウントは運営が保有しているものではありません。</p>
    <p class="basic-text"><a class="username" href="/user/index.php?user=Fernweh" style="color:#0078b8;">Fernweh</a>、<a class="username" href="/user/index.php?user=Fernweh2" style="color:#0078b8;">Fernweh2</a>、<a class="username" href="/user/index.php?user=admin" style="color:#000000;">admin</a>、<a class="username" href="/user/index.php?user=anonymous" style="color:#000000;">anonymous</a></p>
    <hr>
    <p class="basic-text">以下は1問以上解説を書いたユーザーの皆様です。ご協力ありがとうございます。</p>
    <p class="basic-text"></p>
  </div>

  <?php echo default_footer(); ?>
</body>

</html>