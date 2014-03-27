<?php
	$time = time();

	# sign in
	function wx_signIn($createTime,$textTpl,$fromUsername,$toUsername){
        $mysql = new SaeMysql();
		$roster_value=$mysql->getLine("select * from Users where Users_WeixinNumber='$fromUsername'");
        if(empty($roster_value)){
            # if not bind                 
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
            # whether has signed in
            if($roster_value['HasSigned']==0){
                $localtime = localtime(time(),true);
                # calculate the time to 2015's kaoyan
                $remainTime = ceil((1420300800-$createTime)/86400);
            	# get time now                
                $hour = $localtime['tm_hour'];
                $min  = $localtime['tm_min'];
                $wday = $localtime['tm_wday'];
                # today score                        
                $addPoint = (8-$hour)*60+ceil(60-$min);
                # can not sign in before 6                      
                if($addPoint>180){
                    $msgType = "text";
                    $contentStr = "起的太早不利于一天的学习哦！你还是再睡一会儿吧！距离考研还剩".$remainTime." days！";
                    $resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
                    echo $resultStr;
                    exit;
                }
                # no score can be get after 9
                if($addPoint<=0){
                    $msgType = "text";
                    $contentStr = "很遗憾，今天起床太晚了，已经没有积分了哦！下次记得早点！有效签到时间为早上6点到9点哦！\n距离考研还剩".$remainTime." days！";
                    $resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
                    echo $resultStr; 
                    exit;
                }
                
                # update the database

                # time
                $time = $createTime;
                
             	# total score                       
                $Users_TotalScore = $roster_value['Users_TotalScore'];
                $Users_TotalScore += $addPoint;
                
                # week score
                $Users_WeekScore = $roster_value['Users_WeekScore'];
                $Users_WeekScore += $addPoint;
                
                # today score
                $Users_TodayScore = $addPoint;
                
                # today rank
                $users = $mysql->getData("SELECT * FROM Users WHERE HasSigned = '1'");
                $hasSignedNum = count($users);                
                $Signtotal = $roster_value['Signtotal'];
                $Signtotal += $hasSignedNum;
                
                # sign in days
                $Signdays = $roster_value['Signdays'];
                $Signdays += 1; 

                # update
                $sql = "UPDATE Users SET Users_SignTime = '$time' , Users_TotalScore =  '$Users_TotalScore' , HasSigned =  '1' , Users_WeekScore = '$Users_WeekScore' , Users_TodayScore = '$Users_TodayScore' , Signtotal = '$Signtotal' , Signdays = '$Signdays' WHERE Users_WeixinNumber = '$fromUsername'";
                $mysql->runSql($sql);

                # return sign-in succeess information and today rank
                $msgType = "text";
                $contentStr = "今日签到成功！获得积分".$addPoint."！你是今天第".$hasSignedNum."个签到的哦！努力考研，加油！\n距离考研还剩".$remainTime." days！";
                $resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
                echo $resultStr;
                exit;
            }else{               
                
                # if has signed in
                $remainTime = ceil((1420300800-$createTime)/86400);
                $msgType = "text";
                $contentStr = "您已经签过到了,今天不能再签到了！\n距离考研还剩".$remainTime." days！";
                $resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
                echo $resultStr;
                exit;    
            }                   
        }
	}
?>