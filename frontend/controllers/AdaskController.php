<?php
namespace frontend\controllers;

use Yii;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\web\UploadedFile;

    /*
    *广告申请
    */

use frontend\models\Admaterial;
class AdaskController extends BaseController{
	/*
	*广告申请首页
	*/
	public function actionIndex(){

		return $this->render('index');
	}
	/*
	*错误提示
	*/
	public function Ask_message($str){
		$msg['message'] = $str;
                $msg['error'] = 1;
                $msg['link'] = [
                ['title'=>'重新创建','href'=>'index.php?r=adask/index'],
            ];
            return $this->redirect(['/site/message', 'msg'=>$msg]);
	}
	/*
	*接受提交数据
	*/
	public function actionGetdata(){
            
            //接受参数，校验参数的合法性
	        $request=\Yii::$app->request;
	        $data=$request->post();
            //图片上传
            $upObj=new upload;
            $files=$upObj->getFiles();
            foreach ($files as $key => $value) {
               $reso[$key]=$upObj->uploadFile($value);
            }
            $imgStr='';
            foreach ($reso as $key => $value) {
                if (!empty($value['dest'])) {
                    $imgStr.=$value['newName'];
                }else{

                }
            }
            $data['img']=$imgStr;
	        $newdata=$this->veri($data);
	       
	        //将数据添加到数据库
	        $ad=new Admaterial;
	        $re=$ad->create_adask($newdata);
	        if ($re>0) {
	        	$msg['message'] = '提交成功！';
                $msg['error'] = 1;
                $msg['link'] = [
                ['title'=>'继续申请','href'=>'index.php?r=adask/index'],
                ['title'=>'商城首页','href'=>'index.php?r=index/index'],
	            ];
	            return $this->redirect(['/site/message', 'msg'=>$msg]);
	        }else{
	        	return $this->Ask_message('提交失败！');
	        }

	        
	}
	public function veri($data){
	    //验证手机号码
        if (empty($data['cellphone'])) {
        	return $this->Ask_message('手机号码不能为空！');
        }else if (!preg_match("/^(?:13\d|15\d|18\d)\d{5}(\d{3}|\*{3})$/",$data['cellphone'])) {
        	return $this->Ask_message('手机号码错误！');
        }

        //判断验证码

        //$_SESSION[$data['cellphone']]='123456';
		if (empty($_SESSION[$data['cellphone']])) {
        	return $this->Ask_message('验证码错误！');
        }
        if (empty($data['verif']) || ($data['verif']!=$_SESSION[$data['cellphone']])) {
        	return $this->Ask_message('验证码错误！');
        }else{
        	unset($_SESSION[$data['cellphone']]);
        }
        //验证邮箱
        if (empty($data['em']) || !preg_match('/^[\w-]+(\.[\w-]+)*@([\w-]+\.)+[a-zA-Z]+$/', $data['em'])) {
        	return $this->Ask_message('电子邮箱错误！');
        }
        //验证材料
        if (empty($data['mate'])) {
        	return $this->Ask_message('制作材料错误！');
        }
        switch ($data['mate']) {
        	case '1':
        		$data['mate']='画布';
        		break;
        	case '2':
        		$data['mate']='电子屏';
        		break;
        	case '3':
        		$data['mate']='灯箱';
        		break;
        	case '4':
        		if (!empty($data['mateName'])) {
        			$data['mate']=$data['mateName'];
        		}else{
        			return $this->Ask_message('请填写材料');
        		}
        		break;
        	default:
        		return $this->Ask_message('制作材料错误');
        		break;
        }
        //验证尺寸
        if (empty($data['long'])) {
        	return $this->Ask_message('长度未填写！');
        }
     	if (empty($data['wide'])) {
        	return $this->Ask_message('宽度未填写！');
        }
        //发布日期
        if (empty($data['time'])) {
        	return $this->Ask_message('发布时间未填写！');
        }else{
        	$data['se_time']=$data['time'];
        }
        //提交申请的时间
        $data['addtime']=time();
        //校验费用
        if (empty($data['pri'])) {
        	return $this->Ask_message('费用方式未填写！');
        }
        switch ($data['pri']) {
        	case '1':
        		$data['pri']='自费';
        		break;
        	case '4':
        		if (!empty($data['priInfo'])) {
        			$data['pri']='申请补助:'.$data['priInfo'].'元';
        		}else{
        			return $this->Ask_message('请填写申请费用');
        		}
        		break;
        	default:
        		return $this->Ask_message('费用方式未填写');
        		break;
        }
        return $data;
	}

	
	
}
