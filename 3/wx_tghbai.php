<?php
session_start();
?>
<?php
//装载模板文件
include_once("wx_tpl.php");
include_once("base-class.php");
include_once("youdao.php");
include_once("base_class.php");
include_once("weather.php");
include_once("xiaowanrobt.php");
//新建sae数据库类
$mysql = new SaeMysql();

//新建Memcache类
//$mc=memcache_init();

//获取微信发送数据
$postStr = $GLOBALS["HTTP_RAW_POST_DATA"];

if (!empty($postStr)){
          
    //解析数据
    $postObj = simplexml_load_string($postStr, 'SimpleXMLElement', LIBXML_NOCDATA);
    //发送消息方ID
    $fromUsername = $postObj->FromUserName;
    //接收消息方ID
    $toUsername = $postObj->ToUserName;
    //消息类型
    $form_MsgType = $postObj->MsgType;
    //消息时间
    $createTime = $postObj->CreateTime;
    //写入name
    $sql = "select * from Users where Users_WeixinNumber='$fromUsername'";
	$tghbais = $mysql->getData($sql);
    if(!empty($tghbais))
    {
        foreach ($tghbais as $tghbai)
        { 
            $name = $tghbai['Users_Name'];
        }
    }
    //针对订阅消息的欢迎消息
    if($form_MsgType=="event"){
        //获取事件类型
        $form_Event = $postObj->Event;
        //订阅事件
        if($form_Event=="subscribe"){
            //回复欢迎图文菜单
            $resultStr="<xml>\n
            <ToUserName><![CDATA[".$fromUsername."]]></ToUserName>\n
            <FromUserName><![CDATA[".$toUsername."]]></FromUserName>\n
            <CreateTime>".time()."</CreateTime>\n
            <MsgType><![CDATA[news]]></MsgType>\n
            <ArticleCount>4</ArticleCount>\n
            <Articles>\n";
              
            //添加封面图文消息
            $resultStr.="<item>\n
            <Title><![CDATA[]]></Title> \n
            <Description><![CDATA[]]></Description>\n
            <PicUrl><![CDATA[http://tghbai-kaoyanquan2weima.stor.sinaapp.com/kaoyanquan2weima.jpg]]></PicUrl>\n
            <Url><![CDATA[]]></Url>\n
            </item>\n";
                
            $resultStr.="<item>\n
            <Title><![CDATA[考研圈欢迎您的加入！目前只有部分功能开放，回复“help”查看帮助信息，点击查看《考研圈手册》]]></Title> \n
            <Description><![CDATA[]]></Description>\n
            <PicUrl><![CDATA[http://tghbai-kaoyanquanrizhi.stor.sinaapp.com/shouce.png]]></PicUrl>\n
            <Url><![CDATA[http://mp.weixin.qq.com/s?__biz=MzA5NTI5NDAxOQ==&mid=10000043&idx=1&sn=f0e280f193965ef64dbc2805d4cb634e#rd]]></Url>\n
            </item>\n";
            
            $resultStr.="<item>\n
            <Title><![CDATA[考研圈签到须知，了解详细内容请点击查看！]]></Title> \n
            <Description><![CDATA[]]></Description>\n
            <PicUrl><![CDATA[http://tghbai-kaoyanquanrizhi.stor.sinaapp.com/qiandaorizhi.jpg]]></PicUrl>\n
            <Url><![CDATA[http://mp.weixin.qq.com/s?__biz=MzA5NTI5NDAxOQ==&mid=10001125&idx=1&sn=e6656a88d78b2e993df380d9a2c62b06#rd]]></Url>\n
            </item>\n";
            
            $resultStr.="<item>\n
            <Title><![CDATA[考研圈主页，点击查看！]]></Title> \n
            <Description><![CDATA[]]></Description>\n
            <PicUrl><![CDATA[http://tghbai-kaoyanquan2weima.stor.sinaapp.com/kaoyanquantubiao.jpg]]></PicUrl>\n
            <Url><![CDATA[http://2.tghbai.sinaapp.com/index.php]]></Url>\n
            </item>\n";
            
            $resultStr.="</Articles>\n
            <FuncFlag>0</FuncFlag>\n
            </xml>";
              
            echo $resultStr;           
            exit;
        }
        //取消关注事件
        if($form_Event=="unsubscribe"){
            $roster_value=$mysql->getLine("select * from Users where Users_WeixinNumber='$fromUsername'");
            if(!empty($roster_value)){
                //删除数据库中的相关消息
                $sql = "DELETE FROM Users WHERE Users_WeixinNumber = '$fromUsername'";
                $mysql->runSql($sql);
                if( !$mysql->errno() == 0 )
                {
                    echo "error";
                    exit;
                }
                 	echo " delete success";
            		exit; 
            }
            echo " - did not found";
            exit;       
        }
    }
    if($form_MsgType=="text"){
        //获取用户发送的文字内容并过滤
        $form_Content = trim($postObj->Content);
        $form_Content = string::un_script_code($form_Content);
        if(!empty($form_Content)){
            //从memcache获取用户上一次动作
            // $last_do=$mc->get($fromUsername."_do");
            //从memcache获取用户上一次数据
            // $last_data=$mc->get($fromUsername."_data");

            //帮助信息
            if(strtolower($form_Content)=='help'){
                $resultStr="<xml>\n
                <ToUserName><![CDATA[".$fromUsername."]]></ToUserName>\n
                <FromUserName><![CDATA[".$toUsername."]]></FromUserName>\n
                <CreateTime>".time()."</CreateTime>\n
                <MsgType><![CDATA[news]]></MsgType>\n
                <ArticleCount>1</ArticleCount>\n
                <Articles>\n";
                
                //添加封面图文消息
                $resultStr.="<item>\n
                <Title><![CDATA[点击查看帮助]]></Title> \n
                <Description><![CDATA[]]></Description>\n
                <PicUrl><![CDATA[http://tghbai-kaoyanquanrizhi.stor.sinaapp.com/help.jpg]]></PicUrl>\n
                <Url><![CDATA[http://mp.weixin.qq.com/s?__biz=MzA5NTI5NDAxOQ==&mid=200061669&idx=1&sn=0493498e3dcad63c6a6c2a44bdf884c9#rd]]></Url>\n
                </item>\n";
                    
                $resultStr.="</Articles>\n
                <FuncFlag>0</FuncFlag>\n
                </xml>";
                 
                echo $resultStr;
                exit; 
            }
            //主页
            if(strtolower($form_Content)=='/:8-)'){
                $url = "http://tghbai.sinaapp.com/index.php?ID=".$fromUsername;
                if($name!=NUll)
                {
                   $scripte = "提示：您将以".$name."的昵称出现在MiniBBS中！";   
                }
                else
                {
                    $scripte = "提示：您还未绑定账号，只能以游客身份进入浏览，不能回复或评论，如果想回复或评论，请先绑定，然后再重新发送表情[得意]，获取登录链接，回复“bd+昵称”进行绑定！如“bd小明”";
                }
                
                $resultStr="<xml>\n
                <ToUserName><![CDATA[".$fromUsername."]]></ToUserName>\n
                <FromUserName><![CDATA[".$toUsername."]]></FromUserName>\n
                <CreateTime>".time()."</CreateTime>\n
                <MsgType><![CDATA[news]]></MsgType>\n
                <ArticleCount>1</ArticleCount>\n
                <Articles>\n";
                 
                $resultStr.="<item>\n
                <Title><![CDATA[点击访问主页]]></Title> \n
                <Description><![CDATA[".$scripte."]]></Description>\n
                <PicUrl><![CDATA[]]></PicUrl>\n
                <Url><![CDATA[".$url."]]></Url>\n
                </item>\n";
                
                $resultStr.="</Articles>\n
                <FuncFlag>0</FuncFlag>\n
                </xml>";
                  
                echo $resultStr;
                exit;
                
            }   
            //聊天室
            if(strtolower($form_Content)=='/:share'){
                $resultStr="<xml>\n
                <ToUserName><![CDATA[".$fromUsername."]]></ToUserName>\n
                <FromUserName><![CDATA[".$toUsername."]]></FromUserName>\n
                <CreateTime>".time()."</CreateTime>\n
                <MsgType><![CDATA[news]]></MsgType>\n
                <ArticleCount>5</ArticleCount>\n
                <Articles>\n";
                 
                $resultStr.="<item>\n
                <Title><![CDATA[聊天室列表]]></Title> \n
                <Description><![CDATA[]]></Description>\n
                <PicUrl><![CDATA[]]></PicUrl>\n
                <Url><![CDATA[]]></Url>\n
                </item>\n";
                  
                //添加封面图文消息
                $resultStr.="<item>\n
                <Title><![CDATA[聊天室一]]></Title> \n
                <Description><![CDATA[]]></Description>\n
                <PicUrl><![CDATA[http://tghbai-kaoyanquan2weima.stor.sinaapp.com/liaotianshi.png]]></PicUrl>\n
                <Url><![CDATA[http://weixin.qq.com/g/AjZ2DKTqI_tY9uR2QxSF]]></Url>\n
                </item>\n";
                  
                //添加封面图文消息
                $resultStr.="<item>\n
                <Title><![CDATA[聊天室二]]></Title> \n
                <Description><![CDATA[]]></Description>\n
                <PicUrl><![CDATA[http://tghbai-kaoyanquan2weima.stor.sinaapp.com/liaotianshi.png]]></PicUrl>\n
                <Url><![CDATA[http://weixin.qq.com/g/CTRvSn6R8WqKjT7xQzWO]]></Url>\n
                </item>\n";
                
                //添加封面图文消息
                $resultStr.="<item>\n
                <Title><![CDATA[聊天室三]]></Title> \n
                <Description><![CDATA[]]></Description>\n
                <PicUrl><![CDATA[http://tghbai-kaoyanquan2weima.stor.sinaapp.com/liaotianshi.png]]></PicUrl>\n
                <Url><![CDATA[http://weixin.qq.com/g/zDVMSiw67QWWJmyBQylL]]></Url>\n
                </item>\n";
                
                //添加封面图文消息
                $resultStr.="<item>\n
                <Title><![CDATA[聊天室四]]></Title> \n
                <Description><![CDATA[]]></Description>\n
                <PicUrl><![CDATA[http://tghbai-kaoyanquan2weima.stor.sinaapp.com/liaotianshi.png]]></PicUrl>\n
                <Url><![CDATA[http://weixin.qq.com/g/oj7KEczc_wSAwIy3Q70l]]></Url>\n
                </item>\n";
                                 
                $resultStr.="</Articles>\n
                <FuncFlag>0</FuncFlag>\n
                </xml>";
                  
                echo $resultStr;
                exit;
            }
            //有道翻译
            if(strncasecmp($form_Content,"/:,@f",5)==0){
    
                $msgType = "text";
                $contentStr = youdaoDic($form_Content);
                $resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
                echo $resultStr;
                exit;
                
            }
            //天气预报查询
            if(strncasecmp($form_Content,"/:?",3)==0){
    
                $msgType = "text";
                $contentStr = weatherdic($form_Content);
                $resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
                echo $resultStr;
                exit;
                
            }
            
            //绑定
            if(strncasecmp($form_Content,"bd",2)==0){
                //判断是否已经绑定
                $roster_value=$mysql->getLine("select * from Users where Users_WeixinNumber='$fromUsername'");
                if(empty($roster_value)){
                    $user_name = substr($form_Content,2,strlen($form_Content)-2);
                    $roster_value=$mysql->getLine("select * from Users where Users_Name='$user_name'");
                    //判断是否输入了有效昵称
                    if(empty($user_name)){
                        $msgType = "text";
                        $contentStr = "绑定失败，您未输入昵称";
                        $resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
                        echo $resultStr;
                        exit;  
                    }
                    //判断是否有昵称重复
                    if(!empty($roster_value)){
                        $msgType = "text";
                        $contentStr = "绑定失败，该昵称已经被使用了，请换一个重试";
                        $resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
                        echo $resultStr;
                        exit;      
                    }
                    //绑定入数据库
                    $sql = "INSERT INTO Users (Users_WeixinNumber,Users_Name) VALUES ('$fromUsername','$user_name')";
                    $mysql->runSql( $sql );     
                    $msgType = "text";
                    $contentStr = "绑定成功，您的昵称为“".$user_name."”，这是你签到的唯一身份标识！现在起您可以参与签到排序了，回复/:strong试试！";
                    $resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
                    echo $resultStr;
                    exit; 
                }else{
                    //已绑定，无需再绑定
                    $msgType = "text";
                    $contentStr = "绑定失败，您已经绑定过了，不需要再次绑定";
                    $resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
                    echo $resultStr;
                    exit;
                }                
                
            }
            
            //签到功能
            if(strtolower($form_Content)=='qd'){
                	$msgType = "text";
                    $contentStr = "为了简化签到方式，即日起签到方式改为，回复表情/:strong即可完成签到！";
                    $resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
                    echo $resultStr;
                    exit;
                }
            if(strtolower($form_Content)=='/:strong'){
                //判断是否已经绑定
                $roster_value=$mysql->getLine("select * from Users where Users_WeixinNumber='$fromUsername'");
                if(empty($roster_value)){
                    //没有绑定返回绑定提示                   
                    $resultStr="<xml>\n
                    <ToUserName><![CDATA[".$fromUsername."]]></ToUserName>\n
                    <FromUserName><![CDATA[".$toUsername."]]></FromUserName>\n
                    <CreateTime>".time()."</CreateTime>\n
                    <MsgType><![CDATA[news]]></MsgType>\n
                    <ArticleCount>2</ArticleCount>\n
                    <Articles>\n";
                      
                    $resultStr.="<item>\n
                    <Title><![CDATA[您尚未绑定，请绑定后再签到吧！]]></Title> \n
                    <Description><![CDATA[]]></Description>\n
                    <PicUrl><![CDATA[]]></PicUrl>\n
                    <Url><![CDATA[]]></Url>\n
                    </item>\n";
                        
                    $resultStr.="<item>\n
                    <Title><![CDATA[查看如何绑定]]></Title> \n
                    <Description><![CDATA[]]></Description>\n
                    <PicUrl><![CDATA[http://tghbai-kaoyanquanrizhi.stor.sinaapp.com/qiandaorizhi.jpg]]></PicUrl>\n
            		<Url><![CDATA[http://mp.weixin.qq.com/s?__biz=MzA5NTI5NDAxOQ==&mid=10001125&idx=1&sn=e6656a88d78b2e993df380d9a2c62b06#rd]]></Url>\n
                    </item>\n";
                    
                    $resultStr.="</Articles>\n
                    <FuncFlag>0</FuncFlag>\n
                    </xml>";
                      
                    echo $resultStr;           
                    exit;
                }else{
                    //判断是否已经签到
                    if($roster_value['HasSigned']==0){
                        $localtime = localtime(time(),true);
                        //计算距离考研的时间
                        $remaintime = ceil((1420300800-$createTime)/86400);
                        $hour = $localtime['tm_hour'];
                        $min  = $localtime['tm_min'];
                        $wday = $localtime['tm_wday'];
                        //判断今日所获分值                        
                        $addPoint = (8-$hour)*60+ceil(60-$min);
                        
                        //如果6点之前提示还没到可以签到的时间                        
                        if($addPoint>180){
                            $msgType = "text";
                            $contentStr = "起的太早不利于一天的学习哦！你还是再睡一会儿吧！距离考研还剩".$remaintime." days！";
                            $resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
                            echo $resultStr;
                            exit;
                        }
                        //如果9点之后签到没有分
                        if($addPoint<=0){
                            $msgType = "text";
                            $contentStr = "很遗憾，今天起床太晚了，已经没有积分了哦！下次记得早点！有效签到时间为早上6点到9点哦！\n距离考研还剩".$remaintime." days！";
                            $resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
                            echo $resultStr; 
                            exit;
                        }
                        
                        //更新时间戳
                        $time = $createTime;
                        $sql = "UPDATE Users SET Users_SignTime = '$time' WHERE Users_WeixinNumber =  '$fromUsername'";
                        $mysql->runSql($sql);
                        //更新总分                        
                        $Users_TotalScore = $roster_value['Users_TotalScore'];
                        $Users_TotalScore += $addPoint;
                        $sql = "UPDATE  Users SET  Users_TotalScore =  '$Users_TotalScore' WHERE Users_WeixinNumber =  '$fromUsername'";
                        $mysql->runSql($sql);
                        //更新签到标记
                        $sql = "UPDATE  Users SET  HasSigned =  '1' WHERE  Users_WeixinNumber =  '$fromUsername'";
                        $mysql->runSql($sql);
                        //更新周总分
                        $Users_WeekScore = $roster_value['Users_WeekScore'];
                        $Users_WeekScore += $addPoint;
                        $sql = "UPDATE Users SET Users_WeekScore = '$Users_WeekScore' WHERE Users_WeixinNumber = '$fromUsername'";
                        $mysql->runSql($sql);
                        //更新今日积分
                        $Users_TodayScore = $addPoint;
                        $sql = "UPDATE Users SET Users_TodayScore = '$Users_TodayScore' WHERE Users_WeixinNumber = '$fromUsername'";
                        $mysql->runSql($sql);
                        //计算今日排名
                        $users = $mysql->getData("SELECT * FROM Users WHERE HasSigned = '1'");
                        $hasSignedNum = count($users);
                        //更新周签到名次和
                        $Signtotal = $roster_value['Signtotal'];
                        $Signtotal += $hasSignedNum;
                        $sql = "UPDATE Users SET Signtotal = '$Signtotal' WHERE Users_WeixinNumber = '$fromUsername'";
                        $mysql->runSql($sql);
                        //更新周签到次数
                        $Signdays = $roster_value['Signdays'];
                        $Signdays += 1;
                        $sql = "UPDATE Users SET Signdays = '$Signdays' WHERE Users_WeixinNumber = '$fromUsername'";
                        $mysql->runSql($sql);
                        //回复签到成功和今日第几个签到
                        $msgType = "text";
                        $contentStr = "今日签到成功！获得积分".$addPoint."！你是今天第".$hasSignedNum."个签到的哦！努力考研，加油！\n距离考研还剩".$remaintime." days！";
                        $resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
                        echo $resultStr;
                        exit;
                    }else{
                        //计算距离考研的时间
                        $remaintime = ceil((1420300800-$createTime)/86400);
                        $msgType = "text";
                        $contentStr = "您已经签过到了,今天不能再签到了！\n距离考研还剩".$remaintime." days！";
                        $resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
                        echo $resultStr;
                        exit;    
                    }                   
                }
            }
            //个人签到成绩查询
            if($form_Content=="qdcx") {
                //判断是否已经绑定
                $roster_value=$mysql->getLine("select * from Users where Users_WeixinNumber='$fromUsername'");
                if(empty($roster_value)){
                    $msgType = "text";
                    $contentStr = "由于您还尚未绑定，暂无您的信息情况，请绑定再签到后再查询，输入bz查看帮助消息";
                    $resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
                    echo $resultStr;
                    exit;
                }else{
                    $todayScore = $roster_value['Users_TodayScore'];
                    $totalScore = $roster_value['Users_TotalScore'];
                    $weekScore = $roster_value['Users_WeekScore'];
                    //获得总分排名
                    $sql = "SELECT * FROM Users ORDER BY Users_TotalScore DESC";
                    $users = $mysql->getData($sql);
                    $totalRank = 1;
                    foreach ($users as $user) {
                        if($user['Users_TotalScore'] > $totalScore){
                            $totalRank++;
                        }else{
                            break;
                        }
                    }
                    //获得周总分排名
                    $sql = "SELECT * FROM Users ORDER BY Users_WeekScore DESC";
                    $users = $mysql->getData($sql);
                    $weekRank = 1;
                    foreach ($users as $user) {
                        if($user['Users_TotalScore'] > $totalScore){
                            $weekRank++;
                        }else{
                            break;
                        }
                    }
                    //获取百分比
                    $number = count($users);
                    $totalPercent = round((1 - $totalRank / $number) * 100);
                    $weekPercent = round((1 - $weekRank / $number) * 100);
                    //回复用户
                    $msgType = "text";
                    $contentStr = "您的昵称：".$roster_value['Users_Name']."\n周积分：".$weekScore."\n总积分：".$totalScore."\n今日签到积分：".$todayScore."\n本周排名：第".$weekRank."名\n超过".$weekPercent."%的用户\n总分排名：第".$totalRank."名\n超过".$totalPercent."%的用户";
                    $resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
                    echo $resultStr;
                    exit;
                }
            }
            
            
            //默认小丸机器人回复
            
            $msgType = "text";
            $contentStr = xiaowan($form_Content);
            if($contentStr == NULL) $contentStr = xiaojo($form_Content);
            $resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
            echo $resultStr;
            exit;
            
        }
    }
}
?>