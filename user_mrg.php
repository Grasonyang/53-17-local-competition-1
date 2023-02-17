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
    <button onclick="location.href='call_mrg.php?call=6&id=<?php echo $_GET['id']; ?>'">登出</button>
    <button onclick="location.href='userr_mrgg.php?id=<?php echo $_GET['id']; ?>'">會員管理</button>
    
</body>
<script>
</script>
</html>