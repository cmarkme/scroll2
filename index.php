<?php
xdebug_break();include('config.php');
error_reporting(0);
$link=mysqli_connect("localhost",$user,$password,"a8351038_scrolle");

// Check connection
if (mysqli_connect_errno($link))
{
	echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
$query = "SELECT * FROM row_items" or die("Error in the consult.." . mysqli_error($link)); 
$result1 = mysqli_query($link, $query);
while($row1 = mysqli_fetch_array($result1)) {
	$item[]=$row1;

}
?>
<!DOCTYPE html>
<html>
<head>
<title>Scroller</title>
<link rel="stylesheet" media="screen" type="text/css" href="ImageOverlay.css" />
<script type="text/javascript" src="jquery-ui-1.10.4/jquery-1.10.2.js"></script>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.js"></script>
<script type="text/javascript" src="jquery.metadata.2.1/jquery.metadata.js"></script>
<script type="text/javascript" src="jquery.ImageOverlay.js"></script>
<script type="text/javascript" src="fancyapps-fancyBox-18d1712\source\jquery.fancybox.js"></script>
<link rel="stylesheet" href="fancyapps-fancyBox-18d1712\source\jquery.fancybox.css" type="text/css" media="screen" />
<style type="text/css">
#scroller {
	position: relative;
}
#scroller .innerScrollArea {
	overflow: hidden;
	position: absolute;
	left: 0;
	right: 0;
	top: 0;
	bottom: 0;
}
#scroller ul {
	padding: 0;
	margin: 0;
	position: relative;
}
#scroller li {
	padding: 0;
	margin: 0;
	list-style-type: none;
	position: absolute;
}
</style>
</head>
<body>

<div style="height: 100px;
	width: 100%;
	position: fixed;
	top: 0;
	left: 0;
	display:block;
	background: url(images/bg-header.png) repeat-x center bottom;
	z-index: 1000;">
</div>
<h1></h1>

<p>No options:</p>
<div id="container" >
	<div id="slit" style="height:200px;overflow:hidden">
	<div id="firstGalleryDiv" style="position:relative;">	
		<!--	<p style="clear: both; height: 0;">&nbsp;</p>	-->	
		<ul id="firstGallery" class="image-overlay">
			<p style="clear: both; height: 0;">&nbsp;</p>
<?php

foreach($item as $key => $value)
{
	echo '
		<li>
		<a rel="gallery" caption="'.$value['content'].' <span style=\'display: block;background-color: brown;-webkit-border-radius: 15px;border-radius: 15px;\' data-score=\''.$value['vote'].'\' data-postid=\''.$value['id'].'\' class=\'ttl\'>votes : <span class=\'ttll\'></span> 
	&nbsp;&nbsp;&nbsp;	vote <img onclick=\'vote()\' class=\'vote\' data-action=\'up\' src=\'images/thumb-up.png\'</span>
	
	
		
			       
	" '.$value['id'].'" class="fancybox" href="'.$value['file'].'">
		<img alt="Palm Tree" src="'.$value['thumb'].'"/>
		<div class="caption fancybox">
		<h3>'.$value['InnerTitle'].'</h3>
		<p>'.$value['InnerColumn'].'</p>
		</div>
		</a>
		</li>';
}
?>

			<p style="clear: both; height: 0;">&nbsp;</p>
			</ul>
			<ul id="firstGalleryspill" class="image-overlay">
			<p style="clear: both; height: 0;">&nbsp;</p>
<?php
foreach($item as $key1 => $value1)
{
	echo '
		<li>
			<a rel="gallery" caption="'.$value1['content'].' <span style=\'display: block;background-color: brown;-webkit-border-radius: 15px;border-radius: 15px;\' data-score=\''.$value1['vote'].'\' data-postid=\''.$value1['id'].'\' class=\'ttl\'>votes : <span class=\'ttll\'></span> 
	&nbsp;&nbsp;&nbsp;	vote <img onclick=\'vote()\' class=\'vote\' data-action=\'up\' src=\'images/thumb-up.png\'</span>
	
	
		
			       
	" '.$value1['id'].'" class="fancybox" href="'.$value1['file'].'">
		<img alt="Palm Tree" src="'.$value1['thumb'].'"/>
		<div class="caption fancybox">
		<h3>'.$value1['InnerTitle'].'</h3>
		<p>'.$value1['InnerColumn'].'</p>
		</div>
		</a>
		</li>';

}
?>
		</ul>
	</div>
