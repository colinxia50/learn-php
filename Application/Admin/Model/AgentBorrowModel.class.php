<?php
namespace Admin\Model;
use Think\Model;


class agentBorrowModel extends Model {
  //自动验证
  protected $_validate = array(	
     //-1,'名称长度不合法！'
    array('bookname', '/^[^@]{2,30}$/i', -1, self::EXISTS_VALIDATE),

    //-2,'此书已出库给该学校,搜索后编辑入库数量即可！'
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
        //。。方法名懒得改 就不修改原代码了 就写这里吧 
   public function reMove($ids){
   	  return $this->delete($ids);  //会返回影响的行数
   }

   public function getSchool(){
     $map['id']=I('post.id');
     $school= $this->where($map)->find();
     return $school;
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
   
  public function addBorrow(){ //添加借出记录
      $borrnum = I('post.borrownum');
    $data=array(
      'bookid'=>I('post.bookid'),
      'schoolid'=>I('post.schoolid'),
      'agentid'=>session('admin.id'),
      'backTime'=>I('post.backTime'),
      'rental'=>I('post.rental'),
      'borrownum'=>$borrnum,
      'borrowTime'=>date('Y-m-d',time()),
      'ifback'=>1,
    );
    
    $bookinfos=M("bookinfo")->field('number,outdepot')
      ->where(array('bookid'=>I('post.bookid')))
      ->select();
      if($bookinfos['number']-$bookinfos['outdepot'] > I('post.borrownum')){
          return -4; //-4,'该书库存不足,可在库存管理编辑该书库存！'
      }
    $maps['agentid']=session('admin.id');
    $maps['schoolid']=I('post.schoolid');
    $maps['bookid']=I('post.bookid');
    $maps['ifback']=1;
    
    if ($this->where($maps)->find()){
        return -2; //-2,'此书已出库给该学校,搜索后可点击 续借/增加出库数！'
    }
    if ($this->create($data)) {
          $uid = $this->add();
          
          //库存减
          $books = M('bookinfo');
          $datas = array(
              'id' =>I('post.bookid'),
              'outdepot'=>array('exp',"outdepot+$borrnum")
          );
          if ($books->create($datas)) {
              $uids = $books->save();
          }
          
          return $uid ? $uid : 0;
        } else {
          return $this->getError();
        }
  }

    public function update(){
     $rent = I('post.updaterent');
     $num = empty(I('post.borrownum'))?0:I('post.borrownum');
     $data=array(
      'id'=>I('post.id'),
      'rental'=>array('exp',"rental+$rent"),
      'borrownum'=>array('exp',"borrownum+$num"),
      'backTime'=>I('post.updatetime')
    );

    if ($this->create($data)) {
         $uid = $this->save();
         
             $bookids = $this->field('bookid')
              ->where(array('id'=>$uid))
              ->find();
         //库存减
         $bookss = M('bookinfo');
         $datas = array(
             'id' =>$bookids['bookid'],
             'outdepot'=>array('exp',"outdepot+$num")
         );
         if ($bookss->create($datas)) {
             $uids = $bookss->save();
         }
        // echo $bookss->getLastSql();
         return $uid ? $uid : 0;
        } else {
          return $this->getError();
        }
  }
}