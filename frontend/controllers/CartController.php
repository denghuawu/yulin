<?php

namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use frontend\models\Cart;
use frontend\models\Goods;
use frontend\models\UserAddress;
use frontend\models\models;
use frontend\models\OrderGoods;
use frontend\models\OrderInfo;

/**
 * UserController implements the CRUD actions for User model.
 */
class CartController extends BaseController
{

    /**
     * 购物车首页
     * @return mixed
     */
    public function actionIndex()
    {
    	$cart = new Cart();
        //取出当前会员购物车里的商品
    	$data ['cart']= $cart->get_cat_info($_SESSION['frontend']['user_id']);
        //对输出信息进行校验
        if (!empty($data ['cart'])){
            $newData['error']=200;
            $sum=0.00;
           foreach ($data['cart'] as $key => $value) {
                //添加的数量
                $re=floatval($data['cart'][$key]['num']);
                if (!empty($re)) {
                  $arr[$key]['num']= $re;
                }else{
                  $arr[$key]['num']=1;
                }
                //商品价格
                $re=floatval($data['cart'][$key]['price']);
                if (!empty($re)) {
                  $arr[$key]['price']= $re;
                }else{
                    //价格出错了，暂不显示
                    $arr[$key]['price']=0;
                }
                //商品ID
                $re=floatval($data['cart'][$key]['gid']);
                if (!empty($re)) {
                  $arr[$key]['gid']= $re;
                }else{
                    //商品ID，暂不显示
                    $arr[$key]['gid']=0;
                }
                //购物车ID
                $re=floatval($data['cart'][$key]['cid']);
                if (!empty($re)) {
                  $arr[$key]['cid']= $re;
                }else{
                    //购物车ID，暂不显示
                    $arr[$key]['cid']=0;
                }
                //检测图片是否存在不存在设置为默认图片
                if (!empty($data['cart'][$key]['img'])) {
                    $file='../../common/upload/goods/'.$data['cart'][$key]['img'];
                    //判断图片是否存在
                    if (file_exists($file)){
                        $arr[$key]['img']=$data['cart'][$key]['img'];
                    }else{
                        $arr[$key]['img']='cart_dafult.png';
                    }
                }else{
                    $arr[$key]['img']='cart_dafult.png';
                }
                //商品名称
                $arr[$key]['name']=!empty($data['cart'][$key]['gname'])?mb_substr($data['cart'][$key]['gname'], 0,30,'UTF-8'):'';
                //购物车商品合计总价
                $sum += $arr[$key]['price'] * $arr[$key]['num'];
            } 
            $newData['cart']=$arr;
            $newData['sum']=$sum;
        }else{
            //购物车暂无添加的商品
            $newData['error']=404;
            $newData['sum']=0;
        }
        return $this->render('index', $newData);
    }
    

    
    /**
     * ajax 添加商品到购物车
     * @param int $goods_id
     * @param int $num
     */
    public function actionAddcart(){
        //接受参数，校验参数的合法性
        $request=\Yii::$app->request;
        $get_gid=$request->get('goods_id');
        $get_num=$request->get('num');
        $post_gid=$request->post('goods_id');
        $post_num=$request->post('num');
        if ($get_gid!=null) {
           $goods_id=is_numeric($get_gid)?$get_gid:0;
        }else if($post_gid!=null){
           $goods_id=is_numeric($post_gid)?$post_gid:0; 
        }else{
            $goods_id=0;
        };
        if ($get_num!=null) {
           $num=is_numeric($get_num)?$get_num:0;
        }else if($post_gid!=null){
           $num=is_numeric($post_num)?$post_num:0; 
        }else{
           $num=0;
        };
        if($goods_id > 0 && $num > 0 && $_SESSION['frontend']['user_id'] >0){
            /* 检查库存 */
            $goodsModel = new Goods();
            $goods = $goodsModel->checkRepertory($goods_id);
            foreach ($goods as $value) {
                if($num > $value['goods_number']){
                echo json_encode(['code'=>0, 'error'=>'库存不足，添加失败']);
                exit();
                }  
            }
            
            //添加商品到购物车
    		$cart = new Cart();
    		$res =  $cart->add_cart($goods_id, $num,$_SESSION['frontend']['user_id']);
            if(isset($flag)){
    			if($res['error']){
    				$msg['message'] = $res['error'];
    				$msg['error'] = 1;
    				$msg['link'] = [
    						['title'=>'返回','href'=>Yii::$app->request->referrer],
    				];
    				return $this->redirect(['/site/message', 'msg'=>$msg]);
    			}
    			
    			return $this->redirect(['index', 'id'=>$res['id']]);
    		}
    		
    		echo json_encode($res);
    		exit;
    	}
    	
    	echo json_encode(['code'=>0, 'error'=>'添加购物车失败']);
    	exit;
    }
    
    /**
     * 删除购物车商品
     * @param unknown $cart_id
     */
    public function actionDelcart(){
        //接受提交订单的订单
        $request=Yii::$app->request;
        $post=$request->post();
        if (isset($post)) {
            foreach ($post['opt'] as $key =>$value){
                if ($value==1) {
                    $order[]=array('good_id'=>$post['good_id'][$key],'num'=>$post['num'][$key],'cid'=>$post['cid'][$key]);
                }
            }
        }
        if (isset($order)) {
            foreach ($order as $key => $value) {
                $cart_id = intval($value['cid']);
                if($cart_id > 0){
                    $cartObj=new cart();
                    $count=$cartObj->del($cart_id);
                }
            }
        }
        if($count>0){ 
        return $this->redirect(['/cart/index']); 
        }else{ 
        $msg['message'] = '删除失败';
                $msg['error'] = 1;
                $msg['link'] = [
                ['title'=>'返回购物车','href'=>'index.php?r=cart/index'],
        ];
        } 
    }
    
