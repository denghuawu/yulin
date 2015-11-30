<?php

namespace frontend\models;

use Yii;
use yii\db\ActiveRecord;
use frontend\models\Goods;
use frontend\models\Cart;
use yii\db\Connection;
use yii\db\Transaction;
use frontend\models\Comment;
use frontend\models\User;
use backend\models\OrderGoods;
use common\models\Shipping;
use frontend\models\Refund;

/**
 * This is the model class for table "{{%brand}}".
 *
 * @property integer $brand_id
 * @property integer $parent_id
 * @property string $brand_name
 * @property string $brand_logo
 * @property string $brand_desc
 * @property integer $sort_order
 * @property integer $is_show
 */
class OrderInfo extends ActiveRecord
{

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%order_info}}';
    }

    /**
     * 生成订单(购物车确认触发) 返回生成的订单ID
     */
    public function create_order(){
        $connection=Yii::$app->db;
        // 生成订单信息
        $sql1 = "INSERT INTO yl_order_info(order_sn,user_id,order_status,add_time) VALUES(:order_sn,:user_id,:order_status,:add_time)";
        //生成订单号
        $order_sn=substr(microtime(),2);//订单号
        $time = time();//时间
        $status = 1;//订单状态
        $command = $connection->createCommand($sql1);
        $command->bindParam(":order_sn",$order_sn);//订单号
        $command->bindParam(":user_id",$_SESSION['frontend']['user_id']);//会员ID
        $command->bindParam(":order_status",$status);//订单状态
        $command->bindParam(":add_time",$time);//添加时间
        $re=$command->execute();
        if ($re) {
            $sql = "SELECT order_id oid FROM yl_order_info WHERE order_sn='{$order_sn}'";
            $res = self::findBySql($sql)->asArray()->all();
            if (is_array($res)) {
               return $res[0]['oid'];  
            }
        }else{
            return false;
        }
    }

    /*
     * 生成订单(立即购买触发)
     */
    public function once_order($arr){
        $connection=Yii::$app->db;
        // 生成订单信息
        $sql1 = "INSERT INTO yl_order_info(order_sn,user_id,order_status,add_time,goods_amount) VALUES(:order_sn,:user_id,:order_status,:add_time,:goods_amount)";
        //生成订单号
        $order_sn=substr(microtime(),2);//订单号
        $time = time();//时间
        $status = UNPAYED;//订单状态
        $command = $connection->createCommand($sql1);
        $command->bindParam(":order_sn",$order_sn);//订单号
        $command->bindParam(":user_id",$_SESSION['frontend']['user_id']);//会员ID
        $command->bindParam(":order_status",$status);//订单状态
        $command->bindParam(":add_time",$time);//添加时间
        $command->bindParam(":goods_amount",$arr['num']);//商品数量
        $re=$command->execute();
        if ($re) {
            $sql = "SELECT order_id oid FROM yl_order_info WHERE order_sn='{$order_sn}'";
            $res = self::findBySql($sql)->asArray()->all();
            if (is_array($res)) {
               return $res[0]['oid'];  
            }
        }else{
            return false;
        }
    }
    
    /**
     * 获取订单列表（新）
     * @param unknown $status
     * @return unknown
     */
    public function get_order_info($oid){
        
        $id = $id>0 ? 'order_id='.$id : '';

        $sql = "SELECT o.rec_id,oi.order_id oid,oi.order_sn sn,o.goods_id gid,o.sum_quality zhoL,o.goods_number num,g.goods_name gname,g.goods_number gnumber,g.goods_unit unit,g.goods_price price,g.goods_img img,g.shipping_fee fee,c.cat_name cname FROM yl_order_info oi,yl_order_goods o,yl_goods g,yl_category c WHERE oi.order_id={$oid} and ((oi.order_id=o.order_id) and o.goods_id=g.goods_id) and g.cat_id=c.cat_id";
         
        $res = self::findBySql($sql)->asArray()->all();
        return $res;
    }

    /**
     * 更新订单列表（新）
     * 
     */
    public function oder_update($arr){
        $time=time();
        $ost=UNPAYED;
        // 减库存，加销量
        $connection=Yii::$app->db;
        $sql = "UPDATE yl_order_info SET address=:ressr,order_status=:ost,shipping_name=:sname,goods_amount=:gnum,shipping_fee=:fee,pay_fee=:afee,order_amount=:omoney,add_time=:time WHERE order_id=:oid";
        $command = $connection->createCommand($sql);
        $command->bindParam(":oid",$arr['oid']);//订单ID
        $command->bindParam(":ost",$ost);//订单状态
        $command->bindParam(":ressr",$arr['UserAddress']);//收货地址
        $command->bindParam(":sname",$arr['express_name']);//快递名称
        $command->bindParam(":gnum",$arr['goodsNumber']);//订单商品总数
        $command->bindParam(":fee",$arr['wl_money']);//快递费
        $command->bindParam(":afee",$arr['orderSumMoney']);//支付金额
        $command->bindParam(":omoney",$arr['orderSumMoney']);//订单总金额
        $command->bindParam(":time",$time);//添加时间
        $re=$command->execute();
        return $re;
     }
     /**
     * 根据订单ID查询支付金额（新）
     * 
     */
     public function getOrderMoney($id){
       $sql = "SELECT shipping_fee exp_money,pay_fee,order_amount,order_id oid,order_sn osn,goods_amount FROM yl_order_info WHERE order_id=:oid";
        $re= self::findBySql($sql,array(':oid'=>$id))->asArray()->all();
        return $re;
     }

     /**
     * 支付完成更改订单状态（新）
     * 
     */
     public function upStatus($id,$status){
        $time=time();
        $psy=1;
        $connection=Yii::$app->db;
        $sql = "UPDATE yl_order_info SET order_status=:status,pay_time=:time,pay_status=:pay WHERE order_id=:oid";
        $command = $connection->createCommand($sql);
        $command->bindParam(":oid",$id);//订单ID
        $command->bindParam(":status",$status);//订单状态
        $command->bindParam(":time",$time);//支付时间
        $command->bindParam(":pay",$psy);//支付状态
        $re=$command->execute();
        return $re;
     }

     /**
     * 个人中心根据条件获取订单列表（新）
     *
     */
     public function user_oreder($status=null){
        if ($status) {
            $sta='order_status='.$status.' AND ';
        }else{
            $sta='order_status>0 AND ';
        }
        $sql = "SELECT order_id oid,order_sn osn,order_status ost,pay_fee FROM yl_order_info WHERE ".$sta." user_id={$_SESSION['frontend']['user_id']}"." ORDER BY add_time desc";
        $res= self::findBySql($sql)->asArray()->all();
        return $res;
     }


      /**
     * 个人中心获取订单列表下商品的信息（新）
     *
     */
     public function user_get_goods($oid){
        $sql = "SELECT goods_id gid,goods_number num FROM yl_order_goods WHERE order_id={$oid}";
        $res = self::findBySql($sql)->asArray()->all();
        return $res;
     }


