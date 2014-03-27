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
        <h1 align="center"><a href="http://tghbai.sinaapp.com/index.php" ><img style="width:240px" src="http://tghbai-website.stor.sinaapp.com/Logo_Yan_500_160.png" /></a></h1>
        <center><h2>上周获奖同学名单</h2></center>
        <table border="1" align="center" style="color:balck" width=100%>
            <tr>
                <td><center><font color="blue"><span>序号</span></font></center></td>
                <td><center><font color="blue"><span>用户名</span></font></center></td>
            </tr>
            <?php
            $mysql = new SaeMysql();
            $sql = "SELECT * FROM Users ORDER BY Laseweek LIMIT 0 , 3";
            $users = $mysql->getData($sql);
                if(!empty($users)){
                    $a=0;
                    foreach ($users as $user) {	
                        $a++;
                        $b = $user['Users_Name'];            
                        echo "<tr>";
                        echo "<td><center><span>$a</span></center></td>";
                        echo "<td><center><span>$b</span></center></td>";
                        echo "</tr>";                   
                    }
                }
            ?>
        </table>
        <center><h2>请获奖同在主页最下面特殊通道进去留下QQ号，方便联系发送奖励（特殊通道仅获奖同学可见）</h2></center>
    <div id="footer">
        <center><span>&copy;2014 考研圈</span>&nbsp; <img src="http://tghbai-website.stor.sinaapp.com/Logo_Yan_500_160.png" width="50px"/> &nbsp;
            <span>kaoyan_quan</span></center>
	</div> 
    </body>
</html>