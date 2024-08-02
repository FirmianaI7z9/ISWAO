<?php
  require_once "php/default.php";
  require_once "php/db_connect.php";
  require_once "php/functions.php";
  session_start();

  $now = new DateTime();
  $week = new DateTime();
  $week->modify("-1 week");
  $week->modify("+1 day");

  $pre = $pdo->prepare("SELECT * FROM schedules WHERE start_at <= :m AND finish_at >= :n ORDER BY start_at ASC;");
  $params = array(":m" => $now->format("Y-m-d 23:59:59"), ":n" => $now->format("Y-m-d 00:00:00"));
  $pre->execute($params);
  $schedules = $pre->fetchAll();

  $pre = $pdo->prepare("SELECT * FROM information WHERE created_at >= :n ORDER BY created_at DESC;");
  $params = array(":n" => $week->format("Y-m-d 00:00:00"));
  $pre->execute($params);
  $information = $pre->fetchAll();
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
  <link rel="stylesheet" href="/css/schedule.css">
  <link rel="stylesheet" href="/css/root_index.css">
  <link rel="stylesheet" href="/css/past.css">
  <script src=""></script>
</head>

<body>
  <?php echo default_header(); ?>
  <h2 class="h2">Breaking News</h2>
  <!--
  <p style="color:red;font-weight:600;">臨時リンク：IOAIの詳細については<a href="https://ioai-japan.notion.site/1-IOAI2024-7ee01907740141dcbcad2e3bc70b7210" target="_blank" rel="noopener noreferrer">こちら</a></p>
  <p style="font-weight:600;">臨時リンク：本年度を含む過去4年の国際大会開催地情報は<a href="articles/recent_ixo_held.html">こちら</a></p>
  -->
  <hr>
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
    <p class="root-info-text">明日以降の予定は「<a href="schedule.php">スケジュール</a>」へ。</p>
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
      <p>より過去のお知らせは「<a href="info.php">お知らせ</a>」へ。</p>
    </div>
  </div>
  <div class="root-info-container">
    <h3 class="root-info-container-title">申し込み受付中の大会</h3>
    <div class="root-info-container-main">
      <p>現在申し込みを行っている大会はありません。</p>
    </div>
  </div>
  <div class="root-info-container">
    <h3 class="root-info-container-title">大会LIVE配信情報</h3>
    <div class="root-info-container-main">
      <p>現在LIVE配信を行っている・直近に予定している大会はありません。</p>
    </div>
  </div>
  <div class="root-info-container">
    <h3 class="root-info-container-title">ウェブサイト更新情報 (<?php echo $week->format("m月d日")?>～<?php echo $now->format("m月d日")?>)</h3>
    <div class="root-info-container-main">
      <p>直近7日の更新情報はありません。</p>
      <p>より過去の更新情報は「ウェブサイト更新情報」へ。</p>
    </div>
  </div>
  <div class="root-info-container">
    <h3 class="root-info-container-title">SNSほか</h3>
    <div class="root-info-container-main">
      <p>一般向けアカウント：<a href="">Twitter(現X)</a></p>
      <p>物好き向けアカウント：<a href="">Twitter(現X)</a></p>
    </div>
  </div>

  <hr>
  <h2 class="h2">Contents</h2>

  <div class="root-content-container">
    <div class="root-content-item">
      <a href="info.php"></a>
      <h3 class="root-content-item-title">最新情報・お知らせ</h3>
      <p class="root-content-item-text">学術オリンピックに関する最新情報や、運営からのお知らせなどをまとめています。<br>一部の情報については詳説します。</p>
    </div>
    
    <div class="root-content-item">
      <a href="schedule.php"></a>
      <h3 class="root-content-item-title">スケジュール</h3>
      <p class="root-content-item-text">学術オリンピックの大会の今後の予定を掲載しています。<br>大会内のスケジュールも掲載しているものもあります。</p>
    </div>
    
    <div class="root-content-item">
      <a href="calendar_m.php"></a>
      <h3 class="root-content-item-title">月別カレンダー</h3>
      <p class="root-content-item-text">学術オリンピックの大会の今後の予定をカレンダー形式で掲載しています。</p>
    </div>
    
    <div class="root-content-item">
      <a href="calendar_l.php"></a>
      <h3 class="root-content-item-title">リスト式カレンダー</h3>
      <p class="root-content-item-text">学術オリンピックの大会の今後の予定をリスト形式で掲載しています。</p>
    </div>
    
    <div class="root-content-item">
      <a href="contests.php"></a>
      <h3 class="root-content-item-title">コンテスト一覧</h3>
      <p class="root-content-item-text">当サイトで扱っている大会一覧を掲載しています。</p>
    </div>
    
    <div class="root-content-item">
      <a href="d_booking.php"></a>
      <h3 class="root-content-item-title">予定被り情報</h3>
      <p class="root-content-item-text">大会毎の予定被り情報をまとめています。</p>
    </div>
    
    <div class="root-content-item">
      <a href="useful_links.php"></a>
      <h3 class="root-content-item-title">便利リンク集</h3>
      <p class="root-content-item-text">役に立ちそうなウェブサイトへの道標の集合体です。</p>
    </div>
    
    <div class="root-content-item">
      <a href="contact.php"></a>
      <h3 class="root-content-item-title">問い合わせ</h3>
      <p class="root-content-item-text">不具合報告や要望はここから。</p>
    </div>
    
    <div class="root-content-item">
      <a href="about.php"></a>
      <h3 class="root-content-item-title">ABOUT</h3>
      <p class="root-content-item-text">当サイトに関する情報を掲載しています。</p>
    </div>
  </div>

  <hr>
  <h2 class="h2">Genres / Contests</h2>

  <div class="root-genre-container">
    <div class="root-genre-item">
      <h3 class="root-genre-item-title background-mathematics color-black">数学</h3>
      <ul class="root-genre-item-list">
        <li><span class="tag background-mathematics color-black">JMO</span>日本数学オリンピック</li>
        <li><span class="tag background-mathematics color-black">JJMO</span>日本ジュニア数学オリンピック</li>
        <li><span class="additional-tag-wrapper background-black color-white"><span class="additional-tag-innertag background-mathematics color-black">EGMO</span>qual</span>EGMO一次選抜</li>
        <li><span class="tag background-mathematics color-black">IMO</span>国際数学オリンピック</li>
        <li><span class="tag background-mathematics color-black">EGMO</span>ヨーロッパ女子数学オリンピック</li>
        <li><span class="tag background-mathematics color-black">APMO</span>アジア太平洋数学オリンピック</li>
      </ul>
    </div>

    <div class="root-genre-item">
      <h3 class="root-genre-item-title background-physics color-white">物理</h3>
      <ul class="root-genre-item-list">
        <li><span class="tag background-physics color-white">JPhO</span>物理チャレンジ</li>
        <li><span class="tag background-physics color-white">IPhO</span>国際物理オリンピック</li>
        <li><span class="tag background-physics color-white">APhO</span>アジア物理オリンピック</li>
        <li><span class="tag background-physics color-white">OPhO</span>Online Physics Olympiad</li>
        <li><span class="tag background-physics color-white">EuPhO</span>Europian Physics Olympiad</li>
      </ul>
    </div>

    <div class="root-genre-item">
      <h3 class="root-genre-item-title background-chemistry color-black">化学</h3>
      <ul class="root-genre-item-list">
        <li><span class="tag background-chemistry color-black">JChO</span>化学グランプリ</li>
        <li><span class="tag background-chemistry color-black">IChO</span>国際化学オリンピック</li>
      </ul>
    </div>

    <div class="root-genre-item">
      <h3 class="root-genre-item-title background-biology color-white">生物学</h3>
      <ul class="root-genre-item-list">
        <li><span class="tag background-biology color-white">JBO</span>日本生物学オリンピック</li>
        <li><span class="tag background-biology color-white">IBO</span>国際生物学オリンピック</li>
      </ul>
    </div>

    <div class="root-genre-item">
      <h3 class="root-genre-item-title background-earthscience color-black">地学</h3>
      <ul class="root-genre-item-list">
        <li><span class="tag background-earthscience color-black">JESO</span>日本地学オリンピック</li>
        <li><span class="tag background-earthscience color-black">IESO</span>国際地学オリンピック</li>
      </ul>
    </div>

    <div class="root-genre-item">
      <h3 class="root-genre-item-title background-informatics color-white">情報</h3>
      <ul class="root-genre-item-list">
        <li><span class="tag background-informatics color-white">JOI</span>日本情報オリンピック</li>
        <li><span class="tag background-informatics color-white">JOIG</span>日本情報オリンピック女性部門</li>
        <li><span class="tag background-informatics color-white">IOI</span>国際情報オリンピック</li>
        <li><span class="tag background-informatics color-white">EGOI</span>ヨーロッパ女子情報オリンピック</li>
        <li><span class="tag background-informatics color-white">APIO</span>アジア太平洋情報オリンピック</li>
        <li><span class="tag background-informatics color-white">OpenOI</span>Open Olympiad in Informatics</li>
      </ul>
    </div>

    <div class="root-genre-item">
      <h3 class="root-genre-item-title background-kako color-white">科学の甲子園</h3>
      <ul class="root-genre-item-list">
        <li><span class="tag background-kako color-white">科甲</span>科学の甲子園</li>
        <li><span class="tag background-kako color-white">科甲Jr</span>科学の甲子園ジュニア</li>
        <li><span class="tag background-kako color-white">SO</span>Science Olympiad</li>
      </ul>
    </div>

    <div class="root-genre-item">
      <h3 class="root-genre-item-title background-linguistics color-black">言語学</h3>
      <ul class="root-genre-item-list">
        <li><span class="tag background-linguistics color-black">JOL</span>日本言語学オリンピック</li>
        <li><span class="tag background-linguistics color-black">IOL</span>国際言語学オリンピック</li>
        <li><span class="tag background-linguistics color-black">APLO</span>アジア太平洋言語学オリンピック</li>
        <li><span class="tag background-linguistics color-black">Onling</span>Online Olympiad in Linguistics</li>
      </ul>
    </div>

    <div class="root-genre-item">
      <h3 class="root-genre-item-title background-astronomy color-white">天文学</h3>
      <ul class="root-genre-item-list">
        <li><span class="tag background-astronomy color-white">JAO</span>日本天文学オリンピック</li>
        <li><span class="tag background-astronomy color-white">IOAA</span>国際天文学・天体物理学オリンピック</li>
        <li><span class="tag background-astronomy color-white">IAO</span>国際天文学オリンピック</li>
      </ul>
    </div>

    <div class="root-genre-item">
      <h3 class="root-genre-item-title background-geography color-black">地理</h3>
      <ul class="root-genre-item-list">
        <li><span class="tag background-geography color-black">JGeO</span>科学地理オリンピック日本選手権</li>
        <li><span class="tag background-geography color-black">iGeO</span>国際地理オリンピック</li>
      </ul>
    </div>

    <div class="root-genre-item">
      <h3 class="root-genre-item-title background-philosophy color-black">哲学</h3>
      <ul class="root-genre-item-list">
        <li><span class="tag background-philosophy color-black">JPO</span>日本倫理・哲学グランプリ</li>
        <li><span class="tag background-philosophy color-black">IPO</span>国際哲学オリンピック</li>
      </ul>
    </div>

    <div class="root-genre-item">
      <h3 class="root-genre-item-title background-economics color-white">経済</h3>
      <ul class="root-genre-item-list">
        <li><span class="tag background-economics color-white">エコ甲</span>エコノミクス甲子園</li>
        <li><span class="tag background-economics color-white">IEO</span>国際経済オリンピック</li>
      </ul>
    </div>

    <div class="root-genre-item">
      <h3 class="root-genre-item-title background-brainscience color-white">脳科学</h3>
      <ul class="root-genre-item-list">
        <li><span class="tag background-brainscience color-white">JBB</span>日本脳科学オリンピック</li>
        <li><span class="tag background-brainscience color-white">IBB</span>国際脳科学オリンピック</li>
      </ul>
    </div>

    <div class="root-genre-item">
      <h3 class="root-genre-item-title background-ai color-white">人工知能</h3>
      <ul class="root-genre-item-list">
        <li><span class="tag background-ai color-white">IOAI</span>国際人工知能オリンピック</li>
      </ul>
    </div>

    <div class="root-genre-item">
      <h3 class="root-genre-item-title background-socialscience color-white">社会科学</h3>
      <ul class="root-genre-item-list">
        <li><span class="tag background-socialscience color-white">IOSS</span>国際社会科学オリンピック</li>
      </ul>
    </div>
  </div>

  <?php echo default_footer(); ?>
</body>

</html>