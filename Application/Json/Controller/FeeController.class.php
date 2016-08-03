<?php

namespace Json\Controller;

use Think\Controller;
use Think\Exception;


class FeeController extends BaseController
{



	public function lists(){

		$model = M('fee');
		$user = I('user');
		$id = M('user')->where(array('user'=>$user))->getField('id');
		if(!$id){
			$this->doFailed('用户不存在');
		}else{
			$list = $model->where(array('user_id'=>$id))->select();
			if($list){
				$this->doSuccess($list);
			}else{
				$this->doSuccess();
			}
		}

	}












}