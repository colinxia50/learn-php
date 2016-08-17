<?php
namespace Admin\Controller;
use Think\Auth;

class IndexController extends AuthController {
	//显示后台框架
    public function index(){
        $auth=new Auth();
        $a=$auth->getGroups(session('admin.id'));
        $groups=$a[0]['rules'];
        $rules1=empty($a[0]['rules1'])?'0':$a[0]['rules1']; //当前管理员无权限访问的二级菜单id
        $AuthRule=M('AuthRule');
        $map['id']=array('in',$groups);
        $obj=$AuthRule->field('title')->where($map)->select();
        $texts='';
        foreach ($obj as $key=>$value){
            $texts.= $value['title'].',';
        }
        $Nav=D('Nav');
        $data = $Nav->getNav(0,substr($texts, 0,-1));
        foreach($data as $k => $v){
            $map['nid']=$v['id'];
            $map['id']  = array('not in',$rules1);
            $childData = M('nav')->where($map)->select();
            $data[$k]['child'] = $childData;
        }

        $this->assign('Nav',$data);
         $this->display('index_new');
    }
   //获取菜单导航  只显示指定菜单
    public function getNav(){
       $auth=new Auth();
       $a=$auth->getGroups(session('admin.id'));      
       $groups=$a[0]['rules'];
       $AuthRule=M('AuthRule');
       $map['id']=array('in',$groups);
       $obj=$AuthRule->field('title')->where($map)->select();
       $texts='';
       
       foreach ($obj as $key=>$value){
           $texts.=$value['title'].',';
       }
       $Nav=D('Nav');
       $this->ajaxReturn($Nav->getNav(I('post.id'),substr($texts, 0,-1)));
    }
}