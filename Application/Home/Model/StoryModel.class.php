<?php
namespace Home\Model;

use Think\Model\RelationModel;
class StoryModel extends RelationModel{
    protected $_validate = array(
    //-1,'标题不得为空'
    array('title', 'require', -1, self::EXISTS_VALIDATE),
    //-2,'内容不得为空'
    array('content', 'require', -2, self::EXISTS_VALIDATE),
    
    );
    
    protected $_link=array(
        'story_img'=>array(
            'mapping_type'=>self::HAS_MANY,
            'class_name'=>'story_img',
            'foreign_key'=>'sid',
            'mapping_fields'=>'data'
        ),
    );
    
    
    public function addstory(){
        $data=array(
            'title'=>I('post.title'),
            'url'=>I('post.url'),
            'uid'=>session('user_auth.id'),
            'school_id'=>session('user_auth.school_id'),
            'content'=>I('post.content'),
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
            'url'=>I('post.url'),
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