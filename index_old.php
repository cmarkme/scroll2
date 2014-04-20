<?php
include('config.php');
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
	$query = 'SELECT id, first_name, last_name, film_info, vote 
  FROM  voting
  LIMIT 0 , 15'; 
$result1 = mysqli_query($link, $query);
while($row1 = mysqli_fetch_array($result1)) {
	$vote[]=$row1;

}
echo "<pre>";print_r($vote);echo "</pre>";
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
		<a rel="gallery" title="'.$value['content'].'" class="fancybox" href="'.$value['file'].'">
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
		<a rel="gallery" title="'.$value1['content'].'" class="fancybox" href="'.$value1['file'].'">
		<img alt="Palm Tree" src="'.$value1['thumb'].'"/>
		<div class="caption fancybox">
		<h3 data-logic="'.$value1['id'].'">'.$value1['InnerTitle'].'</h3>
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

});
$.fancybox.center
	/////////////////////////////



	var Globalspeed=(10000/parseInt($("#container").css('height').replace('px', '')));

var scroller = $('#firstGalleryDiv');
var speed=10000;
var scrollerContent = scroller.find('ul');


$("#firstGallery").ImageOverlay();
$("#firstGalleryspill").ImageOverlay();
var mv=0;	

setInterval(

	function() {
		$("#container").css('height',parseInt($("#firstGalleryDiv").css('height')))
			$("#slit").css('height',parseInt($("#firstGallery").css('height')));

		var height1=parseInt($("#container").css('height').replace('px', ''));		



	}	,50);	

var firstshot=1;
var heightoffirstGalleryDiv=parseInt($("#firstGalleryDiv").css('height').replace('px', ''));
var currentanim=heightoffirstGalleryDiv;

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
,50);

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

