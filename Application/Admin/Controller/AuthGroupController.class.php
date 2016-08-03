<?php
namespace Admin\Controller;

class AuthGroupController extends AuthController {
	//显示框架
    public function index(){
        $AuthGroup=M('auth_group');
        $map = array();
        $first = $this->page($AuthGroup,$map,'page_auth',10);
        $authData = $AuthGroup->limit($first,10)->select();
        if($authData){
            $auth_rule = M('auth_rule');
            foreach($authData as $k => $v){
                $rulesData = explode(',',$v['rules']);
                $rules = '';
                foreach($rulesData as $key => $value){
                    $rule = $auth_rule->where(array('id' => $value))->find();
                    $rules .= " {$rule['title']}";
                }
                $authData[$k]['rules'] = $rules;
            }
        }
        $rule = M('auth_rule')->select();
        $this->assign('Rule',$rule);
        //$data = json_decode($data,true);
        $this->assign('AuthData',$authData);
        $this->display('index_new');
    }
    
  public function getList(){
     if (IS_AJAX) {
     	$AuthGroup=D('AuthGroup');
     	$this->ajaxReturn($AuthGroup->getList(I('post.page'),I('post.rows')));
     }else{
     	$this->error('非法操作');
     }
  }
  
  //获取所有角色
  public function getListAll() {
      if (IS_AJAX) {
          $AuthGroup = D('AuthGroup');
          $this->ajaxReturn($AuthGroup->getListAll());
      } else {
          $this->error('非法操作！');
      }
  }
  //获取单个角色
  public function getAuthGroup(){
      if (IS_AJAX) {
          $AuthGroup=D('AuthGroup');
          $this->ajaxReturn($AuthGroup->getAuthGroup());
      }else{
          $this->error('非法操作');
      }
  }
 public function addRole(){
    if (IS_AJAX) {
      $AuthGroup=D('AuthGroup');
      $res = $AuthGroup->addRole(I('post.title'),I('post.rules'));
      if($res < 0){
          $this->ajaxReturn($res);
      }else{
          return $this->index();
      }
     }else{
      $this->error('非法操作');
     }
 }
 
 public function update(){
     if (IS_AJAX){
         $AuthGroup=D('AuthGroup');
         $data = $AuthGroup->update();
         if($data < 0){
             $this->ajaxReturn();
         }else{
             return $this->index();
         }

     }else{
         $this->error('非法操作');
     }
 }
 
 public function remove(){
     if (IS_AJAX) {
         $AuthGroup=D('AuthGroup');
         $data = $AuthGroup->remove(I('post.ids'));
         if($data < 0){
             $this->ajaxReturn($data);
         }else{
             return $this->index();
         }
         //$this->ajaxReturn();
     }else{
         $this->error('非法操作');
     }
 }

    function page($infos,$map,$class,$p = 1,$join = ''){
        if($join){
            $count = $infos->join($join)->where($map)->count();
        }else{
            $count=$infos->where($map)->count();
        }
        $total=ceil($count/$p);
        $page=I('post.page')?:1;
        $first=($page-1)*$p;
        $pghtml=PageList($page,$total,$class);
        $this->assign('page',$pghtml);
        return $first;
    }

}