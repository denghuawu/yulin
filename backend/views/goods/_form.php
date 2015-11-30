<link rel="stylesheet" href="../../ext/kindeditor/themes/default/default.css" />
	<script charset="utf-8" src="../../ext/kindeditor/kindeditor.js"></script>
	<script charset="utf-8" src="../../ext/kindeditor/lang/zh_CN.js"></script>
	
	<script>
	KindEditor.ready(function(K) {
		KindEditor.ready(function(K) {
			var editor = K.editor({
				allowFileManager : true
			});
			K('#J_selectImage').click(function() {
				editor.loadPlugin('multiimage', function() {
					editor.plugin.multiImageDialog({
						clickFn : function(urlList) {
							var div = K('#J_imageView');
							div.html('');
							K.each(urlList, function(i, data) {
								div.append('<img src="' + data.url + '">');
							});
							editor.hideDialog();
						}
					});
				});
			});
		});
	</script>

<!-- 初始隐藏 新建 -->
				<div id="content" class="hide">
					<form action='index.php?r=goods/create' method='post' class="form-horizontal">
						<div class="row">
							<div class="control-group span10">
								<label class="control-label">产品编号：</label>
								<div class="controls">
									<input class="input-normal control-text" type="text" name="Goods[goods_sn]">
								</div>
							</div>
							<div class="control-group span10">
								<label class="control-label">产品规格：</label>
								<div class="controls bui-form-field-plain" data-cfg="{renderer:planFormat}">
									<input class="input-normal control-text" type="text" name="Goods[unit_jian]">
								</div>
							</div>
						</div>
						<div class="row">
							<div class="control-group span10">
								<label class="control-label">产品名称：</label>
								<div class="controls">
									<input class="input-normal control-text" type="text" name="Goods[goods_name]"></div>
							</div>
							<div class="control-group span10">
								<label class="control-label">库存上限：</label>
								<div class="controls bui-form-field-plain" data-cfg="{renderer:planFormat}">
									<input class="input-normal control-text" type="text" name="Goods[warehouse_upper_limit]"></div>
							</div>
						</div>
						<div class="row">
							<div class="control-group span10">
								<label class="control-label">产品年份：</label>
								<div class="controls">
									<select name="Goods[goods_year]" class="input-normal">
										<option value="">请选择</option>
										<?= make_option_list($GLOBALS['goods_year']) ?>
									</select>
							</div>
							<div class="control-group span10">
								<label class="control-label">库存下限：</label>
								<div class="controls bui-form-field-plain" data-cfg="{renderer:planFormat}">
									<input class="input-normal control-text" type="text" name="Goods[warehouse_down_limit]"></div>
							</div>
						</div>
						<div class="row">
							<div class="control-group span10">
								<label class="control-label">产品系列：</label>
								<div class="controls">
									<select name="Goods[variety_id]" class="input-normal">
										<option value="">请选择</option>
										<?= make_option_list($data['variety']) ?>
									</select>
								</div>
							</div>
							<div class="control-group span10">
								<label class="control-label">标准单价：</label>
								<div class="controls bui-form-field-plain" data-cfg="{renderer:planFormat}">
									<input class="input-normal control-text" type="text" name="Goods[goods_price]"></div>
							</div>
						</div>
						<div class="row">
							<div class="control-group span10">
								<label class="control-label">产品分类：</label>
								<div class="controls">
									<select name="Goods[cat_id]" class="input-normal">
										<option value="">请选择</option>
										<?= make_option_list($data['category']) ?>
										
									</select>	
								</div>
							</div>
							<div class="control-group span10">
								<label class="control-label">出厂价：</label>
								<div class="controls bui-form-field-plain" data-cfg="{renderer:planFormat}">
									<input class="input-normal control-text" type="text" name="Goods[factory_price]"></div>
							</div>
						</div>
						<div class="row">
							<!-- 职位名称 -->
							<div class="control-group span10">
								<label class="control-label">产品配货：</label>
								<div class="controls  control-row-auto">
									<select name="Goods[is_updown]" class="input-normal">
										<option value="1">上架</option>
										<option value="0">下架</option>
									</select>	
								</div>
							</div>
						</div>
						
						<div class="row">
							<!-- 产品图片 -->
							<div class="control-group span10">
								<label class="control-label">产品图片：</label>
								<div class="controls  control-row-auto">
									
								</div>
							</div>
						</div>
						
						<input type='submit' />
					</form>
					<input type="button" id="J_selectImage" value="批量上传" />
									<div id="J_imageView"></div>
					</div>
					<!-- 查看 -->
					<div id="content3" class="hide">
					<form class="form-horizontal none_border">
						<div class="row">
							<div class="pull-right input_button_group clearfix">
								<a href="#" class="button_a">left</a>
								<a href="#" class="button_a">middle</a>
								<a href="#" class="button_a">right</a>
							</div>
						</div>
						<div class="row">
							<div class="control-group span10">
								<label class="control-label">产品编号：</label>
								<div class="controls">
									<input readonly="" class="input-normal control-text" type="text">
								</div>
							</div>
							<div class="control-group span10">
								<label class="control-label">产品规格：</label>
								<div class="controls bui-form-field-plain" data-cfg="{renderer:planFormat}">
									<input readonly="" class="input-normal control-text" type="text">
								</div>
							</div>
						</div>
						<div class="row">
							<div class="control-group span10">
								<label class="control-label">产品名称：</label>
								<div class="controls">
									<input readonly="" class="input-normal control-text" type="text"></div>
							</div>
							<div class="control-group span10">
								<label class="control-label">库存上限：</label>
								<div class="controls bui-form-field-plain" data-cfg="{renderer:planFormat}">
									<input readonly="" class="input-normal control-text" type="text"></div>
							</div>
						</div>
						<div class="row">
							<div class="control-group span10">
								<label class="control-label">产品年份：</label>
								<div class="controls">
									<input readonly="" class="input-normal control-text" type="text"></div>
							</div>
							<div class="control-group span10">
								<label class="control-label">库存下限：</label>
								<div class="controls bui-form-field-plain" data-cfg="{renderer:planFormat}">
									<input readonly="" class="input-normal control-text" type="text"></div>
							</div>
						</div>
						<div class="row">
							<div class="control-group span10">
								<label class="control-label">产品系列：</label>
								<div class="controls">
									<input readonly="" class="input-normal control-text" type="text">
								</div>
							</div>
							<div class="control-group span10">
								<label class="control-label">标准单价：</label>
								<div class="controls bui-form-field-plain" data-cfg="{renderer:planFormat}">
									<input readonly="" class="input-normal control-text" type="text"></div>
							</div>
						</div>
						<div class="row">
							<div class="control-group span10">
								<label class="control-label">产品分类：</label>
								<div class="controls">
									<input readonly="" class="input-normal control-text" type="text">
								</div>
							</div>
							<div class="control-group span10">
								<label class="control-label">出厂价：</label>
								<div class="controls bui-form-field-plain" data-cfg="{renderer:planFormat}">
									<input readonly="" class="input-normal control-text" type="text"></div>
							</div>
						</div>
						<div class="row">
							<!-- 职位名称 -->
							<div class="control-group span10">
								<label class="control-label">产品配货：</label>
								<div class="controls  control-row-auto">
									<input readonly="" class="input-normal control-text" type="text">
								</div>
							</div>

						</div>
					</form>
				</div>
				<!-- 初始隐藏 编辑 -->
				<div id="content2" class="hide">
					<form class="form-horizontal">
						<div class="row">
							<div class="control-group span10">
								<label class="control-label">产品编号：</label>
								<div class="controls">
									<input class="input-normal control-text" type="text">
								</div>
							</div>
							<div class="control-group span10">
								<label class="control-label">产品规格：</label>
								<div class="controls bui-form-field-plain" data-cfg="{renderer:planFormat}">
									<input class="input-normal control-text" type="text">
								</div>
							</div>
						</div>
						<div class="row">
							<div class="control-group span10">
								<label class="control-label">产品名称：</label>
								<div class="controls">
									<input class="input-normal control-text" type="text"></div>
							</div>
							<div class="control-group span10">
								<label class="control-label">库存上限：</label>
								<div class="controls bui-form-field-plain" data-cfg="{renderer:planFormat}">
									<input class="input-normal control-text" type="text"></div>
							</div>
						</div>
						<div class="row">
							<div class="control-group span10">
								<label class="control-label">产品年份：</label>
								<div class="controls">
									<input class="input-normal control-text" type="text"></div>
							</div>
							<div class="control-group span10">
								<label class="control-label">库存下限：</label>
								<div class="controls bui-form-field-plain" data-cfg="{renderer:planFormat}">
									<input class="input-normal control-text" type="text"></div>
							</div>
						</div>
						<div class="row">
							<div class="control-group span10">
								<label class="control-label">产品系列：</label>
								<div class="controls">
									<select name="" class="input-normal">
										<option value="">行政部</option>
										<option value="1">选项一</option>
										<option value="2">选项二</option>
									</select>
								</div>
							</div>
							<div class="control-group span10">
								<label class="control-label">标准单价：</label>
								<div class="controls bui-form-field-plain" data-cfg="{renderer:planFormat}">
									<input class="input-normal control-text" type="text"></div>
							</div>
						</div>
						<div class="row">
							<div class="control-group span10">
								<label class="control-label">产品分类：</label>
								<div class="controls">
									<select name="" class="input-normal">
										<option value="">行政部</option>
										<option value="1">选项一</option>
										<option value="2">选项二</option>
									</select>	
								</div>
							</div>
							<div class="control-group span10">
								<label class="control-label">出厂价：</label>
								<div class="controls bui-form-field-plain" data-cfg="{renderer:planFormat}">
									<input class="input-normal control-text" type="text"></div>
							</div>
						</div>
						<div class="row">
							<!-- 职位名称 -->
							<div class="control-group span10">
								<label class="control-label">产品配货：</label>
								<div class="controls  control-row-auto">
									<select name="" class="input-normal">
										<option value="0">上架</option>
										<option value="1">下架</option>
									</select>	
								</div>
							</div>

						</div>
					</form>
					</div>