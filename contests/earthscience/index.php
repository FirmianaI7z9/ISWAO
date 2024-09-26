<?php
  require_once "../../php/default.php";
  require_once "../../php/db_connect.php";
  require_once "../../php/functions.php";
  session_start();

  $now = new DateTime();
  $week = new DateTime();
  $week->modify("-1 week");
  $week->modify("+1 day");

  $pre = $pdo->prepare("SELECT * FROM schedules WHERE start_at <= :m AND finish_at >= :n AND genre = 'ea' ORDER BY start_at ASC;");
  $params = array(":m" => $now->format("Y-m-d 23:59:59"), ":n" => $now->format("Y-m-d 00:00:00"));
  $pre->execute($params);
  $schedules = $pre->fetchAll();

  $pre = $pdo->prepare("SELECT * FROM information WHERE created_at >= :n AND tags LIKE '%\"ea\"%'  ORDER BY created_at DESC;");
  $params = array(":n" => $week->format("Y-m-d 00:00:00"));
  $pre->execute($params);
  $information = $pre->fetchAll();

  $pre = $pdo->prepare("SELECT * FROM applications WHERE start_at <= :n1 AND finish_at >= :n2 AND genre = 'ea' ORDER BY finish_at ASC;");
  $params = array(":n1" => $now->format("Y-m-d H:i:s"), ":n2" => $now->format("Y-m-d H:i:s"));
  $pre->execute($params);
  $applications = $pre->fetchAll();

  $pre = $pdo->prepare("SELECT * FROM streams WHERE finish_at >= :n AND genre = 'ea' ORDER BY start_at DESC;");
  $params = array(":n" => $now->format("Y:m:d H:i:s"));
  $pre->execute($params);
  $streams = $pre->fetchAll();
?>

<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1">
  <meta name="description" content="このページでは、学術オリンピックのうち地学分野についての情報をまとめています。">
  <meta property="og:url" content="https://acaoly-inofficial.com/contests/earthscience/index.php">
  <meta property="og:type" content="website">
  <meta property="og:site_name" content="学術オリンピック非公式まとめサイト">
  <meta property="og:image" content="https://acaoly-inofficial.com/img/comp_site_thumbnail.png">
  <meta property="og:title" content="地学トップ">
  <meta name="twitter:card" content="summary">
  <meta name="twitter:site" content="@acaoly_notifi">
  <link rel="shortcut icon" type="image/x-icon" href="/img/favicon.ico">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@100..900&family=Roboto+Condensed:wght@500&display=swap" rel="stylesheet">
  <title>地学トップ | 学術オリンピック非公式まとめサイト</title>
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

  <div class="genre-header-container gradient-earthscience">
    <p>地学</p>
  </div>

  <h2 class="h2">Information</h2>
  <div class="root-info-container">
    <h3 class="root-info-container-title">本日 (<?php echo $now->format("m月d日")?>) の予定</h3>
    <div class="root-info-container-flex">
      <?php
        if (count($schedules) == 0) {
          echo '<p>本日の予定はありません。</p>';
        }
        else {
          echo format_schedule_with_month(implode('', array_map('format_schedule', $schedules)), false);;
        }
      ?>
    </div>
    <p class="root-info-text">明日以降 &gt;&gt;&gt; <a href="schedule.php">スケジュール</a></p>
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
    <h3 class="root-info-container-title">申し込み受付中の大会</h3>
    <div class="root-info-container-flex">
      <?php
        if (count($applications) == 0) {
          echo '<p>現在申し込みを行っている大会はありません。</p>';
        }
        else {
          echo format_schedule_with_month(implode('', array_map('format_schedule', $applications)), false);;
        }
      ?>
    </div>
  </div>
  <div class="root-info-container">
    <h3 class="root-info-container-title">大会LIVE配信情報</h3>
    <div class="root-info-container-flex">
      <?php
        if (count($streams) == 0) {
          echo '<p>現在LIVE配信を行っている・直近に予定している大会はありません。</p>';
        }
        else {
          echo format_schedule_with_month(implode('', array_map('format_schedule', $streams)), false);;
        }
      ?>
    </div>
    <p class="root-info-text">過去のライブ配信は「<a href="info.php">ライブ配信アーカイブ</a>」へ。</p>
  </div>

  <hr>
  
  <h2 class="h2">Contents</h2>

  <div class="root-content-container">
    <div class="root-content-item">
      <a href="info.php"></a>
      <h3 class="root-content-item-title">最新情報・お知らせ</h3>
      <p class="root-content-item-text">地学関係のお知らせはこちら</p>
    </div>
    
    <div class="root-content-item">
      <a href="schedule.php"></a>
      <h3 class="root-content-item-title">スケジュール</h3>
      <p class="root-content-item-text">地学関係の予定はこちら</p>
    </div>
    
    <div class="root-content-item">
      <a href="routemap.php"></a>
      <h3 class="root-content-item-title">国内・国際ルートマップ</h3>
      <p class="root-content-item-text">国際大会に日本代表として参加する流れをご紹介します。</p>
    </div>
    
    <div class="root-content-item">
      <a href="../common/problems.php"></a>
      <h3 class="root-content-item-title">全大会過去問一覧</h3>
      <p class="root-content-item-text">地学関係の大会の過去問を一覧できます。</p>
    </div>
    
    <div class="root-content-item">
      <a href="../common/editorial_request.php"></a>
      <h3 class="root-content-item-title">ユーザー解説需要リスト</h3>
      <p class="root-content-item-text">まだユーザー解説が無い過去問のうち、解説の需要が大きいものを挙げています (登録ユーザー向け機能)。</p>
    </div>
    
    <div class="root-content-item">
      <a href="useful_links.php"></a>
      <h3 class="root-content-item-title">公式・便利リンク集</h3>
      <p class="root-content-item-text">公式や役に立ちそうなウェブサイトへの道標の集合体です。</p>
    </div>
    
    <div class="root-content-item">
      <a href="../../provision_info.php"></a>
      <h3 class="root-content-item-title">運営に情報提供する (共通)</h3>
      <p class="root-content-item-text">地学関係の大会等に関して、情報の補足や訂正等があれば気軽にご連絡ください。</p>
    </div>
  </div>

  <hr>

  <h2 class="h2">Contests</h2>

  <div class="root-genre-container">
    <div class="contest-link background-earthscience">
      <a href="jeso.php"></a>
      <p class="whiteletter-light color-earthscience">JESO</p>
      <div class="contest-link-content">
        <h3 class="light-underline">日本地学オリンピック</h3>
      </div>
    </div>
    <div class="contest-link background-earthscience">
      <a href="ieso.php"></a>
      <p class="whiteletter-light color-earthscience">IESO</p>
      <div class="contest-link-content">
        <h3 class="light-underline">国際地学オリンピック</h3>
      </div>
    </div>
    <div class="contest-link background-earthscience">
      <a href="esf.php"></a>
      <p class="whiteletter-light color-earthscience">ESF</p>
      <div class="contest-link-content">
        <h3 class="light-underline">地学フェスティバル</h3>
      </div>
    </div>
  </div>

  <?php echo default_footer(); ?>
</body>

</html>