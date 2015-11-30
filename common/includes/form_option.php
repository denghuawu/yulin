<?php
/* 
 * 定义表单选项数组
 *  */

// 政治状态
$GLOBALS['political_status'] = ['中共党员','共青团员 ','普通公民'];

// 民族
$GLOBALS['nation'] = ["汉族","蒙古族","回族","藏族","维吾尔族","苗族","彝族","壮族","布依族","朝鲜族","满族","侗族","瑶族","白族","土家族",
               "哈尼族","哈萨克族","傣族","黎族","傈僳族","佤族","畲族","高山族","拉祜族","水族","东乡族","纳西族","景颇族","柯尔克孜族",
               "土族","达斡尔族","仫佬族","羌族","布朗族","撒拉族","毛南族","仡佬族","锡伯族","阿昌族","普米族","塔吉克族","怒族", "乌孜别克族",
              "俄罗斯族","鄂温克族","德昂族","保安族","裕固族","京族","塔塔尔族","独龙族","鄂伦春族","赫哲族","门巴族","珞巴族","基诺族"];

// 在职状态
$GLOBALS['position_status'] = ['在职试用','在职正式','离职','退休'];

// 员工类型
$GLOBALS['em_type'] = ['正式工','合同工','临时工','试用','兼职'];

// 人才类型
$GLOBALS['tp_type'] = ['普通','中级','高级','顶尖'];

// 学历
$GLOBALS['education_level'] = ['无','中专','大专','本科','硕士','博士','研究生'];

// 婚姻
$GLOBALS['marriage'] = ['未婚','已婚','离异'];

// 计算当天
$startTime=strtotime(date('Y-m-d'));
$endTime=strtotime(date('Y-m-d',strtotime('+1 day')));

// 计算本月
$start = mktime(0,0,0,date('m'),1,date('Y'));
$startMonth = date('Y-m-01', strtotime(date("Y-m-d",$start)));
$today = explode('-', $startMonth);
$start_month = mktime(0,0,0,$today[1],$today[2],$today[0]);
$endDay = date('Y-m-d', strtotime("$startMonth +1 month -1 day"));
$endDay = explode('-', $endDay);
$endMonth = mktime(23,59,59,$endDay[1],$endDay[2],$endDay[0]);

// 计算下一个月
$nextMonth = date('Y-m-01', strtotime("$startMonth +1 month"));
$endDay = date('Y-m-d', strtotime("$nextMonth +2 month -1 day"));
$nextMonth = explode('-', $nextMonth);
$nextMonth = mktime(0,0,0,$nextMonth[1],$nextMonth[2],$nextMonth[0]);
$endDay = explode('-', $endDay);
$endNextMonth = mktime(23,59,59,$endDay[1],$endDay[2],$endDay[0]);

// <1年 >1年  >2年 >3年  >4年
$qu_year = time()-365*24*3600*1;
$yi_year = time()-365*24*3600*1;
$er_year = time()-365*24*3600*2;
$san_year = time()-365*24*3600*3;
$si_year = time()-365*24*3600*4;
// 今天，明天，后天，本月，下月
$today = ' BETWEEN '.$startTime.' and '.(strtotime(date('Y-m-d',strtotime('+1 day')))-1);
$yesterday = ' BETWEEN '.strtotime(date('Y-m-d',strtotime('+1 day'))).' and '.(strtotime(date('Y-m-d',strtotime('+2 day')))-1);
$afterday = ' BETWEEN '.strtotime(date('Y-m-d',strtotime('+2 day'))).' and '.(strtotime(date('Y-m-d',strtotime('+3 day')))-1);
$month = ' BETWEEN '.($start_month).' and '.($endMonth);
$nextmonth = ' BETWEEN '.($nextMonth).' and '.($endNextMonth);

$GLOBALS['birthday'] = [$today=>'今天',$yesterday=>'明天',$afterday=>'后天',$month=>'本月',$nextmonth=>'下月'];
//var_dump($GLOBALS['birthday']);die;
// 入职时间
$GLOBALS['entry_time'] = ['<'.$qu_year=>'<1年','>'.$yi_year=>'>1年','>'.$er_year=>'>2年','>'.$san_year=>'>3年','>'.$si_year=>'>4年'];

// 男女
$GLOBALS['sex'] = ['女','男'];

// <5人 >5人 >10人 >20人 >30人
$people_num = ['<5'=>'5人','>=5'=>'>5人',' >=10'=> '>10人','>=20'=>'>20人','>=30'=>'>30人'];

// 产品年份
$range_year = range(2013,date(Y));
$GLOBALS['goods_year'] = array_combine($range_year,$range_year);

// 产品单价
$GLOBALS['goods_price'] = ['<1000'=>'<1000元','>1000'=>'>1000元','>2000'=>'>2000元','>3000'=>'>3000元','>5000'=>'>5000元'];

// 库存预警
$GLOBALS['warehouse_warnning'] = [1=>'紧缺',2=>'满溢'];

// 客户类型
$GLOBALS['user_type'] = [1=>'公海客户',2=>'专管客户',3=>'开发中客户'];