</div>

</div>

<script type="text/javascript">

$(".fancybox").fancybox({

	openEffect : 'elastic',
    openSpeed  : 150,
    closeEffect : 'elastic',
    closeSpeed  : 150,
    closeClick : true,
    afterShow: function(){
 $('.ttll').html( function(){votedb(1)});
} ,
    beforeLoad: function() {
	    this.title = $(this.element).attr('caption');
	   
    }
  

});
//$.fancybox.center
	/////////////////////////////


	var Globalspeed=(10000/parseInt($("#container").css('height').replace('px', '')));

var scroller = $('#firstGalleryDiv');
var speed=10000;
var scrollerContent = scroller.find('ul');


$("#firstGallery").ImageOverlay();
$("#firstGalleryspill").ImageOverlay();
var mv=0;	
$( document ).ready(function() {
setInterval(

	function() {
		$("#container").css('height',parseInt($("#firstGalleryDiv").css('height')))
			$("#slit").css('height',parseInt($("#firstGallery").css('height')));

		var height1=parseInt($("#container").css('height').replace('px', ''));		



	}	,50);})	
	

var firstshot=1;
var heightoffirstGalleryDiv=parseInt($("#firstGalleryDiv").css('height').replace('px', ''));
var currentanim=heightoffirstGalleryDiv;
	$( document ).ready(function() {
var animinterval=setInterval(

	function() {




		if( parseInt($("#firstGalleryDiv").css('top').replace('px', '')) < -parseInt($("#firstGallery").css('height').replace('px', ''))) {
			var heightoful=parseInt($("#firstGallery").css('height').replace('px', ''));
			var height1=parseInt($("#container").css('height').replace('px', ''));
			$("#firstGalleryDiv").stop( true);
			$("#firstGalleryDiv").css('top','0px');
			currentanim=heightoffirstGalleryDiv;


		}
		$('#firstGalleryDiv').animate({
			'top': -currentanim+'px'
		}, (parseInt($("#firstGallery").css('height').replace('px', ''))*75),"linear");
		currentanim=currentanim+currentanim;
	}
,50);})

//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

setInterval(

	function() {
		if( parseInt($("#firstGalleryDiv").css('height').replace('px', '')) > (heightoffirstGalleryDiv*2) ) {


			var $lis = $("ul li");
			$lis.slice(0, Math.floor($lis.length/3)).remove();

		}
		
		
	}
,50);







</script>
	<script type="text/javascript">

  // ajax setup
  $.ajaxSetup({
    url: 'ajaxvote.php',
    type: 'POST',
    cache: 'false'
 }); 

 function vote(){

	

    var self = $('.vote'); // cache $this
    var action = self.data('action'); // grab action data up/down 
    var parent = self.parent(); // grab grand parent .item
    var postid = parent.data('postid'); // grab post id from data-postid
    var score = parent.data('score'); // grab score form data-score

    // only works where is no disabled class
  //  if (!parent.hasClass('.disabled')) {
      // vote up action
      if (action == 'up') {
        // increase vote score and color to orange
	     // $('span.ttll').html(++score).css({'color':'orange'});
	    // $('span.ttl').data('score', ++score);
        // change vote up button color to orange
        self.css({'color':'orange'});
        // send ajax request with post id & action
	$.ajax({data: {'postid' : postid, 'action' : 'up'}}).done(function(result){if(result=='1 Vote per Image'){alert('1 Vote per Image');}});
	votedb(1);
      }
    ;

      // add disabled class with .item
      parent.addClass('.disabled');
  //  };
 }; 
 function votedb(r)
 {
	 var self = $('.vote'); // cache $this
    var action = self.data('action'); // grab action data up/down 
    var parent = self.parent(); // grab grand parent .item
    var postid = parent.data('postid'); // grab post id from data-postid
    var score = parent.data('score'); // grab score form data-score
    	
  // $('.vote').bind('afterShow', function () {alert('after show');    })
  //  votedb(1);
   
$.ajax({url: 'ajaxvote.php',type: 'POST',data: {'postid' : postid, 'action' : 'up','r' : r}}).done(function(result1){$('.ttll').html(result1);});
 }
  </script>
	<div style="height: 100px;
	width: 100%;
	position: fixed;
	bottom: 0;
	left: 0;
	display:block;
	background: url(images/bg-header.png) repeat-x center bottom;
	z-index: 1000;">
</div>
</body>
</html>

