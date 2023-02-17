<?php
    $db=mysqli_connect("localhost","admin","1234","53_1");
    mysqli_query($db,"SET NAMES UTF8");
    session_start();
    $time=date("h:i:s Y/m/d");
    if(!isset($_SESSION['number'])){
        $_SESSION['number']=60;
    }
    $_SESSION['number']=60;
?>