<?php
namespace Home\Model;

use Think\Model\RelationModel;
class BookinfoModel extends RelationModel{

  //自动验证
  protected $_validate = array(	
     //-1,'名称长度不合法！'
    array('bookname', '/^[^@]{2,30}$/i', -1, self::EXISTS_VALIDATE),

    //-2,'此书已入库,搜索后编辑入库数量即可！'
    array('bookname', '', -2, self::EXISTS_VALIDATE, 'unique'),
    //-3,'条码不能为空！'
    array('barcode', '', -5,self::EXISTS_VALIDATE, 'unique'),

);


   public function reMove($ids){
   	  return $this->delete($ids);  //会返回影响的行数
   }

   public function getSchool(){
       $sobook=I('post.sobook');
       if (empty($sobook)){
           $map['id']=I('post.id');
           $map['schoolid']=session('user_auth.school_id');
       }else {
           $map['barcode'] = array('like',"%{$sobook}%");
           $map['bookname'] = array('like',"%{$sobook}%");
           $map['_logic'] = 'OR';
       }
     $school= $this->where($map)->select();
     return $school;
   }
	
   
  public function addSchool(){
  
    $data=array(
      'barcode'=>I('post.barcode'),
      'ISBN'=>I('post.ISBN'),
      'bookname'=>I('post.bookname'),
      'rent'=>I('post.rent'),
      'price'=>I('post.price'),
      'number'=>I('post.number'),
      'schoolid'=>I('post.schoolid'),
      'inTime'=>date('Y-m-d H:i:s',time()),
    );

    if ($this->create($data)) {
          $uid = $this->add();
          return $uid ? $uid : 0;
        } else {
          return $this->getError();
        }
  }

    public function update(){
    $data=array(
      'id'=>I('post.id'),
      'barcode'=>I('post.barcode'),
      'ISBN'=>I('post.ISBN'),
      'bookname'=>I('post.bookname'),
      'rent'=>I('post.rent'),
      'price'=>I('post.price'),
      'number'=>I('post.number'),
    );

    if ($this->create($data)) {
         $uid = $this->save();
         return $uid ? $uid : 0;
        } else {
          return $this->getError();
        }
  }
  public function getUser(){  //取用户 借书操和搜索作用
      $user=D("User");
      $souser=I('post.user_name');
      $map['user'] = array('like',"%{$souser}%");
      $map['nick_name'] = array('like',"%{$souser}%");
      $map['mobile'] = array('like',"%{$souser}%");
      $map['_logic'] = 'OR';
      $userinfo= $user->where($map)->select();
      //echo $user->getLastSql();
      return $userinfo;
  }
  
  public function getschoolinfo(){  //取学校信息 借书操作和搜索用
      $school=D("School");
      $soschool=I('post.shool_name');
      $map['name'] = array('like',"%{$soschool}%");
      $map['mobile'] = array('like',"%{$soschool}%");
      $map['_logic'] = 'OR';
      $schoolinfo= $school->where($map)->select();
      return $schoolinfo;
  }
  
  public function addSchools(){  //添加借书记录

      $data=array(
          'userid'=>I('post.userid'),
          'bookid'=>I('post.bookid'),
          'schoolid'=>I('post.shcoolid'),
         // 'operator'=>$operator,
          'backTime'=>I('post.backTime'),
          'borrowtime'=>date('Y-m-d H:i:s',time()),
      );
  
      if ($this->create($data)) {
          $uid = $this->add();
  
          //库存减一
          $books = M('bookinfo');
          $datas = array(
              'id' =>I('post.bookid'),
              'outdepot'=>array('exp',"outdepot+1")
          );
          if ($this->create($datas)) {
              $uids = $this->save();
          }
  
          return $uid ? $uid : 0;
      } else {
          return $this->getError();
      }
  }
  
}