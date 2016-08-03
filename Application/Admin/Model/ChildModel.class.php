<?php
namespace Admin\Model;
use Think\Model;
use Think\Auth;

class ChildModel extends Model {
	


	//新增用户
	public function addChild($uid) {
	    $data = array(
	        'uid'=>$uid,
	        'school_id'=>I('post.school_id'),
	        'class_id'=>I('post.class_id'),
	        'name'=>I('post.nick_name'),
	        'sex'=>I('post.sex'),
	        'birthday'=>strtotime(I('post.birthday')),
	    );
	
	    if ($this->create($data)) {
	        $cid = $this->add();
	    } else {
	        return $this->getError();
	    }
	}
	
	//修改学生
	public function upChild($uid){
	    $data = array(	        	        
	        'school_id'=>I('post.school_id'),
	        'class_id'=>I('post.class_id'),
	        'name'=>I('post.nick_name'),
	        'sex'=>I('post.sex'),
	        'birthday'=>strtotime(I('post.birthday')),
	    );
	    $map['uid']=$uid;
	    if ($this->create($data)) {
	        $cid = $this->where($map)->save();
	    } else {
	        return $this->getError();
	    }  
	}

}