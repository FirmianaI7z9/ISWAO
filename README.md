# ISWAO

## About this repository

このリポジトリは、Firmianaが日本国内向けに提供する「学術オリンピック非公式まとめサイト」の作業場です。Issuesにて要望も受けています。READMEの書き方よく分からないのでこの辺でAboutは終わりです。

## Sitemap

TODO

## CSS class list

TODO (Wikiに作りそう)

## How to collect past contests' information or problems

他の大会でもやること一緒なので以下テンプレです。

(共通：データを見つけたら URL は全て保存する。PDF も全て保存。ウェブページ上のデータは……どうしよう。スクショツールで PDF 化でもしようか。10 MB 以上あるような重い PDF は圧縮かけたほうが良さそう。)
1. 大会の存在自体の公式ウェブサイトを探す
    1. (存在したら) 2. へ
    2. (存在しなければ) 13. へ
2. 大会の存在自体の公式ウェブサイトに①過去大会の情報一覧②過去問一覧③大会統計がないか探し、以下を順に行う
    1. (①があれば) 得たデータを持って 3. へ
    2. (①がなければ) 5. へ
    3. (②があれば) 6. へ
    4. (②がなければ) 8. へ
    5. (③があれば) 得たデータを持って 10. へ
    6. (③がなければ) 12. へ
3. 過去大会それぞれの公式ウェブサイトを探す
    1. (存在したら) データに加えて 4. へ
    2. (存在しなければ or 存在するがアクセスすべきでないと判断したら) そのことをデータに加えて 4. へ
4. 過去大会データを精製してデータベースへ挿入する (2.3. へ)
5. とりあえずどうにかして開催回次と年次や開催地を対応させデータを作り、さらに大会名と年次(例：「International Math Olympiad 2024」「IMO2024」「国際数学オリンピック2024」)などと検索し、公式ウェブサイトを探す
    1. (存在したら) データに加えて 4. へ
    2. (存在しなければ or 存在するがアクセスすべきでないと判断したら) そのことをデータに加えて 4. へ
6. 国際大会ならまず英語版を確保 (DL 可能ならする。ストレージ場所はローカル、もしかしたら Private Repository にして GitHub？)。日本語版も探す。予選、本選の区分や、理論、実験の種別違いに気を付け、問題セットに分ける。問題名が無い場合は適切に振り、データ化する。分野は考える。分からなかったら調べて、それでも分からなければ詳しそうな人に聞く。7. へ
7. 問題データを精製してデータベースへ挿入する。また、大会データの問題セット部分を更新する (2.5. へ)
8. 過去大会データの年次別公式ウェブサイトに過去問が無いか探す
    1. (存在したら) 6. へ
    2. (存在しなければ) 9. へ
9. WebArchive 等で問題の PDF が得られないか探す。無ければ「そういう」ウェブサイトにないか確認する。それでもなければ諦め、データをまとめて 7. へ
10. 参加人数や参加国分布、男女比、各問題 (大問) ごとの平均得点 (これ重要)、メダル獲得ボーダーのデータを資料から集める。この時点でなければ基本見つからないが、時間があれば 12. へ。適当に集まるか諦めたらデータをまとめて 11. へ
11. 大会統計データを精製してデータベースへ挿入する。必要に応じて問題データも更新する (14. へ)
12. WebArchive 等を駆使してデータを集める。データが見つかるか、諦めたら 10. に戻る
13. 首を傾げつつ、3. へ
14. ISWAO のウェブページを見て、何かおかしなことが起きていないかを見る。起きていたら該当部分修正、起きていなければ終了！
