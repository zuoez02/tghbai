<?php
	$date = date('Y-m-d');
	$dj = new SaeDeferredJob();
	$taskID = $dj->addTask("export","mysql","back","$date.sql.zip",SAE_MYSQL_DB,"","");
	
	# Write log to Storage
	$Storage = new SaeStorage();
	$domin = 'systemlog';
 	$logFile = 'refresh_log.txt';
 	$read = $Storage->read($domin,$logFile); 	
 	$msg = $read.date('Y-m-d H:i:s').' >>> '.'wx_database_backup.php in version 4 was run.'."\r\n"; 	
 	$Storage->write($domin,$logFile,$msg);
?>