<?php
	# go to Hompage in Weixin Application
	function wx_goToHomepage($fromUsername,$toUsername){
		# new SaeMysql objcet
		$mysql = new SaeMysql();
		$sql = "select * from Users where Users_WeixinNumber='$fromUsername'";
		$tghbai = $mysql->getLine($sql);
    	$name = $tghbai['Users_Name'];

					
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
?>