<?php
namespace Admin\Model;
use Think\Model;


class BookinfoModel extends Model {
  //自动验证
  protected $_validate = array(	
     //-1,'名称长度不合法！'
    array('bookname', '/^[^@]{2,30}$/i', -1, self::EXISTS_VALIDATE),

    //-2,'此书已入库,搜索后编辑入库数量即可！'
    //array('bookname', '', -2, self::EXISTS_VALIDATE, 'unique'),
    //-3,'条码不能为空！'
    array('barcode', '', -5,self::EXISTS_VALIDATE, 'unique'),

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
       $sobook=I('post.sobook');
       if (empty($sobook)){
           $map['id']=I('post.id');
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
      'agentid' => session('admin.id'),
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
}