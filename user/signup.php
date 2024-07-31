<?php
  require_once "../php/default.php";
  require_once "../php/db_connect.php";
  require_once "../php/functions.php";

  session_start();

  $datas = [
    'name'  => '',
    'password'  => '',
    'confirm_password'  => ''
  ];

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

    $errors = validation($datas);

    if(empty($errors['name'])){
      $stmt = $pdo->prepare("SELECT id FROM users WHERE username = :name");
      $params = array(':name' => $datas['name']);
      $stmt->execute($params);
      if($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        $errors['name'] = 'このユーザ名は既に使用されています。';
      }
    }

    if(empty($errors)){
      $params = [
        'id' =>null,
        'username'=>$datas['name'],
        'password'=>password_hash($datas['password'], PASSWORD_DEFAULT),
        'created_at'=>null,
        'titles'=>'["一般ユーザー"]'
      ];

      $count = 0;
      $columns = '';
      $values = '';
      foreach (array_keys($params) as $key) {
        if($count > 0){
          $columns .= ',';
          $values .= ',';
        }
        $columns .= $key;
        $values .= ':'.$key;
        $count++;
      }

      $pdo->beginTransaction();
      try {
        $sql = 'INSERT INTO users ('.$columns .') VALUES('.$values.')';
        $stmt = $pdo->prepare($sql);
        $stmt->execute($params);
        $pdo->commit();
        header("location: login.php");
        exit;
      } catch (PDOException $e) {
        echo $e;
        echo 'エラー: 登録できませんでした。管理者に連絡してください。';
        $pdo->rollBack();
      }
    }
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1">
  <title>Sign Up</title>
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
    <h2 class="h2">Signup</h2>
    <form action="<?php echo $_SERVER ['SCRIPT_NAME']; ?>" method="post">
      <label for="name">ユーザー名(1～16文字、半角英数字と_のみ)</label>
      <input type="text" name="name" class="form-input<?php echo (isset($errors['name']) && !empty(h($errors['name']))) ? ' form-input-error' : ''; ?>" value="<?php echo h($datas['name']); ?>" placeholder="ユーザー名" oninput="if(value.length>16)value = value.substring(0,16);value=value.replaceAll(/[^A-Za-z0-9_]/gu,'');"/>
      <p class="invalid-feedback"><?php if (isset($errors['name'])) echo h($errors['name']); ?></p>

      <label for="password">パスワード(8～16文字、半角英数字のみ)</label>
      <input type="password" name="password" class="form-input<?php echo (isset($errors['password']) && !empty(h($errors['password']))) ? ' form-input-error' : ''; ?>" id="" value="<?php echo h($datas['password']); ?>" placeholder="パスワード" oninput="if(value.length>16)value = value.substring(0,16);value=value.replaceAll(/[^A-Za-z0-9]/gu,'');"/>
      <p class="invalid-feedback"><?php if (isset($errors['password'])) echo h($errors['password']); ?></p>

      <label for="name">パスワード確認</label>
      <input type="password" name="confirm_password" class="form-input<?php echo (isset($errors['confirm_password']) && !empty(h($errors['confirm_password']))) ? ' form-input-error' : ''; ?>" id="" value="<?php echo h($datas['confirm_password']); ?>" placeholder="パスワード確認" oninput="if(value.length>16)value = value.substring(0,16);value=value.replaceAll(/[^A-Za-z0-9]/gu,'');"/>
      <p class="invalid-feedback"><?php if (isset($errors['confirm_password'])) echo h($errors['confirm_password']); ?></p>

      <input type="hidden" name="token" value="<?php echo h($_SESSION['token']); ?>">
      <button type="submit" class="form-button">登録</button>
      <p>既にアカウントをお持ちの方は <a href="login.php">ログイン</a> から</p>
    </form>
  </div>

  <?php echo default_footer(); ?>
</body>
</html>