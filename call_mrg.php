<?php
    include 'connect.php';
    if(!isset($_SESSION['wrong_time'])){
        $_SESSION['wrong_time']=0;
    }
    if(!empty($_POST)){
        if($_GET['call']==1){
            $row1=mysqli_query($db,"SELECT * FROM `user` WHERE `user` LIKE '$_POST[log_id]'");
            if(mysqli_num_rows($row1)){
                $row2=mysqli_query($db,"SELECT * FROM `user` WHERE `user` LIKE '$_POST[log_id]' AND `password` LIKE '$_POST[log_pwd]'");
                if(mysqli_num_rows($row2)){
                    if($_POST['img_code_sort']==$_POST['img_code_sorted']){
                        $arr=mysqli_fetch_array($row2);
                        mysqli_query($db,"INSERT INTO `user_web`(`user`, `action`, `time`, `sf`) VALUES 
                        ('$arr[user]','登入','$time','成功')");
                        $_SESSION['wrong_time']=0;
                        if($arr['rank']=='3' || $arr['rank']=='2'){
                            echo "
                                <script>
                                    alert('成功');
                                    location.href='twwrf.php?call=1&id=$arr[id]';
                                </script>
                            ";
                        }else{
                            echo "
                                <script>
                                    alert('成功');
                                    location.href='twwrf.php?call=2&id=$arr[id]';
                                </script>
                            ";
                        }
                    }else{
                        mysqli_query($db,"INSERT INTO `user_web`(`user`, `action`, `time`, `sf`) VALUES 
                        ('$arr[user]','登入','$time','失敗')");
                        $_SESSION['wrong_time']++;
                        if($_SESSION['wrong_time']==3){
                            $_SESSION['wrong_time']=0;
                            header('Location:wrong.php');
                        }else{
                            echo "
                                <script>
                                    alert('驗證碼錯誤');
                                    location.href='index.php';
                                </script>
                            ";
                        }
                    }
                }else{
                    mysqli_query($db,"INSERT INTO `user_web`(`user`, `action`, `time`, `sf`) VALUES 
                    ('$arr[user]','登入','$time','失敗')");
                    $_SESSION['wrong_time']++;
                    if($_SESSION['wrong_time']==3){
                        $_SESSION['wrong_time']=0;
                        header('Location:wrong.php');
                    }else{
                        echo "
                            <script>
                                alert('密碼錯誤');
                                location.href='index.php';
                            </script>
                        ";
                    }
                }
            }else{
                mysqli_query($db,"INSERT INTO `user_web`(`user`, `action`, `time`, `sf`) VALUES 
                ('$arr[user]','登入','$time','失敗')");
                $_SESSION['wrong_time']++;
                if($_SESSION['wrong_time']==3){
                    $_SESSION['wrong_time']=0;
                    header('Location:wrong.php');
                }else{
                    echo "
                        <script>
                            alert('帳號錯誤');
                            location.href='index.php';
                        </script>
                    ";
                }
            }
        }else if($_GET['call']==2){
            mysqli_query($db,"INSERT INTO `user`(`user`, `name`, `password`, `rank`) VALUES
            ('$_POST[id]','$_POST[name]','$_POST[pwd]','$_POST[rank]')");
            header("Location:userr_mrgg.php");
        }else if($_GET['call']==3){
            // $row="";
            $fw=$_POST['fw'];
            if($_POST['kw']!=""){
                $row=mysqli_query($db,"SELECT * FROM `user` WHERE (`user` LIKE '$_POST[kw]') || 
                (`name` LIKE '$_POST[kw]') || 
                (`password` LIKE '$_POST[kw]') || 
                (`rank` LIKE '$_POST[kw]') ORDER BY `user`.`$fw` $_POST[sorted]");
            }else{
                $row=mysqli_query($db,"SELECT * FROM `user` ORDER BY `user`.`$fw` $_POST[sorted]") ;
            }
            while($arr=mysqli_fetch_array($row)){
                echo json_encode($arr)."(+)";
            }
        }else if($_GET['call']==4){
            mysqli_query($db,"DELETE FROM `user` WHERE `id` LIKE '$_POST[id]'");
        }else if($_GET['call']==5){
            mysqli_query($db,"UPDATE `user` SET `user`='$_POST[id]',`name`='$_POST[name]',`password`='$_POST[pwd]',`rank`='$_POST[rank]' WHERE `id` LIKE '$_POST[true_id]'");
            header("Location:userr_mrgg.php");
        }
    }
    if($_GET['call']==6){
        mysqli_query($db,"INSERT INTO `user_web`(`user`, `action`, `time`) VALUES 
        ('$arr[user]','登出','$time')");
        header('Location:index.php');
    }
?>