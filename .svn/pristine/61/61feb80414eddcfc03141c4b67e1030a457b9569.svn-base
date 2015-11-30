
	<div class="nav_top clearfix" style="position:absolute;"><span class="re_left"></span>申请退款</div>
	<div class="wrap">
		<div class="refund fs25">
			<form action="index.php?r=order/refund&id=<?= $order_id ?>"  method="post" id='refund_f'>				
				<div class="l">
					<p>退款类型<span class="f1">*</span></p>
					<p class="clearfix">我要退款<span class="f_r r"><span class="r3"></span></span></p>
					<p class="clearfix">我要退货<span class="f_r r"><span class="r4"></span></span></p>
					<input type="hidden" value="1" name="Refund[refund_type]">
				</div>
				<div class="sp10"></div>
				<div class="l">
					<p>退款原因<span class="f1">*</span></p>
					<div class="yy">
						<p class="clearfix f7"><span class="yy">我要退款</span><span class="f_r"><span class="go_r"></span></span></p>
						<p class="dn">退运费</p>
						<p class="dn">收到商品破损</p>
						<p class="dn">商品错发/漏发</p>
						<p class="dn">商品质量问题</p>
						<p class="dn">发票问题</p>
						<p class="dn">收到商品与描述不符</p>
						<p class="dn">我不想要了</p>
					</div>

					<input type="hidden" value="" name="Refund[refund_reason]">
				</div>

				<div class="sp10"></div>				
				<div class="l">
					<p>退款说明(可不写)</p>
					<p class="clearfix" style="padding-left:0;"><textarea name="Refund[refund_desc]" id="" placeholder='请输入退款说明'></textarea></p>
				</div>
				
				<div style='color:red'>
				<!-- 错误信息的输出 -->
					<?php
						if($errors){
							foreach ($errors as $val){
								foreach($val as $v){
									echo '&nbsp;'.$v.'<br/>';
								}
							}
						}
					?>
			    </div>
				
			</form>
			<div class="refund_f fs30" onclick="submitForm('#refund_f')" >确定</div>
		</div>
	</div>

