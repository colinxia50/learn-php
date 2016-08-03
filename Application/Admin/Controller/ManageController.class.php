<?php
namespace Admin\Controller;

use Think\Auth;
class ManageController extends AuthController {

    public function index(){
        $Manage = M('Manage');
        $Auth=new Auth();
        $map = array();
        if(I('post.searchText')){
            $map =array('manager' => 'like','%'.I('post.searchText').'%');
            $this->assign('searchText',I('post.searchText'));
        }
        $first = $this->page($Manage,$map,'',10);
        $ManageData = $Manage->order('id desc')->where($map)->limit($first,10)->select();
        if($ManageData){
            foreach($ManageData as $k => $v){
                $AuthData = $Auth->getGroups($v['id']);
                $ManageData[$k]['title'] = $AuthData[0]['title'];
                $ManageData[$k]['last_ip'] = long2ip($v['last_ip']);
            }
        }
       $json=file_get_contents('http://localhost/zzb/address.json');
       $json=json_decode($json,true);
       
        $Access = M('auth_group')->select();
        $this->assign('Manager',$ManageData);
        $this->assign('address',$json);
        $this->assign('Access',$Access);
        $this->display('index_new');
    }
    
    public function getManage(){
        if (IS_AJAX) {
            $Manage=D('Manage');
            $this->ajaxReturn($Manage->getManage());
        }else{
            $this->error('非法操作');
        }
    }
    
    public function getList(){
        if (IS_AJAX) {
            $Manage=D('Manage');
            $this->ajaxReturn($Manage->getList(I('post.page'),I('post.rows'),I('post.sort'),I('post.order'),I('post.manager')));
        }else{
            $this->error('非法操作');
        }
    }
    
    public function update(){
        if (IS_AJAX) {
            $Manage=D('Manage');
            $obj = $Manage->update();
            if($obj < 0){
                $this->ajaxReturn($obj);
            }else{
                return $this->index();
            }
        }else{
            $this->error('非法操作');
        }
    }
    
    //新增管理员
    public function addManage() {
        if (IS_AJAX) {
            $Manage = D('Manage');
            $obj=$Manage->addManage(I('post.manager'), I('post.password'), I('post.role'));
            if($obj < 0){
                $this->ajaxReturn($obj);
            }else{
                return $this->index();
            }
        } else {
            $this->error('非法操作！');
        }
    }
    
    public function remove(){
        if (IS_AJAX) {
            $Manage=D('Manage');
            $Manage->remove(I('post.ids'));
            return $this->index();
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
    
    public function city(){
    	$json=file_get_contents('./address.json');
    	$json=json_decode($json,true);
    	$area=$json['city'];
    	$returnstring='';
    	$pid=intval($_GET['pid']);
    	foreach($area as $a){
    		if($a['pid']==$pid){
    			$returnstring=$returnstring.$a['cid'].',#'.$a['name'].'&*';
    		}
    		
    	}
    	echo $returnstring;
    	
    }
    public function area(){
    	$json=file_get_contents('./address.json');
    	$json=json_decode($json,true);
    	$area=$json['area'];
    	$returnstring='';
    	$cid=intval($_GET['cid']);
    	foreach($area as $a){
    		if($a['cid']==$cid){
    			$returnstring=$returnstring.$a['aid'].',#'.$a['name'].'&*';
    		}
    		
    	}
    	echo $returnstring;
    	
    }
}