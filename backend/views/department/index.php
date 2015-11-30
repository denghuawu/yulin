<?php

use yii\helpers\Url;

?>

<div class="container">
		<div class="right">
			<form action="" class="form_elect clearfix">
				<div class="">
					<input type='hidden' name='r' value='department/index'/>
					<input type='hidden' name='sel_con' value="$sel_con"/>
					<input type="text" class="control-text search-query" name="DepartmentSearch[depart_name]">
            		<input type="submit" class="button" value="搜索">
            	</div>

            	<div class="controls_elect2">
            		<span class="label label_elect">部&nbsp;&nbsp;&nbsp;&nbsp;门</span>
            		<a href="<?= Url::to(['department/index']) ?>"><span>不限</span></a>
            		<?php foreach($con['departs'] as $val){	?>
            		<a href="<?= Url::to(['department/index',
            				'DepartmentSearch[people_num]'=>$_REQUEST['DepartmentSearch']['people_num'],
            				'DepartmentSearch[depart_name]' => $val['id'].','.$val['depart_name']
            		]); ?>"><span><?= $val['depart_name'] ?></span></a>
					<?php } ?>
            		
            	</div>
            	<div class="controls_elect2">
            		<span class="label label_elect">人&nbsp;&nbsp;&nbsp;&nbsp;数</span>
            		<a href="<?= Url::to(['department/index']) ?>"><span>不限</span></a>
            		<?= make_con_option($GLOBALS['people_num'],  Url::to(['department/index',
            				'DepartmentSearch[depart_name]' => $_REQUEST['DepartmentSearch']['depart_name'],
            				'DepartmentSearch[people_num]'=>''])) ?>
            	</div>

            	<div class="nav_elect">
					   <span class="label_elect_title">筛选</span>
					   
						<?php 
						if($_REQUEST['EmployeeSearch']){
						
							foreach ($_REQUEST['EmployeeSearch'] as $key=>$val){
								if(empty($val))continue;
								unset($_REQUEST['EmployeeSearch'][$key]); 
					?>
								<a href="<?= Url::to(['department/index',
								'DepartmentSearch[depart_name]' => $_REQUEST['DepartmentSearch']['depart_name'],
								'DepartmentSearch[people_num]'=>$_REQUEST['DepartmentSearch']['people_num']]) ?>" class="label_elect_nav">
								<?= explode(',', $val)[1] ?></a>
					<?php }} ?>
						
					<a href="" class="label_elect_title">清除全部</a>  
            	</div>
			</form>
			<div>
				<div id="table_list"></div>
				<div id="bar">
					<?= $this->render('/layouts/pager',['pagination'=>$dataProvider->pagination]); // 分页  ?> 
				</div>
				<?= $this->render('_form',['data'=>$data,'department'=>$dataProvider->getModels()]); // 表单（新增，查看，编辑）  ?> 
			</div>
		</div>
	</div> 

	<script type="text/javascript"> 
	
		var data = [
		    		<?php foreach ($dataProvider->getModels() as $value){
		    			// 取出列表数据
		    			//根据出员工统计职位人数
		    			//$job_name = 
		    			if($_REQUEST['DepartmentSearch']['people_num']){	// 人数检索
		    				/* if(!(count($value['employee']).$_REQUEST['DepartmentSearch']['people_num']))
		    					continue; */
		    				
		    			}
		    		?>
		    			{"Department['id']":'<?= $value['id'] ?>',"Department['depart_name']":'<?= $value['depart_name'] ?>',depart_num:'2',"Department['input_time']":<?= $value['input_time']*1000 ?>},
		    		<?php } ?>
		    		];
		
		BUI.use(['bui/grid','bui/data','bui/form'],function(Grid,Data,Form){
       	var Grid = Grid,
          Store = Data.Store,
          columns = [
            {title : 'id',dataIndex :"Department['id']", width:0,elStyle:{'border-left':'none','border-top':'none','display':'none'}},
            {title : '部门名称',dataIndex :"Department['depart_name']", width:100},
            {title : '部门人数',dataIndex :'depart_num', width:100},
            {title : '录入时间',dataIndex :"Department['input_time']", width:100,editor : {xtype : 'date'},renderer : Grid.Format.dateRenderer}, 
			
            {title : '操作',dataIndex : 'e', width:130,renderer : function(){
            	return '<span class="grid-command btn-edit">查看</span><span class="grid-command btn-revamp">修改</span><span class="grid-command btn-remove">删除</span>';
            }}
           ];
           //由于设置了数据跟状态的对应关系，此时状态会反映到Html上面
           //disabled的字段无法被选中 
           //selected 是否选中
          /*data = [{a:'123',selected : true},{a:'cdd',b:'edd',disabled:true},{a:'1333',c:'eee',d:2}];*/



		var store = new Store({
			data : data,
			autoLoad:true
		  }),
		editing_a = new Grid.Plugins.DialogEditing({
			contentId : 'content',
			editor : {
                title : '添加部门',
                width : 900,
                focusable : false,
                listeners : {
                  show : function(){
                    var form = this.get('form');
                    
                  }
                }
              }
		}),
		editing = new Grid.Plugins.DialogEditing({
			contentId : 'content3',
			triggerCls : 'btn-edit',
			editor : {
                title : '查看部门',
                width : 900,
                focusable : false,
                listeners : {
                  show : function(){
                    var form = this.get('form');
                    
                  }
                }
              }
		}),
		editing2 = new Grid.Plugins.DialogEditing({
			contentId : 'content2',
			triggerCls : 'btn-revamp',
			editor : {
					title : '编辑部门',
	                width : 900,
	                focusable : false,
	                listeners : {
	                    show : function(){
	                      var form = this.get('form');
	                      
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
			plugins : [Grid.Plugins.CheckSelection,editing,editing2,editing_a],	// 插件形式引入多选表格
			tbar:{
				items : [{
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
		//删除选中的记录
      function delFunctionEl(item,itemEl){        	
        BUI.Message.Confirm('确认删除记录？',function(){
          var input = itemEl.find('input'),
            name = itemEl.attr('name');
            
          if(name){
          	form.getField(name).remove();
          }

      	$.post("index.php?r=department/delete&id="+item["Department['id']"],{'id':item["Department['id']"]},function(str){
				alert(str);
          	});
          store.remove(item);
        },'question');
      } 
		/*添加*/
		function addFunction(){
			var newData = {b : 0};
        	editing_a.add(newData,'a'); //添加记录后，直接编辑
		}
		/*刪除*/
		function delFunction(){
			var selections = grid.getSelection();
			store.remove(selections);
		}              
	});
	</script>
	