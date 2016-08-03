<?php
namespace Home\Model;

use Think\Model;
class ClassModel extends Model{
    //用户表自动验证
    protected $_validate = array(
        //-1,'班级名称长度不合法！'
        array('class_name', '1,10', -1, self::EXISTS_VALIDATE,'length'),
        //-2,'密码长度不合法！'
        array('class_info', '1,100', -2, self::VALUE_VALIDATE,'length'),
    );
    
    public function getClass(){
        $map['school_id']=session('user_auth.school_id');
        return $this->where($map)->field('id,class_name')->select();
    }
    //增加班级
    public function addClass(){
        $data=array(
          'class_name'=>I('post.class_name'),
          'class_info'=>I('post.class_info'), 
          'school_id'=>session('user_auth.school_id'),
        );
        if ($this->create($data)){
            $id=$this->add();
            return $id?:0;
        }else{
            return $this->getError();
        }
    }
    //修改班级
    public function update(){
        $data=array(
          'id'=>I('post.id'),
          'class_name'=>I('post.class_name'),
          'class_info'=>I('post.class_info'), 
        );
        if ($this->create($data)){
            $id=$this->save();
            return $id?:0;
        }else{
            return $this->getError();
        }
    }
}