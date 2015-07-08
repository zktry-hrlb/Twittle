<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<title>Twittle!!</title>
<link rel="stylesheet" type="text/css" href="./base.css" media="all">
</head>
<style type="text/css">
	.keyword{
		color: red;
	}
</style>
<body>

<?php
ini_set( 'display_errors', 1 ); 

function getSafePostFrom($val){
    return htmlspecialchars($val, ENT_QUOTES, 'UTF-8', false);
}

//set search word
if ($_POST['TwiWord0'] != "") {
 	$twiwards = htmlspecialchars($_POST['TwiWord0'], ENT_QUOTES, 'UTF-8', false);
 } else{
 	echo "<p>Error Input!!</p>";
 }
if ($_POST['TwiWord1'] != "") {
 	$twiwards .=  " OR ".  htmlspecialchars($_POST['TwiWord1'], ENT_QUOTES, 'UTF-8', false);
 }
 if ($_POST['TwiWord2'] != "") {
 	$twiwards .=  " OR ".  htmlspecialchars($_POST['TwiWord2'], ENT_QUOTES, 'UTF-8', false);
 }
 if ($_POST['TwiWord3'] != "") {
 	$twiwards .=  " OR ".  htmlspecialchars($_POST['TwiWord3'], ENT_QUOTES, 'UTF-8', false);
 }
 if ($_POST['TwiWord4'] != "") {
 	$twiwards .=  " OR ".  htmlspecialchars($_POST['TwiWord4'], ENT_QUOTES, 'UTF-8', false);
 }
//var_dump($twiwards);
//explode(" OR ",$twiwards);
?>

<form method="post" action="twar.php">
	<input name="TwiWord0" type="text" value= <?php echo  htmlspecialchars($_POST['TwiWord0'], ENT_QUOTES, 'UTF-8', false); ?> ><span>VS</span>
	<input name="TwiWord1" type="text" value= <?php echo  htmlspecialchars($_POST['TwiWord1'], ENT_QUOTES, 'UTF-8', false); ?> ><span>VS</span>
	<input name="TwiWord2" type="text" value= <?php echo  htmlspecialchars($_POST['TwiWord2'], ENT_QUOTES, 'UTF-8', false); ?> ><span>VS</span>
	<input name="TwiWord3" type="text" value= <?php echo  htmlspecialchars($_POST['TwiWord3'], ENT_QUOTES, 'UTF-8', false); ?> ><span>VS</span>
	<input name="TwiWord4" type="text" value= <?php echo  htmlspecialchars($_POST['TwiWord4'], ENT_QUOTES, 'UTF-8', false); ?> >
	<input type="submit" />
</form>

<?php
flush();   ob_flush();

//echo htmlspecialchars($_POST['TwiWord']);

// ライブラリ読み込み
require __DIR__ . '/TwistOAuth.phar';

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
				'count' => '180',
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

	//var_dump($tweets_params);
	print_r($tweets[0]->id_str);
} catch (TwistException $e) {
	// エラーを表示
	echo "[{$e->getCode()}] {$e->getMessage()}";
}

$twiWord0_con = 0;
$twiWord1_con = 0;
$margTweets = "";
foreach ($tweets as $value) {
    $text = htmlspecialchars($value->text, ENT_QUOTES, 'UTF-8', false);
    
    // 検索キーワードをマーキング
    $keywords = preg_split('/,|\sOR\s/', $tweets_params['q']); //配列化

    // 修正
    $fixText = str_ireplace($keywords,"",$text);
    $margTweets .= $fixText;

    //match的なの探す
     	if (strpos($text, $keywords[0]) !== FALSE)
     	{
     		$twiWord0_con ++;
     	}
     	if (strpos($text, $keywords[1]) !== FALSE)
     	{
     		$twiWord1_con ++;
     	}

    
    foreach ($keywords as $key) {
        $text = str_ireplace($key, '<span class="keyword">'.$key.'</span>', $text);
        
    }
    // ツイート表示のHTML生成
    echo  $keywords[0] .":". $twiWord0_con;
    echo $keywords[1] .":".$twiWord1_con;
    //
    echo $margTweets;
    disp_tweet($value, $text);

}



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
   	//$meCab = new MeCab_Tagger();
    
    //$nodes = $meCab->parseToNode($text);
    //$nodes = $meCab->parse($text);
   // echo $nodes -> feature;
    
    //
    //echo $meCab->parse($text);
	//MeCab_research($value->text);    
    echo '</div>' . PHP_EOL;
    
}

MeCab_research($margTweets);
function MeCab_research($text){
	//$meCab = new MeCab_Tagger();
	//$nodes = $meCab->parseToNode($text);
   	//$meCabText = $meCab->parse($text);
   	// print_r($meCabText);
   	// $meCabArr = preg_split('/,/', $meCabText);
   	// print_r($meCabArr);
   	// echo "<p></p>";
   	// for ($i=0; $i < count($meCabArr); $i++) { 
   	// 	# code...
   	// }


   	// foreach ($meCabArr as $key) {
   	// 	//print_r($key);
   	// 	//echo "<p></p>";
   	// 	//print_r($meCabArr[$key]);

   	// 	if (strpos($key, '名詞') !== FALSE)
    //     		{	

    //        			print_r($key);
   	// 				echo "//";
    //        			//echo $keywords[$i];
    //        			//$twiWordsArr[$keywords[$i]] ++;
    //        			//$twiWordsArr[$i]  ++;
    //     		}
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
	print_r($retArr);

   	
   	
}



// // OAuthライブラリの読み込み
// require "twitteroauth/autoload.php";
// use Abraham\TwitterOAuth\TwitterOAuth;

// $consumer_key = ' xO1WOtIBuyc7jDmA80jaIgA4q';
// $consumer_secret = 'OuDF0yOMdgsS5RyLIVUZ2AGHNlqR0KO9cx70RYrWgWWo0Qh5Zn';
// $access_token = ' 3231402426-Gu3B3ZgkkypQuG6DmQdLVIQzRK7dHQvntY17U7Z';
// $access_token_secret = 'GV0JPapPhGLPDZqNI78XYOgNAPeX0xQF7DOEXkcUh6nrA';

// $connection = new TwitterOAuth($consumer_key, $consumer_secret, $access_token, $access_token_secret);


// //ツイート
// $res = $connection->post("statuses/update", array("status" => "テストメッセージ"));

// //レスポンス確認
// var_dump($res);

?>

</body>
</html>