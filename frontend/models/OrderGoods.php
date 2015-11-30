<?php

namespace frontend\models;

use Yii;
use yii\db\ActiveRecord;
use frontend\models\Goods;


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
class OrderGoods extends ActiveRecord
{

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%order_goods}}';
    }

    /**
     * 添加订单商品信息
     */
    public function once_orgoods($arr){
        $connection=Yii::$app->db;
        // 生成订单信息
        $sql1 = "INSERT INTO yl_order_info(order_sn,user_id,order_status,add_time,goods_amount) VALUES(:order_sn,:user_id,:order_status,:add_time,:goods_amount)";
        //生成订单号
        $order_sn=substr(microtime(),2);//订单号
        $time = time();//时间
        $status = 1;//订单状态
        $command = $connection->createCommand($sql1);
        $command->bindParam(":order_sn",$order_sn);//订单号
        $command->bindParam(":user_id",$_SESSION['frontend']['user_id']);//会员ID
        $command->bindParam(":order_status",$status);//订单状态
        $command->bindParam(":add_time",$time);//添加时间
        $command->bindParam(":goods_amount",$arr['num']);//添加时间
        $re=$command->execute();
        if ($re) {
            $sql = "SELECT order_id oid FROM yl_order_info WHERE order_sn='{$order_sn}'";
            $res = self::findBySql($sql)->asArray()->all();
            if (is_array($res)) {
                var_dump($res[0]['oid']);
                exit();
               return $res[0]['oid'];  
            }
        }else{
            return false;
        }
    } 
    
    /**
     * 更新订单商品信息
     * 
     */
    public function orderGoodsUp($arr){
        if (is_array($arr) && empty($arr)) {
            return false;
        }
        // 减库存，加销量
        $connection=Yii::$app->db;
        try{
            foreach ($arr as $value) {
                $transaction=$connection->beginTransaction();
                $sql = "UPDATE yl_order_goods SET goods_number=:number,goods_amount=:money,sum_quality=:zl WHERE rec_id=:rid and order_id=:oid";
                $command = $connection->createCommand($sql);
                $command->bindParam(":number",$value['num']);//购买的数量
                $command->bindParam(":money",$value['sum_money']);//商品的总价格
                $command->bindParam(":zl",$value['zhoL']);//商品的总重量
                $command->bindParam(":rid",$value['rec_id']);//商品订单ID
                $command->bindParam(":oid",$value['oid']);//订单ID
                $re=$command->execute();
                //商品表更新库存
                $sql1='UPDATE yl_goods SET goods_number=:num WHERE goods_id=:gid';
                $number=$value['gnumber']+$value['former']-$value['num'];
                $command = $connection->createCommand($sql1);
                $command->bindParam(":num",$number);//商品的数量
                $command->bindParam(":gid",$value['gid']);//商品的Id
                $re=$command->execute();
                $transaction->commit();
            }
        }
        catch(Exception $e){
            $transaction->rollBack();
            return false;
        }
        return count($arr);

    }


///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


    /**
     * 取出当前会员的购物车商品
     * @return unknown
     */
    public function get_order_info(){
    	$sql = "SELECT c.cart_id,c.goods_number AS buy_number,c.add_time,g.goods_id,g.goods_price,g.goods_name,g.goods_img,
    			g.goods_number,b.brand_name
    			FROM cm_cart AS c LEFT JOIN cm_goods AS g ON c.goods_id=g.goods_id LEFT JOIN cm_brand AS b ON g.brand_id=b.brand_id 
    			WHERE c.user_id=".$_SESSION['frontend']['user_id'];
    	$res = self::findBySql($sql)->asArray()->all();
    	return $res;
    }
    
    public function add_orderGoods($order){
    	
    	$model = new OrderGoods();
    	
    }

}
