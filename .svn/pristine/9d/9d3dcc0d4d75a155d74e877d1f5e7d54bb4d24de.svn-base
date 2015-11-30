<?php 
use yii\helpers\Url;
?>
	<div class="nav_top clearfix">
		<span class="re_left"></span>个人资料
	</div>
	<div class="wrap">
		<div class="personal">
			<ul class="fs30 i">
				<li class="clearfix">
					<div>
						<span>头像</span>
						<form action="javascript:void(0)" class="f_r" id="photo">
							<p>
								<input type="file" class="" name="photo" style="position: absolute;height: 5.375rem;width: 5.375rem;margin-top: 1.0625rem;opacity: 0;z-index: 2;">
								<span class="f7">
								<span class="f7"><img src="/common/upload/figure/<?= $user->figure?$user->figure:'default.png' ?>" alt="" class="box1"></span><span
								class="go_r"></span>
							</p>
					</form>
					</div>
					
				</li>
				<li class="clearfix re_n">
					<div>
						<span>昵称</span>
						<p class="f_r">
							<span class="f7"><?= $user->user_name?$user->user_name:'还是空的，快来取' ?></span><span class="go_r"></span>
						</p>
					</div>
				</li>
				<li class="clearfix re_s">
					<div>
						<span>性别</span>
						<p class="f_r">
							<span class="f7"><?= $user->sex=='1'?'男':'女' ?></span><span class="go_r"></span>
						</p>
					</div>
				</li>
				<li class="dn">
					<div class="revamp_sex">
						<div>
							<div>
								<p>男</p>
								<p>女</p>
							</div>
							<div>
								<p>取消</p>
							</div>
						</div>
					</div>
				</li>
				<li class="clearfix re_p">
					<div>
						<span>修改登录密码</span>
						<p class="f_r">
							<span class="f7"></span><span class="go_r"></span>
						</p>
					</div>
				</li>
				<li class="clearfix re_t">
					<div>
						<span>修改手机号码</span>
						<p class="f_r">
							<span class="f7"><?= substr($user->mobile_phone,0,3).'*****'.substr($user->mobile_phone,8,3) ?></span><span class="go_r"></span>
						</p>
					</div>
				</li>
			</ul>
			<ul class="z fs30">
				<li class="y dn">
					<form action="">
						<div class="cen">我们已经发送验证码到您的手机:</div>
						<div class="cen">134*****542</div>
						<div class="yzm">
							<span class="">验证码</span> <input type="text" placeholder='验证码'> <span
								class="t f7">59秒后重发</span>
						</div>
						<div class="btn">
							<span>下一步</span>
						</div>
					</form>
				</li>
				<li class="revamp_p re_p dn">
					<form action="<?= Url::to(['user/personal']) ?>" method='post'>
						<div class="revamp_i">
							<span>原密码</span> <input type="password" name="User[password]" placeholder="请输入原密码" maxlength="20" required>
						</div>
						<div class="revamp_i">
							<span>新密码</span> <input type="password" name="User[new_password]" placeholder="请输入新密码" maxlength="20" required>
						</div>
						<div class="revamp_i">
							<span>确认密码</span> <input type="password" name="User[confirm_password]" placeholder="请输入确认密码" maxlength="20" required>
						</div>
						<p class="fs20">密码由6-20位英文字母、数字或下划线组成</p>
						<div class="btn" onclick="submitForm($(this).parent())">
							<span>下一步</span>
						</div>
						<input type='hidden' name='type' value='mod_pass'/>
					</form>
				</li>
				<li class="revamp_p re_n dn">
					<form action="<?= Url::to(['user/personal']) ?>" method='post'>
						<div class="revamp_i">
							<span>昵称</span> <input name="User[user_name]" type="text" placeholder="请输入昵称" maxlength="20" required>
						</div>
						<input type='hidden' name='type' value='mod_name'/>
						<div class="btn" onclick="submitForm($(this).parent())")>
							<span>下一步</span>
						</div>
					</form>

				</li>
				<li class="revamp_p re_t dn">
					<form action="">
						<p class="">请输入新的手机号码</p>
						<div class="revamp_i">
							<span>手机号码</span> <input type="text" placeholder="请输入手机号码"
								maxlength="20" required>
						</div>
						<div class="btn">
							<span>下一步</span>
						</div>
					</form>

				</li>
			</ul>
			
			<div style='color:red'>
				<!-- 错误信息的输出 -->
					<?php
						if($model->errors){
							foreach ($model->errors as $val){
								foreach($val as $v){
									echo '&nbsp;'.$v.'<br/>';
								}
							}
						}
					?>
			    </div>
			
			
		</div>
		<a href="<?= Url::to(['site/logout']) ?>">
		<div class="personal_foot fs35">退出当前账号</div>
		</a>
	</div>
	
	
<script type="text/javascript">
    function fsubmit(){
        var data = new FormData($('#photo')[0]);
        $.ajax({
            url: 'index.php?r=user/figure',
            type: 'POST',
            data: data,
            dataType: 'JSON',
            cache: false,
            processData: false,
            contentType: false
        }).done(function(ret){
            if(ret['success'] ){                
               $('.personal ul>li:first img').attr({'src':'/common/upload/figure/'+ret['name']});
            }else{
                alt('提交失敗');
            }
        });
        return false;
    }
    $('input[name="photo"]').change(function(){
    	fsubmit();
        });
</script>