<?php
namespace Admin\Model;
use Think\Model;

class AuthGroupModel extends Model {
  
   public function getList($page,$rows){
   	  $map=array();
      $obj= $this->field('id,title,rules')
      ->where($map)
      ->limit($rows*($page-1),$rows)
      ->select();
        foreach ($obj as $key=>$value){
            $map['id']=array('in',$value['rules']);
            $AuthRule=M('AuthRule');
            $objAR=$AuthRule->field('title')->where($map)->select();
            foreach ($objAR as $k=>$v){
                $obj[$key]['auth'].=$v['title'].',';
            }
            $obj[$key]['auth']=substr($obj[$key]['auth'], 0,-1);
        }
      //要用数据表格显示分页,就必须返回所有数据条数,和数据
      return array(
      	 'total'=>$this->where($map)->count(),
         'rows'=>$obj?:'',
      	);
   }
   
   //获取所有角色
   public function getListAll() {
       return $this->field('id,title,rules')->select();
   }

	//新增角色
	public function addRole($title, $rules) {
		$map['title'] = array('in', $rules);
        $ids = '';
		foreach ($rules as $key=>$value) {
			$ids .= $value.',';
		}
		$ids = trim($ids,',');
		$data = array(
			'title'=>$title,
			'rules'=>$ids,
		);
		if ($this->create($data)) {
			$aid = $this->add($data);
			return $aid ? $aid : 0;
		} else {
			return $this->getError();
		}
	}
   
   public function remove($ids){
   	  return $this->delete($ids);  //会返回影响的行数
   }

 //获得个个信息
   public function getAuthGroup(){
     $AuthRule=M("AuthRule");
     $Nav=M('Nav');   
     $map['id']=I('post.id');
     $obj=$this->where($map)->find();
     $Aumap['id']=array('in',$obj['rules']);
     $allAuthRule=$AuthRule->field('title')->where($Aumap)->select();
     $n='';
     foreach ($allAuthRule as $key=>$value){
         $n.=$value['title'].',';
     }
     $n=substr($n, 0,-1);
     $NMap['text']=array('in',$n);
     $allNav=$Nav->where($NMap)->field('id')->select();
     $b='';
     foreach ($allNav as $k=>$v){
        $b.=$v['id'].','; 
     }
     $b=substr($b, 0,-1);
     $obj['rules']=$b;
     return $obj;
   }
   
   public function update(){
        $map['title'] = array('in', I('post.rules'));
		$AuthRule = M('AuthRule');
		//$objAr = $AuthRule->field('id')->where($map)->select();

       $ids = '';
       foreach (I('post.rules') as $key=>$value) {
           $ids .= $value.',';
       }
       $ids = trim($ids,',');
		$data = array(
		    'id'=>I('post.id'),
		    'rules'=>$ids,
		);
		if ($this->create($data)) {
		    $aid = $this->save($data);
		    return $aid ? $aid : 0;
		} else {
		    return $this->getError();
		}
		
   }
   

 
}