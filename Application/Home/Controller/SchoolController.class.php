<?php
namespace Home\Controller;
use Think\Controller;
class SchoolController extends Controller {
 
    
    public function index(){
        if (IS_AJAX){
            $school=D("School");
            $user=D("User");
            $map['school_id']=session('user_auth.school_id');
            $map['group_id']=2;
            
            $oneuser=$user->where($map)->field('nick_name')->select();
            $one=$school->find(session('user_auth.school_id'));
            
            foreach ($oneuser as $key=>$value){
                $yz.=$value['nick_name'].',';
            }
            $yz=substr($yz, 0,-1);
            
            
            $this->assign('YZ',$yz);
            $this->assign('School',$one);
            $this->display();
        }
    } 
    
    public function save(){
        if (IS_AJAX){
            $school=D("School");
            $id=$school->update();
            $this->ajaxReturn($id);
        }
    }

}