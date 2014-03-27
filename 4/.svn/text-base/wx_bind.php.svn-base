<?php
	$time = time();

	# bind to database
	function wx_bind($textTpl,$form_Content,$fromUsername,$toUsername){
		$mysql = new SaeMysql();
		$user=$mysql->getLine("select * from Users where Users_WeixinNumber='$fromUsername'");
        
        if(empty($user)){    
            $user_name = substr($form_Content,2,strlen($form_Content)-2);
            $user=$mysql->getLine("select * from Users where Users_Name='$user_name'");
          
            # whether user enter the nickname
            if(empty($user_name)){
                $msgType = "text";
                $contentStr = "绑定失败，您未输入昵称";
                $resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
                echo $resultStr;
                exit;  
            }
            
            # whether the nickname has been used
            if(!empty($user)){
                $msgType = "text";
                $contentStr = "绑定失败，该昵称已经被使用了，请换一个重试";
                $resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
                echo $resultStr;
                exit;      
            }
            
            # bind to database
            $sql = "INSERT INTO Users (Users_WeixinNumber,Users_Name) VALUES ('$fromUsername','$user_name')";
            $mysql->runSql( $sql );     
            $msgType = "text";
            $contentStr = "绑定成功，您的昵称为“".$user_name."”，这是你签到的唯一身份标识！现在起您可以参与签到排序了，回复/:strong试试！";
            $resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
            echo $resultStr;
            exit; 
        }else{  
   		     
   		    # user has bound, no need to bind again
   		    $msgType = "text";
            $contentStr = "绑定失败，您已经绑定过了，不需要再次绑定";
            $resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
            echo $resultStr;
            exit;
        }                    
    }
?>