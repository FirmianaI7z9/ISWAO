<?php
  require_once "../php/default.php";
  require_once "../php/db_connect.php";
  require_once "../php/functions.php";
  session_start();
?>

<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1">
  <title>ホーム | 学術オリンピック非公式まとめサイト</title>
  <link rel="stylesheet" href="/css/common.css">
  <link rel="stylesheet" href="/css/past.css">
  <link rel="stylesheet" href="/css/develop.css">
</head>

<body>
  <?php echo default_header(); ?>
  <h2 class="h2">Developer Page</h2>
  <a href="index.php">Back to home</a>

  <div class="basic-container">
    <h3 class="basic-h3">Calculate Difficulty</h3>
    <p class="basic-text"><a href="javascript: start_calc();">Do calcuation</a></p>
    <div class="develop-container">
      <p class="develop-item-text">Genre</p>
      <input type="text" class="dit" style="width: 200px;"/>
      <p class="develop-item-text">Contest</p>
      <input type="text" class="dit" style="width: 200px;"/>
      <p class="develop-item-text">Year(Begin)</p>
      <input type="text" class="dit" style="width: 200px;"/>
      <p class="develop-item-text">Year(End)</p>
      <input type="text" class="dit" style="width: 200px;"/>
      <p class="develop-item-text">MaxDiff</p>
      <input type="text" class="dit" style="width: 200px;"/>
      <p class="develop-item-text">Power</p>
      <input type="text" class="dit" style="width: 200px;"/>
    </div>
  </div>

  <?php echo default_footer(); ?>

  <script>
    function start_calc() {
      console.log('sending...');
      var dit = document.getElementsByClassName('dit');
      var val = {
        "genre": dit[0].value,
        "contest": dit[1].value,
        "beginwith": Number(dit[2].value),
        "endwith": Number(dit[3].value),
        "max": Number(dit[4].value),
        "power": Number(dit[5].value)
      };
      var json = JSON.stringify(val);
      console.log(json);
      callphp(json);
    }

    async function callphp(json) {
      let req = await fetch(`php/diffcalc.php`, {
        method: "post",
        headers: {"Content-Type": "application/json"},
        body: json
      }).then(response => {
        console.log(response);
        return response.text();
      })
      .then(res => {
        console.log(res);
        //location.href = '';
      }).catch(error => {
        console.log(error);
      });
    }
  </script>
</body>

</html>