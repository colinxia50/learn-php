<?php
namespace Admin\Model;
use Think\Model;


class SchoolModel extends Model {
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

    //用户表自动完成
  protected $_auto = array(
      array('dateline', 'time', self::MODEL_INSERT, 'function'),
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

   public function is_up($ids){
       $school=$this->field('id,is_up')->where(array('id' => $ids))->find();
       if ($school['is_up']==1){
           $data=array(
               'id'=>$school['id'],
               'is_up'=>0,
           );
       }elseif ($school['is_up']==0){
           $data=array(
               'id'=>$school['id'],
               'is_up'=>1,
           );
       }
       $id=$this->save($data);
       return $id?:0;
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
  	
  	$json=file_get_contents('http://localhost/zzb/address.json');
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
  	$address=$province.'-'.$city.'-'.$area;
  	
    $data=array(
      'name'=>I('post.name'),
      'name'=>I('post.name'),
      'address'=>$address,
      'mobile'=>I('post.mobile'),
      'is_up'=>1,
      'agent'=>session('admin.manager'),
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
      'name'=>I('post.name'),
      'address'=>I('post.address'),
      'mobile'=>I('post.mobile'),
    );

    if ($this->create($data)) {
         $uid = $this->save();
         return $uid ? $uid : 0;
        } else {
          return $this->getError();
        }
  }
  
  
  public function getagent(){
     $map['name']=I('post.schoolname');
     $school= $this->where($map)->find();
     if ($school and $school['agent']==session('admin.manager')){
         return $school['id'];
     }
     return 0;
  }
}