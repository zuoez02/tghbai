<?php
session_start();
//将name写入session
$ID=$_GET['ID'];
$Lastweek=99999;
$mysql = new SaeMysql();
$sql = "select * from Users where Users_WeixinNumber='$ID'";
$tghbais = $mysql->getData($sql);
if(!empty($tghbais))
{
    foreach ($tghbais as $tghbai)
    { 
        $name = $tghbai['Users_Name'];
        $Group = $tghbai['Users_Group'];
        $Lastweek = $tghbai['Laseweek'];
    }
    $_SESSION['Users_Name'] = $name;
}
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
		</style>
        <meta http-equiv="Content-Type" content="text/html; charset=utf8">
        <title>考研圈</title>
        <base target="_blank" />
    </head>        
    <body style="padding:0px">
        <h1 align="center"><img src="http://tghbai-website.stor.sinaapp.com/Logo_Yan.png" width="70px"><br/></h1>
        
        <div id="container">        
        <div data-role="navbar" id="navbar">
            <ul data-theme="d">                
                <li style="text-indent: 0;"><a href="notice.php"  data-ajax="false"><span>上周奖励名单</span></a></li>
                <li style="text-indent: 0;"><a href="http://wx.wsq.qq.com/182095151/"  data-ajax="false"><span>微社区</span></a></li>
                <li style="text-indent: 0;"><a href="wx_database.php"  data-ajax="false"><span>签到表</span></a></li>
            </ul>
        </div>   
        <div id="main">
		<a href="http://pan.baidu.com/s/1eQ9TJzG" data-ajax="false">
			<div class="category-cover" style="background-image:url(http://tghbai-website.stor.sinaapp.com/index0.jpg);" >
				<div class="category-title " style="background:#ffa22a;">
					<p>网盘资料<br />
                        <span>提取密码:g2su</span>
					</p>
				</div>
			</div>
		</a>
		<a href="http://mp.weixin.qq.com/s?__biz=MzA5NTI5NDAxOQ==&mid=10001125&idx=1&sn=e6656a88d78b2e993df380d9a2c62b06#rd" data-ajax="false">
			<div class="category-cover" style="background-image:url(http://tghbai-website.stor.sinaapp.com/index2.jpg);">
				<div class="category-title right" style="background:#801ac0;">
					<p>签到说明<br />
						<span>签到规则变更说明</span>
					</p>
				</div>
			</div>
		</a>
		<a href="http://mp.weixin.qq.com/s?__biz=MzA5NTI5NDAxOQ==&mid=10000043&idx=1&sn=f0e280f193965ef64dbc2805d4cb634e#rd" data-ajax="false">
			<div class="category-cover" style="background-image:url(http://tghbai-website.stor.sinaapp.com/index3.jpg);">
				<div class="category-title " style="background:#0ea497;">
					<p>考研圈手册<br />
						<span>关于考研圈资料下载说明</span>
					</p>
				</div>
			</div>
		</a>
		<a href="http://mp.weixin.qq.com/s?__biz=MzA5NTI5NDAxOQ==&mid=10000200&idx=1&sn=f3d89b1142cb8588a39eef9d13e54a41#rd" data-ajax="false">
			<div class="category-cover" style="background-image:url(http://tghbai-website.stor.sinaapp.com/index4.jpg);">
				<div class="category-title right" style="background:#207eff;">
					<p>直播视频<br />
						<span>近期直播课程信息</span>
					</p>
				</div>
			</div>
		</a>
        <a href="http://tghbai.sinaapp.com/video/0001.php" data-ajax="false">
			<div class="category-cover" style="background-image:url(http://tghbai-website.stor.sinaapp.com/index5.jpg);">
				<div class="category-title " style="background:#c0a22a;">
					<p>在线视频<br />
						<span>建议在wifi环境下观看视频</span>
					</p>
				</div>
			</div>
		</a>
	</div>
            
            <?php
				if($Group > 0||$Lastweek <= 0)
                {
                   ?>
            		仅获奖者可以看见此入口<a href="http://tghbai.sinaapp.com/BBSmini/BBSindex.php" ><u>进入mini论坛</u></a>
            		<?php
                }
            ?>
            
            
    <div id="footer">
        <center><span>&copy;2014 考研圈</span>&nbsp; <img src="http://tghbai-website.stor.sinaapp.com/Logo_Yan_500_160.png" width="50px"/> &nbsp;
        <span>kaoyan_quan</span></center>
	</div> 

</div>   
    </body>
</html>