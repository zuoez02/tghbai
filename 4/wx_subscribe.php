<?php
    # reply welcome graphic message
    function wx_subscribe($fromUsername,$toUsesrname){
	$resultStr="<xml>\n
        <ToUserName><![CDATA[".$fromUsername."]]></ToUserName>\n
        <FromUserName><![CDATA[".$toUsername."]]></FromUserName>\n
        <CreateTime>".time()."</CreateTime>\n
        <MsgType><![CDATA[news]]></MsgType>\n
        <ArticleCount>4</ArticleCount>\n
        <Articles>\n";
          
        # adding a cover graphic message
        $resultStr.="<item>\n
        <Title><![CDATA[]]></Title> \n
        <Description><![CDATA[]]></Description>\n
        <PicUrl><![CDATA[http://tghbai-kaoyanquan2weima.stor.sinaapp.com/kaoyanquan2weima.jpg]]></PicUrl>\n
        <Url><![CDATA[]]></Url>\n
        </item>\n";
            
        $resultStr.="<item>\n
        <Title><![CDATA[考研圈欢迎您的加入！目前只有部分功能开放，回复“help”查看帮助信息，点击查看《考研圈手册》]]></Title> \n
        <Description><![CDATA[]]></Description>\n
        <PicUrl><![CDATA[http://tghbai-kaoyanquanrizhi.stor.sinaapp.com/shouce.png]]></PicUrl>\n
        <Url><![CDATA[http://mp.weixin.qq.com/s?__biz=MzA5NTI5NDAxOQ==&mid=10000043&idx=1&sn=f0e280f193965ef64dbc2805d4cb634e#rd]]></Url>\n
        </item>\n";
        
        $resultStr.="<item>\n
        <Title><![CDATA[考研圈签到须知，了解详细内容请点击查看！]]></Title> \n
        <Description><![CDATA[]]></Description>\n
        <PicUrl><![CDATA[http://tghbai-kaoyanquanrizhi.stor.sinaapp.com/qiandaorizhi.jpg]]></PicUrl>\n
        <Url><![CDATA[http://mp.weixin.qq.com/s?__biz=MzA5NTI5NDAxOQ==&mid=10001125&idx=1&sn=e6656a88d78b2e993df380d9a2c62b06#rd]]></Url>\n
        </item>\n";
        
        $resultStr.="<item>\n
        <Title><![CDATA[考研圈主页，点击查看！]]></Title> \n
        <Description><![CDATA[]]></Description>\n
        <PicUrl><![CDATA[http://tghbai-kaoyanquan2weima.stor.sinaapp.com/kaoyanquantubiao.jpg]]></PicUrl>\n
        <Url><![CDATA[http://2.tghbai.sinaapp.com/index.php]]></Url>\n
        </item>\n";
        
        $resultStr.="</Articles>\n
        <FuncFlag>0</FuncFlag>\n
        </xml>";
          
        echo $resultStr;           
        exit;	
	}
?>