<?php
//echo $_POST;
if($_POST){
	//die();
	//var_dump($_POST);
	
	
	//$id = "mouse";
	$id = $data = $_GET['id'];

	//print $id;
	$data = $_POST['data'];
	//print $data;
	
	//security
	$id = preg_replace( "/[^a-zA-Z0-9]/", "", $id );
	
	$ourFileName = "./results/".$id;

		// only save it if we don't have it
		$towrite =
			" <ip>" . $_SERVER["REMOTE_ADDR"] . "</ip>\n".
			" <referer>" . $_SERVER["HTTP_REFERER"] . "</referer>\n" .
			" <date>" . date("D M j G:i:s T Y") . "</date>\n".
			" <userAgent>" . $_SERVER["HTTP_USER_AGENT"] . "</userAgent>\n". 
			" <userLang>" . $_SERVER["HTTP_ACCEPT_LANGUAGE"] . "</userLang>\n";
		
		foreach ($_POST as $key => $value){
			$towrite = $towrite ." <".$key .">" . $value."</".$key .">\n";
		}
		
		$towrite = "<pull>\n".$towrite."\n</pull>";
		
		$towrite = $towrite."\n\n";
		
		$fh = fopen($ourFileName, 'a') or die("can't create file");
		fwrite($fh, $towrite, 500000);
		fclose($fh);

?>
Thanks for completing the survey!

<?php
	// we are all set
	die();
}

?>




<html>
<head>
<script type="text/javascript" src="../js/jquery-1.7.min.js"></script>
<script type="text/javascript" src="../js/jquery-ui-1.8.18.custom.min.js"></script>
<link rel="stylesheet" href="css/ui-lightness/jquery-ui-1.8.9.custom.css" />
<script type="text/javascript">


function getQueryParams(qs) {
    qs = qs.split("+").join(" ");
    var params = {},
        tokens,
        re = /[?&]?([^=]+)=([^&]*)/g;

    while (tokens = re.exec(qs)) {
        params[decodeURIComponent(tokens[1])]
            = decodeURIComponent(tokens[2]);
    }

    return params;
}



var firstClick = 0;
var lastClicked = '';

$(document).ready(function(){
   $(document).mousemove(function(e){
	  if (firstClick != 0)
      	$("#status").append(lastClicked + ',' + e.pageX +', '+ e.pageY + ',' + (new Date().getTime() - firstClick) + '\n');
   }); 
   $(".ui-button").button();
   $(".ui-button").click(function(e){
	   lastClicked = e.srcElement.innerText.replace(/(\r\n|\n|\r)/gm, "");
		//alert(e.srcElement.innerHTML);
		if (firstClick == 0)
			firstClick = new Date().getTime();
   	});
	$("#9").click(function(e){ 
		//alert($("name").text());
		//alert($("#status").html());
		//$("#data").val($("#status").html());
		var dat = $("#status").html();
		$.ajax({
			  type: 'POST',
			  url: "?id=" + $_GET['name'],
			  data: { data: dat }
			});
		//alert("Thanks");
		 $("#thanks").dialog({ modal: true , width: 400,
			 beforeClose: function(event, ui) {document.location = document.location;}
		});
		//document.location = document.location;
		firstClick = 0;
	});


	var $_GET = getQueryParams(document.location.search);

	if (!$_GET['name']){
		$("#dialog").dialog({ modal: true });
	}

	//  start game
	if ($_GET['name']){
		$("#8").addClass("ui-state-highlight");
		$("#8").click(function(){
			$("#8").removeClass("ui-state-highlight");
			$("#6").addClass("ui-state-highlight");
			$("#6").click(function(){
				$("#6").removeClass("ui-state-highlight");
				$("#4").addClass("ui-state-highlight");
				$("#4").click(function(){
					$("#4").removeClass("ui-state-highlight");
					$("#3").addClass("ui-state-highlight");
					$("#3").click(function(){
						$("#3").removeClass("ui-state-highlight");
						$("#5").addClass("ui-state-highlight");
						$("#5").click(function(){
							$("#5").removeClass("ui-state-highlight");
							$("#9").addClass("ui-state-highlight");
							$("#9").click(function(){
								$("#9").removeClass("ui-state-highlight");
								
							});
						});
					});
				});
			});
		});
	}
});



</script>
<style>
.ui-button{
margin: 30px;
}

</style>

<body style="background-color: grey;">

<div id="can" style="background-color: white;width: 600px; height: 550px">

<div class="ui-widget">
	<div class="ui-state-highlight ui-corner-all" style="margin-top: 20px; padding: 0 .7em;"> 
		<p><span class="ui-icon ui-icon-info" style="float: left; margin-right: .3em;"></span>
	 The objective is to watch how you move the mouse when clicking some numbers</p>
	</div>
</div>

<div class="ui-widget">
	<div class="ui-state-error ui-corner-all" style="padding: 0 .7em;"> 
		<p><span class="ui-icon ui-icon-alert" style="float: left; margin-right: .3em;"></span> 
		Use the mouse to click the numbers <strong style="font-size: x-large;" >8-6-4-3-5-9</strong></p>
	</div>
</div>

<form id="numbersform" action="#" method="post">
<input type="hidden" id="data">
</form>

<div id="numbers" style="position:absolute;   left:130px; top:200px">

<button id="1" class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only" role="button" aria-disabled="false">
1
</button>

<button id="2" class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only" role="button" aria-disabled="false">
2
</button>

<button id="3" class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only" role="button" aria-disabled="false">
3
</button>

<br/>

<button id="4" class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only" role="button" aria-disabled="false">
4
</button>

<button id="5" class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only" role="button" aria-disabled="false">
5
</button>

<button id="6" class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only" role="button" aria-disabled="false">
6
</button>

<br/>

<button id="7" class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only" role="button" aria-disabled="false">
7
</button>

<button id="8" class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only" role="button" aria-disabled="false">
8
</button>

<button id="9" class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only" role="button" aria-disabled="false">
9
</button>

</div>

<div id="dialog" title="" style="display: none;">
<form method="get">
<center>Please enter an identifier: <br/>
<input name="name" type="text"/>
<input type="submit" value="GO">
</center>
</form>
</div>

<div id="thanks" title="" style="display: none;">

<center>Thanks! Want to do it again?<br/>
<img alt="take this" src="cat-take-this.jpg">
</center>

</div>





</div>
<pre id="status" style="font-size: xx-small;width:300px;display: none;">
  
</pre>
</body>
</html>