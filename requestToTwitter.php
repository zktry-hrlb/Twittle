<?php
header("Content-type: text/plain; charset=UTF-8");
if (isset($_POST['TwiWord0']))
{
	//ここに何かしらの処理を書く

	if ($_POST['result_type']==="new") {
		require( "getNewerTweetQty.php" );
	}
	 if ($_POST['result_type']==="old") {
	 	require( "getOldTweetQty.php" );
	 }
	 



	//echo "OK";
}
else
{
	echo 'The parameter of "request" is not found.';
}
?>