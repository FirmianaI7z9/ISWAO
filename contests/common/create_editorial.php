<?php
  require_once "../../php/default.php";
  require_once "../../php/db_connect.php";
  require_once "../../php/functions.php";
  session_start();

  if (!isset($_SESSION['id']) || !isset($_GET['pid'])) {
    header("location: ../../401.html");
  }

  $problem_id = $_GET['pid'];
  $_SESSION['problem_id'] = $problem_id;

  if (!preg_match('/[0-9]{2}\-[0-9]{2}\-[0-9]{4}\-[0-9]{1}\-[0-9]{2}\-[0-9]{2}/', $problem_id)) {
    header("location: ../../401.html");
  }

  if (!isset($_GET['eid'])) {
    $pre = $pdo->prepare("INSERT INTO `editorials` (`problem_id`, `type`, `user_id`, `status`) VALUES (:pid, 2, :uid, 1);");
    $pre->bindValue(":pid", $problem_id, PDO::PARAM_INT);
    $pre->bindValue(":uid", $_SESSION['id'], PDO::PARAM_INT);
    $pre->execute();
    $editorial_id = $pdo->lastInsertId();
    header("location: create_editorial.php?pid=".strval($problem_id)."&eid=".strval($editorial_id));
  }
  else{
    $_SESSION['editorial_id'] = $_GET['eid'];
    $pre = $pdo->prepare("SELECT * FROM `editorials` WHERE id = :eid;");
    $pre->bindValue(":eid", $_GET['eid'], PDO::PARAM_INT);
    $pre->execute();
    $editorial = $pre->fetch();
    if (!is_numeric($_SESSION['editorial_id']) || $_SESSION['editorial_id'] <= 0 || $editorial['user_id'] != $_SESSION['id']) {
      header("location: ../../401.html");
    }
  }
?>

<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1">
  <meta name="robots" content="noindex">
  <link rel="shortcut icon" type="image/x-icon" href="/img/favicon.ico">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@100..900&family=Roboto+Condensed:wght@500&display=swap" rel="stylesheet">
  <title>解説作成 | 学術オリンピック非公式まとめサイト</title>
  <link rel="stylesheet" href="/css/common.css">
  <link rel="stylesheet" href="/css/colors.css">
  <link rel="stylesheet" href="/css/editorial.css">
  <link rel="stylesheet" href="/css/past.css">
  <link rel="stylesheet" href="/css/problems.css">
  <script src="/js/textarea_resize.js"></script>
  <script src="/js/editorial_submit.js?v1.0.1"></script>
</head>

<body>
  <?php echo default_header(); ?>
  <h2 class="h2">Create Editorial</h2>
  <div class="basic-container">
    <div class="basic-container-inner">
      <h3>解説作成</h3>
      <div class="editorial-info-container">
        <?php if (isset($_GET['i']) && $_GET['i'] == 0) echo '<p id="edit-info-text">正常に保存されました。</p>'?>
      </div>
      <div class="edit-textarea-container">
        <div class="edit-textarea-dummy" aria-disabled="true"><?php echo($editorial['text']); ?></div>
        <textarea class="edit-textarea" id="editorial_text"><?php echo($editorial['text']); ?></textarea>
      </div>
      <button type="submit" class="button-blue" onclick="submit_editorial('<?php echo $_GET['pid']; ?>', 0);">提出 (審査待ち)</button>
      <button type="submit" class="button-white" onclick="submit_editorial('<?php echo $_GET['pid']; ?>', 1);">下書き保存</button>
      <button type="submit" class="button-white" onclick="window.open('editorial.php?id=<?php echo $editorial['id'];?>&pre=1')">プレビュー</button>
    </div>
  </div>
  <?php echo default_footer(); ?>
</body>

</html>