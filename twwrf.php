<?php
    include 'connect.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="cript/jquery-3.6.3.min.js"></script>
    <script src="cript/jquery-ui.js"></script>
    <link rel="stylesheet" href="cript/jquery-ui.css">
    <title>Document</title>
</head>
<style>
    .craft{
        height:50px;
        width:50px;
        border:1px solid black;
        background-color:white;
    }
    .turn{
        background-color:red;
    }
</style>
<body>
    <div style="display:flex">
        <div class="craft"></div>
        <div class="craft"></div>
    </div>
    <div style="display:flex">
        <div class="craft"></div>
        <div class="craft"></div>
    </div>
    <button onclick="sendout()">送出</button>
</body>
<script>
    let craft=document.querySelectorAll('.craft');
    // console.log(craft)
    craft.forEach(key=>{
        key.addEventListener('click',() => {
            key.classList.toggle("turn");
        },false);
    });
    function sendout(){
        if(($(".craft:eq(0)").css('background-color')=='rgb(255, 0, 0)' && $(".craft:eq(1)").css('background-color')=='rgb(255, 0, 0)') ||
        ($(".craft:eq(0)").css('background-color')=='rgb(255, 0, 0)' && $(".craft:eq(2)").css('background-color')=='rgb(255, 0, 0)') ||
        ($(".craft:eq(3)").css('background-color')=='rgb(255, 0, 0)' && $(".craft:eq(1)").css('background-color')=='rgb(255, 0, 0)') ||
        ($(".craft:eq(0)").css('background-color')=='rgb(255, 0, 0)' && $(".craft:eq(2)").css('background-color')=='rgb(255, 0, 0)')){
            alert('歡迎');
            if(<?php echo $_GET['call'] ?>==1){
                location.href="user_mrg.php?id=<?php echo $_GET['id']; ?>";
            }else{
                location.href="user_use.php?id=<?php echo $_GET['id']; ?>";
            }
        }else{
            alert('錯誤');
        }
    }
</script>
</html>