<?php
	# load Module files
	include_once("base_class.php");			# base classes to analysis
	include_once("wx_tpl.php");				# xml module of return
	include_once("wx_bind.php");			# bind to database 
	include_once("wx_getGrade.php");		# get the sign in grade
	include_once("wx_goToHomepage.php");	# get the homepage url
	include_once("wx_help.php");	  		# get help information
	include_once("wx_signIn.php");			# sign in and update database 'Users'
	include_once("wx_subscribe.php");		# subscribe Kaoyan_quan first time
	include_once("wx_talkingRoom.php");		# get talking room weixin qun number
	include_once("wx_unsubscribe.php");		# unsubscribe Kaoyan_quan and delete user's information
	include_once("wx_weather.php");			# get a city's weather
	include_once("wx_xiaowanrobot.php");	# xiaowan auto reply robot
	include_once("wx_youdao.php");			# look up English words from YoudaoDic API
	
	# get datas from Weixin
	$postStr = $GLOBALS["HTTP_RAW_POST_DATA"];

	
	if(!empty($postStr)){
	    # analysis $postStr
	    $postObj = simplexml_load_string($postStr, 'SimpleXMLElement', LIBXML_NOCDATA);
	    $fromUsername = $postObj->FromUserName;
	    $toUsername = $postObj->ToUserName;
	    $form_MsgType = $postObj->MsgType;
	    $createTime = $postObj->CreateTime;
	    
	    # system time
	    $time = time(); 
	    
	    # subscribe or Unsubscribe event
	    if($form_MsgType == "event"){
	    	# get event's form
	    	$form_Event = $postObj->Event;

	    	# subscribe Event
	    	if($form_Event == "subscribe"){
	    		wx_subscribe($fromUsername,$toUsername);
	    	}

	    	# unsubscribe Event
	    	if($form_Event == "unsubscribe"){
	    		wx_unsubscribe($fromUsername);
	    	}
	    }

	    # recieve text message from user
	    if($form_MsgType == "text"){
	        # get the content of the message from postStr
	        $form_Content = trim($postObj->Content);
	        $form_Content = string::un_script_code($form_Content);  
	        $form_Content = strtolower($form_Content);  

	        # compare the first two characters
	        $fristTwo = substr($form_Content, 0,2);

	        switch ($fristTwo) {
	        	case 'he':
	        		# reply help information
	        		wx_help($fromUsername,$toUsername);
	        		break;     	

				case 'qd':
					# get sign-in grade
					wx_getGrade($textTpl,$fromUsername,$toUsername);
					break;

				case 'bd':
					# bind to database
					wx_bind($textTpl,$form_Content,$fromUsername,$toUsername);
					break;

				case '/:':
					# get emotion text
					switch (substr($form_Content, 2,2)) {
						case '8-':
							# go to hompage
							wx_goToHomepage($fromUsername,$toUsername);
							break;
						
						case 'sh':
							# talking room link
							wx_talkingRoom($fromUsername,$toUsername);
							break;

						case ',@':
							# translate from YoudaoDic API
							wx_youdao($textTpl,$form_Content,$fromUsername,$toUsername);
							break;

						case 'st':
							# sign in
							wx_signIn($createTime,$textTpl,$fromUsername,$toUsername);
							break;

						default:
							# get weahter
							if(substr($form_Content,2,1) == '?'){
								wx_weather($textTpl,$form_Content,$fromUsername,$toUsername);	
							}							
							break;
					}
					break;
	        	default:
	        		# robot reply
	        		wx_xiaowanrobot($textTpl,$form_Content,$fromUsername,$toUsername);
	        		break;
	        }	        
	  	}
	}
?>