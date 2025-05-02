<?php
  require_once "../../../php/default.php";
  require_once "../../../php/db_connect.php";
  require_once "../../../php/functions.php";
  session_start();
?>

<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1">
  <meta name="description" content="このページでは、PILAME杯の概要をまとめています。">
  <meta property="og:url" content="https://acaoly-inofficial.com/contests/mathematics/pilame/abstract.php">
  <meta property="og:type" content="website">
  <meta property="og:site_name" content="学術オリンピック非公式まとめサイト">
  <meta property="og:image" content="https://acaoly-inofficial.com/img/comp_site_thumbnail.png">
  <meta property="og:title" content="PILAME杯の概要">
  <meta name="twitter:card" content="summary">
  <meta name="twitter:site" content="@acaoly_notifi">
  <link rel="shortcut icon" type="image/x-icon" href="/img/favicon.ico">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@100..900&family=Roboto+Condensed:wght@500&display=swap" rel="stylesheet">
  <title>PILAME杯の概要 | 学術オリンピック非公式まとめサイト</title>
  <link rel="stylesheet" href="/css/common.css">
  <link rel="stylesheet" href="/css/colors.css">
  <link rel="stylesheet" href="/css/editorial.css">
  <link rel="stylesheet" href="/css/schedule.css">
  <link rel="stylesheet" href="/css/past.css">
  <link rel="stylesheet" href="/css/root_index.css">
  <link rel="stylesheet" href="/css/contest.css">
</head>

<body>
  <?php echo default_header(); ?>

  <div class="genre-header-container gradient-mathematics">
    <p>数学</p>
  </div>

  <div class="basic-container">
    <p class="contest-title"><span class="circle-blue"></span>PILAME杯</p>
    <hr>
    <p class="contest-subtitle">PILAME Cup <span class="tag background-mathematics color-black">PILAME</span></p>
  </div>

  <div class="basic-container">
    <div class="basic-container-inner">
      <a href="../index.php">数学トップ</a>
      <span>&gt;</span>
      <a href="../pilame.php">PILAMEトップ</a>
    </div>
  </div>

  <h2 class="h2">大会概要</h2>

  <div class="basic-container">
    <div class="basic-container-inner">
      <h3 class="border-mathematics">概要</h3>
      <p><b>PILAME杯</b>とは、2024年から競技数学界隈の有志により開催されている、同じ高校のメンバーでチームを組み競う、競技数学の団体戦です。</p>
    </div>
  </div>

  <div class="basic-container">
    <div class="basic-container-inner">
      <h3 class="border-mathematics">公式</h3>
      <p>公式ウェブサイト：</p>
      <div class="link-box">
        <a href="https://pilame.jp/" target="_blank" rel="noopener noreferrer"></a>
        <p>PILAME杯</p>
      </div>
    </div>
  </div>

  <div class="basic-container">
    <div class="basic-container-inner">
      <h3 class="border-mathematics">大会</h3>
      <p>注意：この項目の情報は2024年大会以前の情報を参考にしています。</p>
      
      <h4>予選</h4>
      
      <h5>問題形式</h5>
      <p>結果のみを解答する問題25問+途中の過程も解答する問題4問</p>
      
      <h5>試験時間</h5>
      <p>3時間</p>
      
      <h5>配点等</h5>
      <p>傾斜配点</p>
      
      <h5>参加資格</h5>
      <ul>
        <li>高校生であること (N/S高などの通信制高校も参加可能)</li>
        <li>同じ高校のメンバー4人以下 (4人推奨) でチームを組めること</li>
      </ul>

      <h5>参加費</h5>
      <p>なし</p>
      
      <h5>開催時期</h5>
      <p>成人の日（1月第2月曜日）</p>

      <h5>申込時期</h5>
      <p>9月1日～10月下旬<sup>[注2]</sup></p>

      <h5>開催地</h5>
      <p>全国の会場（年毎に若干変わるので注意）<sup>[注3]</sup></p>

      <h5>注釈・その他特記事項</h5>
      <ul>
        <li>注1a：<b>学校一括申し込み</b>という制度を利用すれば、人数によって割引がある（最大1,500円）。ただし学校側が把握していない可能性もあるので確認した方が良いでしょう。</li>
        <li>注1b：会場までの交通費・宿泊費は自己負担。</li>
        <li>注2：学校一括申し込みの場合は9月30日が締切。また、EGMO日本代表一次選抜に参加する場合も、9月30日までに申し込まなければならない。</li>
        <li>注3：申し込み時に設定する。また、応募締め切り後の変更は原則できない。</li>
        <li>概ね、問題番号が増えるにつれて難易度は上がる。</li>
        <li>例年の予選通過ボーダー（予選Aランク得点）は5～8点とぶれる。8点取れば安心かも。</li>
      </ul>

      <h4>本選</h4>

      <h5>問題形式</h5>
      <p>結果のみを解答する問題13問+途中の過程も解答する問題10問</p>
      
      <h5>試験時間</h5>
      <p>2日に渡って合計4時間</p>
      
      <h5>配点等</h5>
      <p>傾斜配点</p>
      
      <h5>参加資格</h5>
      <ul>
        <li>予選にてAランク者と認められていること<sup>[注4]</sup></li>
      </ul>

      <h5>参加費</h5>
      <p>0円<sup>[注5]</sup></p>
      
      <h5>開催時期</h5>
      <p>2月11日<sup>[注6]</sup></p>

      <h5>申込時期</h5>
      <p>---</p>

      <h5>開催地</h5>
      <p>全国の会場（年毎に若干変わるので注意）<sup>[注7]</sup></p>

      <h5>注釈・その他特記事項</h5>
      <ul>
        <li>注4：前年度の成績優秀者（詳細不明）は、予選にてAランク得点に達していなくても本選に出場できる。</li>
        <li>注5：会場までの交通費・宿泊費は自己負担。</li>
        <li>注6：表彰式は後述の代表選考合宿中に行われる。すなわち「受賞者」＝「代表選考合宿進出者」。</li>
        <li>注7：予選結果発表後に通知されると思われる。</li>
        <li>予選同様、問題番号が増えるにつれ難易度が上がる。</li>
      </ul>
    </div>
  </div>
