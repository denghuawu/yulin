<?php

ini_set('display_errors','ON');
error_reporting(E_ALL);


/**
 * 匹配权限代码
 * @param unknown $search
 * @param unknown $arr
 * @return boolean
 */
function in_arrays($search,$arr){
	 
	foreach ($search as $v){
		if(in_array($v['action_url'], $arr)){
			return true;
		}
	}
	 
	return false;
}

/**
 * 生成随机文件名
 * @param string $ext	文件后缀
 * @return number
 */
function rand_name($ext,$prefix=null){
	$randName = time() . rand(1000, 9999);
	$path = abs(crc32($randName) % 500).'.'.$ext;
	return $prefix.$path;
}

/**
 * 生成select的option选项
 */
function make_option_list($data){
	if(is_array($data) && !empty($data)){
		$options = '';
		foreach ($data as $key=>$val){
			$options .= "<option value='{$key}'>{$val}</option>";
		}
		return $options;
	}
}

/**
 * 生成筛选条件选项
 * @param unknown $data
 * @param unknown $href
 */
function make_con_option($data,$href){
	if(is_array($data) && !empty($data)){
		$options = '';
		foreach ($data as $key=>$val){
			$options .= "<a href='{$href}{$key},{$val}'><span>{$val}</span></a>";
		}
		
		return $options;
	}
	
}

/**
 * 订单交易状态信息
 * @param int $progress	交易状态
 * @param int $deal 买卖
 * @return array
 */
function order_status($data){

		// 卖
		switch (intval($data['order_status'])){
			case UNPAYED:
				//	状态-》已下单，未付款 	 动作=》付款，取消订单
				$name = '待付款';
				$action[] = '<a href="index.php?r=order/index">确认收货</a>';
				break;
			case PAYED:
				//	状态-》已付款 （等待商家发货）	 	动作=》申请售后
				$name = '已付款，等待商家发货';
				$action[] = '<a href="index.php?r=order/refund&id='.$data['order_id'].'">申请售后</a>';
				break;
			case SHIPPED:
				//	状态-》已发货  		动作=》确认收货	申请售后
				$name = '商家已发货';
				$action[] = '<a href="index.php?r=order/refund&id='.$data['order_id'].'">申请售后</a>';
				$action[] =  '<a href="javascript:doFinish('.$data['order_id'].')">确认收货</a>';
				break;
			case FINISHED:
				//	状态-》已收货  （交易完成）		动作=》申请售后
				$name = '交易完成';
				$action[] = '<a href="index.php?r=order/refund&id='.$data['order_id'].'">申请售后</a>';
				$action[] = '<a href="index.php?r=order/comment&id='.$data['order_id'].'">评价</a>';
				break;
			case RETURNED:
				//	状态-》退货退款 		动作=》取消退货
				$name = '退货退款';
				break;
			case CANCEL:
				//	状态-》已取消订单		动作=》恢复订单
				$name = '订单已取消';
				break;
			case FAILED:
				//	状态-》交易失败
				$name = '交易失败';
				break;
			case COMMENTED:
				$name = '交易完成';	// 已评价
				break;
		}
	return array('name'=>$name,'action'=>$action,'flag'=>$flag,'express'=>$express);
}



/**
 * 得到新订单号
 * @return  string
 */
function get_order_sn()
{
	/* 选择一个随机的方案 */
	mt_srand((double) microtime() * 1000000);

	return date('Ymd') . str_pad(mt_rand(1, 99999), 5, '0', STR_PAD_LEFT);
}

/**
 * 获得时间段
 * @param unknown $type
 */
function get_timer($type){
	
	$today = date('Y-m-d',time());
	list($y,$m,$d) = explode('-', $today);
	
	switch ($type){

		case 1:		// 昨天和今天时间段
			if ($m == 1 && $d == 1) {
				$start = mktime(0,0,0,12,31,$y);
				$end = mktime(23,59,59,$m,$d,$y);
			}else {
				$start = mktime(0,0,0,$m,$d-1,$y);
				$end = mktime(23,59,59,$m,$d,$y);
			}
			break;
		case 2:		// 三个月时间段
			$start = strtotime(date('Y-m-01 00:00:00' ,strtotime('-2 month')));
			$end = mktime(23,59,59,$m,$d,$y);
	}
	
	return ['start'=>$start, 'end'=>$end, 'today'=>mktime(0,0,0,$m,$d,$y)];
}

// 请求接口获得物流信息
function curl_shipping($deliver){

	switch ($deliver['company']){
		case '德邦物流':
			$com = "debang";
			break;
		case 'EMS快递':
			$com = "ems";
			break;
		case '申通快递':
			$com = "shentong";
			break;
		case '圆通快递':
			$com = "yuantong";
			break;
		case '中通快递':
			$com = "zhongtong";
			break;
		case '汇通快递':
			$com = "huitong";
			break;
		case '天天快递':
			$com = "tiantian";
			break;
		case '韵达快递':
			$com = "yunda";
			break;
		case '顺丰快递':
			$com = "shunfeng";
			break;
		case '天天快递':
			$com = "tiantian";
			break;
		default:
			$com = false;
			break;
	}
	if(!$com){
		return false;
	}

	$url = "http://api.ickd.cn/?id=109878&secret=df3f2a241246afb4e575ae3ea85dab89&type=json&encode=utf8&ord=desc&nu=".$deliver['expressNo']."&com=".$com;
	$ch = curl_init();
	// 设置选项
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_HEADER, 0);
	// 执行并获得返回结果
	$output = curl_exec($ch);
	// 释放句柄
	curl_close($ch);

	return json_decode($output,true);
}



