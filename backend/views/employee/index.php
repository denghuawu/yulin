<?php

use yii\helpers\Url;

?>

	<div class="container">
		<div class="box_left">
			<!-- 树控 -->
			<div class="box left">
				<div class="division">
					<span style="padding-left:9px;">部门职位架构</span>
					<apan class="retract " id="retract">- 收起</apan>

				</div>

				<div id="tree" class="tree"></div>
			</div>
			<!-- 表格 -->
			<div class="row">
				<div class="span16">
					<div id="grid"></div>
				</div>
			</div>
		</div>	
		<div class="box_right">
			<form action="index.php" class="form_elect clearfix">
				<div class="">
					<input type="hidden" name="r" value='employee/index'>

					<input type="text" name="EmployeeSearch[em_name]" class="control-text search-query">
					<input type="submit" class="button" value="搜索">
				</div>

				<div class="controls_elect">
					<span class="label label_elect">学&nbsp;&nbsp;&nbsp;&nbsp;历</span>
					<a href=""><span>不限</span></a>
					<?= make_con_option($GLOBALS['education_level'], Url::to(['employee/index',
							'EmployeeSearch[marriage]'=>$_REQUEST['EmployeeSearch']['marriage'],
							'EmployeeSearch[entry_time]'=>$_REQUEST['EmployeeSearch']['entry_time'],
							'EmployeeSearch[birthday]'=>$_REQUEST['EmployeeSearch']['birthday'],
							'EmployeeSearch[position_status]'=>$_REQUEST['EmployeeSearch']['position_status'],
							'EmployeeSearch[sex]'=>$_REQUEST['EmployeeSearch']['sex'],
							'EmployeeSearch[graduation_level]'=>''])) ?>
				</div>
				<div class="controls_elect">
					<span class="label label_elect">婚&nbsp;&nbsp;&nbsp;&nbsp;姻</span>
					<a href=""><span>不限</span></a>
					<?= make_con_option($GLOBALS['marriage'], Url::to(['employee/index',
							'EmployeeSearch[graduation_level]'=>$_REQUEST['EmployeeSearch']['graduation_level'],
							'EmployeeSearch[entry_time]'=>$_REQUEST['EmployeeSearch']['entry_time'],
							'EmployeeSearch[birthday]'=>$_REQUEST['EmployeeSearch']['birthday'],
							'EmployeeSearch[position_status]'=>$_REQUEST['EmployeeSearch']['position_status'],
							'EmployeeSearch[sex]'=>$_REQUEST['EmployeeSearch']['sex'],
							'EmployeeSearch[marriage]'=>''])) ?>
				</div>
				<div class="controls_elect">
					<span class="label label_elect">入职时间</span>
					<a href=""><span>不限</span></a>
					<?= make_con_option($GLOBALS['entry_time'], Url::to(['employee/index',
							'EmployeeSearch[graduation_level]'=>$_REQUEST['EmployeeSearch']['graduation_level'],
							'EmployeeSearch[marriage]'=>$_REQUEST['EmployeeSearch']['marriage'],
							'EmployeeSearch[birthday]'=>$_REQUEST['EmployeeSearch']['birthday'],
							'EmployeeSearch[position_status]'=>$_REQUEST['EmployeeSearch']['position_status'],
							'EmployeeSearch[sex]'=>$_REQUEST['EmployeeSearch']['sex'],
							'EmployeeSearch[entry_time]'=>''])) ?>
				</div>
				<div class="controls_elect">
					<span class="label label_elect">员工生日</span>
					<a href=""><span>不限</span></a>
					<?= make_con_option($GLOBALS['birthday'], Url::to(['employee/index',
							'EmployeeSearch[graduation_level]'=>$_REQUEST['EmployeeSearch']['graduation_level'],
							'EmployeeSearch[marriage]'=>$_REQUEST['EmployeeSearch']['marriage'],
							'EmployeeSearch[entry_time]'=>$_REQUEST['EmployeeSearch']['entry_time'],
							'EmployeeSearch[position_status]'=>$_REQUEST['EmployeeSearch']['position_status'],
							'EmployeeSearch[sex]'=>$_REQUEST['EmployeeSearch']['sex'],
							'EmployeeSearch[birthday]'=>''])) ?>
				</div>
				<div class="controls_elect">
					<span class="label label_elect">在职状态</span>
					<a href=""><span>不限</span></a>
					<?= make_con_option($GLOBALS['position_status'], Url::to(['employee/index',
							'EmployeeSearch[graduation_level]'=>$_REQUEST['EmployeeSearch']['graduation_level'],
							'EmployeeSearch[marriage]'=>$_REQUEST['EmployeeSearch']['marriage'],
							'EmployeeSearch[entry_time]'=>$_REQUEST['EmployeeSearch']['entry_time'],
							'EmployeeSearch[birthday]'=>$_REQUEST['EmployeeSearch']['birthday'],
							'EmployeeSearch[sex]'=>$_REQUEST['EmployeeSearch']['sex'],
							'EmployeeSearch[position_status]'=>''])) ?>
				</div>
				<div class="controls_elect">
					<span class="label label_elect">性别</span>
					<a href=""><span>不限</span></a>
					<?= make_con_option($GLOBALS['sex'], Url::to(['employee/index',
							'EmployeeSearch[graduation_level]'=>$_REQUEST['EmployeeSearch']['graduation_level'],
							'EmployeeSearch[marriage]'=>$_REQUEST['EmployeeSearch']['marriage'],
							'EmployeeSearch[entry_time]'=>$_REQUEST['EmployeeSearch']['entry_time'],
							'EmployeeSearch[birthday]'=>$_REQUEST['EmployeeSearch']['birthday'],
							'EmployeeSearch[position_status]'=>$_REQUEST['EmployeeSearch']['position_status'],
							'EmployeeSearch[sex]'=>''])) ?>
				</div>
				<div class="nav_elect">
					<span class="label_elect_title">筛选</span>
					<?php 
						if($_REQUEST['EmployeeSearch']){
						
							foreach ($_REQUEST['EmployeeSearch'] as $key=>$val){
								if(empty($val))continue;
								$tmp_request = $_REQUEST;
								unset($tmp_request['EmployeeSearch'][$key]); 
					?>
								<a href="<?= Url::to(['employee/index',
								'EmployeeSearch[graduation_level]'=>$tmp_request['EmployeeSearch']['graduation_level'],
								'EmployeeSearch[marriage]'=>$tmp_request['EmployeeSearch']['marriage'],
								'EmployeeSearch[entry_time]'=>$tmp_request['EmployeeSearch']['entry_time'],
								'EmployeeSearch[birthday]'=>$tmp_request['EmployeeSearch']['birthday'],
								'EmployeeSearch[position_status]'=>$tmp_request['EmployeeSearch']['position_status'],
								'EmployeeSearch[em_name]'=>$tmp_request['EmployeeSearch']['em_name'],
								'EmployeeSearch[sex]'=>$tmp_request['EmployeeSearch']['sex']]) ?>" class="label_elect_nav">
								<?= explode(',', $val)[1] ?></a>
					<?php }} ?>
					<a href="" class="label_elect_title">清除全部</a>      		
				</div>
			</form>
			<div>
				<div id="table_list"></div>
				<div id="bar"> <?php  // 分页 ?> </div>
				
				<?= $this->render('_form',['data'=>$data]); ?>
			</div>
		</div>
	</div> 

	<script type="text/javascript">
		var data = [
		    		<?php	foreach($dataProvider->getModels() as $val){	?>
		    			{
		    				"Employee[id]" : '<?= $val['id'] ?>',
		    				"Employee[em_sn]" : '<?= $val['em_sn'] ?>',
		    				"Employee[em_name]" : '<?= $val['em_name'] ?>',
		    				"Employee[mobile_phone]" : '<?= $val['mobile_phone'] ?>',
		    				"Employee[id_card]" : '<?= $val['id_card'] ?>',
		    				"Employee[birthday]" : <?= $val['birthday']*1000 ?>,
		    				"Employee[marriage]" : '<?= $val['marriage'] ?>',
		    				"Employee[sex]" : '<?= $val['sex']=='0' ? '女' : '男' ?>',
		    				"Employee[ss_number]" : '<?= $val['ss_number'] ?>',
		    				"Employee[native_place]" : '<?= $val['native_place'] ?>',
		    				"Employee[domicile]" : '<?= $val['domicile'] ?>',
		    				"Employee[card_no]" : '<?= $val['card_no'] ?>',
		    				"Employee[nation]" : '<?= $val['nation'] ?>',
		    				"Employee[admin_id]" : '<?= $val['admin_id'] ?>',
		    				"Employee[used_name]" : '<?= $val['used_name'] ?>',
		    				"Employee[political_status]" : '<?= $val['political_status'] ?>',
		    				"Employee[height]" : '<?= $val['height'] ?>',
		    				"Employee[weight]" : '<?= $val['weight'] ?>',
		    				"Employee[self_introduction]" : '<?= $val['self_introduction'] ?>',
		    				"Employee[qq]" : '<?= $val['qq'] ?>',
		    				"Employee[email]" : '<?= $val['email'] ?>',
		    				"Employee[emergency_contact]" : '<?= $val['emergency_contact'] ?>',
		    				"Employee[emergency_phone]" : '<?= $val['emergency_phone'] ?>',
		    				"Employee[now_address]"	 : '<?= $val['now_address'] ?>',
		    				"Employee[home_phone]" : '<?= $val['home_phone'] ?>',
		    				"Employee[position_status]" : '<?=  $GLOBALS['position_status'][$val['position_status']] ?>',
		    				"Employee[em_type]" : '<?= $val['em_type'] ?>',
		    				"Employee[entry_time]" : <?= $val['entry_time']*1000 ?>,
		    				"Employee[leave_time]" : <?= $val['leave_time']*1000 ?>,
		    				"Employee[has_probation]" : '<?= $val['has_probation'] ?>',
		    				"Employee[probation_time_start]" : <?= $val['probation_time_start']*1000 ?>,
		    				"Employee[probation_time_end]" : <?= $val['probation_time_end']*1000 ?>,
		    				"Employee[regular_time]" : <?= $val['regular_time']*1000 ?>,
		    				"Employee[engage_time_start]" : <?= $val['engage_time_start']*1000 ?>,
		    				"Employee[engage_time_end]" : <?= $val['engage_time_end']*1000 ?>,
		    				"Employee[depart_id]" : '<?= $val['department'][0]['depart_name'] ?>',
		    				"Employee[job_id]" : '<?= $val['job'][0]['job_name'] ?>',
		    				"Employee[salary]" : '<?= $val['salary'] ?>',
		    				"Employee[tp_type]" : '<?= $val['tp_type'] ?>',
		    				"Employee[join_work_time]" : <?= $val['join_work_time']*1000 ?>,
		    				"Employee[graduate_school]" : '<?= $val['graduate_school'] ?>',
		    				"Employee[graduate_time]" : <?= $val['graduate_time']*1000 ?>,
		    				"Employee[major]" : '<?= $val['major'] ?>',
		    				"Employee[education_level]" : '<?= $val['education_level'] ?>',
		    				"Employee[pro_certificate]" : '<?= $val['pro_certificate'] ?>',
		    				"Employee[education_exp]" : '<?= $val['education_exp'] ?>',
		    				"Employee[work_exp]" : '<?= $val['work_exp'] ?>',

			    		},

					<?php } ?>
		    		];
		BUI.use(['bui/tree','bui/grid','bui/data'],function(Tree,Grid,Data){
		var Grid = Grid,
	  	Store = Data.Store;
       	var t_data = [
	          {text : '行政部',href :'index.php?r=employee/index',id : '1',children: [{text : '营销总监',id : '11',children: [{text : '办公室主任',id : '11',children: [{text : '财务',id : '13'},{text : '茶艺师',id : '14'},{text : '核单员',id : '15',children:[{text:'仓管员',children:[{text:'物流员',id:'17'}]}]},{text : '档案专员',id : '16'}]},{text:'行政部经理',id:'23',children:[{text:'档案专员',id:'26'},{text:'广告员',id:'27'}]}]}]},
	          {text:'电商部',id:'28',children: [{text : '营销总监',id : '29',children: [{text : '电商经理',id : '30',children: [{text : '经理助理',id : '31',children: [{text : '营运客服主管',id : '32',children:[{text:'营运专员',id:'33'},{text:'客服专员'}]},{text:'财务',id:'34'}]}]},{text:'物流主管',id:'35',children:[{text:'物流员',id:'36'}]}]}]},
	          {text:'推广部',id:'37',children:[{text:'运营总监',id:'38'}]}
	      ];
	      
      	var tree = new Tree.TreeList({
	        render : '#tree',
	        width:'199',
	        nodes : t_data,
	        dirCls : 'icon-pkg',
	        leafCls : 'icon-example',
	        showLine : true 
	      });
	      tree.render();
	      //表格
          
	     //收起
	  	var retract=document.getElementById('retract')
				retract.onclick=function(){ 
					BUI.augment(Mixin,{
						
	  					collapseAll:function(){ 
	  						var _self=this,
	  						elements=_self.get('view').getAllElements();
	  						 BUI.each(elements,function(element){
						      var item = _self.getItemByElement(element);
						      if(item){
						        _self._collapseNode(item,element,true);
						      }
						    });
	  					}
	  				})

	  				tree.collapseAll();
		};

		var columns = [
			{title : 'id',dataIndex :"Employee[id]", width:0,elStyle:{'border-left':'none','border-top':'none','display':'none'}},
			{title : '员工编号',dataIndex :"Employee[em_sn]", width:0,elStyle:{'border-left':'none','border-top':'none','display':'none'}},
			{title : '姓名',dataIndex :"Employee[em_name]", width:100},
			{title : '性别',dataIndex :"Employee[sex]", width:100},
			{title : '所在部门',dataIndex :"Employee[depart_id]", width:100},
			{title : '职位',dataIndex :"Employee[job_id]", width:100},
			{title : '联系手机',dataIndex :"Employee[mobile_phone]", width:200}, 
			{title : '入职时间',dataIndex :"Employee[entry_time]", width:100,editor : {xtype : 'date'},renderer : Grid.Format.dateRenderer},
			{title : '在职状态',dataIndex :"Employee[position_status]", width:100},
			{title : '身份证号',dataIndex :"Employee[id_card]", width:0,elStyle:{'border-left':'none','border-top':'none','display':'none'}},
			{title : '生日',dataIndex :"Employee[birthday]", width:0,elStyle:{'border-left':'none','border-top':'none','display':'none'},editor : {xtype : 'date'},renderer : Grid.Format.dateRenderer},
			{title : '婚姻状况',dataIndex :"Employee[marriage]", width:0,elStyle:{'border-left':'none','border-top':'none','display':'none'}},
			{title : '社保号',dataIndex :"Employee[ss_number]", width:0,elStyle:{'border-left':'none','border-top':'none','display':'none'}},
			{title : '籍贯',dataIndex :"Employee[native_place]", width:0,elStyle:{'border-left':'none','border-top':'none','display':'none'}},
			{title : '户籍所在地',dataIndex :"Employee[domicile]", width:0,elStyle:{'border-left':'none','border-top':'none','display':'none'}},
			{title : '工资银行卡号',dataIndex :"Employee[card_no]", width:0,elStyle:{'border-left':'none','border-top':'none','display':'none'}},
			{title : '民族',dataIndex :"Employee[nation]", width:0,elStyle:{'border-left':'none','border-top':'none','display':'none'}},
			{title : '管理账号',dataIndex :"Employee[admin_id]", width:0,elStyle:{'border-left':'none','border-top':'none','display':'none'}},
			{title : '曾用名',dataIndex :"Employee[used_name]", width:0,elStyle:{'border-left':'none','border-top':'none','display':'none'}},
			{title : '政治面貌',dataIndex :"Employee[political_status]", width:0,elStyle:{'border-left':'none','border-top':'none','display':'none'}},
			{title : '身高',dataIndex :"Employee[height]", width:0,elStyle:{'border-left':'none','border-top':'none','display':'none'}},
			{title : '体重',dataIndex :"Employee[weight]", width:0,elStyle:{'border-left':'none','border-top':'none','display':'none'}},
			{title : '自我介绍',dataIndex :"Employee[self_introduction]", width:0,elStyle:{'border-left':'none','border-top':'none','display':'none'}},
			{title : '个人QQ',dataIndex :"Employee[qq]", width:0,elStyle:{'border-left':'none','border-top':'none','display':'none'}},
			{title : 'Email',dataIndex :"Employee[email]", width:0,elStyle:{'border-left':'none','border-top':'none','display':'none'}},
			{title : '紧急联系人',dataIndex :"Employee[emergency_contact]", width:0,elStyle:{'border-left':'none','border-top':'none','display':'none'}},
			{title : '紧急联系电话',dataIndex :"Employee[emergency_phone]", width:0,elStyle:{'border-left':'none','border-top':'none','display':'none'}},
			{title : '现住址',dataIndex :"Employee[now_address]", width:0,elStyle:{'border-left':'none','border-top':'none','display':'none'}},
			{title : '家庭电话',dataIndex :"Employee[home_phone]", width:0,elStyle:{'border-left':'none','border-top':'none','display':'none'}},
			{title : '员工类型',dataIndex :"Employee[em_type]", width:0,elStyle:{'border-left':'none','border-top':'none','display':'none'}},
			{title : '离职时间',dataIndex :"Employee[leave_time]", width:0,elStyle:{'border-left':'none','border-top':'none','display':'none'},editor : {xtype : 'date'},renderer : Grid.Format.dateRenderer},
			{title : '有无试用期',dataIndex :"Employee[has_probation]", width:0,elStyle:{'border-left':'none','border-top':'none','display':'none'}},
			{title : '开始试用期',dataIndex :"Employee[probation_time_start]", width:0,elStyle:{'border-left':'none','border-top':'none','display':'none'},editor : {xtype : 'date'},renderer : Grid.Format.dateRenderer},
			{title : '结束试用期',dataIndex :"Employee[probation_time_end]", width:0,elStyle:{'border-left':'none','border-top':'none','display':'none'},editor : {xtype : 'date'},renderer : Grid.Format.dateRenderer},
			{title : '转正时间',dataIndex :"Employee[regular_time]", width:0,elStyle:{'border-left':'none','border-top':'none','display':'none'}},
			{title : '开始聘用时间',dataIndex :"Employee[engage_time_start]", width:0,elStyle:{'border-left':'none','border-top':'none','display':'none'},editor : {xtype : 'date'},renderer : Grid.Format.dateRenderer},
			{title : '结束聘用时间',dataIndex :"Employee[engage_time_end]", width:0,elStyle:{'border-left':'none','border-top':'none','display':'none'},editor : {xtype : 'date'},renderer : Grid.Format.dateRenderer},
			{title : '薪水',dataIndex :"Employee[salary]", width:0,elStyle:{'border-left':'none','border-top':'none','display':'none'}},
			{title : '人才类型',dataIndex :"Employee[tp_type]", width:0,elStyle:{'border-left':'none','border-top':'none','display':'none'}},
			{title : '参加工作时间',dataIndex :"Employee[join_work_time]", width:0,elStyle:{'border-left':'none','border-top':'none','display':'none'},editor : {xtype : 'date'},renderer : Grid.Format.dateRenderer},
			{title : '毕业院校',dataIndex :"Employee[graduate_school]", width:0,elStyle:{'border-left':'none','border-top':'none','display':'none'}},
			{title : '毕业时间',dataIndex :"Employee[graduate_time]", width:0,elStyle:{'border-left':'none','border-top':'none','display':'none'},editor : {xtype : 'date'},renderer : Grid.Format.dateRenderer},
			{title : '专业',dataIndex :"Employee[major]", width:0,elStyle:{'border-left':'none','border-top':'none','display':'none'}},
			{title : '学历',dataIndex :"Employee[education_level]", width:0,elStyle:{'border-left':'none','border-top':'none','display':'none'}},
			{title : '职业资格证书',dataIndex :"Employee[pro_certificate]", width:0,elStyle:{'border-left':'none','border-top':'none','display':'none'}},
			{title : '教育经历',dataIndex :"Employee[education_exp]", width:0,elStyle:{'border-left':'none','border-top':'none','display':'none'}},
			{title : '工作经历',dataIndex : "Employee[work_exp]", width:0,editor : {xtype : 'date'},renderer : Grid.Format.dateRenderer},
			{title : '操作',dataIndex : 'e', width:130,renderer : function(){
			  return '<span class="grid-command btn-edit">查看</span><span class="grid-command btn-revamp">修改</span><span class="grid-command btn-remove">删除</span>';
			}} 
		   ];
		var store = new Store({
			data : data,
			autoLoad:true
		  }),
		editing = new Grid.Plugins.DialogEditing({
			contentId : 'content1',
			triggerCls : 'btn-edit',
			editor : {
				elCls :'none_border',
        	  	title : '查看员工',
              	width : 900,
              	focusable : false,
              	listeners : {
                    show : function(){                  
                    }
                  }
                }

		}),
		editing2 = new Grid.Plugins.DialogEditing({
			contentId : 'content',
			triggerCls : 'btn-revamp',
			editor : {
					title : '编辑员工',
	                width : 900,
	                focusable : false,
	                success : function(){

	                	var edtor = this,form = edtor.get('form');
	                	/*form.valid();
                		alert(form.isValid())*/
	                	edtor.accept();},
	                listeners : {
	                    show : function(){
	                      var form = this.get('form');						
	                    },
	                    recordchange : function(){
							alert(123);
					  	}
                    }
			}
		}),
		grid = new Grid.Grid({
			render:'#table_list',
			columns : columns,
			forceFit : true,
			itemStatusFields : { //设置数据跟状态的对应关系
			  selected : 'selected',
			  disabled : 'disabled'
			},
			store : store,
			plugins : [Grid.Plugins.CheckSelection,editing,editing2],	// 插件形式引入多选表格
			tbar:{
				items : [{
					btnCls : 'button button-small',
					text : '<i class="icon-plus"></i>添加',	
					// content : '<input type="button" name="" id="" class="" value="添加"/>',
					listeners : {
						'click' : addFunction
					}
					},{
					btnCls : 'button button-small',
					text : '<i class="icon-remove"></i>删除',
					listeners : {
						'click' : delFunction
					}
				}]
			}
			//multiSelect: true  // 控制表格是否可以多选，但是这种方式没有前面的复选框 默认为false
		  });
		grid.render();

		//点击操作
		grid.on('itemclick',function(ev){
		  var sender = $(ev.domTarget),
			itemEl = $(ev.element),
			item = ev.item;
			if(sender.hasClass('btn-remove')){ //点击删除操作
				delFunctionEl(item,itemEl);
			}
		 
		});
		grid.on('recordchange',function(){
			alert(1);
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
            $.post("index.php?r=employee/delete&id="+item["Employee[id]"],{'id':item["Employee[id]"]},function(str){
				alert(str);
          	});
            store.remove(item);
          },'question');
        } 
		/*添加*/
		function addFunction(){
			var newData = {b : 0};
          	/*editing2.add(newData,'a'); //添加记录后，直接编辑*/
          	editing2.add(); //添加记录后，直接编辑
		}
		/*刪除*/
		function delFunction(){
			var selections = grid.getSelection();
			store.remove(selections);
		}   
           
	});
	</script>
	<script type="text/javascript">
      BUI.use('bui/tab',function(Tab){
      var tab = new Tab.TabPanel({
          srcNode : '#tab',
          elCls : 'nav-tabs',
          itemStatusCls : {
            'selected' : 'active'
          },
          panelContainer : '#panel'//如果不指定容器的父元素，会自动生成
          //selectedEvent : 'mouseenter',//默认为click,可以更改事件
          
        });
 
        tab.render();
      });
        BUI.use('bui/tab',function(Tab){
      var tab = new Tab.TabPanel({
          srcNode : '#tab2',
          elCls : 'nav-tabs',
          itemStatusCls : {
            'selected' : 'active'
          },
          panelContainer : '#panel2'//如果不指定容器的父元素，会自动生成
          //selectedEvent : 'mouseenter',//默认为click,可以更改事件
          
        });
        tab.render();
      });

       
     
    </script>