<!--
  <div class="basic-container">
    <div class="basic-container-inner">
      <h3 class="border-mathematics">参加の流れ</h3>
      
      <h4>申し込み（個人）</h4>
      <ol>
        <li>募集要項を確認し、所定のウェブサイトから情報を登録し、申し込む<sup>[注1]</sup>。</li>
        <li>メールで届く「申し込み番号」を確認し、<b>1. から1週間以内に</b>指定された口座に受験料を振り込む。詳しい方法は募集要項に記載されている。</li>
        <li>受験票は12月頃郵送で届く。受験番号及び受験会場が書かれているので確認する。また、会場で提示する必要があるため持参するのを忘れないこと。<sup>[注2]</sup></li>
      </ol>

      <h4>申し込み（学校一括）</h4>
      <p>所属学校の担当者が申し込む。具体的な募集方法は学校によるためここには記載しない。</p>
      <p>担当者がすべき手順、および割引額等は募集要項を参照。なお、5人未満の場合は一括で申し込むことができない。個人で申し込む必要がある。</p>
      
      <div class="triangle-bottom background-mathematics"></div>
      
      <h4>予選</h4>
      <ol>
        <li><b>受験票、筆記用具を忘れない</b><sup>[注2]</sup>。会場によっては上履き（体育館シューズ等）が必要な場合がある（受験票に記載されている）。また、多数が同室で受験するため、体感温度を調整できるようにした方が良い。</li>
        <li>予選は概ね午後1時から始まる。一定時間の遅刻であれば受験できるが、試験時間の延長はない。</li>
        <li>計算用紙は配布される。足りない場合の追加はない<sup>[注3]</sup>。</li>
        <li>2月上旬までにウェブ上で結果発表が行われる。</li>
      </ol>

      <div class="triangle-bottom background-mathematics"></div>

      <h4>本選</h4>
      <button type="submit" class="button-white">情報提供をする</button>

      <hr>

      <h4>注釈・その他特記事項</h4>
      <ul>
        <li>注1a：<a>https://www.imojp.org/archive/moxxxx/jmo/jmo_apply.html</a> にある。xxxxの部分には開催年度を入れる。</li>
        <li>注1b：<a href="https://contest-kyotsu.com/entry/#jmo" target="_blank" rel="noopener noreferrer">https://contest-kyotsu.com/entry/#jmo</a></li>
        <li>注1c：2024年から申し込み方法が変更され、オンライン主体となった。メールアドレスが必要。</li>
        <li>注2：受験票忘れの救済はある。指示に従い、数学オリンピック財団に受験票を速やかに郵送しなければならない。</li>
        <li>注3：問題冊子や計算用紙が入っていた封筒を分解して計算用紙にしてもいいらしい。</li>
      </ul>
    </div>
  </div>

  <div class="basic-container">
    <div class="basic-container-inner">
      <h3 class="border-mathematics">出題範囲等</h3>
      <p><a href="https://www.imojp.org/domestic/jmo_overview.html" target="_blank" rel="noopener noreferrer">出典1</a>の中ほどにある。</p>
      <p>基本的に数学Iや数学Aの内容そのものや、その拡張が多い。ただし、数学IIIの複素数平面や数学Cのベクトルも役立つことはある（が、計算量が爆発しやすい）。</p>
      <p>また、上記リンクにあるように、グラフ理論やゲーム理論の考え方を利用する問題も出題される。</p>
    </div>
  </div>

  <div class="basic-container">
    <div class="basic-container-inner">
      <h3 class="border-mathematics">受賞</h3>
      <p>予選と本選でそれぞれ賞（予選はどちらかと言うと称号的なものだが……）を得られる。原則高成績なものから順に書いている。</p>

      <h4>予選</h4>

      <h5>予選Aランク賞</h5>
      <div class="table-wrapper">
        <table>
          <tbody>
            <tr>
              <th>獲得条件</th>
              <td>予選にてAランク得点以上の得点を得る</td>
            </tr>
            <tr>
              <th>人数</th>
              <td>200人前後。</td>
            </tr>
            <tr>
              <th>物理的な賞品</th>
              <td>なし</td>
            </tr>
            <tr>
              <th>その他の特典</th>
              <td>
                <ul>
                  <li>本選進出資格</li>
                  <li>公式ウェブサイトへの氏名掲載</li>
                </ul>
              </td>
            </tr>
          </tbody>
        </table>
      </div>

      <h5>地区優秀賞</h5>
      <div class="table-wrapper">
        <table>
          <tbody>
            <tr>
              <th>獲得条件</th>
              <td>予選にてBランク得点以上の得点を得る<sup>[注1]</sup>、かつ自分が属する地区分けに属する参加者のうち、上位約1割である<sup>[注2]</sup></td>
            </tr>
            <tr>
              <th>人数</th>
              <td>400～600人程度。かなり変動する。</td>
            </tr>
            <tr>
              <th>物理的な賞品</th>
              <td>
                <ul>
                  <li>表彰状</li>
                </ul>
              </td>
            </tr>
            <tr>
              <th>その他の特典</th>
              <td>なし</td>
            </tr>
            <tr>
              <th>注釈</th>
              <td>
                <ul>
                  <li>注1：全体の上位50%と大体同じ。</li>
                  <li>注2a：地区分けは公式が決めているもの。年ごとに少し変わることがある。大体の雰囲気は<a href="https://www.imojp.org/domestic/jmo_prize.html" target="_blank" rel="noopener noreferrer">ここ</a>で分かる。</li>
                  <li>注2b：基本的に「Aランク得点-1点」だと思って良い。</li>
                </ul>
              </td>
            </tr>
          </tbody>
        </table>
      </div>

      <h4>本選</h4>

      <h5>川井杯 <span class="tag background-absolute color-white">ABSOLUTE WINNER</span></h5>
      <div class="table-wrapper">
        <table>
          <tbody>
            <tr>
              <th>獲得条件</th>
              <td>本選で1位になる</td>
            </tr>
            <tr>
              <th>人数</th>
              <td>1人<sup>[注3]</sup></td>
            </tr>
            <tr>
              <th>物理的な賞品</th>
              <td>
                <ul>
                  <li>川井杯（トロフィー）</li>
                </ul>
              </td>
            </tr>
            <tr>
              <th>その他の特典</th>
              <td>(金賞の項を参照のこと。)</td>
            </tr>
            <tr>
              <th>注釈</th>
              <td>
                <ul>
                  <li>注3：同点の場合でも、答案の出来栄えから1人に絞られる  。</li>
                </ul>
              </td>
            </tr>
          </tbody>
        </table>
      </div>

      <h5>金賞 <span class="tag background-gold color-black">GOLD</span></h5>
      <div class="table-wrapper">
        <table>
          <tbody>
            <tr>
              <th>獲得条件</th>
              <td>本選で非常に優秀な成績を収める<sup>[注4]</sup></td>
            </tr>
            <tr>
              <th>人数</th>
              <td>1～2人程度<sup>[注5]</sup></td>
            </tr>
            <tr>
              <th>物理的な賞品</th>
              <td>
                <ul>
                  <li>金メダル</li>
                  <li>表彰状</li>
                  <li>本？</li>
                </ul>
              </td>
            </tr>
            <tr>
              <th>その他の特典</th>
              <td>
                <ul>
                  <li>代表選考合宿招待</li>
                  <li>公式ウェブサイトへの氏名掲載</li>
                </ul>
              </td>
            </tr>
            <tr>
              <th>注釈</th>
              <td>
                <ul>
                  <li>注4：川井杯受賞者ももらえる。</li>
                  <li>注5：年により割と変動する。後述の銀賞、銅賞も同様。</li>
                </ul>
              </td>
            </tr>
          </tbody>
        </table>
      </div>

      <h5>銀賞 <span class="tag background-silver color-black">SILVER</span></h5>
      <div class="table-wrapper">
        <table>
          <tbody>
            <tr>
              <th>獲得条件</th>
              <td>本選で金賞に次いで非常に優秀な成績を収める</td>
            </tr>
            <tr>
              <th>人数</th>
              <td>1～4人程度<sup>[注5]</sup></td>
            </tr>
            <tr>
              <th>物理的な賞品</th>
              <td>
                <ul>
                  <li>銀メダル</li>
                  <li>表彰状</li>
                  <li>本？</li>
                </ul>
              </td>
            </tr>
            <tr>
              <th>その他の特典</th>
              <td>
                <ul>
                  <li>代表選考合宿招待</li>
                  <li>公式ウェブサイトへの氏名掲載</li>
                </ul>
              </td>
            </tr>
          </tbody>
        </table>
      </div>

      <h5>銅賞 <span class="tag background-bronze color-black">BRONZE</span></h5>
      <div class="table-wrapper">
        <table>
          <tbody>
            <tr>
              <th>獲得条件</th>
              <td>本選で銀賞に次いで非常に優秀な成績を収める</td>
            </tr>
            <tr>
              <th>人数</th>
              <td>1～8人程度<sup>[注5]</sup></td>
            </tr>
            <tr>
              <th>物理的な賞品</th>
              <td>
                <ul>
                  <li>銅メダル</li>
                  <li>表彰状</li>
                  <li>本？</li>
                </ul>
              </td>
            </tr>
            <tr>
              <th>その他の特典</th>
              <td>
                <ul>
                  <li>代表選考合宿招待</li>
                  <li>公式ウェブサイトへの氏名掲載</li>
                </ul>
              </td>
            </tr>
          </tbody>
        </table>
      </div>

      <h5>優秀賞</h5>
      <div class="table-wrapper">
        <table>
          <tbody>
            <tr>
              <th>獲得条件</th>
              <td>本選で銅賞に次いで非常に優秀な成績を収める</td>
            </tr>
            <tr>
              <th>人数</th>
              <td>金賞、銀賞、銅賞と合わせて20人程度。</td>
            </tr>
            <tr>
              <th>物理的な賞品</th>
              <td>
                <ul>
                  <li>表彰状</li>
                  <li>本？</li>
                </ul>
              </td>
            </tr>
            <tr>
              <th>その他の特典</th>
              <td>
                <ul>
                  <li>代表選考合宿招待</li>
                  <li>公式ウェブサイトへの氏名掲載</li>
                </ul>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>

  <div class="basic-container">
    <div class="basic-container-inner">
      <h3 class="border-mathematics">豆知識</h3>
      <ul>
        
      </ul>
    </div>
  </div>

  <div class="basic-container">
    <div class="basic-container-inner">
      <h3 class="border-mathematics">出典・参考</h3>
      <ol>
        <li>公益財団法人 数学オリンピック財団「日本数学オリンピック（JMO）概要」, <a href="https://www.imojp.org/domestic/jmo_overview.html" target="_blank" rel="noopener noreferrer">https://www.imojp.org/domestic/jmo_overview.html</a></li>
      </ol>
    </div>
  </div>
-->
  <?php echo default_footer(); ?>
</body>

</html>