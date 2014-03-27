<?php
	# talking room
	function wx_talkingRoom($fromUsername,$toUsername){
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
                  
        # talking room 1
        $resultStr.="<item>\n
        <Title><![CDATA[聊天室一]]></Title> \n
        <Description><![CDATA[]]></Description>\n
        <PicUrl><![CDATA[http://tghbai-kaoyanquan2weima.stor.sinaapp.com/liaotianshi.png]]></PicUrl>\n
        <Url><![CDATA[http://weixin.qq.com/g/AjZ2DKTqI_tY9uR2QxSF]]></Url>\n
        </item>\n";
                  
        # talking room 2
        $resultStr.="<item>\n
        <Title><![CDATA[聊天室二]]></Title> \n
        <Description><![CDATA[]]></Description>\n
        <PicUrl><![CDATA[http://tghbai-kaoyanquan2weima.stor.sinaapp.com/liaotianshi.png]]></PicUrl>\n
        <Url><![CDATA[http://weixin.qq.com/g/CTRvSn6R8WqKjT7xQzWO]]></Url>\n
        </item>\n";
                
        # talking room 3
        $resultStr.="<item>\n
        <Title><![CDATA[聊天室三]]></Title> \n
        <Description><![CDATA[]]></Description>\n
        <PicUrl><![CDATA[http://tghbai-kaoyanquan2weima.stor.sinaapp.com/liaotianshi.png]]></PicUrl>\n
        <Url><![CDATA[http://weixin.qq.com/g/zDVMSiw67QWWJmyBQylL]]></Url>\n
        </item>\n";
                
        # talking room 4
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
?>