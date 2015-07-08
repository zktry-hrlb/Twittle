<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="utf-8">
	<title>Twittle_Main</title>
	<meta name="viewpoint" content="width=device-width">
	<link rel="stylesheet" href="http://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css">
	<!--<link rel="stylesheet" href="./css/main.css">-->
	<link rel="stylesheet" href="./css/bootstrap.min.css">
	<link rel="stylesheet" href="./css/style.css">

	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
	<script type="text/javascript" src="./js/jquery.add-input-area.js"></script>
	<script src="js/jquery.validationEngine.js"></script>
	<script src="js/jquery.validationEngine-ja.js"></script>
	<link rel="stylesheet" href="css/validationEngine.jquery.css">
	<script type="text/javascript" src="./js/ObjectsPlus.js"></script>
	<?php 	
	function getSafePostFrom($val){
		return "'".htmlspecialchars($val, ENT_QUOTES, 'UTF-8', false) ."'";
	}
	function getPost($val){
		return htmlspecialchars($val, ENT_QUOTES, 'UTF-8', false);
	}
	?>
	<style type="text/css">
		.keyword{
			color: red;
		}
		.blue{
			color: blue;
		}

	</style>
	<script>
		$(function(){
			jQuery("#form_1").validationEngine();
		});
	</script>
	<link rel="shortcut icon" href="./img/favicon.png" type="image/vnd.microsoft.icon" />
  	<link rel="icon" href="./img/favicon.png" type="image/vnd.microsoft.icon" />
