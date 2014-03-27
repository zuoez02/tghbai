<?php
	# get server local time
	$time = localtime(time(),true);
	$hour = $time['tm_hour'];
	
	# can not run between 6 and 9
	if(!($hour>=6 && $hour<=8)){
		$mysql = new SaeMysql();	
		$i = 0;
		$users = $mysql->getData("SELECT * FROM Users ORDER BY Signdays DESC, Signtotal");
		foreach($users as $user){
			# week initialize
			$i++;
			$userName = $user['Users_Name'];
			$mysql->runSql("UPDATE Users SET Users_WeekScore = '0' , Signdays = '0' , Signtotal = '0' , Laseweek = $i WHERE Users_Name = '$userName'");
		}
		$mysql->closeDb();

		# Write log to Storage
		$Storage = new SaeStorage();
		$domin = 'systemlog';
 		$logFile = 'refresh_log.txt';
 		$read = $Storage->read($domin,$logFile); 	
 		$msg = $read.date('Y-m-d H:i:s').' >>> '.'wx_weekrefresh.php in version 4 was run.'."\r\n"; 	
 		$Storage->write($domin,$logFile,$msg);  	
	}        	
?>