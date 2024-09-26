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
    <h3 class="basic-h3">Add Problems</h3>
    <p class="basic-text"><a href="javascript: senddata();">Send to server</a></p>
    <div class="develop-container">
      <p class="develop-item-text">Values</p>
      <textarea class="dit" name="1" id="2" style="height: 800px; width: 90%;"></textarea>
    </div>
  </div>

  <?php echo default_footer(); ?>

  <script>
    function senddata() {
      console.log('sending...');
      var val = { "table" : "problems", "arg" : [] };
      var dit = document.getElementsByClassName('dit');
      var values = dit[0].value.split('\n');
      for (let i = 0; i < values.length; i++) {
        var value = values[i].split(',');
        var item = {
          "problem_id": value[0],
          "problem_name": value[1],
          "genre": value[2],
          "correct_rate": Number(value[3]),
          "difficulty": Number(value[4])
        };
        val["arg"].push(item);
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