</head>
<body>
	
	<div class="container-fluid">
		<div class="row ">
			<div class="col-sm-12">
				<div class="header">
					<center><img src="./img/TWITTLE!!.png" alt="" class="logo"></center>
				</div>
			</div><!-- col -->
		</div><!-- row -->
	</div>

	<div class="container-fluid">
		<div class="row">
			<div class="col-sm-12">

				<form id="form_1"  method="post" action="main.php">
					<div class="form-group">
						<ul id="list1" class="ul-bar">
							<li>
								<div class="btn-group">
								<button type="button" class="btn btn-danger btn-lg list1_add" id="add_list1"><i class="glyphicon glyphicon-plus-sign"></i>追加</button>
								<button type="submit" class="btn btn-primary btn-lg"><i class="glyphicon glyphicon-play"></i>育成</button>
								</div>
							</li>
							<label class="sr-only control-label" for="search">search</label>
							<li class="list1_var">
								<input style="width: 200px; display: inline;" type="text" id="list1_0" class="form-control validate[required,custom[onlySpace]]" name="list1_0" placeholder="気になるワード">
								<i style="display: inline: left;" class="list1_del glyphicon glyphicon-remove-sign"></i>
							</li>
						</ul>
					</div>
				</form>				
			</div><!-- col -->
		</div><!-- row -->
	</div>



	<div class="container-fluid solo">

		
		<div class="row">
			<div class="col-sm-12 main-image">

				<img  class="img-responsive img-responsive-overwrite red-D" id="monster-img1" src="./img/dragonR01.png">

				</div><!-- col -->
			</div><!-- row -->
			<div class="row">
				<div class="col-sm-12">
					<div class="entry img-responsive img-responsive-overwrite">
						<div class="inner">
							<table class="table">
								<thead>
									<tr>
										<th>ステータス</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td class="monster-name">ワードラゴンの名前: <span class ="keyword" id="monsterName_1"></span></td>
									</tr>
									<tr>
										<td class="exp-tweet">経験値: <span class ="keyword" id="expTweets_1"></span> (Tweet数)</td>
									</tr>
									<tr>
										<td class="rest-exp-tweet">次の進化まであと <span class ="keyword" id="resExpTweete_1"></span> Tweet</td>
									</tr>
									<tr>
									<td><a data-toggle="modal" href="#myModal1" class="btn btn-primary">関連キーワード</a></td>
									</tr>
									<tr>
										<td></td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>
				</div><!-- col -->
			</div><!-- row -->
		</div>
		
		<div class="modal fade" id="myModal1">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button class="close" data-dismiss="modal">&times;</button>
						<h4 class="modal-title">関連キーワード</h4>
					</div>
					<div class="modal-body bodyA1">
						<table class="table">
							<thead>
								<tr>
									<th>人気</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td class="goodA1">
									<form id="form_1"  method="post" action="main.php">
										<input style="" type="text" id="list1_0" class="form-control validate[required,custom[onlySpace]]" name="list1_0">
										<button type="submit" class="btn btn-primary btn-lg"><i class="glyphicon glyphicon-play"></i>育成</button>
									</form>
									</td>
								</tr>
								<tr>
									<td class="goodA2">
									<form id="form_1"  method="post" action="main.php">
										<input style="" type="text" id="list1_0" class="form-control validate[required,custom[onlySpace]]" name="list1_0">
										<button type="submit" class="btn btn-primary btn-lg"><i class="glyphicon glyphicon-play"></i>育成</button>
									</form>
									</td>
								</tr>
								<tr>
									<td class="goodA3">
									<form id="form_1"  method="post" action="main.php">
										<input style="" type="text" id="list1_0" class="form-control validate[required,custom[onlySpace]]" name="list1_0">
										<button type="submit" class="btn btn-primary btn-lg"><i class="glyphicon glyphicon-play"></i>育成</button>
									</form>
									</td>
								</tr>
								<tr>
									<td class="goodA4">
									<form id="form_1"  method="post" action="main.php">
										<input style="" type="text" id="list1_0" class="form-control validate[required,custom[onlySpace]]" name="list1_0">
										<button type="submit" class="btn btn-primary btn-lg"><i class="glyphicon glyphicon-play"></i>育成</button>
									</form>
									</td>
								</tr>
								<tr>
									<td class="goodA5">
									<form id="form_1"  method="post" action="main.php">
										<input style="" type="text" id="list1_0" class="form-control validate[required,custom[onlySpace]]" name="list1_0">
										<button type="submit" class="btn btn-primary btn-lg"><i class="glyphicon glyphicon-play"></i>育成</button>
									</form>
									</td>
								</tr>
								<tr>
									<td>
										
									</td>
								</tr>
							</tbody>
						</table>
					</div>
					<!-- <div class="modal-body bodyA2">
						<table class="table">
							<thead>
								<tr>
									<th>不人気</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td class="badA1">
									<form id="form_1"  method="post" action="main.php">
										<input style="" type="text" id="list1_0" class="form-control validate[required,custom[onlySpace]]" name="list1_0">
										<button type="submit" class="btn btn-primary btn-lg"><i class="glyphicon glyphicon-search"></i>検索</button>
									</form>
									</td>
								</tr>
								<tr>
									<td class="badA2">
									<form id="form_1"  method="post" action="main.php">
										<input style=";" type="text" id="list1_0" class="form-control validate[required,custom[onlySpace]]" name="list1_0">
										<button type="submit" class="btn btn-primary btn-lg"><i class="glyphicon glyphicon-search"></i>検索</button>
									</form>
									</td>
								</tr>
								<tr>
									<td class="badA3">
									<form id="form_1"  method="post" action="main.php">
										<input style="" type="text" id="list1_0" class="form-control validate[required,custom[onlySpace]]" name="list1_0">
										<button type="submit" class="btn btn-primary btn-lg"><i class="glyphicon glyphicon-search"></i>検索</button>
									</form>
									</td>
								</tr>
								<tr>
									<td></td>
								</tr>
							</tbody>
						</table>
					</div> -->
				</div>
			</div>
		</div>

		<!-- <div class="modal fade" id="myModal2">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button class="close" data-dismiss="modal">&times;</button>
						<h4 class="modal-title">Bとの関連キーワード</h4>
					</div>
					<div class="modal-body bodyB1">
						<table class="table">
							<thead>
								<tr>
									<th>人気</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td class="goodB1">
										<input style="width: 50px;" type="text" id="good-b1" class="form-control validate[required,custom[onlySpace]]" name="good-b1">
										<button type="submit" class="btn btn-primary btn-lg"><i class="glyphicon glyphicon-search"></i>検索</button>
									</td>
								</tr>
								<tr>
									<td class="goodB2">
										<input style="width: 50px;" type="text" id="good-b2" class="form-control validate[required,custom[onlySpace]]" name="good-b2">
										<button type="submit" class="btn btn-primary btn-lg"><i class="glyphicon glyphicon-search"></i>検索</button>
									</td>
								</tr>
								<tr>
									<td class="goodB3">
										<input style="width: 50px;" type="text" id="good-b3" class="form-control validate[required,custom[onlySpace]]" name="good-b3">
										<button type="submit" class="btn btn-primary btn-lg"><i class="glyphicon glyphicon-search"></i>検索</button>
									</td>
								</tr>
								<tr>
									<td class="goodB4">
										<input style="width: 50px;" type="text" id="good-b3" class="form-control validate[required,custom[onlySpace]]" name="good-b3">
										<button type="submit" class="btn btn-primary btn-lg"><i class="glyphicon glyphicon-search"></i>検索</button>
									</td>
								</tr>
								<tr>
									<td class="goodB5">
										<input style="width: 50px;" type="text" id="good-b3" class="form-control validate[required,custom[onlySpace]]" name="good-b3">
										<button type="submit" class="btn btn-primary btn-lg"><i class="glyphicon glyphicon-search"></i>検索</button>
									</td>
								</tr>
								<tr>
									<td class="goodB6">
										<input style="width: 50px;" type="text" id="good-b3" class="form-control validate[required,custom[onlySpace]]" name="good-b3">
										<button type="submit" class="btn btn-primary btn-lg"><i class="glyphicon glyphicon-search"></i>検索</button>
									</td>
								</tr>
								<tr>
									<td>
										
									</td>
								</tr>
							</tbody>
						</table>
					</div>
					<!-- <div class="modal-body bodyB2">
						<table class="table">
							<thead>
								<tr>
									<th>不人気</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td class="badB1">
										<input style="width: 50px;" type="text" id="bad-b1" class="form-control validate[required,custom[onlySpace]]" name="bad-b1">
										<button type="submit" class="btn btn-primary btn-lg"><i class="glyphicon glyphicon-search"></i>検索</button>
									</td>
								</tr>
								<tr>
									<td class="badB2">
										<input style="width: 50px;" type="text" id="bad-b2" class="form-control validate[required,custom[onlySpace]]" name="bad-b2">
										<button type="submit" class="btn btn-primary btn-lg"><i class="glyphicon glyphicon-search"></i>検索</button>
									</td>
								</tr>
								<tr>
									<td class="badB3">
										<input style="width: 50px;" type="text" id="bad-b3" class="form-control validate[required,custom[onlySpace]]" name="bad-b3">
										<button type="submit" class="btn btn-primary btn-lg"><i class="glyphicon glyphicon-search"></i>検索</button>
									</td>
								</tr>
								<tr>
									<td></td>
								</tr>
							</tbody>
						</table>
					</div> -->
				</div>
			</div>
		</div>

		<script type="text/javascript" src="./js/bootstrap.min.js"></script>
		<script type="text/javascript" src="./js/vs-form.js"></script>
		<script type="text/javascript">

			var idStr = "";
			var twiWordArr = {
				'0' : 0,
				'1' : 0
			}
			var twiWordArr = new Array();
			var secondWordsArr = [];
			var secondWordsArr = new Array();
			var twiWordStr0 ="";
			var twiWordQty0 = 0;
			var twiWordStr1 ="";
			var twiWordQty1 = 0;
			var curResExpTweete =10;
	// setInterval("ajaxRequestToGetTweets()",10000);
	function ajaxRequestToGetTweets(resultType,max_id,since_id){
		var data = {
			'result_type': resultType,  
			'max_id':max_id,
			'since_id':since_id,
			'TwiWord0' : <?php echo getSafePostFrom($_POST['list1_0']); ?>,
			'TwiWord1' : <?php echo getSafePostFrom($_POST['list1_1']); ?>,
			'TwiWord2' : <?php echo getSafePostFrom($_POST['list1_2']); ?>,
			'TwiWord3' : <?php echo getSafePostFrom($_POST['list1_3']); ?>,
			'TwiWord4' : <?php echo getSafePostFrom($_POST['list1_4']); ?>
		}

		$.ajax({
			type: "POST",
			url: "requestToTwitter.php",
			data: data,
			success: function(data, dataType)
			{	
                      // for (var i = Things.length - 1; i >= 0; i--) {
                      // Things[i]
                      // };
                    	//alert(data);
                    	var resultsObj =JSON.parse(data);
                    	if (resultsObj['id_str']) {
                    		idStr = resultsObj['id_str'];
                    	}else{
                        //idStr = resultsObj['id_str'];
                    	};                    
                      	//console.log(resultsObj);

                      	// for(var key in resultsObj)
                      	// {
                      		
                      	// 	if (key != "id_str") {
                      	
                      	// 			twiWordArr[key] += resultsObj[key];
                      		

                      	// 	};    
                      	// } 
                      	//alert(resultsObj[resultsObj[0]]);
                      	for (var i = 0; i < resultsObj['keyWordsQty']; i++) {
                      		//var key = "'" + resultsObj[i] +"'";
                      		//twiWordArr[i] += resultsObj[key];
                      		//alert(twiWordArr[i]);
                      		//alert(resultsObj[resultsObj[i]]);
                      		if (i==0) {
                      			twiWordQty0 += resultsObj[resultsObj[i]];
                      		};
                      		if (i==1) {
                      			twiWordQty1 += resultsObj[resultsObj[i]];
                      		};
                      		
                      		//console.log(twiWordArr[i]);


                      		var targetImg = "#monster-img1";
                      		if (twiWordQty0>=10) {
                      			curResExpTweete1 = 30;
                      			$(targetImg).attr("src","./img/dragonR02.png");

                      		};
                      		if (twiWordQty0>=30) {
                      			curResExpTweete1 = 60;
                      			$(targetImg).attr("src","./img/dragonR03.png");

                      		};
                      		if (twiWordQty0>=60) {
                      			curResExpTweete1 = 110;
                      			$(targetImg).attr("src","./img/dragonR04.png");

                      		};
                      		if (twiWordQty0>=110) {
                      			curResExpTweete1 = twiWordQty0;
                      			$(targetImg).attr("src","./img/dragonR05.png");

                      		};

                      		var targetImg1 = "#monster-img2";
                      		if (twiWordQty1>=10) {
                      			curResExpTweete2 = 30;
                      			$(targetImg1).attr("src","./img/dragonB02.png");

                      		};
                      		if (twiWordQty1>=30) {
                      			curResExpTweete2 = 60;
                      			$(targetImg1).attr("src","./img/dragonB03.png");

                      		};
                      		if (twiWordQty1>=60) {
                      			curResExpTweete2 = 110;
                      			$(targetImg1).attr("src","./img/dragonB04.png");

                      		};
                      		if (twiWordQty1>=110) {
                      			curResExpTweete2 = twiWordQty1;
                      			$(targetImg1).attr("src","./img/dragonB05.png");

                      		};
                      		if (i==0) {
                      			$("#expTweets_1").text(String(twiWordQty0));
								$("#resExpTweete_1").text(String(curResExpTweete1-twiWordQty0));
                      		};
                      		if (i==1) {
                      			$("#expTweets_2").text(String(twiWordQty1));
								$("#resExpTweete_2").text(String(curResExpTweete2-twiWordQty1));
								$("#tweeBetween_1").text(String(twiWordQty0 - twiWordQty1));
								$("#tweeBetween_2").text(String(twiWordQty1 - twiWordQty0)); 
                      		};
                      		
                      		


                      	};

                      	//console.log(twiWordQty0 + "vs" +twiWordQty1);
                      		// var ffo = $("#monster-img1").attr("src");
                      		// alert(ffo);

                       	//console.log(resultsObj['secondWords']);
                       	secondWordsArr = secondWordsArr.plus(resultsObj['secondWords']);
                       	var tmpObj = $.extend(true, {}, secondWordsArr);

                       	var data;
                       	var Value1 = 0;
                       	var key1 = "";
                       	var Value2 = 0;
                       	var key2 = "";
                       	var Value3 = 0;
                       	var key3 = "";
                       	var Value4 = 0;
                       	var key4 = "";
                       	var Value5 = 0;
                       	var key5 = "";
                       	var MAX = "";
                       	var MAXNUM =0;
                       	//var secondWordsArr =[];

                       	for ( var key in tmpObj) {
                       		//alert(secondWordsArr[key]);
                       		if (secondWordsArr[key]>=MAXNUM) {
                       			MAXNUM = secondWordsArr[key];
                       			key1 = key;

                       		};

                       		// if (Value5 <= secondWordsArr[key]) {
                       		// 	//alert(secondWordsArr[key]);
                       		// 	Key5 = key;
                       		// 	if (Value4 <= secondWordsArr[key]) {
                       		// 		if (key4 != "") {key5 = key4;};
                       		// 		Key4 = key;
                       		// 		if (Value3 <= secondWordsArr[key]) {
                       		// 			if (key3 != "") {key4 = key3;};
                       		// 			Key3 = key;
                       		// 			if (Value2 <= secondWordsArr[key]) {
                       		// 				if (key2 != "") {key3 = key2;};
                       		// 				Key2 = key;
                       		// 				if (Value1 <= secondWordsArr[key]) {
                       		// 					if (key1 != "") {key2 = key1;};
                       		// 					Key1 = key;
                       		// 					alert(key1);
                       		// 				};
                       		// 			};
                       		// 		};
                       		// 	};
                       		// };
                       		

							//maxValue = secondWordsArr[key];
						// keyやdataを使った処理
						}
						delete tmpObj[key1];
						MAXNUM = 0;
                        for ( var key in tmpObj) {
                       		if (secondWordsArr[key]>=MAXNUM) {
                       			MAXNUM = secondWordsArr[key];
                       			key2 = key;
                       		};
						}
						delete tmpObj[key2];
						MAXNUM = 0;
						for ( var key in tmpObj) {
                       		if (secondWordsArr[key]>=MAXNUM) {
                       			MAXNUM = secondWordsArr[key];
                       			key3 = key;
                       		};
						}
						delete tmpObj[key3];
						MAXNUM = 0;
						for ( var key in tmpObj) {
                       		if (secondWordsArr[key]>=MAXNUM) {
                       			MAXNUM = secondWordsArr[key];
                       			key4 = key;
                       		};
						}
						delete tmpObj[key4];
						MAXNUM = 0;
						for ( var key in tmpObj) {
                       		if (secondWordsArr[key]>=MAXNUM) {
                       			MAXNUM = secondWordsArr[key];
                       			key5 = key;
                       		};
						}


						//alert(key2);
                        //console.log(data);
                        console.log(secondWordsArr);

                        $(".goodA1").find("#form_1").children("#list1_0").val([key1]);
                        $(".goodA2").find("#form_1").children("#list1_0").val([key2]);
                        $(".goodA3").find("#form_1").children("#list1_0").val([key3]);
                        $(".goodA4").find("#form_1").children("#list1_0").val([key4]);
                        $(".goodA5").find("#form_1").children("#list1_0").val([key5]);

                        //console.log( $(".goodA1").find("#form_1").children("#list1_0").val(['fooo']));
                        //secondWordsArr.pop();
                        $("#expTweets_2").text(String(twiWordQty1));

                    },
                    error: function(XMLHttpRequest, textStatus, errorThrown)
                    {                    
                    	alert('Error : ' + errorThrown);
                    }
                });
}

