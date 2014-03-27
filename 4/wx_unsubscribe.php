<?php
	function wx_unsubscribe($fromUsername){
		#new SaeMysql object
		$mysql = new SaeMysql();
		$user_info=$mysql->getLine("select * from Users where Users_WeixinNumber='$fromUsername'");
            if(!empty($user_info)){
                #Delete the database-related news
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
	#all 'echo' is used for testing, no infomation will be store to file.
?>