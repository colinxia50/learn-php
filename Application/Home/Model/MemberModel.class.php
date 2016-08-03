<?php
namespace Home\Model;

use Think\Model;
class MemberModel extends Model{
    //用户表自动验证
    protected $_validate = array(
        //-1,'学生姓名不得为空'
        array('nick_name', 'require', -1, self::EXISTS_VALIDATE),
        //-2,'父亲姓名不得为空'
        array('rule1_name', 'require', -2, self::EXISTS_VALIDATE),
        //-3,'母亲姓名不得为空'
        array('rule1_name', 'require', -3, self::EXISTS_VALIDATE),
        //-4,'联系电话不得为空'
        array('mobile', 'require', -4, self::EXISTS_VALIDATE),
        //-5,'出生日期不得为空'
        array('birthday', 'require', -5, self::EXISTS_VALIDATE),
        //-6,'班级不得为空'
        array('class_id', 'require', -6, self::EXISTS_VALIDATE),

        //-7,'学生姓名长度不合法'
        array('nick_name', '2,10', -7, self::EXISTS_VALIDATE,'length'),

        //-8,'父亲姓名长度不合法'
        array('rule1_name', '2,10', -8, self::EXISTS_VALIDATE,'length'),

        //-9,'母亲姓名长度不合法'
        array('rule2_name', '2,10', -8, self::EXISTS_VALIDATE,'length'),

        //-10,'联系电话格式不正确'
        array('mobile','/^(0|86|17951)?(13[0-9]|15[012356789]|17[678]|18[0-9]|14[57])[0-9]{8}$/',-10,self::EXISTS_VALIDATE,'regex'),
        //-11,'电话号码被占用'
        array('mobile', '',-11, self::EXISTS_VALIDATE, 'unique'), 

    );
    
    
    
   public function addChild(){
      $data=array(
          'nick_name'=>I('post.name'),
          'user_name'=>I('post.mobile'),
          'password'=>sha1(123456),
          'mobile'=>I('post.mobile'),
          'email'=>I('post.email'),
          'rule1_name'=>I('post.rule1_name'),
          'rule2_name'=>I('post.rule2_name'),
          'class_id'=>I('post.class_id'),
          'group_id'=>I('post.group_id'),
          'sex'=>I('post.sex'),
          'birthday'=>strtotime(I('post.birthday')),
          'reg_time'=>time(),
      );
      if ($this->create($data)) {
          $id=$this->add();
          return $id?:0;
      }else{
         return $this->getError();
      }
   }
}