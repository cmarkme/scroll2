<?php
include('config.php');
error_reporting(0);
$link=mysqli_connect("localhost",$user,$password,"a8351038_scrolle");

// Check connection
if (mysqli_connect_errno($link))
{
	echo "Failed to connect t MySQL: " . mysqli_connect_error();
}


$query = "SELECT * FROM row_items" or die("Error in the consult.." . mysqli_error($link)); 
$result1 = mysqli_query($link, $query);

while($row1 = mysqli_fetch_array($result1)) {
	$item[]=$row1;

}
//echo "<pre>";print_r($item[0]['file']);echo "</pre>";
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
</head>
<body>

<div>

</div>
<?php
function createThumbs( $pathToImages, $pathToThumbs, $thumbWidth,$link,$item) 
{
	// open the directory
	$dir = opendir( $pathToImages );

	// loop through it, looking for any/all JPG files:
	while (false !== ($fname = readdir( $dir ))) {
		// parse path for the extension
		$info = pathinfo($pathToImages . $fname);
		// continue only if this is a JPEG image
		if ( strtolower($info['extension']) == 'jpg' ) 
		{
			//echo "Creating thumbnail for {$fname} <br />";

			// load image and get image size
			$img = imagecreatefromjpeg( "{$pathToImages}{$fname}" );
			$width = imagesx( $img );
			$height = imagesy( $img );

			// calculate thumbnail size
			$new_width = $thumbWidth;
			$new_height = floor( $height * ( $thumbWidth / $width ) );

			// create a new temporary image
			$tmp_img = imagecreatetruecolor( $new_width, $new_height );

			// copy and resize old image into new image 
			imagecopyresized( $tmp_img, $img, 0, 0, 0, 0, $new_width, $new_height, $width, $height );

			// save thumbnail into a file
			imagejpeg( $tmp_img, "{$pathToThumbs}{$fname}" );
			///////////////////////////////////////////////////////////
			//
			$thumb=$pathToThumbs.$fname;
			$file=$pathToImages.$fname;
			$go=0;
			//echo $thumb.$value['thumb'];
			foreach($item as $key => $value)
			{

				//echo $thumb." ".$value['thumb'];	
				if(($value['file'] != $file) && ($value['thumb'] != $thumb))
				{
					//	$go=1;echo $go;
					//	echo $value['file']."<br/>";
					$thumb=mysqli_real_escape_string($link,$thumb);
					$file=mysqli_real_escape_string($link,$file);
					$sql = "INSERT INTO row_items (file,thumb)VALUES ('".$file."','".$thumb."')";

					mysqli_query($link,$sql);
				}

			}


		}
	}
	// close the directory
	closedir( $dir );
}
// call createThumb function and pass to it as parameters the path 
// to the directory that contains images, the path to the directory
// in which thumbnails will be placed and the thumbnails width. 
// We are assuming that the path will be a relative path working 
// both in the filesystem, and through the web for links

createThumbs("bigimages/","thumbnails/",$width_of_thumb,$link,$item);

?>
