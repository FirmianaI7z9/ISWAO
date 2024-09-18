<?php
  require_once "../php/default.php";
  require_once "../php/db_connect.php";
  require_once "../php/functions.php";
  session_start();

  if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: ../mypage.php");
    exit;
  }

  $datas = [
    'name'  => '',
    'password' => ''
  ];
  $login_err = "";

  if($_SERVER['REQUEST_METHOD'] != 'POST'){
    setToken();
  }

  if($_SERVER["REQUEST_METHOD"] == "POST"){
    checkToken();

    foreach($datas as $key => $value) {
      if($value = filter_input(INPUT_POST, $key, FILTER_DEFAULT)) {
        $datas[$key] = $value;
      }
    }

    $errors = validation($datas,false);
    if(empty($errors)){
      $stmt = $pdo->prepare("SELECT id,username,password FROM users WHERE username = :name");
      $params = array(":name" => $datas['name']);
      $stmt->execute($params);

      if($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        if (password_verify($datas['password'],$row['password'])) {
          session_regenerate_id(true);
          $_SESSION["loggedin"] = true;
          $_SESSION["id"] = $row['id'];
          $_SESSION["name"] =  $row['username'];
          header("location: ../mypage.php");
          exit();
        } else {
          $login_err = 'ユーザ名かパスワードが正しくありません。1';
        }
      }else {
        $login_err = 'ユーザ名かパスワードが正しくありません。2';
      }
    }
  }
?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1">
  <title>Login</title>
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
    <h2 class="h2">Login</h2>
    <p>ユーザ名とパスワードを入力してください。</p>

    <?php 
    if(!empty($login_err)){
      echo '<div class="invalid-login">' . $login_err . '</div>';
    }
    ?>

    <form action="<?php echo $_SERVER ['SCRIPT_NAME']; ?>" method="post">
      <input type="text" name="name" class="form-input<?php echo (isset($errors['name']) && !empty(h($errors['name']))) ? ' form-input-error' : ''; ?>" value="<?php echo h($datas['name']); ?>" placeholder="ユーザー名" oninput="if(value.length>16)value = value.substring(0,16);value=value.replaceAll(/[^A-Za-z0-9_]/gu,'');"/>
      <p class="invalid-feedback"><?php if (isset($errors['name'])) echo h($errors['name']); ?></p>

      <input type="password" name="password" class="form-input<?php echo (isset($errors['password']) && !empty(h($errors['password']))) ? ' form-input-error' : ''; ?>" id="" value="<?php echo h($datas['password']); ?>" placeholder="パスワード" oninput="if(value.length>16)value = value.substring(0,16);value=value.replaceAll(/[^A-Za-z0-9]/gu,'');"/>
      <p class="invalid-feedback"><?php if (isset($errors['password'])) echo h($errors['password']); ?></p>

      <input type="hidden" name="token" value="<?php echo h($_SESSION['token']); ?>">
      <button type="submit" class="form-button">ログイン</button>
      <p>ユーザー登録は <a href="signup.php">ここ</a> から</p>
    </form>
  </div>

  <?php echo default_footer(); ?>
</body>
</html>
