<?php
  require_once "../php/default.php";
  require_once "../php/db_connect.php";
  require_once "../php/functions.php";
  session_start();

  $pre = $pdo->prepare("SELECT * FROM `users` ORDER BY `users`.`username` ASC;");
  $pre->execute();
  $users = $pre->fetchAll();
?>

<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@100..900&family=Roboto+Condensed:wght@500&display=swap" rel="stylesheet">
  <title>ホーム | 学術オリンピック非公式まとめサイト</title>
  <link rel="stylesheet" href="/css/common.css">
  <link rel="stylesheet" href="/css/colors.css">
  <link rel="stylesheet" href="/css/past.css">
</head>

<body>
  <?php echo default_header(); ?>
  <h2 class="h2">Developer Page</h2>

  <div class="basic-container">
    <h3 class="basic-h3">Users</h3>
    <?php
      for ($i = 0; $i < count($users); $i++) {
        echo '<p class="basic-text"><a class="username" href="/user/index.php?user=' . $users[$i]['username'] . '" style="color:#' . $users[$i]['color'] . ';">' . $users[$i]['username'] . '</a></p>';
      }
    ?>
  </div>

  <?php echo default_footer(); ?>
</body>

</html>