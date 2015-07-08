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
				'count' => '100',
				"result_type" => "recent",
				"lang" => "ja"
			];
	$tweets = $to->get('search/tweets', $tweets_params)->statuses;

	//var_dump($tweets);
	//print_r($tweets);
} catch (TwistException $e) {
	// エラーを表示
	echo "[{$e->getCode()}] {$e->getMessage()}";
}

$twiWord0_con = 0;
$twiWord1_con = 0;

foreach ($tweets as $value) {
    $text = htmlspecialchars($value->text, ENT_QUOTES, 'UTF-8', false);

    // 検索キーワードをマーキング
    $keywords = preg_split('/,|\sOR\s/', $tweets_params['q']); //配列化

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
   // $meCab = new MeCab_Tagger();
    
    //$nodes = $meCab->parseToNode($text);
    //$nodes = $meCab->parse($text);
   // echo $nodes -> feature;
    
    //
    //echo $meCab->parse($text);
    
    echo '</div>' . PHP_EOL;
    
}

function MeCab_research($text){
	$meCab = new MeCab_Tagger();
	//$nodes = $meCab->parseToNode($text);
   	echo $meCab->parse($text);
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