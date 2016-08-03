<?php
namespace Admin\Model;
use Think\Model\RelationModel;
use Org\Util\Tool;

class ArticlesModel extends RelationModel {


    //用户表自动完成
  protected $_auto = array(
      array('reg_time', 'time', self::MODEL_INSERT, 'function'),
  );



   public function getArticle(){
     $map['id']=I('post.id');
     $user= $this->where($map)->find();
     return $user;
   }
	
  public function addArticle(){
    $data=array(
      'title'=>I('post.title'),
      'content'=>I('post.content'),
      'create_time'=>date('Y-m-d H:i:s',time())
    );
    if ($this->create($data)) {
          $uid = $this->add();
          if ($uid){
              return $uid;
          }else{
              return $this->getError();
          }
        }
    else {
          return $this->getError();
        }
  }

    public function updateArticle(){
    $data=array(
        'id'=>I('post.id'),
        'title'=>I('post.title'),
        'content'=>I('post.content'),
        'is_pass'=>I('post.is_pass'),
    );

    if ($this->create($data)) {
         $uid = $this->save();
         if ($uid){
                return $uid;
             }else{
                return $this->getError();
             }
        } else {
          return $this->getError();
        }
  }
}