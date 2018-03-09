<?
session_start(); 

$text  = "ABCDEFGHIJKLMNPQRSTUVWXYZ123456789";

$rand = substr(str_shuffle($text),0,3); 
$_SESSION['verify_value'] = strtolower($rand); 

$im = imagecreatefromjpeg("images/bg.jpg");
$textcolor = imagecolorallocate ($im, 0, 0, 0);  

imagestring ($im, 5, 20, 5,  $rand, $textcolor);  

header('Content-type: image/jpeg'); 
imagejpeg($im); 
imagedestroy($im); 
?>