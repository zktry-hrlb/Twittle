<?php
// echo <<<ETO
// <!DOCTYPE html>
// <html lang="ja">
// <head>
// <meta charset="UTF-8">
// <title>Twittle!!</title>
// <link rel="stylesheet" type="text/css" href="./base.css" media="all">
// </head>
// <style type="text/css">
//  .keyword{
//    color: red;
//  }
// </style>
// <body>
// ETO;


//ini_set( 'display_errors', 1 ); 
header("charset=UTF-8");
// ライブラリ読み込み
require __DIR__ . '/TwistOAuth.phar';

function getSafePostFrom($val){
  return htmlspecialchars($val, ENT_QUOTES, 'UTF-8', false);
}




//set search word
if ($_POST['TwiWord0'] != "") {
 $twiWord0 = getSafePostFrom($_POST['TwiWord0']);
 //$twiWordsArr = array(0=>$twiWord0);
 //$twiWordsArr += array($twiWord0 => 0); 
 $twiwards = $twiWord0;
} else{
 echo "Error Input!!";
}
if ($_POST['TwiWord1'] != "") {
 $twiWord1 = getSafePostFrom($_POST['TwiWord1']);
 //$twiWordsArr += array(1=>$twiWord1);
 //$twiWordsArr += array($twiWord1=>1);
 $twiwards .=  " AND ".  $twiWord1;
}
 // if ($_POST['TwiWord2'] != "") {
 //     $twiWord2 = getSafePostFrom($_POST['TwiWord2']);
 //     $twiWordsArr += array($twiWord2=>0);
 //     $twiwards .=  " OR ".  $twiWord2;
 // }
 // if ($_POST['TwiWord3'] != "") {
 //     $twiWord3 = getSafePostFrom($_POST['TwiWord3']);
 //     $twiWordsArr += array($twiWord3=>0);
 //     $twiwards .=  " OR ".  $twiWord3;
 // }
 // if ($_POST['TwiWord4'] != "") {
 //   $twiWord4 = getSafePostFrom($_POST['TwiWord3']);
 //   $twiWordsArr += array($twiWord4=>0);
 //   $twiwards .=  " OR ".  $twiWord4;
 // }

//echo $twiwards;
//print_r($twiWordsArr );
//print_r($twiWordsQty);
//var_dump($twiwards);
//explode(" OR ",$twiwards);






// 認証情報４つ
$ck = 'editkey';
$cs = 'editSecretkey';
$at = '3231402426-Gu3B3ZgkkypQuG6DmQdLVIQzRK7dHQvntY17U7Z';
$as = 'GV0JPapPhGLPDZqNI78XYOgNAPeX0xQF7DOEXkcUh6nrA';

// TwitterAPIに接続するあらゆる正常時の処理はこのブロックの中で行う
try {
  // 接続
 $to = new TwistOAuth($ck, $cs, $at, $as);
      // キーワードによるツイート検索 
 $tweets_params = ['q' => $twiwards,
 'count' => '10',
 "result_type" => "recent",
 "lang" => "ja"
 ];

 if ($_POST['max_id'] != "") {
  $max_id = getSafePostFrom($_POST['max_id']);
  $tweets_params += ['max_id' => $max_id];
}
if ($_POST['since_id'] != "") {
  $since_id =  getSafePostFrom($_POST['since_id']) ;
  $tweets_params += ['since_id' => $since_id];
}

$tweets = $to->get('search/tweets', $tweets_params)->statuses;

  //var_dump($tweets);
  //print_r($tweets);
  //echo "conection is ok";
} catch (TwistException $e) {
  // エラーを表示
  echo "[{$e->getCode()}] {$e->getMessage()}";
}

$tweetsArr = [];
$margTweets = "";
foreach ($tweets as $value) {
  $text = getSafePostFrom($value->text);
  $tweetsArr[] = $text;
  $tweet_id = $value->id_str;
    // 検索キーワードをマーキング
  $keywords = preg_split('/,|\sOR\s/', $tweets_params['q']); //配列化
  // 修正
  $fixText = str_replace($keywords,"",$text);
  $removeWords = ['RT','http','co','t','相互'];
  $fixText = str_ireplace($removeWords,"",$fixText);
  $margTweets .= $fixText;
  //match的なの探す
  $keyWordsQty = count($keywords);
  //$twiWordsArr += array('keyWordsQty' => $keyWordsQty);
  for ($i=0; $i < $keyWordsQty; $i++) { 
  // 修正
  
  
  if (strpos($text, $keywords[$i]) !== FALSE)
  {
                //echo $keywords[$i];
    //$twiWordsArr[$twiWordsArr[$i]] ++;
                //$twiWordsArr[$i]  ++;
  }     
}



    // foreach ($keywords as $key) {
    //      $text = str_ireplace($key, '<span class="keyword">'.$key.'</span>', $text);

    // }
    //ツイート表示のHTML生成
      //disp_tweet($value, $text);

}
//echo count($keywords);


function disp_tweet($value, $text){
  $icon_url = $value->user->profile_image_url;
  $screen_name = $value->user->screen_name;
  $updated = date('Y/m/d H:i', strtotime($value->created_at));
  $tweet_id = $value->id_str;
  $url = 'https://twitter.com/' . $screen_name . '/status/' . $tweet_id;

  echo "<div>/--------------------------------------------------/</div>";
  echo '<div class="tweetbox">' . PHP_EOL;
  echo '<div class="thumb">' . '<img alt="" src="' . $icon_url . '">' . '</div>' . PHP_EOL;
  echo '<div class="meta"><a target="_blank" href="' . $url . '">' . $updated . '</a>' . '<br>@' . $screen_name .'</div>' . PHP_EOL;
  echo '<div class="tweet">' . $text . '</div>' . PHP_EOL;
    //
   // $meCab = new MeCab_Tagger();

    //$nodes = $meCab->parseToNode($text);
    //$nodes = $meCab->parse($text);
   // echo $nodes -> feature;

    //
    //echo $meCab->parse($text);

  echo '</div>' . PHP_EOL;

}



