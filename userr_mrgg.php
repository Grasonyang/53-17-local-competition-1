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
</style>
<body>
    <span id="numbercount"></span>
    <button onclick="location.href='user_mrg.php?id=<?php echo $_GET['id']; ?>'">返回</button>
    <button onclick="$('.place:eq(0)').dialog('open')">新增使用者</button>
    <select id="fw">
        <option value="id" class="options_fw">使用者編號</option>
        <option value="user" class="options_fw">帳號</option>
        <option value="name" class="options_fw">姓名</option>
    </select>
    <input type="text" placeholder="關鍵字" id="kw">
    <select id="sorted">
        <option value="ASC" class="options_sorted">升冪</option>
        <option value="DESC" class="options_sorted">降冪</option>
    </select>
    <button onclick="user_table()">查詢</button><br>
    <input type="number" id="nummm">
    <button onclick="sendout()">送出</button>
    <div class="all_user">
        <table border="1" id="user_table">
            <tr>
                <td>編號</td>
                <td>帳號</td>
                <td>姓名</td>
                <td>密碼</td>
                <td>權限</td>
                <td>操作</td>
            </tr>
        </table>
    </div>
    <div class="place">
        <form action="call_mrg.php?call=2" method="post">
            帳號:<input type="text" name="id"><br>
            密碼:<input type="text" name="pwd"><br>
            姓名:<input type="text" name="name"><br>
            權限:
            <select name="rank">
                <option value="1" class="options">一般使用者</option>
                <option value="2" class="options">管理者</option>
            </select><br>
            <input type="submit">
        </form>
    </div>
    <div class="place">
        <form action="call_mrg.php?call=5" method="post">
            <input type="hidden" name="true_id" id="true_id">
            帳號:<input type="text" name="id" id="ed_id"><br>
            密碼:<input type="text" name="pwd" id="ed_pwd"><br>
            姓名:<input type="text" name="name" id="ed_name"><br>
            權限:
            <select name="rank" id="ed_rank">
                <option value="1" class="ed_options">一般使用者</option>
                <option value="2" class="ed_options">管理者</option>
            </select><br>
            <input type="submit">
        </form>
    </div>
    <div class="placeaa">
        <h1>是否繼續?</h1>
        <button type="button" class="aaa" onclick="location.href='userr_mrgg.php?id=<?php echo $_GET['id']; ?>'">是</button>
        <button type="button" class="aaa" onclick="location.href='user_mrg.php?id=<?php echo $_GET['id']; ?>'">否</button>
    </div>
</body>
<script>
    let timer1;
    $(".placeaa").hide();
    let num=parseInt('<?php echo $_SESSION['number'] ?>');
    $("#numbercount").text(num);

    $(".place").dialog({
        autoOpen:false,
    });
    timer();
    user_table();
    function sendout(){
        num=$("#nummm").val();
        clearInterval (timer1);
        timer();
    }
    function timer(){
        timer1=setInterval(() => {
            num--;
            $("#numbercount").text(num);
            // console.log(num);
            if(num==0){
                // alert(1);
                clearInterval (timer1);
                go();
            }
        }, 1000);
    }
    function go(){
        $(".placeaa").show();
        setInterval(() => {
            location.href='user_mrg.php?id=<?php echo $_GET['id']; ?>';    
        }, 5000);
    }
    function user_table(){
        $.post({
            async:false,
            url:"call_mrg.php?call=3",
            data:{
                fw:$("#fw").val(),
                kw:$("#kw").val(),
                sorted:$("#sorted").val(),
            },
            success:function(e){
                let list = e.split("(+)");
                list.pop();
                $(".newtr").remove();
                for(let i=0;i<list.length;i++){
                    let arr=JSON.parse(list[i]);
                    if(arr['rank']=='3'){
                        arr['rank']="管理者";
                    }else if(arr['rank']=='2'){
                        arr['rank']="管理者";
                    }else{
                        arr['rank']="一般使用者";
                    }
                    $("#user_table").append(`
                        <tr class="tr${i} newtr">
                            <td class="td${i}">${arr['id']}</td>
                            <td class="td${i}">${arr['user']}</td>
                            <td class="td${i}">${arr['name']}</td>
                            <td class="td${i}">${arr['password']}</td>
                            <td class="td${i}">${arr['rank']}</td>
                        </tr>
                    `);
                    if(arr['id']!='0000'){
                        $(".tr"+i).append(`
                            <td>
                                <button type="button" onclick="del('${arr['id']}')">刪除</button>
                                <button type="button" onclick="edit(${i})">修改</button>
                            </td>
                        `);
                    }else{
                        $(".tr"+i).append(`
                            <td></td>
                        `);
                    }
                }
            },
        });
    }
    function edit(textt){
        console.log(textt)
        $("#true_id").val($('.td'+textt+":eq(0)").text());
        $("#ed_id").val($('.td'+textt+":eq(1)").text())
        $("#ed_pwd").val($('.td'+textt+":eq(3)").text())
        $("#ed_name").val($('.td'+textt+":eq(2)").text())
        if($('.td'+textt+":eq(4)").text()=="管理者"){
            $(".ed_options:eq(1)").attr('selected');
        }else{
            $(".ed_options:eq(0)").attr('selected');
        }
        $(".place:eq(1)").dialog("open");
    }
    function del(text){
        $.post({
            async:false,
            url:"call_mrg.php?call=4",
            data:{
                id:text,
            },
            success:function(e){
                user_table();
            },
        });
    }
</script>
</html>