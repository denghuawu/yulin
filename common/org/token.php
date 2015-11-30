<?php
header("Content-type: text/html; charset=utf-8");
ini_set("display_errors", "On");
error_reporting(E_ALL | E_STRICT);
/**
 * 获取token
 */

function getToken()
{
	$appid = "wxec407ab76208d834";
	$secret = "597990ac430d4c048e718b60e35c1212";

	$json=https_request("https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid={$appid}&secret={$secret}");

	$arr= json_decode($json, true);

	$access_token = $arr["access_token"];

	return $access_token;
}


/**
 * 使用https协议，模拟GET\POST请求
 * @param string	$url	请求url
 * @param mixed		$data	post提交的数据 
 */
function https_request($url, $data = null)
{
	$curl = curl_init();
	curl_setopt($curl, CURLOPT_URL, $url);
	curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
	curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);
	if (!empty($data)){
		curl_setopt($curl, CURLOPT_POST, 1);
		curl_setopt($curl, CURLOPT_POSTFIELDS, $data);//var_dump($data);die;
	}
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
	$output = curl_exec($curl);
	if(curl_errno($curl)){
		return 'Error'.curl_error($curl);
	}
	curl_close($curl);
	return $output;
}

/**
 * 使用 http 协议，模拟GET\POST请求
 * @param string	$url	请求url
 */
function http_request($url)
{
	$curl = curl_init();
	curl_setopt($curl, CURLOPT_URL, $url);
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
	$output = curl_exec($curl);
	if(curl_errno($curl)){
		return 'Error'.curl_error($curl);
	}

	curl_close($curl);
	return $output;
}


/**
 * 获取用户基本信息，通过http的GET请求
 * @param	string	$open_id	fromUsername,对于不同公众号，同一用户的openid不同
 */
function getUserInfo($open_id)
{
	$access_token = getToken();
	$url = "https://api.weixin.qq.com/cgi-bin/user/info?access_token={$access_token}&openid={$open_id}&lang=zh_CN";
	// 发送http请求,返回json数据
	$jsonStr = https_request($url);
	$arr = json_decode($jsonStr, true);
	return $arr;
}


/**
 * 向用户发送消息
 */
/*funciton sendText($obj){
    $access_token = getToken();
    $url = "https://api.weixin.qq.com/cgi-bin/message/custom/send?access_token={$access_token}";

    $sendContent = date("Y-m-d H:i").'发送';
    $sendContent = urlencode($sendContent);

    $openid = $obj->FromUserName;
    $textArr = array("touser"=>"{$openid}","msgtype"=>"text","text"=>array("content"=>"{$sendContent}"));
    $textJson = json_encode($textArr); 
    
    $textJson = urldecode($textJson);

    https_request($url, $textJson);
}*/


/**
 * 获得关注者列表
 */
function getSubList(){

	$access_token  = getToken();

	$url = "https://api.weixin.qq.com/cgi-bin/user/get?access_token={$access_token}";

	$jsonStr = https_request($url);

	$arr = json_decode($jsonStr, true);

	return $arr;
}

//my_json_decode() 将数组转成json
function my_json_encode($p, $type="text") 
{
    if (PHP_VERSION >= '5.4')
    {
        $str = json_encode($p, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
    }
    else
    {
        switch ($type)
        {
            case 'text':
                isset($p['text']['content']) && ($p['text']['content'] = urlencode($p['text']['content']));
                break;
        }
        $str = urldecode(json_encode($p));
    }
    return $str;
}

?>