//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    
    /**
     * 个人中心我的订单
     * @return unknown
     */

    public function get_order_all($user_id){
        $sql = "SELECT order_id oid,order_sn oNum,order_amount sumMoney,order_status ostatus,confirm_time addtime FROM yl_order_info WHERE user_id={$user_id}   ORDER BY add_time DESC ";
        $res = self::findBySql($sql)->asArray()->all();
        return $res;
     }
      
    
    /**
     * 获取订单列表
     * @param unknown $status
     * @return unknown
     */
    public function get_order_list($status=0){
        $status = $status>0 ? ' AND order_status='.$status : '';
        
        $pager = get_pager($this->order_record($status),0,3);
    	$limit = ' LIMIT '.$pager['start'].','.$pager['size'];
    	
    	$sql = "SELECT order_id,order_sn,order_amount,order_status,confirm_time FROM yl_order_info WHERE user_id={$_SESSION['frontend']['user_id']} {$status} 
    			ORDER BY add_time DESC ".$limit;
        $res = self::findBySql($sql)->asArray()->all();
        var_dump($res);
        exit();
    	if($res){
    		foreach ($res as &$val){
    			
    			$sql = "SELECT g.goods_id,g.goods_name,g.goods_img,o.goods_number,o.goods_price FROM yl_goods AS g,yl_order_goods AS o 
    					WHERE o.goods_id=g.goods_id AND o.order_id={$val['order_id']}";
    			$val['order_goods'] = OrderGoods::findBySql($sql)->asArray()->all();
    		
    			// 订单状态
    			$val['status'] = $flag ? chamei_order_status($val) : order_status($val);
    			
    			//检查用户是否参与了评价
    			/* foreach ($val['order_goods'] as $v){
    				$this->check_commect(['confirm_time'=>$val['confirm_time'], 'goods_id'=>$v['goods_id'],'order_id'=>$val['order_id'],'order_status'=>$val['order_status']]);
    			} */
    		}
    		
    		$res['page_count'] = $pager['page_count'];
    	}
    	return $res;
    }
     
        
    
    
    /**
     * 检查用户是否参与了评价
     * @param unknown $arr
     */
    /* public function check_commect($arr){
    	
    	$time = 24*3600*intval($_SESSION['cfg']['comment_time']);	// 多少天不评价，系统自动评价为好评
    	if(intval($arr['confirm_time']) > $time && $arr['order_status'] == FINISHED){
    			$model = new Comment();
    			$model->comment_time = time();
    			$model->comment_score = 1;
    			$model->comment_content = '好评';
    			$model->user_id = $_SESSION['frontend']['user_id'];
    			$model->goods_id = $arr['goods_id'];
    			$model->save(false);
    			
    			$model = new OrderInfo($arr['order_id']);
    			$model->order_status = COMMENTED;
    			$model->save();
    	}
    	return true;
    } */
    
    /**
     * 更新订单状态
     * @param unknown $id
     * @param unknown $status
     * @return boolean
     */
    public static function update_order_status($id,$status){
    	if($id > 0 && $status >0){
    		$order = OrderInfo::findOne($id);
    		$order->order_status = $status;
    		$order->update(false);
    		return true;
    	}
    }
    
    /**
     * 成交记录（昨日、今日、近三个月）
     * @return array
     */
    public function bargain_record($type,$keyword=null,$status=0){
    	
    	// 获得时间段
    	$timer = get_timer($type);
    	$keyword = $keyword ? ' AND (o.order_sn="'.$keyword.'" OR u.user_name="'.$keyword.'")' : '';
    	
    	$status = $status>0 ? ' AND o.order_status='.$status :  ' AND o.order_status IN('.FINISHED.','.COMMENTED.')';
    	$time = $type ? ' AND o.confirm_time BETWEEN '.$timer['start'].' AND '.$timer['end'] : '';

    	$sql = "SELECT o.order_id,o.order_sn,o.order_amount,o.order_status,o.confirm_time FROM
    	 		cm_order_info AS o,cm_users AS u  WHERE u.user_id=o.user_id AND o.parent_id={$_SESSION['frontend']['user_id']} {$status} {$time} {$keyword} 
    			ORDER BY o.confirm_time DESC";
    	
    	$res = self::findBySql($sql)->asArray()->all();
    	
    	if($res){
    		foreach ($res as &$val){
    			 
    			$sql = "SELECT g.goods_id,g.goods_name,b.brand_name,g.goods_img,o.goods_number,o.goods_price FROM cm_goods AS g,cm_order_goods AS o,cm_brand AS b
    			WHERE o.goods_id=g.goods_id AND g.brand_id=b.brand_id AND o.order_id={$val['order_id']}";
    			$val['order_goods'] = OrderGoods::findBySql($sql)->asArray()->all();
    	
    			// 订单状态
    			$val['status'] = chamei_order_status($val);
    		}
    	}
    	
    	$res['today'] = $timer['today'];
    	return $res;
    }
    
    /**
     * 检查过期没有确认收货的订单
     */
    public function check_order(){
    	
    	// 取出订单状态为发货状态的
    	$res = self::find()->where(['order_status'=>SHIPPED])->asArray()->all();
    	$id_str = null;
    	foreach ($res as $val){
    		$flag = null;
    		// 过期没有确认收货时间
    		if($val['shipping_time'] > 0){	
    			// 是否过期
    			$flag = time() > $val['shipping_time']+(24*3600*$_SESSION['cfg']['finish_time']);
    			
    			if($flag){
    				$id_str .= $val['order_id'].',';
    			}
    		}
    	}
    	
    	$id_str = rtrim($id_str,',');	
    	// 更新订单为已收货状态
    	if(!empty($id_str)){
    		self::updateAll(['confirm_time'=>time(),'order_status'=>FINISHED],"order_id IN ({$id_str})");
    	}
    	return true;
    }
    /**
     * 检查过期没有付款的订单
     */
    public function check_unpay(){
    	
    	// 取出订单状态为发货状态的
    	$res = self::find()->where(['order_status'=>UNPAYED])->asArray()->all();
    	$id_str = null;
    	foreach ($res as $val){
    		$flag = null;
    		
    		if($val['add_time'] > 0){
    			// 是否过期
    			$flag = time() > $val['add_time']+(24*3600*$_SESSION['cfg']['pay_time']);
    			
    			if($flag){
    				$id_str .= $val['order_id'].',';
    			}
    		}
    	}
    	$id_str = rtrim($id_str,',');
    	
    	// 更新订单为取消状态 ， 恢复商品库存
    	if(!empty($id_str)){
    		
	    		// 取出订单商品id
	    		$res = OrderGoods::find()->where("order_id IN ({$id_str})")->asArray()->all();
	    		
	    		if($res[0]){
	    			foreach ($res as $val){
	    			
	    				$num = intval($val['goods_number']);
	    				
	    				$sql = "UPDATE cm_goods SET goods_number=goods_number+{$num} WHERE goods_id=".$val['goods_id'];
	    				$row = yii::$app->db->createCommand($sql)->query();
	    		
	    			}
	    		}
	    		
	    		self::updateAll(['order_status'=>CANCEL],['order_id'=>[$id_str]]);
    	}
    	return true;
    }
    
    public function order_record($status){

    	$sql = "SELECT order_id FROM yl_order_info 
    			WHERE user_id={$_SESSION['frontend']['user_id']}{$status} ";
        
    	return  self::findBySql($sql)->count();
    }

}
