<?php
  require_once "php/default.php";
  require_once "php/db_connect.php";
  require_once "php/functions.php";
  session_start();

  $pre = $pdo->prepare("SELECT * FROM information ORDER BY created_at DESC;");
  $pre->execute();
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
  <link rel="stylesheet" href="/css/past.css">
  <script src=""></script>
</head>

<body>
  <?php echo default_header(); ?>
  <h2 class="h2">Information</h2>

  <div class="basic-container">
    <?php
      function format_genre($item) {
        return '<span class="tag background-'.genre2text($item->type).' color-'.genre2textcolor($item->type).'">'.$item->text.'</span>';
      }
      function format_info($item) {
        $genres = json_decode($item['genre']);
        $genretags = implode('', array_map('format_genre', $genres));
        $str = '<div class="information-item"><p class="information-item-datetime">'.format_time($item['created_at']).'</p><a class="information-item-title"'.($item['link'] == 1 ? ' href="'.$item['linktext'].'"' : '').($item['is_external_site'] == 1 ? ' target="_blank" rel="noopener noreferrer"' : '').'>'.$item['title'].'</a><p class="information-item-tags">'.$genretags.'</p></div>';
        return $str;
      }
      if (count($information) == 0) {
        echo '<p>お知らせはありません。</p>';
      }
      else {
        echo implode('', array_map('format_info', $information));
      }
    ?>
  </div>

  <div class="information-pagebutton-container">
    <button type="submit" class="information-pagebutton">1</button>
    <button type="submit" class="information-pagebutton">2</button>
    <button type="submit" class="information-pagebutton-now">3</button>
    <button type="submit" class="information-pagebutton">4</button>
    <button type="submit" class="information-pagebutton">5</button>
  </div>

  <?php echo default_footer(); ?>
</body>

</html>