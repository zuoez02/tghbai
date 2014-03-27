<?php
session_start();
?>
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
    <title>考研圈miniBBS</title>
    <base target="_blank" />
</head>
    <!--以上为标题设置-->
<body>
    <?
		if($_GET['event'] == 1)//表示已经点击发布消息确认按钮
        {
            $name = $_SESSION['Users_Name'];//读取session里面的用户名
            $news = $_GET['news'];//读取消息发布框返回的消息内容
            $time = time();//读取消息创建时间
            $sign = $_GET['sign'];//读取消息标记信息
            $father = $_GET['father'];//读取消息的父类
            $level = $_GET['level'];//读取消息等级
            if($level == 1)//消息等级为1表示为发布状态
            {
                $mysql = new SaeMysql();
                $sql = "select * from Datas where User='Level=1内容标'";//读取标记消息标志
                $tghbais = $mysql->getData($sql);   
                if(!empty($tghbais))
                {
                    foreach ($tghbais as $tghbai)
                    { 
                        $sign=$tghbai['Substance_sign']+1;//标记消息标志自增
                    }
                }
                $mysql = new SaeMysql();//将变更后的标记消息标志写入数据库
                $sql = "UPDATE Datas SET `Substance_sign` = '$sign' WHERE `User` LIKE 'Level=1内容标'";
                $mysql->runSql( $sql );
            }
            if($level == 2)// 消息等级为2表示为回复消息
            {
                $father = $sign;//回复消息的父类为父类消息的标志值
                $sign=0;//回复消息消息标记为0
            }
            //将发布消息这用户名、消息内容、发布消息时间、消息父类信息、消息标记信息、消息等级存入数据库
            $mysql = new SaeMysql();
            $sql = "INSERT INTO Datas VALUES ('$name','$news','$time','$father','$sign','$level')";
            $mysql->runSql( $sql ); 
        }
    ?>
    <div data-role="header" data-theme="b"> <h1>考研圈miniBBS</h1>  </div><!--标题考研圈miniBBS-->
    <?php
	if($_SESSION['Users_Name'] == null)//session中的名字为空表示为登录，提示登录
    {
        ?>
    	<div align=right><a>未登录</a>&nbsp;&nbsp;<a href="Login.php" ><u>点击登录</u></a></div>
    	<?php
    }
	else//表示已经登录
    {
        ?>
    	<div align=right><a>已登录&nbsp;&nbsp;<?php echo $_SESSION['Users_Name'];?></a></div>
    	<?php
    }
    ?>
    <!--论坛标志-->
    <h1 align="center"><a href="http://tghbai.sinaapp.com/index.php" ><img style="width:240px" src="http://tghbai-website.stor.sinaapp.com/Logo_Yan_500_160.png" /></a></h1>
    <!--发布状态按钮-->
    <form action ="news.php" method ="get">
        <input type="hidden" name="father" value="0"/>
        <input type="hidden" name="level" value="1"/>
		<input type ="submit" value="发表状态" />
	</form>
    <?php
			//展示内容列表为等级为1的消息（状态消息），读取一部分展示
			$mysql = new SaeMysql();
			$sql = "SELECT * FROM `Datas` where Level='1' ORDER BY `Datas`.`Substance_sign` DESC LIMIT 0 , 30";
			$datas = $mysql->getData($sql);			
			if(!empty($datas)){
				foreach ($datas as $data) {	
					$a = $data['User'];
					$b = $data['Substance'];
					$c = $data['Time'];
                    $date = date('y-m-d H:i:s',$c);
					$d = $data['Father'];
					$e = $data['Substance_sign'];
                    $f = $data['Level'];
                    ?>
    					<div data-role="collapsible">
      						<h1>
                                <div style=" font-size:12px;"><?php echo $a;?>&nbsp;&nbsp;<?php echo $date;?></div>
                            	<div style="color:black;font-size:15px;"><?php echo $b;?></div>
                            </h1>
                            <!--显示评论按钮-->
                            <form action ="news.php" method ="get">
                            <input type="hidden" name="sign" value="<?php echo $e;?>"/>
                            <input type="hidden" name="level" value="2"/>
                            <input type ="submit" value="评论" />
							</form>
                            <?php
                    		Reply($e);//显示评论消息
                            ?>
                        </div>
    				<?php
				}
			}else{
				echo "null";
			}
	?> 
    <!--显示页面底部-->
    <div id="footer">
        <right><a target="_blank" href="http://shang.qq.com/wpa/qunwpa?idkey=b04d6ce9ab36f9b52d0a2d8e727d0f12ecc4c09488325cfe9bb889bd1dbe0c94"><img border="0" src="http://pub.idqqimg.com/wpa/images/group.png" alt="考研圈" title="考研圈">点击加入考研圈QQ群</a></right>

        <center><span>&copy;2014 考研圈</span>&nbsp; <img src="http://tghbai-website.stor.sinaapp.com/Logo_Yan_500_160.png" width="50px"/> &nbsp;
            <span>kaoyan_quan</span></center>

	</div>  
</body>

</html>
<?php
function Reply($e)
{
    //读取父类为$e的消息（状态的回复）
    $mysql = new SaeMysql();
    //按照回复时间先后顺序读取
	$sql = "SELECT * FROM `Datas` where Father='$e'AND Level='2' ORDER BY `Datas`.`Time`";
	$replys = $mysql->getData($sql);
    if(!empty($replys))
   	{
        foreach ($replys as $reply) {
            $a = $reply['User'];
			$b = $reply['Substance'];
			$c = $reply['Time'];
            $date = date('y-m-d H:i:s',$c);
            $d = $reply['Father'];
            $e1 = $reply['Substance_sign'];
            $f = $reply['Level'];
            $g1 = $reply['num'];                                     
            ?>
				<!--显示回复消息-->
               <div>
                   <h1>
                       <div style=" font-size:12px;"><?php echo $a;?>&nbsp;&nbsp;<?php echo $date;?></div>
                       <div style="color:black;font-size:15px;"><?php echo $b;?></div>
                   </h1>
               </div>
            <?php
                                            
         }
   }
}
?>