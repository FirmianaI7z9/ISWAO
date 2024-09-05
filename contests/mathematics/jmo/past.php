<?php
  require_once "../../../php/default.php";
  require_once "../../../php/db_connect.php";
  require_once "../../../php/functions.php";
  session_start();
?>

<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1">
  <meta name="description" content="このページでは、日本数学オリンピック(JMO)の過去大会に関する情報をまとめています。">
  <meta property="og:url" content="https://acaoly-inofficial.com/contests/mathematics/jmo/past.php">
  <meta property="og:type" content="website">
  <meta property="og:site_name" content="学術オリンピック非公式まとめサイト">
  <meta property="og:image" content="https://acaoly-inofficial.com/img/comp_site_thumbnail.png">
  <meta property="og:title" content="日本数学オリンピックの過去大会">
  <meta name="twitter:card" content="summary">
  <meta name="twitter:site" content="@acaoly_notifi">
  <link rel="shortcut icon" type="image/x-icon" href="/img/favicon.ico">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@100..900&family=Roboto+Condensed:wght@500&display=swap" rel="stylesheet">
  <title>日本数学オリンピックの過去大会 | 学術オリンピック非公式まとめサイト</title>
  <link rel="stylesheet" href="/css/common.css">
  <link rel="stylesheet" href="/css/colors.css">
  <link rel="stylesheet" href="/css/editorial.css">
  <link rel="stylesheet" href="/css/schedule.css">
  <link rel="stylesheet" href="/css/past.css">
  <link rel="stylesheet" href="/css/root_index.css">
  <link rel="stylesheet" href="/css/contest.css">
</head>

<body>
  <?php echo default_header(); ?>

  <div class="genre-header-container gradient-mathematics">
    <p>数学</p>
  </div>

  <div class="basic-container">
    <p class="contest-title"><span class="circle-blue"></span>日本数学オリンピック</p>
    <hr>
    <p class="contest-subtitle">Japan Mathematical Olympiad <span class="tag background-mathematics color-black">JMO</span></p>
  </div>

  <div class="basic-container">
    <div class="basic-container-inner">
      <a href="../index.php">数学トップ</a>
      <span>&gt;</span>
      <a href="../jmo.php">JMOトップ</a>
    </div>
  </div>

  <h2 class="h2">過去大会</h2>

  <div class="basic-container">
    <div class="basic-container-inner">
      <h3 class="border-mathematics">はじめに</h3>
      <p>まとめるまでもなく公式ウェブサイト↓に載っていたため、過去大会のどんな情報があるかだけご紹介します。</p>
      <div class="link-box">
        <a href="https://www.imojp.org/domestic/jmo_overview.html" target="_blank" rel="noopener noreferrer"></a>
        <p>日本数学オリンピック（JMO）概要 - 数学オリンピック財団</p>
      </div>
      <p>掲載されている情報は以下の通りです。</p>
      <ol>
        <li>第11回大会以降の予選、本選、代表選考合宿の過去問</li>
        <li>予選の応募者数、参加者数、学年分布（高1と高2）、予選ランク分布（ここまで第26回大会以降）、得点分布、成績優秀者（第11回大会以降）</li>
        <li>地区別表彰の内訳（第26回大会以降）</li>
        <li>本選の平均点、得点分布、受賞者・成績優秀者（第28回大会以降、成績優秀者のみ全大会）</li>
      </ol>
      <p>なお、第10回大会以前の過去問のうち一部は、英語で <a href="https://artofproblemsolving.com/community/c3327_japan_mo_finals" target="_blank" rel="noopener noreferrer">AoPS</a> に掲載されています。本ウェブサイトの過去問一覧ページと併せてご活用ください。</p>
      <p>注：上記の通り、各問題の平均点データは本選の第28回大会以降のみしか一般公開されていませんので、過去問のDifficulty算出はこちらの問題に限られます。</p>
    </div>
  </div>

  <?php echo default_footer(); ?>
</body>

</html>