<?php
    header('Content-type:image/png');
    $img=imagecreate(15,15);
    $color=imagecolorallocate($img,rand(200,225),rand(200,225),rand(200,225));
    imagestring($img,5,0,0,$_GET['call'],imagecolorallocate($img,rand(0,200),rand(0,200),rand(0,200)));
    imagepng($img);
    imagedestroy($img);
?>