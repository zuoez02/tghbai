<?php
//小九机器人
echo xiaowan("你好圈圈你好");
	
function xiaojo($keyword){
		$curlPost=array("chat"=>$keyword);
		$ch = curl_init();//初始化curl
		curl_setopt($ch, CURLOPT_URL,'http://www.xiaojo.com/bot/chata.php');//抓取指定网页
		curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
		curl_setopt($ch, CURLOPT_HEADER, 0);//设置header
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);//要求结果为字符串且输出到屏幕上
		curl_setopt($ch, CURLOPT_POST, 1);//post提交方式
		curl_setopt($ch, CURLOPT_POSTFIELDS, $curlPost);
		$data = curl_exec($ch);//运行curl
		curl_close($ch);
		if(!empty($data)){
			return "小丸子：".$data;
		}else{
			$ran=rand(1,5);
			switch($ran){
				case 1:
					return "小丸子：小丸子今天累了，明天再陪你聊天吧。\n\n回复“help”查看聊天命令！";
					break;
				case 2:
					return "小丸子：小丸子睡觉喽~~\n\n回复“help”查看聊天命令！";
					break;
				case 3:
					return "小丸子：呼呼~~呼呼~~\n\n回复“help”查看聊天命令！";
					break;
				case 4:
					return "小丸子：你话好多啊，不跟你聊了\n\n回复“help”查看聊天命令！";
					break;
				case 5:
					return "感谢您关注考研圈微信，微信号为：kaoyan_quan，喜欢的话分享给更多好友\n回复“help”查看聊天命令！";
					break;
				default:
					return "感谢您关注考研圈微信，微信号为：kaoyan_quan，喜欢的话分享给更多好友\n\回复“help”查看聊天命令！";
					break;
			}
		}
	}
//小丸机器人提高部分
function xiaowan($keyword)
{
    if(strpos($keyword,"圈圈")!==false)return "小丸子：圈圈君现在不在啊！你有什么事先跟我说吧！";
    else if(strpos($keyword,"你")!==false && (strpos($keyword,"名字")!==false||strpos($keyword,"叫什么")!==false)) return "小丸子：我叫小丸子啊，聊了这么久竟然不知道我叫啥，伤心！";
    else return NULL;
    
}
?>