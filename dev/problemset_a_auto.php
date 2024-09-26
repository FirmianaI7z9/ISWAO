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
    <h3 class="basic-h3">Add Problemset</h3>
    <p class="basic-text"><a href="javascript: senddata();">Send to server</a></p>
    <div class="develop-container">
      <p class="develop-item-text">Year(Begin)</p>
      <input type="text" class="dit" style="width: 200px;"/>
      <p class="develop-item-text">Year(End)</p>
      <input type="text" class="dit" style="width: 200px;"/>
      <p class="develop-item-text">Set(Begin)</p>
      <input type="text" class="dit" style="width: 200px;"/>
      <p class="develop-item-text">Set(End)</p>
      <input type="text" class="dit" style="width: 200px;"/>
      <p class="develop-item-text">Genre</p>
      <input type="text" class="dit" style="width: 200px;"/>
      <p class="develop-item-text">Contest</p>
      <input type="text" class="dit" style="width: 200px;"/>
      <p class="develop-item-text">SetName(split with ,)</p>
      <input type="text" class="dit" style="width: 200px;"/>
    </div>
  </div>

  <?php echo default_footer(); ?>

  <script>
    function senddata() {
      console.log('sending...');
      var val = { "table" : "problemsets", "arg" : [] };
      var dit = document.getElementsByClassName('dit');
      var names = dit[6].value.split(',');
      for (let i = Number(dit[0].value); i <= Number(dit[1].value); i++) {
        for (let j = Number(dit[2].value); j <= Number(dit[3].value); j++) {
          var item = {
            "set_id": dit[4].value + '-' + dit[5].value + '-' + ('0000' + i).slice(-4) + '-1-' + ('00' + j).slice(-2),
            "set_name": names[j - Number(dit[2].value)]
          };
          val["arg"].push(item);
        }
      }
      var json = JSON.stringify(val);
      console.log(json);
      callphp(json);
    }

    async function callphp(json) {
      let req = await fetch(`php/post.php`, {
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