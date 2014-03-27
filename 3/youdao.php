<?php
    function youdaoDic($keyword)
    {
		if(!empty( $keyword ))
        {
			$str_trans = mb_substr($keyword,0,5,"UTF-8");
			$str_valid = mb_substr($keyword,0,-5,"UTF-8");
			if($str_trans == '/:,@f' && !empty($str_valid))
            {				
				$word = mb_substr($keyword,5,205,"UTF-8");
				//调用有道词典
                $keyfrom = "tghbai";	//申请APIKEY时所填表的网站名称的内容
                $apikey = "875667563";  //从有道申请的APIKEY		
                //有道翻译-json格式
                $url_youdao = "http://fanyi.youdao.com/fanyiapi.do?keyfrom=".$keyfrom."&key=".$apikey."&type=data&doctype=json&version=1.1&q=".$word;
                
                $jsonStyle = file_get_contents($url_youdao);
        
                $result = json_decode($jsonStyle,true);
                
                $errorCode = $result['errorCode'];
                
                $trans = '';
        
                if(isset($errorCode))
                {
        
                    switch ($errorCode)
                    {
                        case 0:
                        	$trans = "------有道翻译------\n基本词义：".$result['translation'][0]."\n------基本词典------\n读音：".$result['basic']['phonetic']."\n".$result['basic']['explains'][0]
                                	."\n".$result['basic']['explains'][1]."\n------网络释义------\n".$result['web'][0]['key'].":".$result['web'][0]['value'][0]."\t".$result['web'][0]['value'][1]."\t".
                                	$result['web'][0]['value'][2]."\n---------------------\n".$result['web'][1]['key'].":".$result['web'][1]['value'][0]."\t".$result['web'][1]['value'][1]."\t".
                                	$result['web'][1]['value'][2]."\n---------------------\n".$result['web'][2]['key'].":".$result['web'][2]['value'][0]."\t".$result['web'][2]['value'][1]."\t".
                            		$result['web'][2]['value'][2]."\n---------------------\n";
                        //$trans = Resolve($result);
                            break;
                        case 20:
                            $trans = '要翻译的文本过长';
                            break;
                        case 30:
                            $trans = '无法进行有效的翻译';
                            break;
                        case 40:
                            $trans = '不支持的语言类型';
                            break;
                        case 50:
                            $trans = '无效的key';
                            break;
                        default:
                            $trans = '出现异常';
                            break;
                    }
                }
                return($trans);
			}
            else return "欢迎使用翻译功能，请回复/:,@f加上你要翻译的内容！";
        }
    }

?>