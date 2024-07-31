<?php
function default_head() {

}

function default_header() {
  return '
    <div id="header">
      <div class="hp">
        <h1>学術オリンピック<span>非公式</span>まとめサイト</h1>
        <nav>
          <ul>
            <li><a href="/index.php">ホーム</a></li>
            <li><a href="/info.php">お知らせ</a></li>
            <li><a href="/schedule.php">スケジュール</a></li>
            <li><a href="/contest.php">コンテスト一覧</a></li>
            <li><a href="/calendar.php">カレンダー</a></li>
            <li><a href="/contact.php">問い合わせ</a></li>
            <li><a href="/about.php">ABOUT</a></li>
            <li><a href="/mypage.php">マイページ</a></li>
          </ul>
        </nav>
      </div>
      <div class="hs">
        <h1>学術オリンピック<br><span>非公式</span>まとめサイト</h1>
        <input type="checkbox" id="hd">
        <label for="hd" class="l"><span></span></label>
        <div class="hc">
          <ul>
            <li><a href="/index.php">ホーム</a></li>
            <li><a href="/info.php">お知らせ</a></li>
            <li><a href="/schedule.php">スケジュール</a></li>
            <li><a href="/contest.php">コンテスト一覧</a></li>
            <li><a href="/calendar.php">カレンダー</a></li>
            <li><a href="/contact.php">問い合わせ</a></li>
            <li><a href="/about.php">ABOUT</a></li>
            <li><a href="/mypage.php">マイページ</a></li>
          </ul>
        </div>
      </div>
    </div>
  ';
}

function default_footer() {
  return '
    <div class="ft">
      <p class="t">学術オリンピック非公式まとめサイト</p>
      <div class="c">
        <div class="i">
          <h3>Contents</h3>
          <a class="a" href="/index.php">ホーム</a>
          <a class="a" href="/info.php">最新情報・お知らせ</a>
          <a class="a" href="/schedule.php">スケジュール</a>
          <a class="a" href="/contest.php">コンテスト一覧</a>
          <a class="a" href="/calendar.php">月別カレンダー</a>
          <a class="a" href="/something.php">雑多置き場</a>
          <a class="a" href="/something/d_booking.php">予定被り情報まとめ</a>
          <a class="a" href="/something/terms.php">競技科学用語集</a>
          <a class="a" href="/contact.php">問い合わせ</a>
          <a class="a" href="/about.php">当サイトについて</a>
        </div>
        <div class="i">
          <h3>Contests</h3>
          <a class="a" href="/contests/mathematics/index.php">数学オリンピック</a>
          <a class="a" href="/contests/physics/index.php">物理オリンピック</a>
          <a class="a" href="/contests/chemistry/index.php">化学オリンピック</a>
          <a class="a" href="/contests/biology/index.php">生物学オリンピック</a>
          <a class="a" href="/contests/earthscience/index.php">地学オリンピック</a>
          <a class="a" href="/contests/informatics/index.php">情報オリンピック</a>
          <a class="a" href="/contests/kako/index.php">科学の甲子園</a>
          <a class="a" href="/contests/linguistics/index.php">言語学オリンピック</a>
          <a class="a" href="/contests/astronomy/index.php">天文学オリンピック</a>
          <a class="a" href="/contests/geography/index.php">地理オリンピック</a>
          <a class="a" href="/contests/philosophy/index.php">哲学オリンピック</a>
          <a class="a" href="/contests/economics/index.php">経済オリンピック</a>
          <a class="a" href="/contests/brainscience/index.php">脳科学オリンピック</a>
          <a class="a" href="/contests/ai/index.php">人工知能オリンピック</a>
          <a class="a" href="/contests/socialscience/index.php">社会科学オリンピック</a>
        </div>
        <div class="i">
          <h3>Contact Developer & SNS</h3>
          <a class="a" href="contact.php">サイトの不具合報告</a>
          <a class="a" href="contact.php">サイトへの要望</a>
          <p class="p">Email<br>(preparing)</p>
          <a class="a" href="https://twitter.com/acaoly_notifi" target="_blank" rel="noopener noreferrer">X(Twitter) @acaoly_notifi</a>
          <img class="m" src="img/comp_site_thumbnail_2.png"/>
        </div>
      </div>
      <p class="cr">© 2023-2024 ISWAO,Firmiana</p>
    </div>
  ';
}

function genre2text($genre) {
  switch ($genre) {
    case 'ma':
      return 'mathematics';
    case 'ph':
      return 'physics';
    case 'ch':
      return 'chemistry';
    case 'bi':
      return 'biology';
    case 'ea':
      return 'earthscience';
    case 'in':
      return 'informatics';
    case 'ka':
      return 'kako';
    case 'li':
      return 'linguistics';
    case 'as':
      return 'astronomy';
    case 'ge':
      return 'geography';
    case 'pi':
      return 'philosophy';
    case 'ec':
      return 'economics';
    case 'br':
      return 'brainscience';
    case 'ai':
      return 'ai';
    case 'ss':
      return 'socialscience';
    case 'dev':
      return 'black';
  }
}

function genre2textcolor($genre) {
  $blacks = ['ma', 'ch', 'ea', 'li', 'ge', 'pi'];
  if (in_array($genre, $blacks)) {
    return 'black';
  }
  else {
    return 'white';
  }
}