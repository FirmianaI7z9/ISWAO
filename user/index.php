<?php
  require_once "../php/default.php";
  require_once "../php/db_connect.php";
  require_once "../php/functions.php";
  session_start();

  $pre = $pdo->prepare("SELECT * FROM users WHERE username = :i");
  $pre->bindValue(":i", $_GET['user'], PDO::PARAM_STR);
  $pre->execute();
  $user_data = $pre->fetch();

  $pre = $pdo->prepare("SELECT editorials.id,contests.tags,type,user_id,reference,reference_url,status,problems.problem_name,users.username,users.color FROM editorials INNER JOIN problems ON editorials.problem_id = problems.problem_id INNER JOIN contests ON editorials.problem_id LIKE CONCAT(contests.contest_id, '%') INNER JOIN users ON users.id = editorials.user_id WHERE user_id=:i;");
  $params = array(":i" => $user_data['id']);
  $pre->execute($params);
  $editorials = $pre->fetchAll();
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
  <link rel="stylesheet" href="/css/form.css">
  <link rel="stylesheet" href="/css/editorial.css">
  <link rel="stylesheet" href="/css/past.css">
  <script src=""></script>
</head>

<body>
  <?php echo default_header(); ?>
  <h2 class="h2">User Profile</h2>
  <div class="basic-container">
    <p class="username-large" style="color:#<?php echo $user_data['color']; ?>;"><?php echo $user_data['username'];?></p>
    <p class="user-belongs"><?php echo is_empty_str($user_data['affiliation'], '所属未設定');?>, <?php echo implode(',', json_decode($user_data['titles'])); ?></p>
    <hr>
    <div class="user-profile-container">
      <div class="user-profile-item">
        <h3 class="user-profile-item-title">Profile</h3>
        <table class="user-profile-item-table">
          <tbody>
            <tr>
              <th>誕生年</th>
              <td><?php echo is_empty_str(strval($user_data['year']), '未設定');?></td>
            </tr>
            <tr>
              <th>参加大会数</th>
              <td><?php echo count(json_decode($user_data['joined_contest'])); ?> 種</td>
            </tr>
            <tr>
              <th>参加経験</th>
              <td><?php echo implode('', array_map('format_genre', json_decode($user_data['joined_contest']))); ?></td>
            </tr>
            <tr>
              <th>解説作成数</th>
              <td><?php echo count($editorials);?></td>
            </tr>
            <tr>
              <th>ひとこと</th>
              <td><?php echo $user_data['introduction']; ?></td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
  <div class="basic-container">
    <div class="user-profile-container">
      <div class="user-profile-item">
        <h3 class="user-profile-item-title">User Editorials</h3>
        <div class="editorial-link-container">
          <?php
            $str = implode('', array_map('format_editorial_1', $editorials));
            if (count($editorials) > 0 && $str != '') {
              echo $str;
            }
            else {
              echo '<p>このユーザーはまだ解説を作成していません。</p>';
            }
          ?>
        </div>
      </div>
    </div>
  </div>
  <?php echo default_footer(); ?>
</body>

</html>