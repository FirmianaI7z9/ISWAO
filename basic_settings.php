<?php
  require_once "php/db_connect.php";
  require_once "php/functions.php";
  require_once "php/default.php";
  session_start();

  if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
  }

  $datas = [
    'color' => '',
    'year'  => '',
    'affiliation'  => '',
    'introduction' => ''
  ];
  $login_err = "";

  if($_SERVER['REQUEST_METHOD'] != 'POST'){
    setToken();
  }
  
  if($_SERVER["REQUEST_METHOD"] == "POST"){
    checkToken();
    
    foreach($datas as $key => $value) {
      if($value = filter_input(INPUT_POST, $key, FILTER_DEFAULT)) {
        $datas[$key] = htmlspecialchars($value);
      }
    }
    
    $errors = validation2($datas);
        if(empty($errors)){
      try {
        $stmt = $pdo->prepare(
          'UPDATE users SET `color` = :c, `year` = :y, `affiliation` = :a, `introduction` = :t WHERE `id` = :u;');
        $stmt->bindValue(":c", $datas['color'], PDO::PARAM_STR);
        $stmt->bindValue(":y", $datas['year'], PDO::PARAM_STR);
        $stmt->bindValue(":a", $datas['affiliation'], PDO::PARAM_STR);
        $stmt->bindValue(":t", $datas['introduction'], PDO::PARAM_STR);
        $stmt->bindValue(":u", $_SESSION['id'], PDO::PARAM_INT);
        $stmt->execute();
                //header("location: setting.php");
        //exit;
      } catch (PDOException $e) {
        echo 'エラー: 登録できませんでした。管理者に連絡してください。';
      }
    }
  }

  $pre = $pdo->prepare("SELECT * FROM `users` WHERE `id` = :i;");
  $pre->bindValue(":i", $_SESSION['id'], PDO::PARAM_INT);
  $pre->execute();
  $data = $pre->fetch();
  
  if ($data == false) header("location: login.php");

  $datas['color'] = $data['color'];
  $datas['year'] = $data['year'];
  $datas['affiliation'] = $data['affiliation'];
  $datas['introduction'] = $data['introduction'];
  ?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1">
  <link rel="shortcut icon" type="image/x-icon" href="/img/favicon.ico">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@100..900&family=Roboto+Condensed:wght@500&display=swap" rel="stylesheet">
  <title>基本設定 | 学術オリンピック非公式まとめサイト</title>
  <link rel="stylesheet" href="/css/common.css">
  <link rel="stylesheet" href="/css/past.css">
  <link rel="stylesheet" href="/css/form.css">
  <style>
    body{
      font: 16px sans-serif;
    }
    .wrapper{
      width: 340px;
      padding: 20px;
      margin: 0 auto;
    }
  </style>
</head>
<body>
  <?php echo default_header(); ?>

  <div class="wrapper">
    <h2 class="h2">Basic Settings</h2>
    <p>設定を変更したのち、送信ボタンを押下してください。</p>

    <form action="<?php echo $_SERVER ['SCRIPT_NAME']; ?>" method="post">
      <div class="form-group">
        <label>ユーザー色RGBコード (16進6桁)</label>
        <input type="text" name="color" class="form-input<?php echo (isset($errors['color']) && !empty(h($errors['color']))) ? ' is-invalid' : ''; ?>" value="<?php echo h($datas['color']); ?>" oninput="if(value.length>6)value = value.substring(0,6);value=value.replaceAll(/[^0-9A-Fa-f]/g,'');">
        <span class="invalid-feedback"><?php if (isset($errors['color'])) echo h($errors['color']); ?></span>
      </div>
      <div class="form-group">
        <label>誕生年 (12文字以内)</label>
        <input type="text" name="year" class="form-input<?php echo (isset($errors['year']) && !empty(h($errors['year']))) ? ' is-invalid' : ''; ?>" value="<?php echo h($datas['year']); ?>" oninput="if(value.length>12)value = value.substring(0,12);value=value.replaceAll(/\s+/g,'');">
        <span class="invalid-feedback"><?php if (isset($errors['year'])) echo h($errors['year']); ?></span>
      </div>
      <div class="form-group">
        <label>所属 (半角64文字,全角32文字以内)</label>
        <input type="text" name="affiliation" class="form-input<?php echo (isset($errors['affiliation']) && !empty(h($errors['affiliation']))) ? ' is-invalid' : ''; ?>" value="<?php echo h($datas['affiliation']); ?>" oninput="if(value.length>64)value = value.substring(0,64);value=value.replaceAll(/\s+/g,'');">
        <span class="invalid-feedback"><?php if (isset($errors['affiliation'])) echo h($errors['affiliation']); ?></span>
      </div>
      <div class="form-group">
        <label>自己紹介 (半角128文字,全角64文字以内)</label>
        <input type="text" name="introduction" class="form-input<?php echo (isset($errors['introduction']) && !empty(h($errors['introduction']))) ? ' is-invalid' : ''; ?>" value="<?php echo h($datas['introduction']); ?>" oninput="if(value.length>128)value = value.substring(0,128);value=value.replaceAll(/\s+/g,'');">
        <span class="invalid-feedback"><?php if (isset($errors['introduction'])) echo h($errors['introduction']); ?></span>
      </div>
      <div class="form-group">
        <input type="hidden" name="token" value="<?php echo h($_SESSION['token']); ?>">
        <input type="submit" class="btn btn-primary" value="送信">
      </div>
      <p><a href="mypage.php">戻る</a></p>
    </form>
  </div>

  <?php echo default_footer(); ?>
</body>
</html>
