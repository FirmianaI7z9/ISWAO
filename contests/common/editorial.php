<?php
  require_once "../../php/default.php";
  require_once "../../php/db_connect.php";
  require_once "../../php/functions.php";
  require_once "PHP-Markdown/Michelf/Markdown.inc.php";
  use Michelf\Markdown;
  ini_set("display_errors", "On");
  session_start();

  $pre = $pdo->prepare("SELECT
                          `editorials`.`id` AS `id`,
                          `editorials`.`problem_id` AS `problem_id`,
                          `editorials`.`user_id` AS `user_id`,
                          `editorials`.`status` AS `status`,
                          `editorials`.`text` AS `text`,
                          `editorials`.`updated_at` AS `updated_at`,
                          `problems`.`problem_name` AS `problem_name`,
                          `problems`.`difficulty` AS `difficulty`,
                          `contests`.`tags` AS `tags`,
                          `users`.`username` AS `username`,
                          `users`.`color` AS `color`
                        FROM `editorials`
                        INNER JOIN `problems` ON `editorials`.`problem_id` = `problems`.`problem_id`
                        INNER JOIN `contests` ON `problems`.`problem_id` LIKE CONCAT(`contests`.`contest_id`, '-%')
                        INNER JOIN `users` ON `editorials`.`user_id` LIKE `users`.`id`
                        WHERE `editorials`.`id` = :id;");
  $params = array(":id" => $_GET['id']);
  $pre->execute($params);
  $editorial = $pre->fetch();
?>

<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1">
  <meta name="description" content="">
  <meta property="og:url" content="https://acaoly-inofficial.com/contests/common/editorial.php">
  <meta property="og:type" content="website">
  <meta property="og:site_name" content="学術オリンピック非公式まとめサイト">
  <meta property="og:image" content="https://acaoly-inofficial.com/img/comp_site_thumbnail.png">
  <meta property="og:title" content="問題">
  <meta name="twitter:card" content="summary">
  <meta name="twitter:site" content="@acaoly_notifi">
  <link rel="shortcut icon" type="image/x-icon" href="/img/favicon.ico">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@100..900&family=Roboto+Condensed:wght@500&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/katex@0.16.10/dist/katex.min.css" integrity="sha384-wcIxkf4k558AjM3Yz3BBFQUbk/zgIYC2R0QpeeYb+TwlBVMrlgLqwRjRtGZiK7ww" crossorigin="anonymous">
  <script defer src="https://cdn.jsdelivr.net/npm/katex@0.16.10/dist/katex.min.js" integrity="sha384-hIoBPJpTUs74ddyc4bFZSM1TVlQDA60VBbJS0oA934VSz82sBx1X7kSx2ATBDIyd" crossorigin="anonymous"></script>
  <script defer src="https://cdn.jsdelivr.net/npm/katex@0.16.10/dist/contrib/auto-render.min.js" integrity="sha384-43gviWU0YVjaDtb/GhzOouOXtZMP/7XUzwPTstBeZFe/+rCMvRwr4yROQP43s0Xk" crossorigin="anonymous" onload="renderMathInElement(document.body);"></script>
  <title>ユーザー解説 (<?php echo $editorial['problem_name']; ?> by <?php echo $editorial['username']; ?>) | 学術オリンピック非公式まとめサイト</title>
  <link rel="stylesheet" href="/css/common.css">
  <link rel="stylesheet" href="/css/colors.css">
  <link rel="stylesheet" href="/css/editorial.css">
  <link rel="stylesheet" href="/css/past.css">
  <link rel="stylesheet" href="/css/problems.css">
  <script src=""></script>
</head>

<body>
  <?php echo default_header(); ?>
  <h2 class="h2">User Editorial</h2>
  <div class="basic-container">
    <p class="username-large" style="color:<?php echo get_difficulty_color_1($editorial['difficulty']); ?>; padding-left: 5px;">
      <?php 
        $diff = $editorial['difficulty'];
        if ($diff >= 2700) {
          $color = get_difficulty_color_1($diff);
          $gradient = get_difficulty_color_2($diff);
          echo '<span class="difficulty-icon-large" style="'.$gradient.'"></span>';
        }
        else if ($diff >= 1) {
          $rate = ($diff % 300) / 3;
          $color = get_difficulty_color_1($diff);
          echo '<span class="difficulty-icon-large" style="border-color: '.$color.'; background: linear-gradient(to top left, '.$color.' '.strval($rate).'%, #ffffff '.strval($rate).'%);"></span>';
        }
      ?>
      <?php echo $editorial['problem_name'];?></p>
    <hr>
    <p class="user-belongs"><?php echo format_genre(json_decode($editorial['tags'])[0]); ?> by <a class="username" href="/user/index.php?user=<?php echo $editorial['username']; ?>" style="color:#<?php echo $editorial['color']; ?>"><?php echo $editorial['username']; ?></a> ,Updated at <?php echo (new DateTime($editorial['updated_at']))->format("Y-m-d H:i"); ?></p>
  </div>
  <div class="basic-container">
    <div class="basic-container-inner">
      <?php echo Markdown::defaultTransform($editorial['text']); ?>
    </div>
  </div>
  <?php echo default_footer(); ?>
  <script>
    document.addEventListener("DOMContentLoaded", function() {
        renderMathInElement(document.body, {
          delimiters: [
              {left: '$$', right: '$$', display: true},
              {left: '$', right: '$', display: false}
          ],
          throwOnError : false
        });
    });
  </script>
</body>

</html>