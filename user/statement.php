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
  <meta name="description" content="">
  <meta property="og:url" content="https://acaoly-inofficial.com/statement.php">
  <meta property="og:type" content="website">
  <meta property="og:site_name" content="学術オリンピック非公式まとめサイト">
  <meta property="og:image" content="https://acaoly-inofficial.com/img/comp_site_thumbnail.png">
  <meta property="og:title" content="運営声明">
  <meta name="twitter:card" content="summary">
  <meta name="twitter:site" content="@acaoly_notifi">
  <link rel="shortcut icon" type="image/x-icon" href="/img/favicon.ico">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@100..900&family=Roboto+Condensed:wght@500&display=swap" rel="stylesheet">
  <title>運営声明 | 学術オリンピック非公式まとめサイト</title>
  <link rel="stylesheet" href="/css/common.css">
  <link rel="stylesheet" href="/css/colors.css">
  <link rel="stylesheet" href="/css/editorial.css">
  <link rel="stylesheet" href="/css/schedule.css">
  <link rel="stylesheet" href="/css/past.css">
</head>

<body>
  <?php echo default_header(); ?>

  <h2 class="h2">Statement</h2>

  <div class="basic-container">
    <div class="basic-container-inner">
      <h3>運営方針に関する声明</h3>

      <h4>第1条（用語）</h4>
      <ol>
        <li>この声明文を「本声明」といいます。</li>
        <li>個人情報保護法にいう「個人情報」を指すもので，生存する個人に関する情報であって，当該情報に含まれる氏名，生年月日，住所，電話番号，連絡先その他の記述等により特定の個人を識別できる情報及び容貌，指紋，声紋にかかるデータ，及び健康保険証の保険者番号などの当該情報単体から特定の個人を識別できる情報（個人識別情報）を「個人情報」といいます。</li>
        <li>本ウェブサイト上で提供されるサービスを「本サービス」といいます。</li>
        <li>本サービスの運営者であるFernwehを「運営者」といいます。</li>
        <li>本サービスの利用者を「利用者」といいます。</li>
        <li>本サービスのアカウント登録を行った利用者を「ユーザー」といいます。</li>
        <li>プライバシーポリシーの第2条1項と同様、ここに示した大会を総称して「コンテスト」といいます。また、これらの概念的な総称を「学術オリンピック」といいます。</li>
        <li>学術オリンピックの各分野の日本大会または国際大会の運営主体となる団体を「公式団体」といいます。</li>
        <li>コンテストに競技者として参加した人を「参加者」といいます。</li>
        <li>参加者の以下の情報を総称して「参加者情報」といいます。
          <ul>
            <li>参加者の氏名（和文表記・英文表記）</li>
            <li>参加者の国籍</li>
            <li>参加者の年齢・学年・生年</li>
            <li>参加者の所属</li>
            <li>参加者の性別</li>
            <li>その他参加者の個人情報</li>
          </ul>
        </li>
        <li>コンテストの以下の情報を総称して「統計情報」といいます。
          <ul>
            <li>コンテストの参加者の参加者情報</li>
            <li>コンテストの参加者が得た得点、受賞</li>
            <li>コンテストの参加者全体の得点分布</li>
            <li>コンテストで出題された問題の正解率、平均得点、得点分布</li>
            <li>コンテストの各賞の基準や該当人数</li>
          </ul>
        </li>
        <li>コンテストで出題された問題を総称して「過去問」といいます。</li>
      </ol>
      
      <h4>第2条（本サービスの目的）</h4>
      <p>本サービスは以下を主な目的として、運営者により運営されます。</p>
      <ul>
        <li>日本国内における、学術オリンピックの一般への周知・関心の醸成。</li>
        <li>日本国内における、学術オリンピックの一般への普及。</li>
        <li>日本国内における、学術オリンピックの益々の発展。</li>
      </ul>

      <h4>第3条（本サービスの立場）</h4>
      <ol>
        <li>本サービスは、すべて公式団体と実質的に直接関係をもたない「非公式」の立場で運営されます。</li>
        <li>前項は、運営者と公式団体との関係（情報提供等）の維持および新規構築を妨げるものではありません。</li>
      </ol>

      <h4>第4条（本サービスの内容）</h4>
      <ol>
        <li>本サービスは主に以下の内容で構成されています。
          <ul>
            <li>学術オリンピックについての案内。</li>
            <li>学術オリンピックの各分野についての案内。</li>
            <li>コンテストについての案内。</li>
            <li>コンテスト等の開催日程、開催時期および開催時刻に関する情報の提供。</li>
            <li>コンテスト等に関する公式団体からの情報の提供。</li>
            <li>コンテストの統計情報の提供。</li>
            <li>学術オリンピックでよく用いられる用語の解説。</li>
            <li>コンテストのライブ配信の情報の提供。</li>
            <li>過去のコンテストに関する情報の提供。</li>
            <li>過去問およびその公式団体による解説の提供。</li>
            <li>公式団体以外の団体による解説の提供。</li>
            <li>ユーザーによる解説作成の場の提供、およびその利用者への提供。</li>
          </ul>
        </li>
        <li>本サービスに付随するサービスとして以下があります。
          <ul>
            <li>Twitter (現X) 上での情報発信。</li>
          </ul>
        </li>
        <li>利用者は、第1項12号前半を除いた、第1項と第2項のすべてのサービスを利用することができます。</li>
        <li>ユーザーは、第1項と第2項に示したすべてのサービスを利用することができます。</li>
      </ol>

      <h4>第5条（参加者の個人情報保護）</h4>
      <ol>
        <li>本サービスでは個人情報保護の観点から、コンテストの結果をお知らせとして掲載する、またはSNSに投稿する場合には、大会情報のうち参加者情報を掲載することはできません。すなわち、お知らせの内容に選手の氏名や年齢、所属等の情報を含めることはできません。ただし、国際大会において、国籍はこの限りではありません。</li>
        <li>国別の受賞数等、参加者の個人情報と直接には結びつかない統計的な情報については、本サービスは本ウェブサイト上およびSNS上にこれを掲載することができます。</li>
      </ol>

      <h4>第6条（ユーザーによる解説の著作権）</h4>
      <ol>
        <li>ユーザーは、作成した過去問の解説に対する著作権を放棄する必要はありませんが、以下の内容のために、ユーザーは運営者と解説についての著作権を共同で管理するものとします。
          <ul>
            <li>運営者が、解説文中の些細な誤字および脱字を、ユーザーに確認することなく修正する。</li>
            <li>運営者が、解説文の書式をユーザーに確認することなく調整する。</li>
          </ul>
        </li>
        <li>前項において、運営者の独断で修正するかを判定できない事項があった場合は、該当部分の修正内容を提示し、ユーザーに確認してほしい旨を通知するか、ユーザー自身に修正を求める連絡を行います。</li>
        <li>運営者は、ユーザーが作成した解説を、本サービス以外の用途に使用することはできません。</li>
        <li>ユーザーは、自ら以外が書いた解説を提供および投稿することはできません。</li>
      </ol>

      <h4>第7条（掲載している情報の商業的利用）</h4>
      <ol>
        <li>利用者は、本ウェブサイト上に掲載されている情報を、情報提供元の公式団体による許可なしに商業的に利用することはできません。また、運営者に対し商業的利用の許可を求めることはできません。</li>
        <li>利用者は、ユーザーによる解説の一部または全部をそのユーザーに許可なく転載することはできません。</li>
      </ol>

      <h4>第8条（商業的運営の禁止）</h4>
      <p>本サービスを運営する上で、運営者は一切の利潤の獲得を目的としてはいけません。</p>

      <h4>第9条（本声明の改正）</h4>
      <ol>
        <li>本声明の一部または全部を改正するときは、運営者は本ウェブサイト上で、改正後の本声明の内容と、改正を行った旨をすぐに公表しなければいけません。</li>
        <li>第8条1項を改正することはできません。また、これの効力を何らかの形で変化させるような内容を改正により追加することはできません。</li>
      </ol>
      
      <h4>第10条（適用）</h4>
      <p>本声明に規定されている事項は、本声明が本ウェブサイト上で公開されたときから効力を持ちます。</p>
    </div>
  </div>

  <?php echo default_footer(); ?>
</body>

</html>