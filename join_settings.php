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
          'UPDATE users SET `year` = :y, `affiliation` = :a, `introduction` = :t WHERE `id` = :u;');
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
    <h2 class="h2">Joined Contests</h2>
    <p>設定を変更したのち、送信ボタンを押下してください。</p>

    <form action="<?php echo $_SERVER ['SCRIPT_NAME']; ?>" method="post">
      <div class="form-group">
        <h3 class="h3">数学</h3>
        <p>
          <label for="maq1">JMO</label><br>
          <input type="radio" name="maq1" value="x" checked /> 未参加 
          <input type="radio" name="maq1" value="yo" /> 予選 
          <input type="radio" name="maq1" value="ho" /> 本選 
          <input type="radio" name="maq1" value="ko" /> 代表候補
        </p>
        <p>
          <label for="maq2">JJMO</label><br>
          <input type="radio" name="maq2" value="x" checked /> 未参加 
          <input type="radio" name="maq2" value="yo" /> 予選 
          <input type="radio" name="maq2" value="ho" /> 本選 
          <input type="radio" name="maq2" value="ko" /> 代表候補
        </p>
        <p>
          <label for="maq3">EGMO予選</label><br>
          <input type="radio" name="maq3" value="x" checked /> 未参加 
          <input type="radio" name="maq3" value="y" /> 参加
        </p>
        <p>
          <label for="maq4">IMO</label><br>
          <input type="radio" name="maq4" value="x" checked /> 未参加 
          <input type="radio" name="maq4" value="y" /> 参加
        </p>
        <p>
          <label for="maq5">APMO</label><br>
          <input type="radio" name="maq5" value="x" checked /> 未参加 
          <input type="radio" name="maq5" value="y" /> 参加
        </p>
        <p>
          <label for="maq6">EGMO</label><br>
          <input type="radio" name="maq6" value="x" checked /> 未参加 
          <input type="radio" name="maq6" value="y" /> 参加
        </p>
        <p>
          <label for="maq7">浜松</label><br>
          <input type="radio" name="maq7" value="x" checked /> 未参加 
          <input type="radio" name="maq7" value="yo" /> 予選 
          <input type="radio" name="maq7" value="ho" /> 本選
        </p>
        <p>
          <label for="maq8">PILAME</label><br>
          <input type="radio" name="maq8" value="x" checked /> 未参加 
          <input type="radio" name="maq8" value="yo" /> 予選 
          <input type="radio" name="maq8" value="ho" /> 本選
        </p>
      </div>
      <div class="form-group">
        <h3 class="h3">物理</h3>
        <p>
          <label for="phq1">JPhO</label><br>
          <input type="radio" name="phq1" value="x" checked /> 未参加 
          <input type="radio" name="phq1" value="yo" /> 予選 
          <input type="radio" name="phq1" value="ho" /> 本選 
          <input type="radio" name="phq1" value="ko" /> 代表候補
        </p>
        <p>
          <label for="phq2">IPhO</label><br>
          <input type="radio" name="phq2" value="x" checked /> 未参加 
          <input type="radio" name="phq2" value="y" /> 参加
        </p>
        <p>
          <label for="phq3">APhO</label><br>
          <input type="radio" name="phq3" value="x" checked /> 未参加 
          <input type="radio" name="phq3" value="y" /> 参加
        </p>
        <p>
          <label for="phq4">EuPhO</label><br>
          <input type="radio" name="phq4" value="x" checked /> 未参加 
          <input type="radio" name="phq4" value="y" /> 参加
        </p>
        <p>
          <label for="phq5">OPhO</label><br>
          <input type="radio" name="phq5" value="x" checked /> 未参加 
          <input type="radio" name="phq5" value="y" /> 参加
        </p>
      </div>
      <div class="form-group">
        <h3 class="h3">化学</h3>
        <p>
          <label for="chq1">JChO</label><br>
          <input type="radio" name="chq1" value="x" checked /> 未参加 
          <input type="radio" name="chq1" value="yo" /> 予選 
          <input type="radio" name="chq1" value="ho" /> 本選 
          <input type="radio" name="chq1" value="ko" /> 代表候補
        </p>
        <p>
          <label for="chq2">IChO</label><br>
          <input type="radio" name="chq2" value="x" checked /> 未参加 
          <input type="radio" name="chq2" value="y" /> 参加
        </p>
      </div>
      <div class="form-group">
        <h3 class="h3">生物学</h3>
        <p>
          <label for="biq1">JBO</label><br>
          <input type="radio" name="biq1" value="x" checked /> 未参加 
          <input type="radio" name="biq1" value="yo" /> 予選 
          <input type="radio" name="biq1" value="ho" /> 本選 
          <input type="radio" name="biq1" value="ko" /> 代表候補
        </p>
        <p>
          <label for="biq2">IBO</label><br>
          <input type="radio" name="biq2" value="x" checked /> 未参加 
          <input type="radio" name="biq2" value="y" /> 参加
        </p>
      </div>
      <div class="form-group">
        <h3 class="h3">地学</h3>
        <p>
          <label for="eaq1">JESO</label><br>
          <input type="radio" name="eaq1" value="x" checked /> 未参加 
          <input type="radio" name="eaq1" value="yo" /> 予選 
          <input type="radio" name="eaq1" value="ho" /> 本選 
          <input type="radio" name="eaq1" value="ko" /> 代表候補
        </p>
        <p>
          <label for="chq2">IESO</label><br>
          <input type="radio" name="eaq2" value="x" checked /> 未参加 
          <input type="radio" name="eaq2" value="y" /> 参加
        </p>
        <p>
          <label for="chq3">ESF</label><br>
          <input type="radio" name="eaq3" value="x" checked /> 未参加 
          <input type="radio" name="eaq3" value="y" /> 参加
        </p>
      </div>
      <div class="form-group">
        <h3 class="h3">情報</h3>
        <p>
          <label for="inq1">JOI</label><br>
          <input type="radio" name="inq1" value="x" checked /> 未参加 
          <input type="radio" name="inq1" value="yo" /> 予選 
          <input type="radio" name="inq1" value="ho" /> 本選 
          <input type="radio" name="inq1" value="ko" /> 代表候補
        </p>
        <p>
          <label for="inq2">JOIG</label><br>
          <input type="radio" name="inq2" value="x" checked /> 未参加 
          <input type="radio" name="inq2" value="yo" /> 予選 
          <input type="radio" name="inq2" value="ho" /> 本選 
          <input type="radio" name="inq2" value="ko" /> 代表候補
        </p>
        <p>
          <label for="inq3">IOI</label><br>
          <input type="radio" name="inq3" value="x" checked /> 未参加 
          <input type="radio" name="inq3" value="y" /> 参加
        </p>
        <p>
          <label for="inq4">APIO</label><br>
          <input type="radio" name="inq4" value="x" checked /> 未参加 
          <input type="radio" name="inq4" value="y" /> 参加
        </p>
        <p>
          <label for="inq5">EGOI</label><br>
          <input type="radio" name="inq5" value="x" checked /> 未参加 
          <input type="radio" name="inq5" value="y" /> 参加
        </p>
        <p>
          <label for="inq6">ICPC</label><br>
          <input type="radio" name="inq6" value="x" checked /> 未参加 
          <input type="radio" name="inq6" value="DQ" /> 国内予選
          <input type="radio" name="inq6" value="PO" /> playoff
          <input type="radio" name="inq6" value="WF" /> WF
        </p>
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
