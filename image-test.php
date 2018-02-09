<?PHP
ini_set('display_errors', '1');
error_reporting(0);
// Load the main image and the overlay
$stamp = imagecreatefrompng('mark.png');
$im = imagecreatefromjpeg('image.jpg');

$marge_right = 20;
$marge_bottom = 125;
$sx = imagesx($stamp); // finding height and width
$sy = imagesy($stamp);

// Copy the stamp onto the main image with the position based on width/height and margins

imagecopy($im, $stamp, imagesx($im) - $sx - $marge_right, imagesy($im) - $sy - $marge_bottom, 0, 0, imagesx($stamp), imagesy($stamp));

//comment out these two lines 
header('Content-type: image/png');
imagepng($im);
//and uncomment this one to save the file as image-test.php
//imagepng($im, "image-test.png",6,PNG_NO_FILTER);
imagedestroy($im);
?>


