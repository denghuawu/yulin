<?php
namespace frontend\models;
use Yii;
use yii\db\ActiveRecord;
use common\models\Region;
use common\models\common\models;
use yii\web\UploadedFile;


class Admaterial extends ActiveRecord{
	public $img;

	public static function tableName()
    {
        return '{{%ad_ask}}';
    }

    /*
    *创建申请广告
    */
    public function create_adask($arr){
    	$connection=Yii::$app->db;
        //$sql = "insert yl_ad_ask(user_id,cellphone,mailbox,material,long,wide,cost,se_time,img,addtime) values(:user_id,:cellphone,:mailbox,:material,:long,:wide,:cost,:se_time,:img,:addtime)";
        $command = $connection->createCommand()->insert('yl_ad_ask',['cellphone'=>$arr['cellphone'],'mailbox'=>$arr['em'],'material'=>$arr['mate'],'long'=>$arr['long'],'wide'=>$arr['wide'],'cost'=>$arr['pri'],'se_time'=>$arr['se_time'],'addtime'=>$arr['addtime'],'img'=>$arr['img'],'user_id'=>$_SESSION['frontend']['user_id']]);
       $re=$command->execute();
       return $re;
    }
}
