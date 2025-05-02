<?php
  require_once "../../../php/default.php";
  require_once "../../../php/db_connect.php";
  require_once "../../../php/functions.php";
  session_start();

  $pre = $pdo->prepare("SELECT * FROM `contests` WHERE `contest_id` LIKE '01-08-%' ORDER BY `number` DESC;");
  $pre->execute();
  $contests = $pre->fetchAll();
?>

<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1">
  <meta name="description" content="このページでは、PILAME杯の過去大会に関する情報をまとめています。">
  <meta property="og:url" content="https://acaoly-inofficial.com/contests/mathematics/pilame/past.php">
  <meta property="og:type" content="website">
  <meta property="og:site_name" content="学術オリンピック非公式まとめサイト">
  <meta property="og:image" content="https://acaoly-inofficial.com/img/comp_site_thumbnail.png">
  <meta property="og:title" content="PILAME杯の過去大会">
  <meta name="twitter:card" content="summary">
  <meta name="twitter:site" content="@acaoly_notifi">
  <link rel="shortcut icon" type="image/x-icon" href="/img/favicon.ico">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@100..900&family=Roboto+Condensed:wght@500&display=swap" rel="stylesheet">
  <title>PILAME杯の過去大会 | 学術オリンピック非公式まとめサイト</title>
  <link rel="stylesheet" href="/css/common.css">
  <link rel="stylesheet" href="/css/colors.css">
  <link rel="stylesheet" href="/css/editorial.css">
  <link rel="stylesheet" href="/css/schedule.css">
  <link rel="stylesheet" href="/css/past.css">
  <link rel="stylesheet" href="/css/root_index.css">
  <link rel="stylesheet" href="/css/contest.css">
  <link rel="stylesheet" href="/css/problems.css">
</head>

<body>
  <?php echo default_header(); ?>

  <div class="genre-header-container gradient-mathematics">
    <p>数学</p>
  </div>

  <div class="basic-container">
    <p class="contest-title"><span class="circle-blue"></span>PILAME杯</p>
    <hr>
    <p class="contest-subtitle">PILAME Cup <span class="tag background-mathematics color-black">PILAME</span></p>
  </div>

  <div class="basic-container">
    <div class="basic-container-inner">
      <a href="../index.php">数学トップ</a>
      <span>&gt;</span>
      <a href="../pilame.php">PILAMEトップ</a>
    </div>
  </div>

  <h2 class="h2">過去大会</h2>

  <div class="basic-container">
    <div class="basic-container-inner">
      <h3 class="border-mathematics">はじめに</h3>
    </div>
  </div>

  <div class="basic-container">
    <div class="basic-container-inner">
      <h3 class="border-mathematics">過去大会一覧</h3>
      <div class="table-wrapper">
        <table class="problems-table">
          <thead>
            <tr>
              <th>略称</th>
              <th>大会名</th>
              <th>回数</th>
              <th>備考</th>
            </tr>
          </thead>
          <tbody>
            <?php
              function contest_color($val) {
                switch ($val) {
                  case 1:
                    return 'blue';
                  case 2:
                    return 'green';
                  case 3:
                    return 'red';
                  case 4:
                    return 'orange';
                }
              }
              for ($i = 0; $i < count($contests); $i++) {
                $item = $contests[$i];
                $str = '<tr>';
                $str .= '<th><span class="circle-'.contest_color($item['contest_class']).'"></span>'.$item['contest_name'].'</th>';
                $str .= '<td>'.$item['longname'].'</td>';
                $str .= '<td>'.$item['number'].'</td>';
                $str .= '<td>'.$item['info'].'</td>';
                $str .= '</tr>';
                echo $str;
              }
            ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>

  <?php echo default_footer(); ?>
</body>

</html>