<?php

namespace Json\Controller;

use Think\Controller;
use Think\Exception;


class IndexController extends BaseController
{


	public function adv() {

		$list = M("adv")->where()->select();
		if($list){
			$this->doSuccess($list);
		}else{
			$this->doSuccess();
		}
	}

	public function signIn(){
		$user = I('user');
		$date = time();
		$today =  strtotime(date('Y-m-d',$date));

		$model = M('user_sign');
		$where = array(
			'user'=>$user,
			'day'=>$today
		);
		$check = $model->where($where)->find();
		if(!$check){
			$data = array(
				'user'=>$user,
				'day'=>$today,
				'register_date'=>$date
			);
			$model->create($data);
			$insert_id = $model->add($data);
			if($insert_id){
				$this->doSuccess();
			}else{
				$this->doFailed('签到失败');
			}
		}else{
			$this->doFailed('今天您已经签过到了');
		}
	}

	//获取已经签到数据
	public function getSign(){


	}



}