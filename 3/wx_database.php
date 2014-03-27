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
<body>
    <h1 align="center"><a href="index.php" ><img style="width:240px" src="<?php $s=new SaeStorage;echo $s->getUrl("website","Logo_Yan_500_160.png");?>"width="400px" /></a></h1>
    <div data-role="header" data-theme="b"> <h1>签到记录表</h1>  </div> 
    <div style="float:none;">
        
       <b><font size="50"><p style="text-align:center;font-size:larger;"><span>选择排序方式:</span></p></font></b>
        
        <form action="wx_database.php" method="post" align="center">
            <table style="width: 100%;">
                <tr>
                    <td style="width:48%;padding-bottom:10px;">
                        <select name='way'>
                            <option value="TotalScore" selected="selected">总积分</option>
                            <option value="WeekScore">周积分</option>
                            <option value="TodayScore">今日积分</option>   		
                        </select>                        
                    </td>           
                    <td style="width:48%;height:1;padding-bottom:10px;">
                        <input type="submit" style='font-size:50px' value="确定" style="width:10px;height:10px" >          
                    </td>
                </tr>
            </table>
        </form>
    </div>
	<table border="1" align="center" style="color:balck" width=100%>
		<tr>
            <td><center><font color="blue"><span>序号</span></font></center></td>
            <td><center><font color="blue"><span>用户名</span></font></center></td>
            <td><center><font color="blue"><span>总积分</span></font></center></td>
            <td><center><font color="blue"><span>周积分</span></font></center></td>
            <td><center><font color="blue"><span>今日积分</span></font></center></td>
            <td><center><font color="blue"><span>今日签到否</span></font></center></td>
            <td><center><font color="blue"><span>签到时间</span></font></center></td>
		</tr>
		<?php
			$mysql = new SaeMysql();
			$way = $_POST['way'];
			if(empty($way)){
				$sql = "SELECT * FROM Users ORDER BY Users_TotalScore DESC";
			}elseif($way=='TodayScore'){				
				$sql = "SELECT * FROM Users ORDER BY Users_TodayScore DESC";
			}else{
				$sql = "SELECT * FROM Users ORDER BY Users_$way DESC";
			}
			$users = $mysql->getData($sql);	
			if(!empty($users)){
                $a=0;
				foreach ($users as $user) {	
                    $a++;
					$b = $user['Users_Name'];
					$d = $user['Users_TotalScore'];
					$e = $user['Users_WeekScore'];
					$f = $user['Users_TodayScore'];
					$h = $user['HasSigned'];
                    if($h==1){
                        $h="是";
                    }
                    else $h="否";
					$i = $user['Users_SignTime'];
					$date = date('m-d H:i',$i);               
					echo "<tr>";
                    echo "<td><center><span>$a</span></center></td>";
                    echo "<td><center><span>$b</span></center></td>";
					echo "<td><center><span>$d</span></center></td>";
					echo "<td><center><span>$e</span></center></td>";
                    echo "<td><center><span>$f</span></center></td>";
					echo "<td><center><span>$h</span></center></td>";
					echo "<td><center><span>$date</span></center></td>";
					echo "</tr>";                   
				}
			}
		?>
	</table>
    <div id="footer">
        <center><span>&copy;2014 考研圈</span>&nbsp; <img src="http://tghbai-website.stor.sinaapp.com/Logo_Yan_500_160.png" width="50px"/> &nbsp;
        <span>kaoyan_quan</span></center>
	</div>  
</body>
</html>