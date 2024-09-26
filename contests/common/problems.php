<?php
  require_once "../../php/default.php";
  require_once "../../php/db_connect.php";
  require_once "../../php/functions.php";
  session_start();
  
  // 大会名指定、大会名と年次指定クエリの両方が考えられるので、適当に対応する

  $id = str_replace("*", "%", $_GET['id']);

  function check($value) {
    return preg_match('/\A[0-9\-\%]*\z/u', $value) === 1;
  }

  if (!check($id)) $id = '%-%-%-%-%';

  $ids = explode("-", $id);

  // AA-BB-CCCC-C'-DD
  // AA : 分野
  // BB : 大会種別
  // CCCC : 年次
  // C' : 同一年次内の大会区別用
  // DD : 問題セット

  $sql = "SELECT * FROM `problems` RIGHT JOIN 
          (SELECT 
            `contests`.`contest_name` AS `contest_name`,
            `contests`.`number` AS `number`,
            `contests`.`contest_class` AS `class`,
            `problemsets`.`set_id` AS `set_id`,
            `problemsets`.`set_name` AS `set_name`
          FROM `contests` 
          INNER JOIN `problemsets` 
          ON `problemsets`.`set_id` LIKE CONCAT(`contests`.`contest_id`, '-%')
          WHERE `contests`.`contest_id` LIKE :abc AND SUBSTRING(`problemsets`.`set_id`, 14, 2) LIKE :d
          ORDER BY `problemsets`.`set_id` DESC)`setdata` 
          ON `problems`.`problem_id` LIKE CONCAT(`setdata`.`set_id`, '-%')
          WHERE `problem_id` IS NOT NULL
          ORDER BY `setdata`.`set_id` DESC, `problems`.`problem_id` ASC;";
  $pre = $pdo->prepare($sql);
  $pre->bindValue(":abc", $ids[0]."-".$ids[1]."-".$ids[2]."-".$ids[3], PDO::PARAM_STR);
  $pre->bindValue(":d", $ids[4], PDO::PARAM_STR);
  $pre->execute();
  $problems = $pre->fetchAll();

  $sql = "SELECT DISTINCT `set_name` FROM `problemsets` WHERE `problemsets`.`set_id` LIKE CONCAT(:abc, '-%');";
  $pre = $pdo->prepare($sql);
  $pre->bindValue(":abc", $ids[0]."-".$ids[1]."-".$ids[2]."-".$ids[3], PDO::PARAM_STR);
  $pre->execute();
  $sets = $pre->fetchAll();

  console_log($problems);
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
  <link rel="stylesheet" href="/css/problems.css">
</head>

<body>
  <?php echo default_header(); ?>
  <h2 class="h2">Problems</h2>
  <div class="basic-container">
    <p class="contest-title">問題一覧</p>
    <hr>
    <div class="basic-container-inner">
      <div class="buttons-container">
        <?php 
          for ($i = 0; $i < count($sets); $i++) {
            echo '<button type="submit" onclick="location.href=\'problems.php?id='.$ids[0]."-".$ids[1].'-*-*-'.sprintf("%02d", $i + 1).'&m=0\'">'.$sets[$i]['set_name'].'</button>';
          }
        ?>
        <button type="submit" onclick="">リスト</button>
      </div>
      <hr>
      <h4><?php echo(count($sets) != 0 ? $sets[intval($ids[4], 10) - 1]['set_name'] : ""); ?></h4>
      <div class="table-wrapper">
        <table class="problems-table">
          <tbody>
            <?php 
              if (count($problems) == 0 || $problems[0]['created_at'] == null) {
                echo '<tr><td>データがありません</td></tr>';
              }
              else {
                if ($_GET['m'] == '0') {
                  $cname = '';
                  $max_count = 0;
                  $cur_count = 0;
                  for ($i = 0; $i < count($problems); $i++) {
                    $cur_count++;
                    if ($cname != $problems[$i]['contest_name'] || $i + 1 == count($problems)) {
                      $max_count = max($max_count, $cur_count);
                      $cname = $problems[$i]['contest_name'];
                      $cur_count = 0;
                    }
                  }
                  $cname = '';
                  $cur_count = 0;
                  $str = '';
                  function contest_color($val) {
                    switch ($val) {
                      case 1:
                        return 'blue';
                      case 2:
                        return 'green';
                      case 3:
                        return 'red';
                      case 4:
                        return 'orange';
                    }
                  }
                  for ($i = 0; $i < count($problems); $i++) {
                    if ($cname != $problems[$i]['contest_name']) {
                      $cname = $problems[$i]['contest_name'];
                      $str = '<tr><th><span class="circle-'.contest_color($problems[$i]['class']).'"></span>'.$cname.' (#'.$problems[$i]['number'].')</th>';
                      $cur_count = 0;
                    }

                    $genre = implode(',', json_decode($problems[$i]['genre']));
                    $diff = $problems[$i]['difficulty'];
                    if ($diff >= 2700) {
                      $color = get_difficulty_color_1($diff);
                      $gradient = get_difficulty_color_2($diff);
                      $str .= '<td><span class="difficulty-text-small" style="color: '.$color.';">'.strval($diff).'</span><span class="problem-genre-text">'.$genre.'</span><a class="problem-name-normal" style="color: '.$color.';" href="problem.php?id='.$problems[$i]['problem_id'].'"><span class="difficulty-icon-normal" style="'.$gradient.'"></span> '.$problems[$i]['problem_name'].'</a></td>';
                    }
                    else if ($diff >= 1) {
                      $rate = ($diff % 300) / 3;
                      $color = get_difficulty_color_1($diff);
                      $str .= '<td><span class="difficulty-text-small" style="color: '.$color.';">'.strval($diff).'</span><span class="problem-genre-text">'.$genre.'</span><a class="problem-name-normal" style="color: '.$color.';" href="problem.php?id='.$problems[$i]['problem_id'].'"><span class="difficulty-icon-normal" style="border-color: '.$color.'; background: linear-gradient(to top left, '.$color.' '.strval($rate).'%, #ffffff '.strval($rate).'%);"></span> '.$problems[$i]['problem_name'].'</a></td>';
                    }
                    else {
                      $str .= '<td><span class="problem-genre-text">'.$genre.'</span><a class="problem-name-normal" style="color: #000000;" href="problem.php?id='.$problems[$i]['problem_id'].'">'.$problems[$i]['problem_name'].'</a></td>';
                    }
                    $cur_count++;
                    
                    if (($i < count($problems) - 1 && $problems[$i]['contest_name'] != $problems[$i + 1]['contest_name']) || $i == count($problems) - 1) {
                      for ($j = 0; $j < $max_count - $cur_count; $j++) {
                        $str .= '<td></td>';
                      }
                      $str .= '</tr>';
                      echo $str;
                    }
                  }
                }
                else {

                }
              }
            ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
  <?php echo default_footer(); ?>
</body>

</html>