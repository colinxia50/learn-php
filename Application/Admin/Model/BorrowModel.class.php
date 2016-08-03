<?php
namespace Admin\Model;
use Think\Model;


class BorrowModel extends Model {
  //自动验证
  protected $_validate = array(	
     //-1,'名称长度不合法！'
    array('bookname', '/^[^@]{2,30}$/i', -1, self::EXISTS_VALIDATE),

    //-2,'此书已入库,搜索后编辑入库数量即可！'
    array('bookname', '', -2, self::EXISTS_VALIDATE, 'unique'),
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
        //。。方法名懒得改 就不修改原代码了 就写这里吧 
   public function reMove($ids){
   	  return $this->delete($ids);  //会返回影响的行数
   }

   public function getSchool(){  //取图书信息 借书操作用
     $map['id']=I('post.id');
     $school= $this->where($map)->find();
     return $school;
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
   
   
   public function getborrowinfo(){  //取借阅信息
       $map['id']=I('post.id');
       $borrowinfo= $this->where($map)->find();
       return $borrowinfo;
   }
   
  public function addSchool(){
      $operatorarr = session('admin');
      $operator = $operatorarr['manager'];
    $data=array(
      'userid'=>I('post.userid'),
      'bookid'=>I('post.bookid'),
      'schoolid'=>I('post.shcoolid'),
      'operator'=>$operator,
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

    public function update(){
     $rent = I('post.updaterent');
    $data=array(
      'id'=>I('post.id'),
      'rental'=>array('exp',"rental+$rent"),
      'backTime'=>I('post.updatetime')
    );

    if ($this->create($data)) {
         $uid = $this->save();
         //echo $this->getLastSql();
         return $uid ? $uid : 0;
        } else {
          return $this->getError();
        }
  }
}