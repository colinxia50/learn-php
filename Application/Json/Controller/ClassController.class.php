<?php

namespace Json\Controller;

use Think\Controller;
use Think\Exception;


class ClassController extends BaseController
{


	public function lists()
	{
		$schoolId = I('school_id');
		$model = M('class');
		$list = $model->where(array('school_id' => $schoolId))->select();
		if ($list) {
			$this->doSuccess($list);
		} else {
			$this->doFailed('该学校暂无班级');
		}
	}


	public function teacherList()
	{
		$model = M('teacher');
		$class_id = I('class_id');
		$info = $model->where(array('class_id' => $class_id))->select();
		if ($info) {
			$this->doSuccess($info);
		} else {
			$this->doFailed('暂无教师');
		}
	}


	public function notice()
	{

		$class_id = I('class_id');
		$model = M('infos');
		$list = $model->where(array('class_id' => $class_id))->select();
		if ($list) {
			$this->doSuccess($list);
		} else {
			$this->doFailed('暂无公告');
		}
	}



	public function contact(){
		$model = D('child');
		$class_id = I('class_id');
		$list = $model->relation(true)->field(array('name','uid'))->where(array('class_id'=>$class_id))->select();
		if($list){
			foreach($list as &$v){
				$v['cover'] = json_decode($v['cover'],true);
			}
			$this->doSuccess($list);
		}else{
			$this->doSuccess();
		}
	}


}








