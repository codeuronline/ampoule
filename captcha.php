<?php 
if (!(isset($_SESSION['captcha']))){
    $_SESSION['captcha']= random_int(10000,99999);
    header("Content-type: image/jpeg");
    $image = @imagecreate(60, 25)
    or die("Impossible d'initialiser la bibliothèque GD");
    $black_color = imagecolorallocate($image, 0, 0, 0);
    $white_color = imagecolorallocate($image, 255, 255,255);
    imagestring($image, 5, 10, 10,  @$_SESSION['captcha'], $white_color);
    header('Content-type: image/jpeg');
    imagejpeg($image,null);
    ImageDestroy($image);
}
?>