/**
 *  生成分页数组
 *
 * @access  public
 * @param   string      $url        分页的链接地址(必须是带有参数的地址，若不是可以伪造一个无用参数)
 * @param   array       $param      链接参数 key为参数名，value为参数值
 * @param   int         $record     记录总数量
 * @param   int         $page       当前页数
 * @param   int         $size       每页大小
 *
 * @return  array       $pager
 */
function get_pager($record_count, $page = 1, $size = 10)
{
	$size = intval($size);
	if ($size < 1)
	{
		$size = 10;		// 如果没有指定分页大小，默认是10
	}

	$page = intval($page);
	if ($page < 1)
	{
		$page = 1;
	}

	$record_count = intval($record_count);

	$page_count = $record_count > 0 ? intval(ceil($record_count / $size)) : 1;
	if ($page > $page_count)
	{
		$page = $page_count;
	}

	$page_prev  = ($page > 1) ? $page - 1 : 1;
	$page_next  = ($page < $page_count) ? $page + 1 : $page_count;

	$pager['start']        = ($page -1) * $size;
	$pager['page']         = $page;
	$pager['size']         = $size;
	$pager['record_count'] = $record_count;
	$pager['page_count']   = $page_count;

    return $pager;
}

/**
 * 导出excel表
 * @param unknown $data
 * @param unknown $keynames
 * @param string $name
 */
function down_xls($data, $keynames, $name='dataxls') {
	$xls[] = "<html><meta http-equiv=content-type content=\"text/html; charset=UTF-8\"><body><table border='1'>";
	$xls[] = "<tr><td>ID</td><td>" . implode("</td><td>", array_values($keynames)) . '</td></tr>';
	$index = 0;
	if (preg_match('/MSIE/',$_SERVER['HTTP_USER_AGENT'])) {
		$name = rawurlencode($name);
	}
	foreach($data As $o) {
		$line = array(++$index);
		foreach($keynames AS $k=>$v) {
			$line[] = htmlspecialchars($o[$k]);
		}
		$xls[] = '<tr><td>'. implode("</td><td>", $line) . '</td></tr>';
	}
	$xls[] = '</table></body></html>';
	$xls = join("\r\n", $xls);
	header("Content-Type: application/vnd.ms-excel");
	header('Content-Disposition: attachment; filename="'.$name.'.xls"');
	die(mb_convert_encoding($xls,'UTF-8','UTF-8'));
}

/**
 * 使用phpexcel插件导出excel文件
 */
function down_xls2($data){
	// 导入phpexcel文件
	require(__DIR__ . '/../../ext/phpexcel/PHPExcel.php');
	$phpexcel = new PHPExcel();	
	// 获取当前的 sheet
	$excelSheet = $phpexcel->getActiveSheet();
	// 设置sheet名称
	$excelSheet->setTitle($data['title']);
	// 设置行标题
	$ab = range('A', 'Z');
	foreach ($data['head'] as $key=>$val){
		$excelSheet->setCellValue($ab[$key].'1',$val);
	}
	
	// 设置每行的数据
	$i = 1;
	foreach ($data['row_data'] as $key=>$val){
		$i++;
		$excelSheet->setCellValue($ab[$key].$i,$val[$key]);
	}
	
	// 输出浏览器
	header("Content-Type: application/vnd.ms-excel");	//  告诉浏览器将要输出excel2003文件
	header('Content-Disposition: attachment; filename="'.$data['fileName'].'.xls"');	// 告诉浏览器将输出文件的名称
	header("Cache-Control: max-age=0");		// 禁止缓存
	
	// 保存到浏览器
	$objWriter = PHPExcel_IOFactory::createWriter($phpexcel, 'Excel5');
	//$objWriter->save('pjp.xls'); // 保存excel文件到本地
	$objWriter->save('php://output');
	exit;
	//die(mb_convert_encoding($xls,'UTF-8','UTF-8'));
}

/**
 * 使用phpexcel插件导出excel文件
 */
function down_xls3($data){
	// 导入phpexcel文件
	require(__DIR__ . '/../../ext/phpexcel/PHPExcel.php');

	// 设置行标题
	//创建新的PHPExcel对象
	$objPHPExcel = new PHPExcel();
	$objProps = $objPHPExcel->getProperties();
	 
	//设置表头
	$key = ord("A");
	foreach($data['head'] as $v){
		$colum = chr($key);
		$objPHPExcel->setActiveSheetIndex(0) ->setCellValue($colum.'1', $v);
		$key += 1;
	}
	 
	$column = 2;
	$objActSheet = $objPHPExcel->getActiveSheet();
	foreach($data['row_data'] as $key => $rows){ //行写入
		$span = ord("A");
		foreach($rows as $keyName=>$value){// 列写入
			$j = chr($span);
			$objActSheet->setCellValue($j.$column, $value);
			$span++;
		}
		$column++;
	}

	// 输出浏览器
	header("Content-Type: application/vnd.ms-excel");	//  告诉浏览器将要输出excel2003文件
	header('Content-Disposition: attachment; filename="'.$data['fileName'].'.xls"');	// 告诉浏览器将输出文件的名称
	header("Cache-Control: max-age=0");		// 禁止缓存

	// 保存到浏览器
	$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
	//$objWriter->save('pjp.xls'); // 保存excel文件到本地
	$objWriter->save('php://output');
	exit;
	//die(mb_convert_encoding($xls,'UTF-8','UTF-8'));
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
		curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
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

function p($var){
	echo "<pre>";
	var_dump($var);
	echo "</pre>";
}