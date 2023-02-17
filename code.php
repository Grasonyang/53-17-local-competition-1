<?php
    $s="ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
    $char=$s[rand(0,strlen($s)-1)].$s[rand(0,strlen($s)-1)].$s[rand(0,strlen($s)-1)].$s[rand(0,strlen($s)-1)];
    echo $char;
?>