<?php
namespace Home\Model;

use Think\Model;
class SchoolModel extends Model{
    //用户表自动验证
    protected $_validate = array(
     //-1,'名称长度不合法！'
    array('name', '/^[^@]{2,20}$/i', -1, self::EXISTS_VALIDATE),
    //-2,'地址长度不合法！'
    array('address', '4,40', -2, self::EXISTS_VALIDATE,'length'),
    //-3手机格式不合法
    array('mobile','/^(0|86|17951)?(13[0-9]|15[012356789]|17[678]|18[0-9]|14[57])[0-9]{8}$/',-3,self::EXISTS_VALIDATE,'regex'),         
    //-4,'学校名称被占用！'
    array('name', '', -4, self::EXISTS_VALIDATE, 'unique'),
    //-5,'手机号码被占用！'
    array('mobile', '', -5,self::EXISTS_VALIDATE, 'unique'),
    );
    

    //修改学校
    public function update(){
        $data=array(
          'id'=>session('user_auth.school_id'),
          'name'=>I('post.name'),
          'cover'=>I('post.cover'),
          'address'=>I('post.address'),
          'mobile'=>I('post.mobile'),
          'content'=>I('post.content'),
        );
        if ($this->create($data)){
            $id=$this->save();
            return $id?:0;
        }else{
            return $this->getError();
        }
    }
}