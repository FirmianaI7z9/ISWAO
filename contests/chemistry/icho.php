<?php
  require_once "../../php/default.php";
  require_once "../../php/db_connect.php";
  require_once "../../php/functions.php";
  session_start();

  $now = new DateTime();
  $week = new DateTime();
  $week->modify("-1 week");
  $week->modify("+1 day");

  $pre = $pdo->prepare("SELECT * FROM schedules WHERE finish_at >= :n AND tags LIKE '%\"IChO\"%' ORDER BY start_at ASC;");
  $params = array(":n" => $now->format("Y-m-d 00:00:00"));
  $pre->execute($params);
  $schedules = $pre->fetchAll();

  $pre = $pdo->prepare("SELECT * FROM information WHERE created_at >= :n AND tags LIKE '%\"IChO\"%' ORDER BY created_at DESC;");
  $params = array(":n" => $week->format("Y-m-d 00:00:00"));
  $pre->execute($params);
  $information = $pre->fetchAll();

  $pre = $pdo->prepare("SELECT * FROM applications WHERE start_at <= :n1 AND finish_at >= :n2 AND tags LIKE '%\"IChO\"%' ORDER BY finish_at ASC;");
  $params = array(":n1" => $now->format("Y-m-d H:i:s"), ":n2" => $now->format("Y-m-d H:i:s"));
  $pre->execute($params);
  $applications = $pre->fetchAll();

  //$pre = $pdo->prepare("SELECT * FROM streams WHERE finish_at >= :n AND tags LIKE '%\"IChO\"%' ORDER BY start_at DESC;");
  //$params = array(":n" => $now->format("Y:m:d H:i:s"));
  //$pre->execute($params);
  //$streams = $pre->fetchAll();
?>

<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1">
  <meta name="description" content="このページでは、国際化学オリンピック(IChO)に関する情報をまとめています。">
  <meta property="og:url" content="https://acaoly-inofficial.com/contests/chemistry/icho.php">
  <meta property="og:type" content="website">
  <meta property="og:site_name" content="学術オリンピック非公式まとめサイト">
  <meta property="og:image" content="https://acaoly-inofficial.com/img/comp_site_thumbnail.png">
  <meta property="og:title" content="国際化学オリンピック">
  <meta name="twitter:card" content="summary">
  <meta name="twitter:site" content="@acaoly_notifi">
  <link rel="shortcut icon" type="image/x-icon" href="/img/favicon.ico">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@100..900&family=Roboto+Condensed:wght@500&display=swap" rel="stylesheet">
  <title>国際化学オリンピック | 学術オリンピック非公式まとめサイト</title>
  <link rel="stylesheet" href="/css/common.css">
  <link rel="stylesheet" href="/css/colors.css">
  <link rel="stylesheet" href="/css/editorial.css">
  <link rel="stylesheet" href="/css/schedule.css">
  <link rel="stylesheet" href="/css/past.css">
  <link rel="stylesheet" href="/css/root_index.css">
  <link rel="stylesheet" href="/css/contest.css">
  <script src="/js/schedule_resize.js"></script>
</head>

<body>
  <?php echo default_header(); ?>

  <div class="genre-header-container gradient-chemistry color-white">
    <p>化学</p>
  </div>

  <div class="basic-container">
    <p class="contest-title"><span class="circle-blue"></span>国際化学オリンピック</p>
    <hr>
    <p class="contest-subtitle">International Chemistry Olympiad <span class="tag background-chemistry color-white">IChO</span></p>
  </div>

  <div class="basic-container">
    <div class="basic-container-inner">
      <a href="index.php">化学トップ</a>
    </div>
  </div>

  <h2 class="h2">Information</h2>
  <div class="root-info-container">
    <h3 class="root-info-container-title">今後の予定</h3>
    <div class="root-info-container-flex">
      <?php
        if (count($schedules) == 0) {
          echo '<p>現在予定はありません。</p>';
        }
        else {
          echo format_schedule_with_month(implode('', array_map('format_schedule', $schedules)), false);;
        }
      ?>
    </div>
  </div>
  <div class="root-info-container">
    <h3 class="root-info-container-title">新着情報 (<?php echo $week->format("m月d日")?>～<?php echo $now->format("m月d日")?>)</h3>
    <div class="root-info-container-main">
      <?php
        if (count($information) == 0) {
          echo '<p>直近7日の新着情報はありません。</p>';
        }
        else {
          echo implode('', array_map('format_info', $information));
        }
      ?>
    </div>
    <p class="root-info-text">より過去のお知らせは「<a href="info.php">お知らせ</a>」へ。</p>
  </div>
  <div class="root-info-container">
    <h3 class="root-info-container-title">申し込み関係情報</h3>
    <div class="root-info-container-flex">
      <?php
        if (count($applications) == 0) {
          echo '<p>現在申し込み受付はありません。</p>';
        }
        else {
          echo format_schedule_with_month(implode('', array_map('format_schedule', $applications)), false);;
        }
      ?>
    </div>
  </div>

  <hr>
  
  <h2 class="h2">Contents</h2>

  <div class="root-content-container">
    <div class="root-content-item">
      <a href="icho/abstract.php"></a>
      <h3 class="root-content-item-title">大会概要</h3>
      <p class="root-content-item-text">IChOの簡単な内容はこちら</p>
    </div>
    
    <div class="root-content-item">
      <a href="icho/past.php"></a>
      <h3 class="root-content-item-title">過去大会データ</h3>
      <p class="root-content-item-text">IChOの過去大会に関するデータはここから (過去問は別)</p>
    </div>
    
    <div class="root-content-item">
      <a href="../common/problems.php?c="></a>
      <h3 class="root-content-item-title">過去問一覧</h3>
      <p class="root-content-item-text">IChOの過去問を掲載しています。</p>
    </div>
    
    <div class="root-content-item">
      <a href="../common/editorial_request.php"></a>
      <h3 class="root-content-item-title">ユーザー解説需要リスト</h3>
      <p class="root-content-item-text">まだユーザー解説が無い過去問のうち、解説の需要が大きいものを挙げています (登録ユーザー向け機能)。</p>
    </div>
    
    <div class="root-content-item">
      <a href="../../provision_info.php?"></a>
      <h3 class="root-content-item-title">運営に情報提供する (共通)</h3>
      <p class="root-content-item-text">情報の補足や訂正等があれば気軽にご連絡ください。</p>
    </div>
  </div>

  <?php echo default_footer(); ?>
</body>

</html>