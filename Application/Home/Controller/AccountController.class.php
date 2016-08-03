<?php
namespace Home\Controller;
use Think\Controller;
class AccountController extends Controller {
    public function index(){
        if (IS_AJAX){
            $user=D("User");
            $map1['id']=session('user_auth.id');
            $one=$user->where($map1)->field('id,user,mobile')->find();
            $this->assign('User',$one);
            
            $school=M("School");
            $map2['id']=session('user_auth.school_id');
            $oneschool=$school->where($map2)->field('name,cover,address,content,mobile')->find();
            $this->assign('School',$oneschool);
            
            $teacher=D("Teacher");
            $map3['school_id']=session('user_auth.school_id');
            $allTeacher=$teacher->relation(true)->where($map3)->field('uid,name,content,class_id,sex')->select();
            foreach ($allTeacher as $key=>$value){
                $f=json_decode($value['cover'],true);
                $allTeacher[$key]['face']=$f['small'];
                $allTeacher[$key]['sex']=$value['sex']==1?'男':'女';
            }
            $this->assign('Teacher',$allTeacher);
            $this->display();
        }      
    }
    
    public function face(){
        if (IS_AJAX){
            $user=D("User");
            $this->assign('bigFace',$user->getFace());
            $this->display();
        }
    }
}