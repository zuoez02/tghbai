<?php

    $time = time();
    
	# return User's Sign-In grade
	function wx_getGrade($textTpl,$fromUsername,$toUsername){
		$mysql = new SaeMysql();
		$userX=$mysql->getLine("select * from Users where Users_WeixinNumber='$fromUsername'");
		if(empty($userX)){
            $msgType = "text";
            $contentStr = "由于您还尚未绑定，暂无您的信息情况，请绑定再签到后再查询，输入help查看帮助消息";
            $resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
            echo $resultStr;
            exit;
        }else{
            # grades
            $name = $userX['Users_Name'];
            $todayScore = $userX['Users_TodayScore'];
            $totalScore = $userX['Users_TotalScore'];
            $weekScore = $userX['Users_WeekScore'];
            echo $totalScore."...".$weekScore;

            # total rank
            $sql = "SELECT count(*) NUM FROM Users Where Users_TotalScore > '$totalScore'";
            $users = $mysql->getLine($sql);
            $totalRank = $users['NUM'] + 1;
            echo "totalrank=".$totalRank;

            # week rank
            $sql = "SELECT count(*) NUM FROM Users Where Users_WeekScore > '$weekScore'";
            $users = $mysql->getLine($sql);
            $weekRank = $users['NUM'] + 1;
            echo "weekRank=".$weekRank;

            # user's position based on percentage
            $sql = "SELECT count(*) NUM FROM Users";
            $users = $mysql->getLine($sql);
            $number = $users['NUM'];
            $totalPercent = round((1 - $totalRank / $number) * 100);
            $weekPercent = round((1 - $weekRank / $number) * 100);
            
            # return to user
            $msgType = "text";
            $contentStr = "您的昵称：".$userX['Users_Name']."\n周积分：".$weekScore."\n总积分：".$totalScore."\n今日签到积分：".$todayScore."\n本周排名：第".$weekRank."名\n超过".$weekPercent."%的用户\n总分排名：第".$totalRank."名\n超过".$totalPercent."%的用户";
            $resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
            echo $resultStr;
            exit;
        }
	}
?>