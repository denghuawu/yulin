<?php

?>

<!DOCTYPE HTML>
<html>
 <head>
  <title> 后台管理系统</title>
   <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
   <link href="assets/css/dpl-min.css" rel="stylesheet" type="text/css" />
   <link href="assets/css/bui-min.css" rel="stylesheet" type="text/css" />
   <link href="assets/css/main-min.css" rel="stylesheet" type="text/css" />

   <!-- <link href="assets/css/yii-main.css" rel="stylesheet" type="text/css" /> -->
  <script type="text/javascript" src="assets/js/jquery-1.8.1.min.js"></script>
  <script type="text/javascript" src="./assets/js/bui.js"></script>
  <script type="text/javascript" src="./assets/js/config.js"></script>
 </head>
 <body>

  <div class="header">
    
      <div class="dl-title">

          <span class="lp-title-port">大茶源</span><span class="dl-title-text">后台管理</span>
        </a>
      </div>

    <div class="dl-log">欢迎您，<span class="dl-log-user"><?= $_SESSION['admin']['user_name'];?></span>
    <a href="index.php?r=site/reset" class="dl-log-quit">[密码重置]</a>
    <a href="index.php?r=site/logout" title="退出系统" class="dl-log-quit">[退出]</a>
    </div>
  </div>
   <div class="content">
    <div class="dl-main-nav">
      <div class="dl-inform"><div class="dl-inform-title">贴心小秘书<s class="dl-inform-icon dl-up"></s></div></div>
      <ul id="J_Nav"  class="nav-list ks-clear">
      <?php		// 生成导航
	         if(isset($_SESSION['admin']['action_list'])){
	         	foreach ($_SESSION['admin']['action_list'] as $key => $value) {
	         		//f(isset($value['child']) && in_arrays($value['child'],$_SESSION['admin']['my_action'])){
	         			
	   ?>
	   
        <li class="nav-item dl-selected"><div class="nav-item-inner"><?= $value['action_name'] ?></div></li>

        <?php }}//} ?>
        
      </ul>
    </div>
    <ul id="J_NavContent" class="dl-tab-conten">

    </ul>
   </div>
 
  <script>
    BUI.use('common/main',function(){
      var config = [

         <?php		// 生成顶部导航和左边菜单
	         if(isset($_SESSION['admin']['action_list'])){
	         	foreach ($_SESSION['admin']['action_list'] as $key => $value) {
	         		if(isset($value['child']) && in_arrays($value['child'],$_SESSION['admin']['my_action'])){
	         			$json_str = null;
	         			$json_str = "{id:'".$value['action_code']."', menu:[";
	         			$json_str .= "{text:'".$value['action_name']."',items:[";
	         	
	         			foreach ($value['child'] as $k => $v) {
	         				if(in_array($v['action_url'],$_SESSION['admin']['my_action'])){
	         					$json_str .= "{id:'".$v['action_url']."',text:'".$v['action_name']."',href:'index.php?r=".$v['action_url']."'},";
	         				}
	         				
	         			}
	         			$json_str = rtrim($json_str,',');
	         			$json_str .= "]}]},";
	         			echo $json_str;
	         		}
	         	}
	         }
            
         ?>
         /* {
             text:'开发者选项',
             items:[
               {id:'code',text:'导航列表',href:'index.php?r=action/index'}
             ]
           }] */
              
              
          ];
      new PageUtil.MainPage({
        modulesConfig : config
      });
    });
  </script>

</body>
</html>