ajaxRequestToGetTweets("new","","");
setInterval("ajaxRequestToGetTweets('new','',idStr)",10000);
</script>

<script type="text/javascript">

	var postQty = "one";

	<?php 
	if ($_POST['list1_0'] != ""){
		if ($_POST['list1_1'] != ""){
			echo 'postQty = "tw";';
		}
	}
	?>
	if (postQty == "tw") {
		$('.solo').html('<div class="row"><div class="col-sm-5"><div class="row"><div class="col-sm-12"><div class="row"><div class="col-sm-12 main-image2"><img  class="img-responsive img-responsive-overwrite" id="monster-img1" src="./img/dragonR01.png"></div><!-- col --></div><!-- row --><div class="entry2 img-responsive img-responsive-overwrite"><div class="inner2"><table class="table"><thead><tr><th>ステータス</th></tr></thead><tbody><tr><td class="monster-name1">ワードラゴンの名前:　<span class ="keyword" id="monsterName_1"></span></td></tr><tr><td class="exp-tweet">経験値: <span class ="keyword" id="expTweets_1"></span> (Tweet数)</td></tr><tr><td class="rest-exp-tweet">次の進化まであと <span class ="keyword" id="resExpTweete_1"></span> Tweet</td></tr><tr><td class="difference">相手との差: <span class ="keyword" id="tweeBetween_1"></span> (Tweet数)</td></tr><tr><td></td></tr></tbody></table></div></div></div><!-- col --></div><!-- row --></div><div class="col-sm-2"><center><img src="./img/vs2.png" class="VS-logo"><tr><td><a data-toggle="modal" href="#myModal1" class="btn btn-primary">両者の関連キーワード</a></td></tr></center></div><div class="col-sm-5"><div class="row"><div class="col-sm-12"><div class="row"><div class="col-sm-12 main-image2"><img  class="img-responsive img-responsive-overwrite" id="monster-img2" src="./img/dragonB01.png"></div><!-- col --></div><!-- row --><div class="entry2 img-responsive img-responsive-overwrite"><div class="inner2"><table class="table"><thead><tr><th>ステータス</th></tr></thead><tbody><tr><td class="monster-name">ワードラゴンの名前:　<span class ="blue" id="monsterName_2"></span></td></tr><tr><td class="exp-tweet">経験値: <span class ="blue" id="expTweets_2"></span> (Tweet数)</td></tr><tr><td class="rest-exp-tweet">次の進化まであと <span class ="blue" id="resExpTweete_2"></span> Tweet</td></tr><tr><td class="difference">相手との差: <span class ="blue" id="tweeBetween_2"></span> (Tweet数)</td></tr><tr><td></td></tr></tbody></table></div></div></div><!-- col --></div><!-- row --></div></div>');
	};
</script>
<script type="text/javascript">
	
	
	$("#monsterName_1").text(<?php echo getSafePostFrom($_POST['list1_0']); ?>);
	$("#monsterName_2").text(<?php echo getSafePostFrom($_POST['list1_1']); ?>);



</script>
</body>
</html>
<!-- Comment -->