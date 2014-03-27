<?php
	# reply help information
	function wx_help($fromUsername,$toUsername){
		$resultStr="<xml>\n
		<ToUserName><![CDATA[".$fromUsername."]]></ToUserName>\n
		<FromUserName><![CDATA[".$toUsername."]]></FromUserName>\n
		<CreateTime>".time()."</CreateTime>\n
		<MsgType><![CDATA[news]]></MsgType>\n
		<ArticleCount>1</ArticleCount>\n
		<Articles>\n";

		# adding a cover graphic message
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
?>