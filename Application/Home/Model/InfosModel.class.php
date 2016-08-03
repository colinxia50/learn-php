<?php
namespace Home\Model;

use Think\Model\RelationModel;
class InfosModel extends RelationModel{
   
    protected $_link=array(
        'infos_img'=>array(
            'mapping_type'=>self::HAS_MANY,
            'class_name'=>'infos_img',
            'foreign_key'=>'iid',
            'mapping_fields'=>'data'
        ),
    );
    
    
    public function addinfos(){
        $data=array(
            'title'=>I('post.title'),
            'school_id'=>session('user_auth.school_id'),
            'content'=>I('post.content'),
            'uid'=>session('user_auth.id'),
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