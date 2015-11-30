<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "{{%goods}}".
 *
 * @property string $id
 * @property double $goods_price
 * @property string $goods_name
 * @property integer $goods_year
 * @property integer $cat_id
 * @property integer $goods_number
 * @property string $goods_desc
 * @property string $goods_img
 * @property integer $is_new
 * @property integer $is_recommend
 * @property integer $is_hot
 * @property string $goods_unit
 * @property double $shipping_fee
 * @property integer $free_shipping
 * @property string $goods_attr
 */
class Goods extends \yii\db\ActiveRecord
{
	public $tmp_img;
	public $flag;
	public $keyword;
	
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%goods}}';
    }
    
    public function scenarios(){
    	return [
    			'create'=>['goods_name','is_updown','add_time','goods_price', 'goods_year','goods_sn',
    					 'goods_desc','goods_attr','shipping_fee','cat_id',  'goods_number',
    					 'is_new', 'is_recommend', 'is_hot', 'free_shipping','co_men','yulin_shop','super_trader',
    					 'level_1_trader','level_2_trader','level_3_trader','variety_id','unit_jian','unit_ke',
    					'factory_price','warehouse_upper_limit','warehouse_down_limit'
    			],
    			'update'=>['goods_name','is_updown','goods_price', 'goods_year', 'goods_desc',
    					'goods_attr','shipping_fee','cat_id',  'goods_number', 'is_new',
    					 'is_recommend', 'is_hot', 'free_shipping','co_men','yulin_shop','super_trader',
    					 'level_1_trader','level_2_trader','level_3_trader','variety_id','unit_jian','unit_ke',
    					'factory_price','warehouse_upper_limit','warehouse_down_limit'
    			]
    	];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['goods_name','goods_price', 'goods_year', 'cat_id'], 'required','on'=>['create','update']],
            [['goods_price', 'shipping_fee','factory_price'], 'number', 'min' => 0, 'max'=>9999999999, 'on'=>['create','update']],
            [['goods_year', 'cat_id',  'goods_number', 'is_new', 'is_recommend', 'is_hot', 'free_shipping'], 'integer','on'=>['create','update']],
            [['goods_desc'], 'string','on'=>['create','update']],
            [['goods_name'], 'string', 'min'=>1, 'max' => 120,'on'=>['create','update']],
        	[['goods_sn'],'default','value'=>$this->makeGoodsSn() ,'on'=>['create']],
            [['goods_name','goods_sn'], 'unique', 'on'=>['create','update']],
        	[['goods_img'], 'file', 'extensions' => 'jpg, png', 'mimeTypes' => 'image/jpeg, image/png','on'=>['create','update']],
            [['goods_attr'], 'string', 'max' => 1000,'on'=>['create','update']],
            [['goods_year'], 'number', 'min'=>1900, 'max' => date('Y',time()),'on'=>['create','update']],
            [['goods_number'], 'number', 'min' => 0, 'max'=>9999999999, 'message'=>'商品库存必须在0-9999999999之间','on'=>['create','update']],
            [['shipping_fee','co_men','yulin_shop','super_trader',
    					 'level_1_trader','level_2_trader','level_3_trader','variety_id',],'default','value'=>0 ,'on'=>['create']],
            [['add_time'],'default','value'=>time() ,'on'=>['create']],
            
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'id',
            'goods_price' => '价格',
            'goods_name' => '名称',
            'goods_year' => '年份',
            'cat_id' => '商品分类',
            'goods_number' => '库存数量',
            'goods_desc' => '描述',
            'goods_img' => '商品图片',
            'is_new' => '是否新品',
            'is_recommend' => '是否推荐',
            'is_hot' => '是否热门',
            'shipping_fee' => '运费',
            'free_shipping' => '是否包邮',
            'goods_attr' => '商品属性、参数（输入格式 xx:xx 多个用回车键分隔）',
        	'is_updown' => '是否上架',
        	'keyword' => '关键词',
        	'co_men' => '合作商',
        	'yulin_shop' => '雨林馆',
        	'super_trader' => '特级分销商',
        	'level_1_trader' => '一级分销商',
        	'level_2_trader' => '二级分销商',
        	'level_3_trader' => '三级分销商',
        	'variety_id' => '产品系列',
        	'unit_jian' => '产品规格',
        	'unit_ke' => '产品规格',
        	'goods_sn'=> '产品编号',
        	'factory_price' => '出厂价',
        	'warehouse_upper_limit' => '库存上限',
        	'warehouse_down_limit' => '库存下限',
        ];
    }

    /**
     * 生成产品编号（生成规则：G+录入年月日+产品总数++）
     */
    public function makeGoodsSn(){
    	// 产品总数
    	$goods_count = self::find()->count()+1;
    	$date = date('Ymd',time());
    	return 'G'.$date.$goods_count;
    }
    
    /**
     * 数据插入前处理
     * @param unknown $insert
     * @return boolean
     */
    public function beforeSave($insert)
    {
    	// 处理商品属性、参数
    	if(!empty($this->goods_attr)){
    		$arr = explode(PHP_EOL, $this->goods_attr);
    		$new_arr = [];
    		foreach ($arr as $val){
    			$tmp_arr = null;
    			$tmp_arr = strpos($val,':') ? explode(':', $val) : explode('：', $val);	
    			$new_arr[$tmp_arr[0]] = $tmp_arr[1];
    		}
    		$this->goods_attr = serialize($new_arr);
    	}
    	if(parent::beforeSave($insert)){
    		if(!$this->isNewRecord){
    			if($this->flag){
    				// 避免空的值覆盖
    				$this->goods_img = $this->goods_img ? $this->goods_img : $this->tmp_img;
    			}
    		}
    		return true;
    	}else{
    		return false;
    	}
    }

    /**
     * @inheritdoc
     * @return GoodsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new GoodsQuery(get_called_class());
    }
}
