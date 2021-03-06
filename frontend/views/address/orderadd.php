<?php 
use common\models\Region;
use yii\helpers\Url;
?>
	<title>选择收货地址地址</title>
</head>
<body>
	<div class="nav_top "><div class="nav_top_con clearfix"><a href="javascript:history.go(-1);" class="re_left"></a>收货地址<span class="re_txt" onclick="submitForm('#revamp')">确认</span></div></div>
	<div class="wrap">
		<div class="addsite fs30 pm40">
			<form action="<?= Url::to(['address/addorder']) ?>"  method="post" id="revamp">				
				<div><input  type="text" placeholder="收货人姓名" name="n"></div>
				
				<div><input  type="text" placeholder="手机号码" name="tel"></div>
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
						<option value="">请选择</option>
					</select>
					<span class="r_select"></span>
				</div>
				<div>
					<select  name="district" id="district">
						<option value="">请选择</option>
					</select>
					<span class="r_select"></span>
				</div>
				<div><textarea  placeholder="详细地址" name="site"><?= $address['address']?></textarea></div>
			</form>
		</div>
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
					$('#city').empty();
					$('#city').append('<option value="">请选择</option>');
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