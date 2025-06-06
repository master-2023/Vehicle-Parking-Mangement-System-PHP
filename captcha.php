<?php
session_start();

// Generate random CAPTCHA code
$captcha_code = substr(str_shuffle("ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789"), 0, 6);
$_SESSION['captcha_code'] = $captcha_code;

// Create an image
$width = 150;
$height = 50;
$image = imagecreatetruecolor($width, $height);

// Colors
$white = imagecolorallocate($image, 255, 255, 255);
$black = imagecolorallocate($image, 0, 0, 0);

// Fill background
imagefilledrectangle($image, 0, 0, $width, $height, $white);

// Load font (use an existing TTF font)
$font = __DIR__ . '/fonts/ARIALNB.ttf'; // Make sure arial.ttf exists in your project folder

// Add text to image
imagettftext($image, 24, rand(-10, 10), 20, 35, $black, $font, $captcha_code);

// Output image
header("Content-type: image/png");
imagepng($image);
imagedestroy($image);
?>
