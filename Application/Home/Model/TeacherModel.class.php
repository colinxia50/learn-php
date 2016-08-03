<?php
namespace Home\Model;

use Think\Model\RelationModel;
class TeacherModel extends RelationModel{

    protected $_validate = array(
        //资历简介长度
        array('content', '2,200', -1, self::EXISTS_VALIDATE,'length'),
    );
     protected $_link=array(
       'User'=>array(
            'mapping_type' =>self::BELONGS_TO,
            'foreign_key'=>'uid',
            'mapping_fields'=>'user,mobile,email,cover',
            'as_fields'=>'user,mobile,email,cover'
        ),
       'Class'=>array(
            'mapping_type' =>self::BELONGS_TO,
            'foreign_key'=>'class_id',
            'mapping_fields'=>'class_name',
            'as_fields'=>'class_name'
        ),

     );

    


    public function allChild(){
      $map['class_id']=I('post.id');
      $map['state']=1;
      $all=$this->where($map)->field('id,name')->select();
      return $all;
    }

    //增加老师
    public function addTeacher(){
        $user=D("User");
        $data=array(
          'name'=>I('post.name'),
          'content'=>I('post.content'),
          'class_id'=>I('post.class_id'),
          'school_id'=>session('user_auth.school_id'),
          'birthday'=>strtotime(I('post.birthday')),
          'sex'=>I('post.sex'),
        );
        if ($this->create($data)){
            $id=$this->add();
            return $id?:0;
        }else{
            return $this->getError();
        }
    }


    public function updateTeacher(){
        $user=D("User");
        $id=$user->updateTeacher();
        if ($id>0) {
            $data=array(
                'name'=>I('post.name'),
                'content'=>I('post.content'),
                'class_id'=>I('post.class_id'),
                'birthday'=>strtotime(I('post.birthday')),
                'sex'=>I('post.sex')
            );
            if ($this->create($data)){
                $map['uid']=I('post.id');
                $id=$this->where($map)->save();
                return $id?:0;
            }
        }else{
            return $id;
        }
    }
}