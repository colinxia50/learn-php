<?php

namespace Json\Controller;

use Think\Controller;
use Think\Exception;


class ShowController extends BaseController
{


	public function show(){
		$model = D('show');
		$list = $model->relation(true)->select();
		if($list){
			$this->doSuccess($list);
		}else{
			$this->doSuccess();
		}
	}


	public function knowledge(){
		$model = M('knowledge');
		$list = $model->select();
		if($list){
			$this->doSuccess($list);
		}else{
			$this->doSuccess();
		}
	}






}