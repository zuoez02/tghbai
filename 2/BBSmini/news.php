<?php
session_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" />
        <link href="http://tghbai.sinaapp.com/head/main.css" rel="stylesheet" />
        <script src="http://tghbai.sinaapp.com/head/jquery.min.js"></script>
        <script src="http://tghbai.sinaapp.com/head/main.js"></script>
        <link href="http://tghbai.sinaapp.com/head/jquery.mobile-1.3.1.css" rel="stylesheet" />
        <script src="http://tghbai.sinaapp.com/head/jquery.mobile-1.3.1.js"></script>
        <link rel="Shortcut Icon" href="http://tghbai-website.stor.sinaapp.com/Logo.ico" > 
        <style>
           body{background-color:#C7C7E2}
           #searchdiv{
            width:auto; height:40px; line-height:40px; float:left; overflow:hidden; font-size:20px;margin:20px;
            }
        </style>
        <meta http-equiv="Content-Type" content="text/html; charset=utf8">
        <title>考研圈</title>
        <base target="_blank" />        
    </head> 
    <?php
		//获取发布按钮传递过来的内容
		$father = $_GET['father'];
		$level = $_GET['level'];
		$sign = $_GET['sign'];
		//读取session中的值并判断，如果session为空，表示没有登录
        if($_SESSION['Users_Name'] == null)
        {
        ?>
        <body>
            <!--跳转至登录提示页面-->
            <h1 align="center"><a href="http://tghbai.sinaapp.com/index.php" ><img style="width:240px" src="http://tghbai-website.stor.sinaapp.com/Logo_Yan_500_160.png" /></a></h1>
            <form action ="Login.php">
                <center><b>您还未登录，请先登录</b></center>
                <input type ="submit" value="点击进入登录页面" />
            </form>
            <!--显示页面底部-->
            <div id="footer">
                <center><span>&copy;2014 考研圈</span>&nbsp; <img src="http://tghbai-website.stor.sinaapp.com/Logo_Yan_500_160.png" width="50px"/> &nbsp;
                <span>kaoyan_quan</span></center>
			</div>
        </body>
        <?php
        }
		//表示用户已经登录
        else
        {			            
        ?>
        <body>
            <!--显示文本输入框，发布按钮-->
            <h1 align="center"><a href="index.php" ><img style="width:240px" src="http://tghbai-website.stor.sinaapp.com/Logo_Yan_500_160.png" /></a></h1>
            <form action ="BBSindex.php" method ="get">
                <!--传递隐形参数-->
                <input type="hidden" name="father" value="<?php echo $father;?>"/>
                <input type="hidden" name="level" value="<?php echo $level;?>"/>
                <input type="hidden" name="sign" value="<?php echo $sign;?>"/>
                <!--event=1表示从点过发布按钮，返回值首页并且将内容发布写入数据库-->
                <input type="hidden" name="event" value="1"/>
                发表内容: <center><textarea name="news" style="height:150px;width:96%" ></textarea></center>
            	<input type ="submit" value="确认发布" />
            </form>
			<!--显示页面底部-->
            <div id="footer">
                <center><span>&copy;2014 考研圈</span>&nbsp; <img src="http://tghbai-website.stor.sinaapp.com/Logo_Yan_500_160.png" width="50px"/> &nbsp;
                <span>kaoyan_quan</span></center>
			</div>
        </body>
        <?php
        }
     ?> 
</html>