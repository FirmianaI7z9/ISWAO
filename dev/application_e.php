<?php
  require_once "../php/default.php";
  require_once "../php/db_connect.php";
  require_once "../php/functions.php";
  session_start();

  $pre = $pdo->prepare("SELECT * FROM applications ORDER BY start_at ASC;");
  $pre->execute();
  $applications = $pre->fetchAll();
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
    <h3 class="basic-h3">Edit Schedule</h3>
    <p class="basic-text"><a href="javascript: senddata();">Send to server</a></p>
    <div class="develop-container">
      <p class="develop-item-text">id</p>
      <input type="text" class="dii" style="width: 200px;" disabled/>
      <p class="develop-item-text">title</p>
      <input type="text" class="dit" style="width: calc(100% - 10px);"/>
      <p class="develop-item-text">genre</p>
      <input type="text" class="dit" style="width: 200px;"/>
      <p class="develop-item-text">tags</p>
      <input type="text" class="dit" style="width: calc(100% - 10px);"/>
      <p class="develop-item-text">event_type</p>
      <p class="develop-item-text">申込:0,他:1,暫定:2</p>
      <input type="text" class="dit" style="width: 200px;" disabled/>
      <p class="develop-item-text">display_type</p>
      <p class="develop-item-text">月:0,開日:1,日:2,開時:3,終時:4,全:5</p>
      <input type="text" class="dit" style="width: 200px;" disabled/>
      <p class="develop-item-text">start_at</p>
      <input type="text" class="dit" style="width: 200px;"/>
      <p class="develop-item-text">finish_at</p>
      <input type="text" class="dit" style="width: 200px;"/>
      <p class="develop-item-text">is_link</p>
      <input type="text" class="dit" style="width: 200px;"/>
      <p class="develop-item-text">url</p>
      <input type="text" class="dit" style="width: calc(100% - 10px);"/>
      <hr>
      <p class="develop-item-text">created_at</p>
      <input type="text" class="dit" style="width: 200px;" disabled/>
      <p class="develop-item-text">updated_at</p>
      <input type="text" class="dit" style="width: 200px;" disabled/>
    </div>
  </div>
  <div class="basic-container">
    <?php
      function format($item) {
        $json = json_encode($item);
        return '<p class="develop-edit-text"><a href="javascript: setdata('.strval($item['id']).');">Edit</a><br>title:'.$item['title'].', start_at:'.((new DateTime($item['start_at']))->format("Y-m-d H:i:s")).'</p><span id="ei_'.strval($item['id']).'" style="display:none;">'.$json.'</span>';
      }
      echo implode('<hr>', array_map('format', $applications));
    ?>
  </div>

  <?php echo default_footer(); ?>

  <script>
    function setdata(index) {
      var item = JSON.parse(document.getElementById('ei_' + index.toString()).innerText);
      document.getElementsByClassName('dii')[0].value = index;
      var dit = document.getElementsByClassName('dit');
      var key = Object.keys(item);
      key.shift();
      for (let i = 0; i < key.length; i++) {
        dit[i].value = item[key[i]];
      }
    }

    function senddata() {
      console.log('sending...');
      var val = { "table" : "applications", "id" : 0, "arg" : [] };
      var dit = document.getElementsByClassName('dit');
      var set = 11;
      var id = Number(document.getElementsByClassName('dii')[0].value);
      val['id'] = id;
      for (let i = 0; i < dit.length / set; i++) {
        if (dit[i * set + 0].value == '') continue;
        var item = {
          "title" : dit[i * set + 0].value,
          "genre" : dit[i * set + 1].value,
          "tags" : dit[i * set + 2].value,
          "event_type" : Number(dit[i * set + 3].value),
          "display_type" : Number(dit[i * set + 4].value),
          "start_at" : dit[i * set + 5].value,
          "finish_at" : dit[i * set + 6].value,
          "is_link" : Number(dit[i * set + 7].value),
          "url" : dit[i * set + 8].value
        };
        val["arg"].push(item);
      }
      var json = JSON.stringify(val);
      console.log(json);
      callphp(json);
    }

    async function callphp(json) {
      let req = await fetch(`php/update.php`, {
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