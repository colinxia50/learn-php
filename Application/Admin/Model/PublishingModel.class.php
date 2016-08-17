<?php
namespace Admin\Model;
use Think\Model;


class PublishingModel extends Model {
  //用户表自动验证
  protected $_validate = array(	
     //-1,'名称长度不合法！'
    array('pubname', '/^[^@]{2,20}$/i', -1, self::EXISTS_VALIDATE),
    //-2,'地址长度不合法！'
    array('address', '4,40', -2, self::EXISTS_VALIDATE,'length'),
    //-3手机格式不合法
    array('phone','/^(0|86|17951)?(13[0-9]|15[012356789]|17[678]|18[0-9]|14[57])[0-9]{8}$/',-3,self::EXISTS_VALIDATE,'regex'),         
    //-4,'名称被占用！'
    array('pubname', '', -4, self::EXISTS_VALIDATE, 'unique'),
    //-5,'手机号码被占用！'
    array('phone', '', -5,self::EXISTS_VALIDATE, 'unique'),
      //-6,'邮箱格式不正确！'
   array('email', 'email', -6, self::VALUE_VALIDATE),

);


  
   public function getList($page,$rows,$sort,$order,$name){
      $map=array();
   	  if ($name) {
   	  	$map['name']=array('like','%'.$name.'%');
   	  }
      $obj= $this
      ->field('id,name,address,mobile,is_up,dateline')
      ->where($map)
      ->order(array($sort=>$order))
      ->limit($rows*($page-1),$rows)
      ->select();
      
       foreach ($obj as $key => $value) {
       	 $obj[$key]['dateline']=date('Y-m-d H:i:s',$value['dateline']);
       	 
       }
      //要用数据表格显示分页,就必须返回所有数据条数,和数据
      return array(
      	 'total'=>$this->where($map)->count(),
         'rows'=>$obj?:'',
      	);
   }

   public function reMove($ids){
   	  return $this->delete($ids);  //会返回影响的行数
   }

   public function getSchool(){
     $map['id']=I('post.id');
     $school= $this->where($map)->find();
     return $school;
   }
	
   public function getAll(){
       return $this->field('id,name')->select();
   }
   
  public function addSchool(){
  	
  	/*$json=file_get_contents('http://localhost/zzb/address.json');
  	$json=json_decode($json,true);
  	$province='';
  	$city='';
  	$area='';
  	foreach ($json['province'] as $p){
  		if($p['pid']==I('post.province')){
  			$province=$p['name'];
  		}
  	}
  	foreach ($json['city'] as $c){
  		if($c['cid']==I('post.city')){
  			$city=$c['name'];
  		}
  	}
  	foreach ($json['area'] as $a){
  		if($a['aid']==I('post.area')){
  			$area=$a['name'];
  		}
  	}
  	$address=$province.'-'.$city.'-'.$area;*/
  	
    $data=array(
      'ISBN'=>I('post.ISBN'),
      'pubname'=>I('post.pubname'),
      'address'=>I('post.address'),
      'address1'=>I('post.address1'),
      'phone'=>I('post.phone'),
      'qq'=>I('post.qq'),
      'email'=>I('post.email'),
      'contacts'=>I('post.contacts'),
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
      'address'=>I('post.address'),
        'address1'=>I('post.eaddress1'),
        'ISBN'=>I('post.ISBN'),
        'pubname'=>I('post.pubname'),
        'phone'=>I('post.phone'),
        'qq'=>I('post.qq'),
        'email'=>I('post.email'),
        'contacts'=>I('post.contacts'),
    );

    if ($this->create($data)) {
         $uid = $this->save();
         return $uid ? $uid : 0;
        } else {
          return $this->getError();
        }
  }
}