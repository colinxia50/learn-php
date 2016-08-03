<?php

namespace Json\Controller;

use Think\Controller;
use Think\Exception;


class ChildController extends BaseController
{

	public function result(){
		$user = I('user');
		$uid = M('user')->where(array('user'=>$user))->getField('id');
		if(!$uid){
			$this->doFailed('账号不存在');
		}else{
			$child_id = M('child')->where(array('uid'=>$uid))->getField('id');
			$model = M('result');
			$list = $model->where(array('uid'=>$child_id))->select();
			if($list){
				$this->doSuccess($list);
			}else{
				$this->doFailed('暂无成绩');
			}
		}


	}




}








