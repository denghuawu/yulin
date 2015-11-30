<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Job */
/* @var $form yii\widgets\ActiveForm */
?>
<!-- 初始隐藏 新建 -->
				<div id="content" class="hide">
					<form class="form-horizontal" action='index.php?r=department/create' method='post'>
						
						<div class="row">
							<!-- 职位上级 -->
							<div class="control-group">
								<label class="control-label">职位上级：</label>
								<div class="controls">
									<select name="Department[parent_id]" class="input-normal">
										<option value="">请选择</option>
										<option value="0">无</option>
										<?php
											foreach ($department as $val){
										?>
											<option value="<?= $val['id'] ?>"><?= $val['depart_name'] ?></option>
										<?php } ?>
									</select>
								</div>
							</div>
						</div>
						
						<div class="row">
							<!-- 
							部门名称 -->
							<div class="control-group">
								<label class="control-label">部门名称：</label>
								<div class="controls">
									<input name="Department[depart_name]" type="text" data-rules="{required:true}" class="input-normal control-text"></div>
							</div>
						</div>
						
						<input type="submit">
					</div>
					</form>
				</div>
				<!-- 编辑 -->
				<div id="content2" class="hide">
					<form class="form-horizontal" method="get" action="index.php">
						<div class="row">
							<!-- 部门编号 -->
							<div class="control-group span10">
								<label class="control-label">部门编号：</label>
								<div class="controls">
									<input name="bian" type="text" data-rules="{required:true}" class="input-normal control-text"></div>
							</div>

							<div class="control-group span10">
								<label class="control-label">上级部门：</label>
								<div class="controls">
									<select name="shangji" class="input-normal">
										<option value="">行政部</option>
										<option value="1">选项一</option>
										<option value="2">选项二</option>
										<option value="开发部">开发部</option>
										<option value="开发部2好">开发部2好</option>
									</select>
								</div>
							</div>

						</div>
						<div class="row">
							<div class="control-group span10 ">
								<label class="control-label">部门名称：</label>
								<div class="controls">
									<input name="a" type="text" data-rules="{required:true}" class="input-normal control-text"></div>
							</div>
						</div>
					</form>
				</div>
		        <!-- 查看 -->
				<div id="content3" class="hide">
					<form class="form-horizontal">
						<div class="row">
							<!-- 部门编号 -->
							<div class="control-group span10">
								<label class="control-label">部门编号：</label>
								<div class="controls control-row4"><input type="text" name="bian" readonly="true" class="none_border"></div>
							</div>

							<div class="control-group span10">
								<label class="control-label">上级部门：</label>
								<div class="controls control-row4"><input type="text" name="shangji" readonly="true" class="none_border"></div>
							</div>

						</div>
						<div class="row">
							<div class="control-group span10 ">
								<label class="control-label">部门名称：</label>
								<div class="controls control-row4"><input type="text" name="a" readonly="true" class="none_border"></div>
							</div>
							<div class="control-group span10">
								<label class="control-label">部门人数：</label>
								<div class="controls control-row4"><input type="text" name="b" readonly="true" class="none_border"></div>
							</div>

						</div>

						<div class="row">
							<div class="control-group span22">
								<label class="control-label">部门职位：</label>
								<div class="controls control-row4"><input type="text" name="c" readonly="true" class="none_border"></div>
							</div>
						</div>
					</form>
				</div>


