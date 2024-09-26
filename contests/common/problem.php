<?php
  require_once "../../php/default.php";
  require_once "../../php/db_connect.php";
  require_once "../../php/functions.php";
  session_start();

  $id = $_GET['id'];
  $pre = $pdo->prepare("SELECT
                          `problems`.`problem_id` AS `problem_id`,
                          `problems`.`problem_name` AS `problem_name`,
                          `problems`.`genre` AS `genre`,
                          `problems`.`correct_rate` AS `correct_rate`,
                          `problems`.`difficulty` AS `difficulty`,
                          `problems`.`updated_at` AS `updated_at`,
                          `contests`.`contest_name` AS `contest_name`,
                          `contests`.`tags` AS `tags`,
                          `problemsets`.`set_name` AS `set_name`
                        FROM `problems` 
                        INNER JOIN `contests` 
                          ON `contests`.`contest_id` = SUBSTRING(`problems`.`problem_id`, 1, 12)
                        INNER JOIN `problemsets`
                          ON `problemsets`.`set_id` = SUBSTRING(`problems`.`problem_id`, 1, 15)
                        WHERE `problem_id` = :id;");
  $pre->bindValue(":id", $id, PDO::PARAM_INT);
  $pre->execute();
  $problem = $pre->fetch();
  
  $pre = $pdo->prepare("SELECT * FROM `problemlinks` WHERE FIND_IN_SET(:id, `problem_ids`) <> 0;");
  $pre->bindValue(":id", $id, PDO::PARAM_INT);
  $pre->execute();
  $problemlinks = $pre->fetchAll();

  $pre = $pdo->prepare("SELECT 
                          `editorials`.`id`,
                          `contests`.`tags`,
                          `type`,
                          `reference`,
                          `reference_url`,
                          `status`,
                          `user_id`,
                          `problems`.`problem_name`,
                          `users`.`username`,
                          `users`.`color`
                        FROM `editorials` 
                        INNER JOIN `problems` ON `editorials`.`problem_id` = `problems`.`problem_id` 
                        INNER JOIN `contests` ON `editorials`.`problem_id` LIKE CONCAT(`contests`.`contest_id`, '%') 
                        INNER JOIN `users` ON `users`.`id` = `editorials`.`user_id` 
                        WHERE `problems`.`problem_id` = :id");
  $pre->bindValue(":id", $id, PDO::PARAM_INT);
  $pre->execute();
  $editorials = $pre->fetchAll();

  $official_editorials = [];
  $voluntary_editorials = [];
  $user_editorials = [];
  $my_editorials = [];
  for ($i = 0; $i < count($editorials); $i++) {
    if ($editorials[$i]['type'] == 0) {
      $official_editorials[] = $editorials[$i];
    }
    else if ($editorials[$i]['type'] == 1) {
      $voluntary_editorials[] = $editorials[$i];
    }
    else if ($editorials[$i]['type'] == 2) {
      $user_editorials[] = $editorials[$i];
      if (isset($_SESSION['id']) && $editorials[$i]['user_id'] == $_SESSION['id']) {
        $my_editorials[] = $editorials[$i];
      }
    }
  }
?>

<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1">
  <meta name="description" content="">
  <meta property="og:url" content="https://acaoly-inofficial.com/contests/common/problem.php">
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
  <title>問題 | 学術オリンピック非公式まとめサイト</title>
  <link rel="stylesheet" href="/css/common.css">
  <link rel="stylesheet" href="/css/colors.css">
  <link rel="stylesheet" href="/css/editorial.css">
  <link rel="stylesheet" href="/css/past.css">
  <link rel="stylesheet" href="/css/problems.css">
  <script src=""></script>
</head>

<body>
  <?php echo default_header(); ?>
  <h2 class="h2">Problem</h2>
  <div class="basic-container">
    <p class="username-large" style="color:<?php echo get_difficulty_color_1($problem['difficulty']); ?>; padding-left: 5px;">
      <?php 
        $diff = $problem['difficulty'];
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
      <?php echo $problem['problem_name'];?></p>
    <p class="user-belongs"><?php echo format_genre(json_decode($problem['tags'])[0]); ?> Updated at <?php echo (new DateTime($problem['updated_at']))->format("Y-m-d H:i"); ?></p>
    <hr>
    <div class="basic-container-inner">
      <div class="user-profile-item">
        <h3>基本情報</h3>
        <table class="user-profile-item-table">
          <tbody>
            <tr>
              <th>出題場所</th>
              <td><?php echo $problem['contest_name']; ?> - <?php echo $problem['set_name']; ?></td>
            </tr>
            <tr>
              <th>ジャンル</th>
              <td><?php echo implode(',', json_decode($problem['genre'])); ?></td>
            </tr>
            <tr>
              <th>平均得点率</th>
              <td><?php echo ($problem['correct_rate'] < -0.5 ? '---' : number_format($problem['correct_rate'], 2)); ?>%</td>
            </tr>
            <tr>
              <th>Difficulty</th>
              <td><?php echo ($problem['correct_rate'] < -0.5 ? '---' : $problem['difficulty']); ?></td>
            </tr>
          </tbody>
        </table>
        <br>
        <button type="submit" class="button-white">情報提供をする</button>
        <button type="submit" class="button-white">Difficulty投票</button>
      </div>
    </div>
  </div>
  <div class="basic-container">
    <div class="basic-container-inner">
      <div class="user-profile-item">
        <h3>問題など</h3>
        <div class="editorial-link-container">
          <?php
            $captions = [];
            if (count($problemlinks) == 0) {
              echo '問題データがありません。';
            }
            for ($i = 0; $i < count($problemlinks); $i++) {
              $str = '<div class="editorial-link">
                        <a href="'.$problemlinks[$i]['link'].'" target="_blank" rel="noopener noreferrer"></a>
                        <p class="editorial-link-title">'.$problemlinks[$i]['title'].'</p>
                      </div>';
              echo $str;
              $caps = explode(',', $problemlinks[$i]['caption']);
              for ($j = 0; $j < count($caps); $j++) {
                $captions[] = $problemlinks[$i]['title'].' : '.$caps[$j];
              }
            }
          ?>
        </div>
        <ol>
          <?php
            for ($i = 0; $i < count($captions); $i++) {
              echo '<li>'.$captions[$i].'</li>';
            }
          ?>
        </ol>
        <button type="submit" class="button-white">情報提供をする</button>
      </div>
    </div>
  </div>
  <div class="basic-container">
    <div class="basic-container-inner">
      <div class="user-profile-item">
        <h3>公式解説</h3>
        <div class="editorial-link-container">
          <?php
            if (count($official_editorials) > 0) {
              echo implode('', array_map('format_editorial_1', $official_editorials));
            }
            else {
              echo '<p>この問題の公式解説は掲載されていません。</p>';
            }
          ?>
        </div>
        <button type="submit" class="button-white">情報提供をする</button>
      </div>
      <hr>
      <div class="user-profile-item">
        <h3>解説ウェブサイト</h3>
        <div class="editorial-link-container">
          <?php
            if (count($voluntary_editorials) > 0) {
              echo implode('', array_map('format_editorial_1', $voluntary_editorials));
            }
            else {
              echo '<p>他の解説ウェブサイトでこの問題は扱われていません。</p>';
            }
          ?>
        </div>
        <button type="submit" class="button-white">情報提供をする</button>
      </div>
      <hr>
      <div class="user-profile-item">
        <h3>ユーザー解説</h3>
        <div class="editorial-link-container">
          <?php
          $str = implode('', array_map('format_editorial_1', $user_editorials));
            if (count($user_editorials) > 0 && $str != '') {
              echo $str;
            }
            else {
              echo '<p>まだユーザー解説が投稿されていません。</p>';
            }
          ?>
        </div>
        <?php if (isset($_SESSION['id'])) echo '<h4>あなたが作成した解説</h4><div class="editorial-link-container">'; ?>
          <?php
            if (isset($_SESSION['id'])) { 
              if (count($my_editorials) > 0) {
                echo implode('', array_map('format_editorial_2', $my_editorials));
              }
              else {
                echo '<p>まだ解説を作成していません。</p>';
              }
            }
          ?>
        <?php if (isset($_SESSION['id'])) echo '</div><button type="submit" class="button-blue" onclick="location.href = \'create_editorial.php?pid='; ?><?php if (isset($_SESSION['id'])) echo $id;?><?php if (isset($_SESSION['id'])) echo '\'">ユーザー解説を書く</button>'; ?>
      </div>
    </div>
  </div>
  <?php echo default_footer(); ?>
</body>

</html>