<?php

namespace Json\Controller;

use Think\Controller;
use Think\Exception;


class SchoolController extends BaseController
{



	public function lists(){
		$model = M('school');
		$list = $model->select();
		if($list){
			$this->doSuccess($list);
		}else{
			$this->doSuccess();
		}
	}




	public function search(){
		$model = M('school');
		$schoolName = I('keyword');
		$where = array(
			'name'=>array('like','%'.$schoolName.'%')
		);
		$list = $model->where($where)->select();
		if($list){
			$this->doSuccess($list);
		}else{
			$this->doFailed('暂无结果');
		}
	}



	public function detail(){
		$model = M('school');
		$school_id = I('school_id');
		$info = $model->where(array('id'=>$school_id))->find();
		if($info){
			$this->doSuccess($info);
		}else{
			$this->doFailed('该学校不存在');
		}

	}


	public function dynamic(){
		$school_id = I('school_id');
		$model = M('growing');
		$list = $model->where(array('school_id'=>$school_id))->select();
		if($list){
			foreach($list as &$v){
				$v['dateline'] = date('Y-m-d H:i:s',$v['dateline']);
			}
			$this->doSuccess($list);
		}else{
			$this->doFailed('暂无动态');
		}
	}



	public function show(){
		$school_id = I('school_id');
		$model = M('story');

		$list = $model->where(array('school_id'=>$school_id))->select();
		if($list){
			foreach($list as &$v){
				$v['dateline'] = date('Y-m-d H:i:s',$v['dateline']);
			}
			$this->doSuccess($list);
		}else{
			$this->doFailed('暂无展示');
		}

	}


	public function news(){

		$school_id = I('school_id');
		$model = M('infos');

		$list = $model->where(array('school_id'=>$school_id))->select();
		if($list){
			foreach($list as &$v){
				$v['dateline'] = date('Y-m-d H:i:s',$v['dateline']);
			}
			$this->doSuccess($list);
		}else{
			$this->doFailed('暂无新闻');
		}

	}








}