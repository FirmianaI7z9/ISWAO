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
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@100..900&family=Roboto+Condensed:wght@500&display=swap" rel="stylesheet">
  <title>ホーム | 学術オリンピック非公式まとめサイト</title>
  <link rel="stylesheet" href="/css/common.css">
  <link rel="stylesheet" href="/css/colors.css">
  <link rel="stylesheet" href="/css/past.css">
</head>

<body>
  <?php echo default_header(); ?>
  <h2 class="h2">Developer Page</h2>

  <div class="basic-container">
    <h3 class="basic-h3">Add Contents</h3>
    <p class="basic-text">
      <a href="schedule_a.php">Schedule</a>,
      <a href="info_a.php">Information</a>,
      <a href="application_a.php">Application</a>,
      <a href="contest_a.php">Contest</a>,
      <a href="problemset_a.php">ProblemSet</a>,
      <a href="problem_a.php">Problem</a>,
      <a href="editorials_a.php">Editorials</a>
    </p>
  </div>

  <div class="basic-container">
    <h3 class="basic-h3">Edit Contents</h3>
    <p class="basic-text">
      <a href="schedule_e.php">Schedule</a>,
      <a href="info_e.php">Information</a>,
      <a href="application_e.php">Application</a>,
      <a href="contest_e.php">Contest</a>,
      <a href="problemset_e.php">ProblemSet</a>,
      <a href="problem_e.php">Problem</a>,
      <a href="editorials_e.php">Editorials</a>
    </p>
  </div>

  <?php echo default_footer(); ?>
</body>

</html>