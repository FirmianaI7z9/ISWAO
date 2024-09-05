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
  $blacks = ['ma', 'ka', 'ea', 'li', 'ge', 'pi'];
  if (in_array($genre, $blacks)) {
    return 'black';
  }
  else {
    return 'white';
  }
}

function kind2color($kind) {
  switch ($kind) {
    case 'yo':
      return 'gray';
    case 'ho':
      return 'darkgray';
    case 'ko':
      return 'black';
    default:
      return 'gray';
  }
}

function format_genre($item) {
  if ($item->kind == '') {
    return '<span class="tag background-'.genre2text($item->type).' color-'.genre2textcolor($item->type).'">'.$item->name.'</span>';
  }
  else {
    return '<span class="additional-tag-wrapper background-'.kind2color($item->kind).' color-white"><span class="additional-tag-innertag background-'.genre2text($item->type).' color-'.genre2textcolor($item->type).'">'.$item->name.'</span>'.$item->kind.'</span>';
  }
}

function format_schedule($item) {
  $genre = genre2text($item['genre']);
  $color = genre2textcolor($item['genre']);
  $tag = json_decode($item['tags']);
  $tags = implode('', array_map('format_genre', $tag));
  $now = new DateTime();
  $start_at = new DateTime($item['start_at']);
  $finish_at = new DateTime($item['finish_at']);
  $date = '';
  if ($now->format('Y') != $start_at->format('Y')) {
    switch ($item['display_type']) {
      case 0:
        $date = $start_at->format('Y年<b\r>m月');
        break;
      case 1:
        $date = $start_at->format('Y年<b\r>m/d');
        break;
      case 2:
        if ($start_at->format('m/d') == $finish_at->format('m/d')) {
          $date = $start_at->format('Y年<b\r>m/d');
        }
        else {
          $date = $start_at->format('Y年<b\r>m/d').'<br><span class="schedule-arrow-right"></span>'.$finish_at->format('m/d');
        }
        break;
      case 3:
      case 5:
        $date = $start_at->format('Y年<b\r>m/d<b\r>H:i-');
        break;
      case 4:
        $date = $finish_at->format('Y年<b\r>m/d<b\r>-H:i');
        break;
      default:
        break;
    }
  }
  else {
    switch ($item['display_type']) {
      case 0:
        $date = $start_at->format('m月');
        break;
      case 1:
        $date = $start_at->format('m/d');
        break;
      case 2:
        if ($start_at->format('m/d') == $finish_at->format('m/d')) {
          $date = $start_at->format('m/d');
        }
        else {
          $date = $start_at->format('m/d').'<br><span class="schedule-arrow"></span><br>'.$finish_at->format('m/d');
        }
        break;
      case 3:
        $date = $start_at->format('m/d<b\r>H:i-');
        break;
      case 4:
        $date = $finish_at->format('m/d<b\r>-H:i');
        break;
      case 5:
        $date = $start_at->format('m/d<b\r>H:i').'-<br>'.$finish_at->format('H:i');
        break;
      default:
        break;
    }
  }
  $str = '['.$start_at->format('Ym').']<div class="schedule-item border-'.$genre.'"'.(($item['event_type'] == 2 || ($item['display_type'] >= 3 && $now > $finish_at)) ? ' style="opacity: 0.5;"' : '').'>'.($item['is_link'] == 1 ? '<a href="'.($item['url'] == '' ? '' : $item['url']).'" target="_blank" rel="noopener noreferrer">' : '').'</a><div class="schedule-left-container background-'.$genre.' color-'.$color.'"><p class="schedule-left-text">'.$date.'</p></div><div class="schedule-right-container"><p class="schedule-right-tags">'.$tags.'</p><p class="schedule-right-text">'.$item['title'].'</p></div></div>';
  return $str;
}

function format_schedule_with_month($str, $is_encode) {
  if ($is_encode) {
    $patterns = array();
    for ($i = 0; $i < 12 * 10; $i++) {
      $patterns[$i] = '/\[('.strval(2020 + floor($i / 12)).')('.sprintf('%02d', $i % 12 + 1).')\]/';
    }
    return preg_replace('/\[[0-9]{6}\]/', '', preg_replace($patterns, '<p class="schedule-date"><span class="schedule-year">$1.</span>$2</p>', $str, 1));
  }
  else {
    return preg_replace('/\[[0-9]{6}\]/', '', $str);
  }
}

function format_info($item) {
  $tag = json_decode($item['tags']);
  $tags = implode('', array_map('format_genre', $tag));
  $str = '<div class="information-item"><p class="information-item-datetime">'.format_time($item['updated_at']).'</p><a class="information-item-title"'.($item['link'] == 1 ? ' href="'.$item['linktext'].'"' : '').($item['is_external_site'] == 1 ? ' target="_blank" rel="noopener noreferrer"' : '').'>'.$item['title'].'</a><p class="information-item-tags">'.$tags.'</p></div>';
  return $str;
}

function format_editorial($item) {
  $tags = implode('', array_map('format_genre', json_decode($item['tags'])));
  $str = '<div class="editorial-link"><a href="/contests/common/editorial.php?id='.strval($item['id']).'"></a><p class="editorial-link-title">'.($item['problem_name']).'</p><p class="editorial-link-data">'.$tags.' by <a class="username" style="color:#'.$item['color'].'">'.$item['username'].'</a> ('.get_editorial_status($item['status']).')</p></div>';
  return $str;
}

function get_editorial_status($status) {
  switch ($status) {
    case 0:
      return '投稿済み';
    case 1:
      return '一時保存中';
    case 2:
      return '非公開';
    case 3:
      return '審査中';
    default:
      return '?'; 
  }
}