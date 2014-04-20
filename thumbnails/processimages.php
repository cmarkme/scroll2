<?php
error_reporting(0);
$link=mysqli_connect("mysql7.000webhost.com","a8351038_cmarkme","kathleen01041972","a8351038_scrolle");

// Check connection
if (mysqli_connect_errno($link))
{
echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
$query = "SELECT * FROM scroller_row" or die("Error in the consult.." . mysqli_error($link)); 
$result = mysqli_query($link, $query);

while($row = mysqli_fetch_array($result)) {
$name[]=$row;
}  
$query = "SELECT * FROM row_items" or die("Error in the consult.." . mysqli_error($link)); 
$result1 = mysqli_query($link, $query);

while($row1 = mysqli_fetch_array($result1)) {
$item[]=$row1;

}  





function createThumbs( $pathToImages, $pathToThumbs, $thumbWidth ) 
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
echo "Creating thumbnail for {$fname} <br />";

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
$file=$pathToThumbs.$fname;
$sql = "INSERT INTO row_items (file,thumb)VALUES ($file,$thumb)" or die("Error in the consult..".mysqli_error($link));
mysqli_query($link,$sql);

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
createThumbs("bigimages/","thumbnails/",100);





/*

mysqli_query($link,"INSERT INTO web_formitem ('ID', 'formID', 'caption', 'key', 'sortorder', 'type', 'enabled', 'mandatory', 'data')
VALUES (105, 7, 'Tip izdelka (6)', 'producttype_6', 42, 5, 1, 0, 0)") 
or die(mysqli_error($link));*/
?>
