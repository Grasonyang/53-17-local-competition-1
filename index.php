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
    .code_img_dp{
        height:70px;
        width:280px;
        display:flex;
        background-color:gray;
    }
    .code_img{
        height:70px;
        width:70px;
    }
    img{
        height:70px;
        width:70px;
    }
</style>
<body>
    <h1>咖啡商品展示系統</h1>
    <div>
        <form action="call_mrg.php?call=1" method="post" onsubmit="return submit_prepare()">
            <div style="display:flex;">
                <span style="width:120px;">帳號</span>
                <input type="text" name="log_id" id="log_id">
            </div>
            <div style="display:flex;">
                <span style="width:120px;">密碼</span>
                <input type="text" name="log_pwd" id="log_pwd">
            </div>
            <div style="display:flex;">
                <span style="width:120px;">驗證碼</span>
                <input type="hidden" name="img_code_sort" id="img_code_sort">
                <div>
                    <div id="code_img_dp1" class="code_img_dp"></div>
                    <div id="code_img_dp2" class="code_img_dp"></div>
                    <input type="hidden" name="img_code_sorted" id="img_code_sorted">
                </div>
                <button type="button" onclick="code_apr()" id="re_code">重新產生</button>
                <button type="button" onclick="how_sort()" id="fltb">由大到小</button>
            </div>
            <button type="button" onclick="clean()">清除</button>
            <button type="submit">登入</button>
            
        </form>
    </div>
</body>
<script>
    let code="";
    $(document).ready(function(){
        code_apr();
        $("#code_img_dp1,#code_img_dp2").sortable({
            connectWith:".code_img_dp",
        }).disableSelection();
    });
    function code_apr(){
        $.post({
            async:false,
            url:"code.php",
            success:function(e){
                code=e;
                how_sort();
                how_sort();
                $(".code_img").remove();
                $("#code_img_dp1").append(`
                    <div class="code_img" id="${e[0]}"><img src="code_img.php?call=${e[0]}" alt="A1"></div>
                    <div class="code_img" id="${e[1]}"><img src="code_img.php?call=${e[1]}" alt="A2"></div>
                    <div class="code_img" id="${e[2]}"><img src="code_img.php?call=${e[2]}" alt="A3"></div>
                    <div class="code_img" id="${e[3]}"><img src="code_img.php?call=${e[3]}" alt="A4"></div>
                `);
                // alert(e);
            },
        });
    }
    function submit_prepare(){
        // console.log($("#code_img_dp2").children())
        let codee="";
        if($("#code_img_dp2").children().length==4){
            for(let i=0;i<4;i++){
                codee+=$("#code_img_dp2").children()[i].id;
            }
            $("#img_code_sorted").val(codee);
            return true;
        }else{
            alert("請填寫驗證碼");
            return false;
        }
    }
    function how_sort(){
        // console.log(code.split("").sort().join(""),code.split("").sort().reverse().join(""))
        // console.log($("#fltb").text())
        if($("#fltb").text()=="由大到小"){
            $("#fltb").text("由小到大");
            $("#img_code_sort").val(code.split("").sort().join(""));
        }else{
            $("#fltb").text("由大到小");
            $("#img_code_sort").val(code.split("").sort().reverse().join(""));
        }
    }
    function clean(){
        $("#log_id").val("");
        $("#log_pwd").val("");
        code_apr();
    }
</script>
</html>