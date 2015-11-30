<?php
namespace frontend\models;
use Yii;
use yii\db\ActiveRecord;
use common\models\Region;
use common\models\common\models;
use yii\web\UploadedFile;


class Activity extends ActiveRecord{
	public static function tableName()
    {
        return '{{%activity}}';
    }

    /*
    *活动申请
    */
    public function create_adask($arr){
    	$connection=Yii::$app->db;
        //$sql = "insert yl_activity(user_id,cellphone,title,start_time,end_time,site,role,expenditure,img,addtime) values(:user_id,:cellphone,:title,:start_time,:end_time,:site,:role,:expenditure,:img,:addtime)";
        $command = $connection->createCommand()->insert('yl_activity',['cellphone'=>$arr['cellphone'],'title'=>$arr['title'],'start_time'=>$arr['start_time'],'end_time'=>$arr['end_time'],'site'=>$arr['site'],'role'=>$arr['role'],'expenditure'=>$arr['expenditure'],'addtime'=>$arr['addtime'],'img'=>$arr['img'],'user_id'=>$_SESSION['frontend']['user_id']]);
       $re=$command->execute();
       return $re;
    }
}