function MeCab_research($text){
  //$meCab = new MeCab_Tagger();
  //$nodes = $meCab->parseToNode($text);
    //$meCabText = $meCab->parse($text);
    // print_r($meCabText);
    // $meCabArr = preg_split('/,/', $meCabText);
    // print_r($meCabArr);
    // echo "<p></p>";
    // for ($i=0; $i < count($meCabArr); $i++) { 
    //  # code...
    // }


    // foreach ($meCabArr as $key) {
    //  //print_r($key);
    //  //echo "<p></p>";
    //  //print_r($meCabArr[$key]);

    //  if (strpos($key, '名詞') !== FALSE)
    //        { 

    //              print_r($key);
    //        echo "//";
    //              //echo $keywords[$i];
    //              //$twiWordsArr[$keywords[$i]] ++;
    //              //$twiWordsArr[$i]  ++;
    //        }
    // }
    /**
   * Usage:
   * cat data.txt | php example-countMeishi.php {appearances}
   */
  // 解析する文章
    $sentence = $text;
  // 出現回数のしきい値
  // この値以上出現した名詞を集計する
    $appearances = 1;
  // 名詞を表す品詞ID
  //  - 品詞IDの定義
  //  - http://mecab.googlecode.com/svn/trunk/mecab/doc/posid.html
    $meishiPosIdArr = [];
  // $meishiPosIdArr[] = 36; // 名詞 サ変接続
  // $meishiPosIdArr[] = 37; // 名詞 ナイ形容詞語幹
  $meishiPosIdArr[] = 38; // 名詞 一般
  // $meishiPosIdArr[] = 39; // 名詞 引用文字列
  // $meishiPosIdArr[] = 40; // 名詞 形容動詞語幹
  $meishiPosIdArr[] = 41; // 名詞 固有名詞 一般
  $meishiPosIdArr[] = 42; // 名詞 固有名詞 人名 一般
  $meishiPosIdArr[] = 43; // 名詞 固有名詞 人名 姓
  $meishiPosIdArr[] = 44; // 名詞 固有名詞 人名 名
  $meishiPosIdArr[] = 45; // 名詞 固有名詞 組織
  $meishiPosIdArr[] = 46; // 名詞 固有名詞 地域 一般
  $meishiPosIdArr[] = 47; // 名詞 固有名詞 地域 国
  // $meishiPosIdArr[] = 48; // 名詞 数
  // $meishiPosIdArr[] = 49; // 名詞 接続詞的
  // $meishiPosIdArr[] = 50; // 名詞 接尾 サ変接続
  // $meishiPosIdArr[] = 51; // 名詞 接尾 一般
  // $meishiPosIdArr[] = 52; // 名詞 接尾 形容動詞語幹
  // $meishiPosIdArr[] = 53; // 名詞 接尾 助数詞
  // $meishiPosIdArr[] = 54; // 名詞 接尾 助動詞語幹
  // $meishiPosIdArr[] = 55; // 名詞 接尾 人名
  // $meishiPosIdArr[] = 56; // 名詞 接尾 地域
  // $meishiPosIdArr[] = 57; // 名詞 接尾 特殊
  // $meishiPosIdArr[] = 58; // 名詞 接尾 副詞可能
  // $meishiPosIdArr[] = 59; // 名詞 代名詞 一般
  // $meishiPosIdArr[] = 60; // 名詞 代名詞 縮約
  // $meishiPosIdArr[] = 61; // 名詞 動詞非自立的
  // $meishiPosIdArr[] = 62; // 名詞 特殊 助動詞語幹
  // $meishiPosIdArr[] = 63; // 名詞 非自立 一般
  // $meishiPosIdArr[] = 64; // 名詞 非自立 形容動詞語幹
  // $meishiPosIdArr[] = 65; // 名詞 非自立 助動詞語幹
  // $meishiPosIdArr[] = 66; // 名詞 非自立 副詞可能
  // $meishiPosIdArr[] = 67; // 名詞 副詞可能
  // 抽出した名詞を格納する配列
  $meishiArr = [];
  // =================================================
  // main
  // =================================================
  $mecab = new MeCab_Tagger();
  $nodes = $mecab->parseToNode($sentence);
  foreach ($nodes as $node) {
    if ($node->getStat() === MECAB_BOS_NODE || $node->getStat() === MECAB_EOS_NODE) {
      // BOS(文頭), EOS(文末) を表す特殊な形態素
      // ※空文字なので無視する
      continue;
    }
    // 名詞を抽出する
    if (in_array($node->getPosId(), $meishiPosIdArr)) {
      $meishiArr[] = $node->getSurface();
    }
  }
  // 出現回数をカウント
  $retArr = array_count_values($meishiArr);
  // $appearances 回以上出現したものに絞り込み
  $retArr = array_filter($retArr, function($v) use($appearances) {
    return ($v >= $appearances);
  });
  // 出現回数の降順（多い順）に並び替え
  arsort($retArr, SORT_NUMERIC);
  //print_r($retArr);
  return $retArr;


}



//$twiWordsArr += ['secondWords' => MeCab_research($margTweets)];

$twiWordsArr = [ 'id_str' =>$tweets[0]->id_str];
$twiWordsArr += [ 'tweets_arr' =>$tweetsArr];

echo json_encode($twiWordsArr , JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE ); 


// echo <<<ETO

// </body>
// </html>

// ETO;
?>
