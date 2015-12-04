<?php
use yii\helpers\Url;
use common\models\Region;
?>
<style type="text/css">
.container {
	max-width: 1920px;
	width: 100% !important;
	display: block;
}

.bui-dialog {
	border-radius: 0;
	border: 10px solid #262626;
}

.bui-dialog .bui-stdmod-header, .bui-dialog .bui-stdmod-footer {
	background: linear-gradient(#FEFEFE, #EDEDE7);
	background: -ms-linear-gradient(#FEFEFE, #EDEDE7);
	background: -webkit-linear-gradient(#FEFEFE, #EDEDE7);
}

.bui-dialog .bui-stdmod-header {
	height: 28px;
}

.guishuren_btn {
	width: 40px;
	height: 28px;
	text-align: center;
}

.order_information td {
	text-align: center;
}

td.tit {
	text-align: left;
}

table {
	text-align: center;
}

.bui-grid-table .bui-grid-hd {
	text-align: center;
}

.bui-dialog .bui-stdmod-header {
	height: 34px;
	line-height: 34px;
}

.bui-dialog .bui-stdmod-body {
	margin: 0;
}

.bui-dialog .bui-stdmod-footer {
	margin: 0;
	height: 48px;
	line-height: 48px;
}

.bui-dialog a.bui-ext-close {
	top: 9px;
}
/* 搜索 */
.search {
	width: 357px;
	height: 26px;
	background: pink;
	border: 1px solid #d3d3d3;
}

.search input {
	width: 298px;
	height: 24px;
	border: none;
}
/* 添加联系人 */
.toolbar {
	width: 834px;
	height: 34px;
	border: 1px solid #cccccc;
	background: linear-gradient(#fefefe, #eeeeea);
	background: -ms-linear-gradient(#fefefe, #eeeeea);
	background: -webkit-linear-gradient(#fefefe, #eeeeea);
	border-bottom: none;
}

.linkman_btn {
	border: none;
	background: none;
	color: #016b96;
}

.toolbar .linkman_f {
	margin-left: 50px;
}

/* 查看客户资料 */
input.dislodge {
	border: none;
}

.xixi {
	margin-top: 50px;
}

.red {
	color: #f55853;
}

.all {
	margin-top: 12px;
}

.in_add {
	color: #fb7f67;
	padding: 0 5px;
}
</style>

<div class="container">
	<div id="grid1"></div>
	<div id="content1" class="hide">
		<form action="" id="form1" name="form1" class="form-horizontal">
			<!-- 用户名 -->
			<div class="row">
				<div class="control-group span8">
					<label class="control-label">姓名：</label>
					<div class="controls">
						<input type="text" name="userName" id="userName" class="dislodge">
					</div>
				</div>
				<div class="control-group span8">
					<label class="control-label">性别：</label>
					<div class="controls">
						<input type="text" name="sex" id="sex" class="dislodge">
					</div>
				</div>
			</div>
			<!-- 客户类型 -->
			<div class="row">
				<div class="control-group span8">
					<label class="control-label">客户类型：</label>
					<div class="controls">
						<input type="text" name="client_type" id="client_type"
							class="dislodge">
					</div>
				</div>
				<div class="control-group span12">
					<label class="control-label">归属人：</label>
					<div class="controls">
						<input type="text" id="guishuren" name="guishuren"
							class="dislodge">

					</div>
				</div>
			</div>
			<!-- 出生日期 -->
			<div class="row">
				<div class="control-group span8">
					<label class="control-label">出生日期：</label>
					<div class="controls">
						<input type="text" id="birthday" name="birthday" class="dislodge">
					</div>
				</div>
				<div class="control-group span12">
					<label class="control-label">收货地址：</label>
					<div class="controls">
						<input type="text" id="guishuren" name="guishuren"
							class="dislodge">

					</div>
				</div>
			</div>
			<!-- 省份证号 -->
			<div class="row">
				<div class="control-group span8">
					<label class="control-label">身份证号：</label>
					<div class="controls">
						<input type="text" name="id_number" id="id_number"
							class="dislodge">
					</div>
				</div>
				<div class="control-group span12"></div>
			</div>
			<!-- 籍贯 -->
			<div class="row">
				<div class="control-group span8">
					<label class="control-label">籍贯：</label>
					<div class="controls">
						<input type="text" name="native_place" id="native_place"
							class="dislodge">
					</div>
				</div>
				<div class="control-group span8">
					<label class="control-label">店铺名称：</label>
					<div class="controls">
						<input type="text" name="store" id="store" class="dislodge">
					</div>
				</div>
			</div>
			<!-- 手机号码 -->
			<div class="row">
				<div class="control-group span8">
					<label class="control-label">手机号码：</label>
					<div class="controls">
						<input type="text" name="phone_num" id="native_place"
							class="dislodge">
					</div>
				</div>
				<div class="control-group span8">
					<label class="control-label">Email：</label>
					<div class="controls">
						<input type="text" name="store" id="store" class="dislodge">
					</div>
				</div>
			</div>
			<!-- qq -->
			<div class="row">
				<div class="control-group span8">
					<label class="control-label">QQ ：</label>
					<div class="controls">
						<input type="text" name="qq" id="qq" class="dislodge">
					</div>
				</div>

			</div>
		</form>
	</div>
	<!-- 编辑客户资料 -->
	<div id="content2" class="hide">

		<div id="tab"></div>
		<div id="panel" class="" style="padding: 10px;">
			<!-- 客户信息 -->
			<div>
				<form action="" id="form1" name="form1" class="form-horizontal">
					<!-- 用户名 -->
					<div class="row">
						<div class="control-group span8">
							<label class="control-label red"><s>*</s>姓名：</label>
							<div class="controls">
								<input type="text" name="userName" id="userName">
							</div>
						</div>
						<div class="control-group span8">
							<label class="control-label">性别：</label>
							<div class="controls">
								<input id="sex1" name="sex" type="radio" value="1" checked>男 <input
									id="sex2" name="sex" type="radio" value="2">女
							</div>
						</div>
					</div>
					<!-- 客户类型 -->
					<div class="row">
						<div class="control-group span8">
							<label class="control-label">客户类型：</label>
							<div class="controls">
								<select name="client_type" id="client_type">
									<option value="one">一</option>
									<option value="two">二</option>
								</select>
							</div>
						</div>
						<div class="control-group span12">
							<label class="control-label">归属人：</label>
							<div class="controls">
								<input type="text" id="guishuren" name="guishuren">
								<button class="guishuren_btn">···</button>
							</div>
						</div>
					</div>
					<!-- 出生日期 -->
					<div class="row">
						<div class="control-group span8">
							<label class="control-label">出生日期：</label>
							<div class="controls">
								<input type="text" name="birthday" id="birthday"
									class="calendar">
							</div>
						</div>
						<div class="control-group span12">
							<label class="control-label">收货地址</label>
							<div class="controls">
								<select name="city" id="city">
									<option class="input-small" value="citys">请选择省</option>

								</select> <select class="input-small"><option>区</option>请选择市
								</select> <select class="input-small"><option>区</option>请选择区
								</select>

							</div>
						</div>
					</div>
					<!-- 省份证号 -->
					<div class="row">
						<div class="control-group span8">
							<label class="control-label">身份证号：</label>
							<div class="controls">
								<input type="text" name="id_number" id="id_number">
							</div>
						</div>
						<div class="control-group span12">
							<label class="control-label">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
							<div class="controls">
								<input type="text" id="address" name="address"
									data-tip="{text:'请填写详细街道地址'}">

							</div>
						</div>
					</div>
					<!-- 籍贯 -->
					<div class="row">
						<div class="control-group span8">
							<label class="control-label">籍贯：</label>
							<div class="controls">
								<input type="text" name="native_place" id="native_place">
							</div>
						</div>
						<div class="control-group span8">
							<label class="control-label">店铺名称：</label>
							<div class="controls">
								<input type="text" name="store" id="store">
							</div>
						</div>
					</div>
					<!-- 手机号码 -->
					<div class="row">
						<div class="control-group span8">
							<label class="control-label red">手机号码：</label>
							<div class="controls">
								<input type="text" name="phone_num" id="native_place">
							</div>
						</div>
						<div class="control-group span8">
							<label class="control-label">Email：</label>
							<div class="controls">
								<input type="text" name="store" id="store">
							</div>
						</div>
					</div>
					<!-- qq -->
					<div class="row">
						<div class="control-group span8">
							<label class="control-label">QQ ：</label>
							<div class="controls">
								<input type="text" name="qq" id="qq">
							</div>
						</div>

					</div>
				</form>
			</div>
			<!-- 订单信息 -->
			<div>
				<ul class="toolbar">
					<li style="margin-left: 10px;">订单信息</li>
				</ul>
				<div id="grid2"></div>
				<ul class="toolbar xixi">
					<li style="margin-left: 10px;">订单总计</li>
				</ul>
				<div id="grid7"></div>
			</div>
			<!-- 联系人 -->
			<div>
				<ul class="toolbar">
					<li style="margin-left: 10px;">联系人</li>
					<li class="linkman_f"><button type="button" class="linkman_btn"
							id="linkman_btn">+添加联系人</button></li>
					<li></li>
				</ul>
				<div id="grid4"></div>
			</div>
		</div>
	</div>
	<!-- 新增客户资料 -->
	<div id="content9" class="hide">


		<form action="" id="form1" name="form1" class="form-horizontal">
			<!-- 用户名 -->
			<div class="row">
				<div class="control-group span8">
					<label class="control-label red"><s>*</s>姓名：</label>
					<div class="controls">
						<input type="text" name="User[real_name]" id="userName">
					</div>
				</div>
				<div class="control-group span8">
					<label class="control-label">性别：</label>
					<div class="controls">
						<input id="sex1" name="User[sex]" type="radio" value="1" checked>男 <input
							id="sex2" name="sex" type="radio" value="2">女
					</div>
				</div>
			</div>
			<!-- 客户类型 -->
			<div class="row">
				<div class="control-group span8">
					<label class="control-label">客户类型：</label>
					<div class="controls">
						<select name="User[user_rank]" id="client_type">
							<option value="one">一</option>
							<option value="two">二</option>
						</select>
					</div>
				</div>
				<div class="control-group span12">
					<label class="control-label">归属人：</label>
					<div class="controls">
						<input type="text" id="guishuren" name="User[admin_id]">
						<button class="guishuren_btn">···</button>
					</div>
				</div>
			</div>
			<!-- 出生日期 -->
			<div class="row">
				<div class="control-group span8">
					<label class="control-label">出生日期：</label>
					<div class="controls">
						<input type="text" name="User[birthday]" id="birthday" class="calendar">
					</div>
				</div>
				<div class="control-group span12">
					<label class="control-label">店铺所在地</label>
					<div class="controls">
						<select onchange="getRegion('select#city')" name="User[province]" id='province'>
							<option class="input-small" value="">请选择</option>
							<?php foreach(Region::region_list(0) as $pid=>$pname){ ?>
							<option class="input-small" value="<?= $pid ?>"><?= $pname ?></option>
							<?php } ?>
						</select>
						
						<select class="input-small" name='User[city]' id='city' onchange="getRegion('select#district')">
							<option>请选择</option>
						</select>
						
						<select class="input-small" name="User[district]" id='district'>
							<option>请选择</option>
						</select>

					</div>
				</div>
			</div>
			<!-- 省份证号 -->
			<div class="row">
				<div class="control-group span8">
					<label class="control-label">身份证号：</label>
					<div class="controls">
						<input type="text" name="User[id_card]" id="id_number">
					</div>
				</div>
				<div class="control-group span12">
					<label class="control-label">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
					<div class="controls">
						<input type="text" id="User[detail_address]" name="address"
							data-tip="{text:'请填写详细街道地址'}">

					</div>
				</div>
			</div>
			<!-- 籍贯 -->
			<div class="row">
				<div class="control-group span8">
					<label class="control-label">籍贯：</label>
					<div class="controls">
						<input type="text" name="User[native_place]" id="native_place">
					</div>
				</div>
				<div class="control-group span8">
					<label class="control-label">店铺名称：</label>
					<div class="controls">
						<input type="text" name="User[shop_name]" id="store">
					</div>
				</div>
			</div>
			<!-- 手机号码 -->
			<div class="row">
				<div class="control-group span8">
					<label class="control-label red">手机号码：</label>
					<div class="controls">
						<input type="text" name="User[mobile_phone]" id="native_place">
					</div>
				</div>
				<div class="control-group span8">
					<label class="control-label">Email：</label>
					<div class="controls">
						<input type="text" name="User[email]" id="store">
					</div>
				</div>
			</div>
			<!-- qq -->
			<div class="row">
				<div class="control-group span8">
					<label class="control-label">QQ ：</label>
					<div class="controls">
						<input type="text" name="User[qq]" id="qq">
					</div>
				</div>

			</div>
		</form>
	</div>
	<div id="content3" class="hide">
		<form action="">
			密码：<input type="password">
		</form>
		/div>
	</div>

	<script type="text/javascript">
		function getRegion(tag){
			rid = $("#province  option:selected").val();
			$.post("index.php?r=region/getlink&parent_id="+rid,function(data){
                $(tag).html(data);
            });
		}
	</script>

	<script type="text/javascript">
        BUI.use(['bui/grid','bui/data','bui/tab','bui/mask'],function(Grid,Data,Tab){
            var Grid = Grid,
         	Store = Data.Store,
         	
         	sex={"1":"男","2":"女"},
          	columns = [
            	{title : '姓名', dataIndex :'a'},
	            {title : '客户类型', dataIndex :'b'},
	            {title : '性别', dataIndex :'c'},
	            {title : '地区', dataIndex :'d'},
	            {title : '地址', dataIndex :'e'},
	            {title : '联系手机', dataIndex :'f'},
	            {title : '订单', dataIndex :'g'},
	            {title : '归属人', dataIndex :'h'},
	            {title : '操作', dataIndex :'i',renderer : function(){
	              return '<span class="grid-command btn-check">查看</span><span class="grid-command btn-edit">编辑</span><span class="grid-command btn-del">删除</span>';
	          }
	            }
          	],
          	columns1=[
          		{title:'订单号',dataIndex:'a'},
          		{title:'商品名称',dataIndex:'b'},
          		{title:'单价',dataIndex:'c'},
          		{title:'数量',dataIndex:'d'},
          		{title:'单位',dataIndex:'e'},
          		{title:'总价',dataIndex:'f'},
          		{title:'状态',dataIndex:'g'}
          	],
          	columns2=[ 
          		{title:'姓名',dataIndex:'a',editor : {xtype : 'text'}},
          		{title:'性别',dataIndex:'b',editor : {xtype :'select',items : sex},renderer : Grid.Format.enumRenderer(sex)},
          		{title:'对应客户',dataIndex:'c',editor : {xtype : 'text'}},
          		{title:'职位',dataIndex:'d',editor : {xtype : 'text'}},
          		{title:'手机号码',dataIndex:'e',editor : {xtype : 'number'}},
          		{title:'QQ',dataIndex:'f',editor : {xtype : 'number'}},
          		{title:'操作',dataIndex:'g',renderer:function(){ 
          			 return '<span class="grid-command btn-edits  icon-pencil"></span><span class="grid-command btn-remove  icon-remove"></span>'
          		}}
          	],
          	columns3=[ 
          		{title:'订单总数',dataIndex:'a',width:150},
          		{title:'订单总价',dataIndex:'b',width:150},
          		{title:'已成功',dataIndex:'c',width:150},
          		{title:'进行中',dataIndex:'d',width:150},
          		{title:'已关闭',dataIndex:'e',width:150}
          	],
          	
        	data = [{a:'123'},{a:'c个人股dd',c:'2013-03-13'},{a:'1333',b:2222,d:2,e:'1,2'}];
        	data1 = [{a:'1641'},{a:'c方法dd',c:'2013-03-13'},{a:'1333',b:2222,d:2,e:'1,2'}];
        	data2 = [{a:'144523'},{a:'c更换退货dd',c:'2013-03-13'},{a:'1333',b:2222,d:2,e:'1,2'}];
        	data3 = [{a:'124513'}];

 			var store = new Store({
				data : data,
				autoLoad:true
		  	}),
		  	store1 = new Store({
				data : data1,
				autoLoad:true
		  	}),
		  	store2 = new Store({
				data : data2,
				autoLoad:true
		  	}),
		  	store3 = new Store({
				data : data3,
				autoLoad:true
		  	}),

       		//查看客户资料
          	editing2 = new Grid.Plugins.DialogEditing({
	            contentId : 'content1', 
	            triggerCls : 'btn-check', 
	            editor : {
	              title : '查看客户资料',
	              width : 900,
	              focusable : false,
	              listeners : {
	              show : function(){
	              var form = this.get('form');
	                  
	                 
	                }
	              }
	             
	            }
	         }),
          	//编辑客户资料
          	editing1 = new Grid.Plugins.DialogEditing({
	            contentId : 'content2', 
	            triggerCls : 'btn-edit',
	            editor : {
	              title : '编辑客户资料',
	              width : 898,
	              focusable : false,
	              listeners : {
	              show : function(){
	              var form = this.get('form');
	                  
	                 
	                }
	              }
		              
	            }
	         }),
          	//新增客户资料
          	editing10 = new Grid.Plugins.DialogEditing({
	            contentId : 'content9', 
	            editor : {
	              title : '新增客户资料',
	              width : 898,
	              focusable : false,
	              listeners : {
	              show : function(){
	              var form = this.get('form');
	                  
	                 
	                }
	              }
		              
	            }
	         }),
          
          	//切换栏
	         tab = new Tab.TabPanel({
	          	 
		          render : '#tab',
		          elCls : 'nav-tabs',
		          panelContainer : '#panel',
		          autoRender: true,
		         children:[
			            {title:'客户信息',value:'1',selected : true},//选中
			            {title:'订单信息',value:'2'},
			            {title:'联系人',value:'3'}
			           
		        ]
	          
	        });
	       var editing = new Grid.Plugins.CellEditing({
	          triggerSelected : false //触发编辑的时候不选中行
	        }),
	      //全部客户-古树红茶
         grid = new Grid.Grid({
			render:'#grid1',
			columns : columns,
			forceFit : true,   //自适应宽度
			itemStatusFields : { //设置数据跟状态的对应关系
			  selected : 'selected',
			  disabled : 'disabled'
			},
			store : store,
			plugins : [Grid.Plugins.CheckSelection,editing,editing1,editing2,editing10],	// 插件形式引入多选表格
			tbar:{
				items : [{
					btnCls : 'button button-small',
					text : '<i class="icon-plus"></i>新增',	
					listeners : {
						'click' : addFunction
					}
					},{	
					btnCls : 'button button-small',
					text : '<i class="icon-remove"></i>批量删除',
					listeners : {
						'click' : delFunction
					}
				}]
			},
		
			
		  });
		grid.render();
		//订单信息表格
		grid2=new Grid.Grid({ 

			render:"#grid2",
			columns:columns1,
			forceFit:true,   //自适应宽度
			itemStatusFields : { //设置数据跟状态的对应关系
			  selected : 'selected',
			  disabled : 'disabled'
			},
			store : store1
		});
		grid2.render();
		//订单信息汇总
		grid7=new Grid.Grid({ 
			render:"#grid7",
			columns:columns3,
			forceFit:true,
			itemStatusFields : { //设置数据跟状态的对应关系
			  selected : 'selected',
			  disabled : 'disabled'
			},
			store : store3
		});
		grid7.render();
		//可编辑
		var editing6 = new Grid.Plugins.RowEditing({
          triggerCls : 'btn-edits',
          triggerSelected : false
 
        });
        
		//联系人表格
		grid4=new Grid.Grid({ 

			render:"#grid4",
			columns:columns2,
			forceFit:true,  //自适应宽度
			itemStatusFields : { //设置数据跟状态的对应关系
			  selected : 'selected',
			  disabled : 'disabled'
			},
			plugins : [editing6],// 插件形式引入多选表格
			
			store : store2,

			
		});

		grid4.render();
		
		//联系人、添加可以直接编辑
		$("#linkman_btn").on('click',function(){ 
			linkmanEditor();
		});
		function linkmanEditor(){
          var newData1 = {c : 0};
          store2.addAt(newData1,0);
          editing6.edit(newData1,'a'); 
        };
		
		//点击删除操作
		grid.on('itemclick',function(ev){
		  var sender = $(ev.domTarget),
			itemEl = $(ev.element),
			item = ev.item;
			if(sender.hasClass('btn-del')){ 
				delFunctionEl(item,itemEl);
			}
		 
		});
		//删除选中的记录
        function delFunctionEl(item,itemEl){        	
          BUI.Message.Confirm('确认删除记录？',function(){
            var input = itemEl.find('input'),
              name = itemEl.attr('name');
              console.log(name);
            if(name){
              form.getField(name).remove();
            }
 
            store.remove(item);
          },'question');
        }; 
		
        //添加记录
        function addFunction(){
         
          var newData = {b : 0};
          editing10.add(newData,'a'); //添加记录后，直接编辑
        };
        //删除选中的记录
        function delFunction(){
          var selections = grid.getSelection();
          store.remove(selections);
        };
        //联系人、点击删除操作 
		grid4.on('itemclick',function(ev){ 
			var sender = $(ev.domTarget),
			itemE2 = $(ev.element),
			item1 = ev.item;
			if(sender.hasClass('btn-remove')){ 
				delItems(item1,itemE2);
			};


		});
        //联系人删除选中的记录
        function delItems(item1,itemE2){
          BUI.Message.Confirm('确认删除记录？',function(){
		    var input = itemE2.find('input'),
		      name = itemE2.attr('name');
		      console.log(name);
		    if(name){
		      form.getField(name).remove();
		    }

		    store2.remove(item1);
		  },'question');
        };
       

      });

    </script>