<?php
	# get server local time
	$time = localtime(time(),true);
	$hour = $time['tm_hour'];
	
	# can not run between 6 and 9
	if(!($hour>=6 && $hour<=8)){
		$mysql = new SaeMysql();
		$users = $mysql->getData("SELECT * FROM Users ORDER BY Users_TotalScore DESC");
		foreach($users as $user){
			# today score and sign-in mark refresh
			$userName = $user['Users_Name'];
			$mysql->runSql("UPDATE Users SET Users_TodayScore = '0' , HasSigned = '0' WHERE Users_Name = '$userName'");
		}
		if($mysql->errno() != 0){
			die("Error:".$mysql->errmsg());
		}
		$mysql->closeDb();

		# Write log to Storage
		$Storage = new SaeStorage();
		$domin = 'systemlog';
 		$logFile = 'refresh_log.txt';
 		$read = $Storage->read($domin,$logFile); 	
 		$msg = $read.date('Y-m-d H:i:s').' >>> '.'wx_refresh.php in version 1 was run.'."\r\n"; 	
 		$Storage->write($domin,$logFile,$msg);	
	}	
?>