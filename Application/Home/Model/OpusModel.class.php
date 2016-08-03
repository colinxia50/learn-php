<?php
namespace Home\Model;

use Think\Model\RelationModel;
class OpusModel extends RelationModel{
   
    protected $_link=array(
        'opus_img'=>array(
            'mapping_type'=>self::HAS_MANY,
            'class_name'=>'opus_img',
            'foreign_key'=>'oid',
            'mapping_fields'=>'data'
        ),
        'Class'=>array(
            'mapping_type' =>self::BELONGS_TO,
            'foreign_key'=>'class_id',
            'mapping_fields'=>'class_name',
            'as_fields'=>'class_name'
        ),
    );
    protected $_validate = array(
           array('title', 'require',-1, self::EXISTS_VALIDATE),
           array('title', '2,30', -2, self::EXISTS_VALIDATE,'length'),
    );
    
    public function addopus(){
        $data=array(
            'title'=>I('post.title'),
            'school_id'=>session('user_auth.school_id'),
            'class_id'=>I('post.class_id'),
            'content'=>I('post.content'),
            'uid'=>session('user_auth.id'),
            'cid'=>I('post.cid'),
            'name'=>I('post.name'),
            'dateline'=>time(),
        );
        if ($this->create($data)){
             $id=$this->add();
             return $id?:0;
        }else{
            $this->getError();
        }
    }

    
    public function update(){
        $data=array(
            'id'=>I('post.id'),
            'title'=>I('post.title'),
            'content'=>I('post.content'),
        );
        if ($this->create($data)){
             $id=$this->save();
             return $id?:0;
        }else{
            $this->getError();
        }
    }
   
}