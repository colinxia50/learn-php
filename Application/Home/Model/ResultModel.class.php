<?php
namespace Home\Model;

use Think\Model\RelationModel;
class ResultModel extends RelationModel{
   
    
    protected $_link=array(
        'Child'=>array(
            'mapping_type' =>self::BELONGS_TO,
            'foreign_key'=>'uid',
            'mapping_fields'=>'name',
            'as_fields'=>'name:user'
        ),   
    );
    
    
    public function addResult(){
        $data=array(
          'uid'=>I('post.uid'),
          'name'=>I('post.name'),
          'score'=>I('post.score'),
          'dateline'=>strtotime(I('post.dateline')),
        );
       if($this->create($data)){
           $id=$this->add();
           return $id?:0;
       }else{
           return $this->getError();
       }
    }
    
    public function viewList(){
        $map['uid']=I('post.id');
        $all=$this->relation(true)->where($map)->order('dateline desc')->select();
        foreach ($all as $key=>$value){
            $all[$key]['dateline']=date('Y-m-d',$value['dateline']);
        }
        return $all;
    }
    
    public function edit(){
        $data=array(
            'id'=>I('post.id'),
            'name'=>I('post.name'),
            'score'=>I('post.score'),
            'dateline'=>strtotime(I('post.dateline')),
        );
        if($this->create($data)){
            $id=$this->save();
            return $id?:0;
        }else{
            return $this->getError();
        }       
    }
}