    /**
     * 确认提交页面
     */
    public function actionSuborder(){
        //接受提交商品列表
        $request=Yii::$app->request;
        $post=$request->post();
        if (isset($post)) {
            foreach ($post['opt'] as $key =>$value){
                if ($value==1) {
                    $order[]=array('good_id'=>$post['good_id'][$key],'num'=>$post['num'][$key],'cid'=>$post['cid'][$key]);
                }
            }
        }
        //添加订单
        $OrderInfoObj= new OrderInfo;
        $orderNum=$OrderInfoObj->create_order();
        if ($orderNum==false){
            $this->masg('订单提交失败');
        }
       //处理订单
        if (isset($order)) {
            //取出商品的信息
            foreach ($order as $key => $value) {
                $id = intval($value['good_id'])?$value['good_id']:0;
                $num=intval($value['num'])?$value['num']:0;
                $cart_id=intval($value['cid'])?$value['cid']:0;
                //检测判断提交数据的合法性
                if (($id<=0) && ($num<=0)&&($cart_id<=0)) {
                    $msg['message'] = '订单提交失败1，可能原因：<br><li>商品已下架</li><li>商品库存不足</li>';
                        $msg['error'] = 1;
                        $msg['link'] = [
                        ['title'=>'返回购物车','href'=>'index.php?r=cart/index'],
                    ];
                    return $this->redirect(['/site/message', 'msg'=>$msg]);
                }

                
                //读取商品的信息
                $goodObj= new Goods;
                $re=$goodObj->getByOrderAll($id,$num);
                if (empty($re)){
                    $msg['message'] = '订单提交失败2，可能原因：<br><li>商品已下架</li><li>商品库存不足</li>';
                    $msg['error'] = 1;
                    $msg['link'] = [
                    ['title'=>'返回购物车','href'=>'index.php?r=cart/index'],
                    ];
                    return $this->redirect(['/site/message', 'msg'=>$msg]);
                }

               $orderInfo=array();
               $orderInfo=$re['0'];
               //购买商品的数量
               $orderInfo['num']=$num;
               //商品的现有的库存
               //购物车ID
               $orderInfo['cart_id']=$cart_id;
               //计算购买的商品总件数的质量
               if (empty($orderInfo['fee'])) {
                    $msg['message'] = '抱歉！订单提交失败！，可能原因：<br><li>计算商品重量出错了</li>';
                    $msg['error'] = 1;
                    $msg['link'] = [
                    ['title'=>'返回购物车','href'=>'index.php?r=cart/index'],
                    ];
                    return $this->redirect(['/site/message', 'msg'=>$msg]);
                }
                //商品的总质量
                $orderInfo['sum_quality']=$num * $orderInfo['fee'];
                $orderNew[]=$orderInfo;                                         
            }
            //向商品订单列表中添加订单当中的商品
            if (empty($orderNew)) {
                 $this->masg('订单提交失败');
            }

            $cartObj=new Cart;
            $re=$cartObj->cartGoods($orderNew,$orderNum);
            if ($re) {
                return $this->redirect(['/order/verifyorder','orderid'=>$orderNum]);
            }else{
                $this->masg('订单提交失败');
           }
        }
    }


    /**
     *错误提示
     */
    public function masg($str){
        $msg['message'] = $str;
                $msg['error'] = 1;
                $msg['link'] = [
                ['title'=>'返回首页','href'=>'index.php?r=index/index'],
            ];
            return $this->redirect(['/site/message', 'msg'=>$msg]);
    }

    
    /**
     *立即购买
     */
    public function actionAtonce(){
        //接受校验数据的合法性
        $request=\Yii::$app->request;
        $gid=is_numeric($request->post('goods_id'))?$request->post('goods_id'):0;
        $num=is_numeric($request->post('num'))?$request->post('num'):0;
        if(($gid <= 0) && ($num <= 0)){
             return $this->redirect(['/goods/index','id'=>$gid]);
        }
        //检查库存
        $goodsModel = new Goods();
        $goods = $goodsModel->checkRepertory($gid);
        foreach ($goods as $value) {
            if($num > $value['goods_number']){
                return $this->redirect(['/goods/index','id'=>$gid]);
            }  
        }
        //添加订单
        $OrderInfoObj= new OrderInfo;
        $orderNum=$OrderInfoObj->create_order();
        if ($orderNum==false){
            $this->masg('订单提交失败');
        }
        //读取商品的信息
        $goodObj= new Goods;
        $re=$goodObj->getByOrderAll($gid,$num);
        if (empty($re)){
            $this->masg('订单提交失败<br><li>商品已下架或库存不足</li>');
        }
       $orderInfo=array();
       $orderInfo=$re['0'];
       //购买商品的数量
       $orderInfo['num']=$num;
       //计算购买的商品总件数的质量
       if (empty($orderInfo['fee'])) {
         $this->masg('抱歉！订单提交失败');
        }
        //商品的总质量
        $orderInfo['sum_quality']=$num * $orderInfo['fee'];
        $orderNew[]=$orderInfo; 
        //向商品订单列表中添加订单当中的商品
        if (empty($orderNew)) {
            $this->masg('订单提交失败');
            }
        $cartObj=new Cart;
        $re=$cartObj->verifyGoods($orderNew,$orderNum);

        if ($re) {
            return $this->redirect(['/order/verifyorder','orderid'=>$orderNum]);
        }else{
            $this->masg('订单提交失败');
       }
    }
}
