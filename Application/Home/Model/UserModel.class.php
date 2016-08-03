<?php
namespace Home\Model;

use Think\Model\RelationModel;
class UserModel extends RelationModel{
    
    protected $_link=array(
        'Class'=>array(
            'mapping_type' =>self::BELONGS_TO,
            'foreign_key'=>'class_id',
            'mapping_fields'=>'class_name',
            'as_fields'=>'class_name'
        ),
    
    );
    
    
    //用户表自动验证
    protected $_validate = array(
        //-1,'学生姓名不得为空'
        array('nick_name', 'require', -1, self::EXISTS_VALIDATE),
        //-2,'父亲姓名不得为空'
        array('rule1_name', 'require', -2, self::EXISTS_VALIDATE),
        //-3,'母亲姓名不得为空'
        array('rule2_name', 'require', -3, self::EXISTS_VALIDATE),
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
    
        //-12,'帐号长度不合法！'
        array('user', '/^[^@]{2,20}$/i', -12, self::EXISTS_VALIDATE),
        //-13,'密码长度不合法！'
        array('password', '6,40', -13, self::EXISTS_VALIDATE,'length'),
        
        //-14,'邮箱格式不正确'
        array('email','email',-14,self::VALUE_VALIDATE),
        //-15,'邮箱被占用'
        array('email', '',-15,self::VALUE_VALIDATE, 'unique'),
        //-16 新密码长度不合法
        array('password','2,20',-16,self::EXISTS_VALIDATE,'length'),
        //-17,'新密码不得为空'
        array('password', 'require', -17, self::EXISTS_VALIDATE),
        //-18 '密码输入不一致'
        array('notpassword', 'password', -18, self::EXISTS_VALIDATE, 'confirm'),
        
    );
    
    //用户表自动完成
    protected $_auto = array(
        array('password', 'sha1', self::MODEL_BOTH, 'function'),
    );
    
    
    public function getUser(){
        $map['class_id']=I('post.id');
        $map['school_id']=session('user_auth.school_id');
        $map['id']=array('neq',session('user_auth.id'));
        $all=$this
              ->where($map)
              ->field('id,nick_name,group_id')
              ->order('group_id asc')
              ->select();
        foreach ($all as $key=>$value){
            switch ($value['group_id']){
                case 2:
                    $all[$key]['nick_name']=$value['nick_name'].' [园长]';
                    break;
                case 3:
                    $all[$key]['nick_name']=$value['nick_name'].' [老师]';
                    break;
                case 4:
                    $all[$key]['nick_name']=$value['nick_name'].' [学生]';
                    break;
            }
        }
        return $all;
    }
    
    
    public function setPass(){
       $map['user']=session('user_auth.user');
       $map['password']=sha1(I('post.password'));
       $user=$this->where($map)->field('id')->find();
       
       $data=array(
           'id'=>$user['id'],
           'password'=>I('post.newpassword'),
           'notpassword'=>I('post.notpassword'),
           'one'=>1,
       );
       
       if($user){           
           if ($this->create($data)){
                $id=$this->save();
                if($id){
                    session('user_auth.one',1);
                    return $id;
                }else{
                    return 0;
                }
           }else{
               return $this->getError();
           }
       }else{
           return -1;//密码输入不正确
       }
    }
    
    public function addTeacher(){
        $data=array(
            'nick_name'=>I('post.name'),
            'user'=>I('post.mobile'),
            'password'=>123456,
            'mobile'=>I('post.mobile'),
            'email'=>I('post.email'),
            'class_id'=>I('post.class_id'),
            'school_id'=>session('user_auth.school_id'),
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

    public function updateTeacher(){
        $data=array(
            'id'=>I('post.id'),
            'nick_name'=>I('post.name'),
            'mobile'=>I('post.mobile'),
            'email'=>I('post.email'),
            'class_id'=>I('post.class_id'),
            'sex'=>I('post.sex'),
            'birthday'=>strtotime(I('post.birthday')),
        );
        if ($this->create($data)) {
            $id=$this->save();
            return $id?:0;
        }else{
            return $this->getError();
        }
    }
    
    
    
    public function addChild(){
        $data=array(
            'nick_name'=>I('post.name'),
            'user'=>I('post.mobile'),
            'password'=>123456,
            'mobile'=>I('post.mobile'),
            'email'=>I('post.email'),
            'rule1_name'=>I('post.rule1_name'),
            'rule2_name'=>I('post.rule2_name'),
            'class_id'=>I('post.class_id'),
            'school_id'=>session('user_auth.school_id'),
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
    
    public function updateChild(){
        $data=array(
            'id'=>I('post.id'),
            'nick_name'=>I('post.name'),
            'mobile'=>I('post.mobile'),
            'email'=>I('post.email'),
            'rule1_name'=>I('post.rule1_name'),
            'rule2_name'=>I('post.rule2_name'),
            'class_id'=>I('post.class_id'),
            'sex'=>I('post.sex'),
            'birthday'=>strtotime(I('post.birthday')),
        );
        if ($this->create($data)) {
            $id=$this->save();
            return $id?:0;
        }else{
            return $this->getError();
        }       
    }
    
    //更新头像
    public function updateface($face){
        $data=array(
            'cover'=>$face,
        );
        $map['id']=session('user_auth.id');
        return $this->where($map)->save($data);
    }
    //获取 个人头像
    public function getFace(){
        $user=$this->field('cover as face')->find(session('user_auth.id'));
        return json_decode($user['face'])->big;
    }
    
    public function login(){
        $data=array(
            'user'=>I('post.user'),
            'password'=>I('post.password'),
        );
        //where条件
        $map = array();
        
        if ($this->create($data)){
            $map['user']=I('post.user');
        }else{
            return $this->getError();
        }
        
        //验证密码
        $user = $this->field('id,user,class_id,school_id,group_id,password,cover,nick_name,one')->where($map)->find();
        if ($user['password'] == sha1(I('post.password'))){
            //登录验证后写入登录信息
            $update = array(
                'id'=>$user['id'],
                'last_login'=>NOW_TIME,
                'last_ip'=>get_client_ip(1),
            );
            $this->save($update);
            
            //将记录写入到cookie和session中去
            $auth = array(
                'id'=>$user['id'],
                'name'=>$user['nick_name'],
                'user'=>$user['user'],
                'group_id'=>$user['group_id'],
                'class_id'=>$user['class_id'],
                'school_id'=>$user['school_id'],
                'face'=>json_decode($user['cover']),
                'one'=>$user['one'],
                'last_login'=>NOW_TIME,
            );
            
            //写入到session
            session('user_auth', $auth);

            $studentData = M('child')->where(array('uid' => $user['id']))->find();
            session('student_id', $studentData['id']);
            //将用户名加密写入cookie
            cookie('auto', encryption($user['user'].'|'.get_client_ip()),3600 * 24 * 30);
            return $user['id'];
            
        }else{
            return -3;//密码不正确
        }
    }
}