<?php
namespace Home\Model;

use Think\Model\RelationModel;
class MessageModel extends RelationModel{
    protected $_validate = array(
    //-1,'内容不得为空'
    array('content', 'require', -1, self::EXISTS_VALIDATE),    
    );
    
    protected $_link=array(
        'User'=>array(
            'mapping_type'=>self::BELONGS_TO,
            'class_name'=>'user',
            'foreign_key'=>'uid',
            'mapping_fields'=>'nick_name,cover',
            'as_fields'=>'nick_name,cover',
        ),
    );
    
    
    public function addMessage(){
        if (I('post.ids')){
            $arr=explode(',',I('post.ids'));
            foreach ($arr as $value){
                $data=array(
                    'uid'=>session('user_auth.id'),
                    'cid'=>$value,
                    'content'=>I('post.content'),
                    'dateline'=>time(),
                );
                if ($this->create($data)){
                    $id=$this->add();
                }else{
                    $this->getError();
                } 
            } 
            return 1;                      
        }else{
            return -2;
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