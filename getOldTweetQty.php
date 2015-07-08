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
// 	.keyword{
// 		color: red;
// 	}
// </style>
// <body>
// ETO;


ini_set( 'display_errors', 1 ); 
header("charset=UTF-8");
// ライブラリ読み込み
require __DIR__ . '/TwistOAuth.phar';

function getSafePostFrom($val){
    return htmlspecialchars($val, ENT_QUOTES, 'UTF-8', false);
}
//set search word
if ($_POST['TwiWord0'] != "") {
    	$twiWord0 = getSafePostFrom($_POST['TwiWord0']);
    	$twiWordsArr = array($twiWord0=>0);
    	$twiwards = $twiWord0;
 } else{
    	echo "Error Input!!";
 }
if ($_POST['TwiWord1'] != "") {
    	$twiWord1 = getSafePostFrom($_POST['TwiWord1']);
    	$twiWordsArr += array( $twiWord1=>0);
    	$twiwards .=  " OR ".  $twiWord1;
 }
 if ($_POST['TwiWord2'] != "") {
    	$twiWord2 = getSafePostFrom($_POST['TwiWord2']);
    	$twiWordsArr += array($twiWord2=>0);
    	$twiwards .=  " OR ".  $twiWord2;
 }
 if ($_POST['TwiWord3'] != "") {
    	$twiWord3 = getSafePostFrom($_POST['TwiWord3']);
    	$twiWordsArr += array($twiWord3=>0);
    	$twiwards .=  " OR ".  $twiWord3;
 }
 if ($_POST['TwiWord4'] != "") {
 	$twiWord4 = getSafePostFrom($_POST['TwiWord3']);
 	$twiWordsArr += array($twiWord4=>0);
 	$twiwards .=  " OR ".  $twiWord4;
 }

//echo $twiwards;
//print_r($twiWordsArr );
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
	$tweets = $to->get('search/tweets', $tweets_params)->statuses;

	//var_dump($tweets);
	//print_r($tweets);
	//echo "conection is ok";
} catch (TwistException $e) {
	// エラーを表示
	echo "[{$e->getCode()}] {$e->getMessage()}";
}

foreach ($tweets as $value) {
  	  $text = getSafePostFrom($value->text);

   	// 検索キーワードをマーキング
	$keywords = preg_split('/,|\sOR\s/', $tweets_params['q']); //配列化
 	//match的なの探す

    	for ($i=0; $i < count($keywords); $i++) { 
        		if (strpos($text, $keywords[$i]) !== FALSE)
        		{
           			//echo $keywords[$i];
           			$twiWordsArr[$keywords[$i]] ++;
           			//$twiWordsArr[$i]  ++;
        		}   	
    	}
     	

    
    // foreach ($keywords as $key) {
    //     	$text = str_ireplace($key, '<span class="keyword">'.$key.'</span>', $text);
        
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






echo json_encode($twiWordsArr , JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE ); 


// echo <<<ETO

// </body>
// </html>

// ETO;
?>
