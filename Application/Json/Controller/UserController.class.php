<?php

namespace Json\Controller;

use Think\Controller;
use Think\Exception;


class UserController extends BaseController
{


	/**
	 * 发送验证码
	 */
	public function sendCode() {
		self::doCheck ( array ("user") );
		$mobile = Util::getSaveString ( "user" );
		$userModel = M('user');
		$res = $userModel->where(array('user'=>$mobile))->find();
		if(!empty($res)){
			$this->doFailed('您的账号已经注册，请直接登陆','-2');
		}else{
			$code = "";
			$model = M('code');
			$code  = Util::randString ( 6 );
			$sql = "REPLACE INTO code (code,code.user) VALUES ('$code','$mobile')";
			$model->execute($sql);
			if ($code && ! $this->smsSend ( $mobile, $code )) {
				$this->doFailed('验证码发送失败');
			}else{
				$this->doSuccess();
			}
		}


	}


	/*
	 * 校验验证码
	 */
	public function verifyCode() {
		$model = M('code');
		self::doCheck ( array (
				"user",
				"code"
		) );
		$mobile = Util::getSaveString ( "user" );
		$code = Util::getSaveInteger ( "code" );
		$where['code'] = $code;
		$where['user'] = $mobile;
		$list = $model->where($where)->find();
		if ($list) {
			$this->doSuccess();
		} else {
			$this->doFailed('验证码不正确');
		}
	}

	public function checkCode($mobile,$code) {
		$model = M('code');
		$where['code'] = $code;
		$where['user'] = $mobile;
		$list = $model->where($where)->find();
		if (!$list) {
			$this->doFailed('验证码不正确');
		}
	}



	public function register() {

		try{
			self::doCheck ( array (
					"user",
					"password",
					"code",
					"nick_name",
					"class_id",
					"school_id"
			) );

			$mobile = Util::getSaveString ( "user" );
			$code =  Util::getSaveString('code');
			$this->checkCode ($mobile,$code);
			$password= Util::getSaveString ( "password" );
			$nick_name= Util::getSaveString ( "nick_name" );
			$class_id= Util::getSaveString ( "class_id" );
			$school_id= Util::getSaveString ( "school_id" );


			$data = array ();
			$data ['nick_name'] = $nick_name;
			$data ['user'] = $mobile;
			$data ['mobile'] = $mobile;
			$data ['class_id'] = $class_id;
			$data ['school_id'] = $school_id;

			$data ['reg_time'] = time ();
			$data ['password'] =  md5 ( $password );

			$model = M("user");
			$where['user'] =$mobile;
			$member = $model->where($where)->find();
			if (!Validator::is_mobile($data ['user'])) {
				throw new Exception ("手机号不正确！");
			} elseif (strlen ( $password) < 6) {
				throw new Exception ("密码至少6位！");
			} elseif ($member) {
				throw new Exception ("您的号码已经注册，请直接登陆！");
			} else {
				$model->create($data);
				$uid = $model->add($data);
				if ($uid) {
					$info = self::getUserBaseInfo($uid);
					$info['access_token'] = $this->authcode($uid,'Marks');
					$this->doSuccess($info);
				} else {
					$this->doFailed();
				}
			}
		}catch (Exception $e){
			$this->doFailed($e->getMessage());
		}

	}

	/**
	 * 会员登录接口
	 */
	public function login() {
		self::doCheck ( array ("user", "password") );
		$login_name = Util::getSaveString ( "user" );
		$password = Util::getSaveString ( "password" );
		$model = M('user');
		$where['user'] = $login_name;
		$member = $model->where($where)->find();
		if ($member) {
			// 验证密码
			$_password = md5 ( $password );

			if ($_password == $member ['password']) {
				$data = self::getUserBaseInfo ( $member ['id'] );
				$data['access_token'] = $this->authcode($member ['id'],'Marks');
				$model->where(array('user'=>$login_name))->save(array('last_login'=>time(),'last_ip'=>ip2long($_SERVER["REMOTE_ADDR"])));
				$this->doSuccess($data);

			} else {
				$this->doFailed('输入的密码有误!');
			}
		} else {
			$this->doFailed('输入的账号不存在!');
		}
	}


	public static function getUserBaseInfo($uid)
	{
		if (empty ($uid)) return false;
		$model = M('user');
		$member = $model->where("id='$uid'")->find();
		return $member;
	}



	/*
	 * 忘记登陆密码
	 */
	public  function forgetPassword(){

		$user = Util::getSaveString('user');
		$code = Util::getSaveString('code');
		$newPassword = Util::getSaveString('password');
		$this->checkCode($user,$code);
		try {
			$model = M("user");
			$where['user'] = $user;
			$password = md5($newPassword);
			$data['password'] = $password;
			$model->create($data);
			$data = $model->where("user= '$user'")->save();
			if($data){
				$this->doSuccess();
			}else{
				$this->doFailed();
			}
		} catch (Exception $e) {
			$this->doFailed($e->getMessage());
		}
	}




	public function updateInfo(){
		$this->authCheck();
		$user = Util::getSaveString('user');
		$sNickName = Util::getSaveString('nick_name');
		try{
			$data['nick_name'] = $sNickName;
			$model = M('user');
			$model->create($data);
			$model->where("user='$user'")->save($data);
			$this->doSuccess();
		}catch (Exception $e){
			$this->doFailed($e->getMessage());
		}
	}

	public function memberInfo(){
		$this->authCheck();

		$user = Util::getSaveString('user');
		try{
			$model = M('user');
			$list = $model->where("user='$user'")->find();
			if($list){
				$this->doSuccess($list);
			}else{
				$this->doFailed('用户不存在');
			}
		}catch (Exception $e){
			$this->doFailed($e->getMessage());
		}
	}

	public static function uploadFile(){
		$upload = new \Think\Upload();
		// 上传文件
		$upload->maxSize   =     3145728 ;// 设置附件上传大小
		$upload->autoSub=     true; //自动子目录保存文件
		$upload->subName=     array('date', 'Y-m-d'); //子目录创建方式，[0]-函数名，[1]-参数，多个参数使用数组
		$upload->exts =     array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
		$upload->rootPath=     './Uploads/'; //保存根路径
		$info = $upload->upload();
		if (!$info) {// 上传错误提示错误信息
			self::doFailed('上传失败');
			// E($upload->getError());
		} else {// 上传成功
			foreach ($info as &$file) {
				$file['url'] = str_replace("./", "/", $upload->__get("rootPath")) . $file['savepath'] . $file['savename'];
				$res = 'http://'.$_SERVER['HTTP_HOST'].$file['url'];
			}
			return $res;
		}

	}



	public function updateMemberImage(){
		$user = Util::getSaveString('user');
		try{
			$model = M('user');
			$list = $model->where("user='$user'")->find();
			if($list){
				$cover = self::uploadFile();
				$model->where(array('user'=>$user))->save(array('cover'=>$cover));
				$this->doSuccess();
			}else{
				$this->doFailed('用户不存在');
			}
		}catch (Exception $e){
			$this->doFailed($e->getMessage());
		}
	}






}