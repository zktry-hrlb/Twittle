<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>Twittle!!</title>
  <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
  <style type="text/css">
    .tweetsBox {  
      width: 100%;  
      /*border: 1px solid #000;*/  
    }  
    .tweetsBox div   {  
      width: 65%;  
      border-radius: 10px;        /* CSS3草案 */  
      -webkit-border-radius: 10px;    /* Safari,Google Chrome用 */  
      -moz-border-radius: 10px; 
      border: 1px solid #010101;  
      margin: 0 auto; 
      padding: 20px 20px 20px 20px; 
    }
    .tweet {
      margin-bottom: 20px !important;
    }

  </style>
</head>
<style type="text/css">
 .keyword{
   color: red;
 }
</style>

<?php   
function getSafePostFrom($val){
  return "'".htmlspecialchars($val, ENT_QUOTES, 'UTF-8', false) ."'";
}

?>
<body>

  <div style="width: 65%;margin: 0 auto;" id="tweetsBox" class="tweetsBox">
    <h2 style="" align="center">
      <form method="post" action="relationship.php">
        <input name="list1_0" type="text" value= <?php echo  htmlspecialchars($_POST['list1_0'], ENT_QUOTES, 'UTF-8', false); ?> ><span> ✕ </span>
        <input name="list1_1" type="text" value= <?php echo  htmlspecialchars($_POST['list1_1'], ENT_QUOTES, 'UTF-8', false); ?> >
        <input type="submit" />
      </form>
    </h2>
    <div id="twee">
    </div>
  </div>

  <script type="text/javascript">
    var idStr = "";
  // setInterval("ajaxRequestToGetTweets()",10000);
  function ajaxRequestToGetTweets(resultType,max_id,since_id){
    var data = {
      'result_type': resultType,  
      'max_id':max_id,
      'since_id':since_id,
      'TwiWord0' : <?php echo getSafePostFrom($_POST['list1_0']); ?>,
      'TwiWord1' : <?php echo getSafePostFrom($_POST['list1_1']); ?>,
    }

    $.ajax({
      type: "POST",
      url: "getNewerTweets.php",
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

                      
                      for ( var key in resultsObj['tweets_arr']) {
                          $("#twee").append( '<div class="tweet">'+ resultsObj['tweets_arr'][key] + '</div>');
                      }





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
</body>
</html>