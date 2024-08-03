<?php
  require_once "../php/default.php";
  require_once "../php/db_connect.php";
  require_once "../php/functions.php";
  session_start();

  $pre = $pdo->prepare("SELECT * FROM information ORDER BY updated_at ASC;");
  $pre->execute();
  $information = $pre->fetchAll();
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
    <h3 class="basic-h3">Edit Information</h3>
    <p class="basic-text"><a href="javascript: senddata();">Send to server</a></p>
    <div class="develop-container">
      <p class="develop-item-text">id</p>
      <input type="text" class="dii" style="width: 200px;" disabled/>
      <p class="develop-item-text">title</p>
      <input type="text" class="dit" style="width: calc(100% - 10px);"/>
      <p class="develop-item-text">tags</p>
      <input type="text" class="dit" style="width: calc(100% - 10px);"/>
      <p class="develop-item-text">link</p>
      <p class="develop-item-text">無効:0,有効:1</p>
      <input type="text" class="dit" style="width: 200px;"/>
      <p class="develop-item-text">linktext</p>
      <input type="text" class="dit" style="width: calc(100% - 10px);"/>
      <p class="develop-item-text">is_important</p>
      <p class="develop-item-text">無効:0,有効:1</p>
      <input type="text" class="dit" style="width: 200px;"/>
      <p class="develop-item-text">in_external_site</p>
      <p class="develop-item-text">無効:0,有効:1</p>
      <input type="text" class="dit" style="width: 200px;"/>
      <p class="develop-item-text">text</p>
      <textarea class="dit" style="resize: vertical; width: calc(100% - 10px); height: 100px;"></textarea>
      <p class="develop-item-text">updated_at</p>
      <input type="text" class="dit" style="width: 200px;"/>
      <hr>
      <p class="develop-item-text">created_at</p>
      <input type="text" class="dit" style="width: 200px;" disabled/>
    </div>
  </div>
  <div class="basic-container">
    <?php
      function format($item) {
        $json = json_encode($item);
        return '<p class="develop-edit-text"><a href="javascript: setdata('.strval($item['id']).');">Edit</a><br>title:'.$item['title'].', updated_at:'.((new DateTime($item['updated_at']))->format("Y-m-d H:i:s")).'</p><span id="ei_'.strval($item['id']).'" style="display:none;">'.$json.'</span>';
      }
      echo implode('<hr>', array_map('format', $information));
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
      var val = { "table" : "information", "id" : 0, "arg" : [] };
      var dit = document.getElementsByClassName('dit');
      var set = 9;
      var id = Number(document.getElementsByClassName('dii')[0].value);
      val['id'] = id;
      for (let i = 0; i < dit.length / set; i++) {
        if (dit[i * set + 0].value == '') continue;
        var item = {
          "title" : dit[i * set + 0].value,
          "tags" : dit[i * set + 1].value,
          "link" : Number(dit[i * set + 2].value),
          "linktext" : dit[i * set + 3].value,
          "is_important" : Number(dit[i * set + 4].value),
          "is_external_site" : Number(dit[i * set + 5].value),
          "text" : dit[i * set + 6].value,
          "updated_at" : dit[i * set + 7].value
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