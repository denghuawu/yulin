<?php 
use common\models\Region;
use yii\helpers\Url;
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="Pragma" Content="No-cach">
	<meta name="format-detection" content="telephone=no">
	<meta name="viewport" content="width=device-width,initial-scale=0.5,maximum-scale=0.5,minimum-scale=0.5,user-scalable=no">
	<meta name="MobileOptimized" content="320">
	<meta http-equiv="cleartype" content="on">
	<meta name="apple-mobile-web-app-status-bar-style" content="black">
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta charset="UTF-8">
	<title>修改地址</title>
	<link rel="stylesheet" type="text/css" href="./yulin_home/css/style.css">
	<script type="text/javascript" src="./yulin_home/js/jquery.js"></script>
	<script type="text/javascript" src="./yulin_home/js/public.js"></script>
</head>
<body>
	<div class="nav_top "><div class="nav_top_con clearfix"><a href="javascript:history.go(-1);" class="re_left"></a>修改收货地址<span class="re_txt" onclick="submitForm('#revamp')">保存</span></div></div>
	<div class="wrap">
		<div class="addsite fs30 pm40">
			<form action="<?= Url::to(['address/up', 'id'=>$address['address_id']]) ?>"  method="post" id="revamp">				
				<div><input  type="text" placeholder="收货人姓名" name="n" value="<?= $address['address_name'] ?>"></div>
				
				<div><input  type="text" placeholder="手机号码" name="tel" value="<?= $address['mobile'] ?>"></div>
				<div>
					<select  name="province" id="province">
						<?php foreach (Region::region_list(0) as $key=>$val){ ?>
								<option value="<?= $key; ?>" <?= $address['pid'] == $key ? 'selected' : '' ?>> <?= $val; ?> </option>
						<?php } ?>
					</select>
					<span class="r_select"></span>
				</div>
				<div>
					<select  name="city" id="city">
						<option value="<?= $address['cid'] ?>"><?= Region::region_name('',$address['cid']); ?></option>
					</select>
					<span class="r_select"></span>
				</div>
				<div>
					<select  name="district" id="district">
						<option value="<?= $address['did'] ?>"> <?= Region::region_name('','',$address['did']) ?> </option>
					</select>
					<span class="r_select"></span>
				</div>
				<div><textarea  placeholder="详细地址" name="site"><?= $address['address']?></textarea></div>
			</form>
		</div>
		<div class="revampsite fs30 pl30 f1" site_id='' onclick="locat(this)" hre='<?= Url::to(['address/delete', 'id'=>$address['address_id']]) ?>'>
			删除此收货地址
		</div>
		<div class="default_site fs30"><div class="default_site_con fs30"  onclick="locat(this)" hre='<?= Url::to(['address/setdefault', 'id'=>$address['address_id']]) ?>'>设置默认地址</div></div>
	</div>
</body>
</html>
    
    
    <script>

	$("#province").change(function(){
		if(this.value == ''){
			$("#district,#city").empty();
			$("#district,#city").append('<option value="">请选择</option>');
			return;
		}
		var parent_id = this.value;
		$.post(
			'index.php?r=address/region&parent_id='+parent_id,
			function($m){
				if($m){
					$('#district,#city').empty();
					$('#district,#city').append('<option value="">请选择</option>');
					$('#city').append($m);
				}
			})
	})
	
	$("#city").change(function(){
		if(this.value == ''){
			$("#district").empty();
			$('#district').append('<option value="">请选择</option>');
			return;}
		var parent_id = this.value;
		$.post(
			'index.php?r=address/region&parent_id='+parent_id,
			function($m){
				if($m){
					$('#district').empty();
					$('#district').append($m);
				}
				
			})
	})
</script>
