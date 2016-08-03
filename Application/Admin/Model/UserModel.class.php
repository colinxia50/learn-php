<?php
namespace Admin\Model;
use Think\Model\RelationModel;
use Org\Util\Tool;

class UserModel extends RelationModel {
  //用户表自动验证
  protected $_validate = array(	
     //-1,'帐号长度不合法！'
    array('nick_name', '/^[^@]{2,20}$/i', -1, self::EXISTS_VALIDATE),
    //-2手机格式不合法
    array('mobile','/^(0|86|17951)?(13[0-9]|15[012356789]|17[678]|18[0-9]|14[57])[0-9]{8}$/',-2,self::VALUE_VALIDATE,'regex'),
    //-3,'邮箱格式不正确！'
    array('email', 'email', -3, self::VALUE_VALIDATE),       
    //-4,'邮箱被占用！'
    array('email', '', -4, self::VALUE_VALIDATE, 'unique', self::MODEL_INSERT),
    //-5,'手机号码被占用！'
    array('mobile', '', -5, self::VALUE_VALIDATE, 'unique', self::MODEL_INSERT),
    //-6,'长度不合法！'
//    array('rule1_name', '/^[^@]{2,10}$/i', -6, self::VALUE_VALIDATE),
//    //-7,'长度不合法！'
//    array('rule2_name', '/^[^@]{2,10}$/i', -7, self::VALUE_VALIDATE),
    //-8 学校不得为空
    array('school_id','require',-8),
    //-9 班级不得为空
    //array('class_id','require',-9),

);

    //用户表自动完成
  protected $_auto = array(
      array('password', 'sha1', self::MODEL_INSERT, 'function'),
      array('reg_time', 'time', self::MODEL_INSERT, 'function'),
  );

  
  protected $_link=array(
      'Class'=>array(
          'mapping_type'  => self::BELONGS_TO,
          'class_name'    => 'class',
          'foreign_key'   => 'class_id',
          'mapping_fields'=>'class_name',
          'as_fields'=>'class_name',
      ),
  );
  
  
   public function getList($page,$rows,$sort,$order,$nick_name,$group_id,$school_id,$class_id){
      $school=D("School");
      $allSchool=$school->getAll();
      $allSchool=Tool::setFormItem($allSchool, 'id', 'name');
   	  $map=array();
   	  if ($nick_name) {
   	  	$map['nick_name']=array('like','%'.$nick_name.'%');
   	  }
   	  if ($group_id) {
   	      $map['group_id']=$group_id;
   	  }
   	  if ($school_id){
   	      $map['school_id']=$school_id;
   	  }
   	  if ($class_id){
   	      $map['class_id']=$class_id;
   	  }
      $obj= $this
      ->relation('Class')
      ->field('id,nick_name,reg_time,group_id,school_id,class_id,last_login,last_ip')
      ->where($map)
      ->order(array($sort=>$order))
      ->limit($rows*($page-1),$rows)
      ->select();
      
       foreach ($obj as $key => $value) {
       	 $obj[$key]['reg_time']=date('Y-m-d H:i:s',$value['reg_time']);
       	 $obj[$key]['last_login']=date('Y-m-d H:i:s',$value['last_login']);
       	 $obj[$key]['last_ip']=long2ip($value['last_ip']);
       	 $obj[$key]['school_name']=$allSchool[$value['school_id']];
       	 
       }
      //要用数据表格显示分页,就必须返回所有数据条数,和数据
      return array(
      	 'total'=>$this->where($map)->count(),
         'rows'=>$obj?:'',
      	);
   }

   public function reMove($ids){
      $child=D("Child");
      $map['uid']=array('in',$ids);
      $child->where($map)->delete();
   	  return $this->delete($ids);  //会返回影响的行数
   }


   public function getUser(){
     $map['id']=I('post.id');
     $user= $this->where($map)->find();
     $user['cover']=json_decode($user['cover'])->small;
     $user['birthday']=date('Y-m-d',$user['birthday']);
     switch ($user['group_id']){
          case 2:
             $user['group']='园长';
              break;
          case 3:
              $user['group']='老师';
              break;
           case 4:
              $user['group']='学生';
           break;
     }
     return $user;
   }
	
  public function register(){
    $data=array(
      'nick_name'=>I('post.nick_name'),
      'group_id'=>I('post.group_id'),
      'password'=>123456,
      'user'=>I('post.mobile'),
      'rule1_name'=>I('post.rule1_name'),
      'rule2_name'=>I('post.rule2_name'),
      'mobile'=>I('post.mobile'),
      'email'=>I('post.email'),
      'birthday'=>date(),
      'class_id'=>I('post.class_id'),
      'school_id'=>I('post.school_id'),
      'sex'=>I('post.sex'),
    );
    if ($this->create($data)) {
          $uid = $this->add();
          if ($uid){
              if (I('post.group_id')==4){
                 $child=D("Child");
                 $child->addChild($uid); 
              }
              return $uid;
          }else{
              return $this->getError();
          }
        }
    else {
          return $this->getError();
        }
  }

    public function update(){
    $data=array(
        'id'=>I('post.id'),
        'nick_name'=>I('post.nick_name'),
        'group_id'=>I('post.group_id'),
//        'rule1_name'=>I('post.rule1_name'),
//        'rule2_name'=>I('post.rule2_name'),
        'mobile'=>I('post.mobile'),
        'email'=>I('post.email'),
        //'birthday'=>strtotime(I('post.birthday')) ?:'',
        'class_id'=>I('post.class_id'),
        'school_id'=>I('post.school_id'),
        //'sex'=>I('post.sex'),
    );

    if ($this->create($data)) {
         $uid = $this->save();
         if ($uid){
                 if(I('post.group_id')==4){
                     $child=D("Child");
                     $child->upChild(I('post.id'));
                 }
                return $uid;
             }else{
                return $this->getError();
             }
        } else {
          return $this->getError();
        }
  }
}