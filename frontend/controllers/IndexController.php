<?php

namespace frontend\controllers;

use Yii;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\Img;
use frontend\models\Category;
use frontend\models\Goods;
use common\models\Shop;

/**
 * Site controller
 */
class IndexController extends BaseController{
    public $layout="home";
    /**
     * 前台首页
     *
     * @return mixed
     */
    public function actionIndex(){
       //取出所有顶级分类
        $category = new Category();
        $data['cate']=Category::get_cate();
        //默认首页商品展示
        if (!empty($data['cate']['0']['cat_id'])) {
            $goods = new Goods();
            $data['goods']=$goods->getByCidGoodsAll($data['cate']['0']['cat_id']);
            if (!empty($data['goods'])) {
               $data['error']=200; 
            }else{
               $data['error']='该分类暂无商品信息';
            }
        }else{
           $data['error']='暂无分类信息';
        }
        //校验输出数据
        if ($data['error']==200) {
            $data['goods']=$this->verify($data['goods']);
        }else{
            $data['goods']=array('error'=>$data['error']);
        }
        $this->layout="home";
        return $this->render('index',$data);
    }
    
     /**
     * 商品信息
     *根据分类ID 取出该分类下的所有商品信息
     * @return mixed
     */
    public function actionGetgoods(){
        //接受并校验数据的合法性
        $request=\Yii::$app->request;
        $cat_id=is_numeric($request->get('id'))?$request->get('id'):0;
        $data  = [];
        //取出所有顶级分类
        $category = new Category();
        $data['cate']=Category::get_cate();
       if ($cat_id > 0) {
            //查询该分类下的所有商品信息
            $data['id']=$cat_id;
            $goods = new Goods();
            $data['goods']=$goods->getByCidGoodsAll($cat_id);
            $data['error']=200;
        }else{
            $data['error']='参数不合法';
        }
        if (empty($data['goods'])) {
            $data['error']='没有找到相关商品信息';
        }
        //校验输出数据
        if ($data['error']==200) {
            $data['goods']=$this->verify($data['goods']);
        }else{
            $data['goods']=array('error'=>$data['error']);
        }
        $this->layout="home";
      return $this->render('getgoods',$data);
    }
    /**
     * 顶部搜索
     * @return mixed
     */
    public function actionSeo(){
        //接受并判断是否有搜索的内容
        $request=\Yii::$app->request;
        $seo= $request->get('seo');
        $data  = [];
        //取出所有顶级分类
        $category = new Category();
        $data['cate']=Category::get_cate();
        if (!empty($seo)) {
            //查询要搜索的内容
            $data['seo_value']=$seo;
            $goods = new Goods();
            $data['goods']=$goods->getBySeo($seo);
            $data['error']=200;
        }else{
            $data['error']='请输入你要搜索的内容';
        }
        if (empty($data['goods'])) {
            $data['error']='没有找到你要搜索的内容';
        }
        //校验输出数据
        if ($data['error']==200) {
            $data['goods']=$this->verify($data['goods']);
        }
        $this->layout="home";
        return $this->render('seo',$data); 
    }
    /**
     * 校验输出数据
     *
     * @return array
     */
    public function verify($data){
        //校验输出信息
        foreach ($data as $key => $value) {
            //商品图片
            if (!empty($data[$key]['img'])) {
                $file='../../common/upload/goods/'.$value['img'];
                //判断图片是否存在
                if (file_exists($file)){
                    $data[$key]['img']=$value['img'];
                }else{
                    $data[$key]['img']='goods_dafult.png';
                }
            }else{
               $data[$key]['img']='goods_dafult.png';
            }
            //商品价格
            $re=floatval($data[$key]['price']);
            if (!empty($re)) {
              $data[$key]['price']= $re;
            }else{
              $data[$key]['price']=0;
            }
            //商品库存
            $re=floatval($data[$key]['num']);
            if (!empty($re)) {
              $data[$key]['num']= $re;
            }else{
              $data[$key]['num']=0;
            }
            //商品单位
            $data[$key]['unit']=!empty($data[$key]['unit'])?$data[$key]['unit']:'';
            //商品数量
            $data[$key]['num']=!empty($data[$key]['num'])?$data[$key]['num']:'';
        }
        return $data;
    }
}
