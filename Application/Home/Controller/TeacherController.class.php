<?php
namespace Home\Controller;
class TeacherController extends HomeController {
 
    public function index(){
        if (IS_AJAX){
           $class=D("Class");
           $teacher=D("Teacher");
          
           $allClass=$class->getClass(); 
           
           
           $map['school_id']=session('user_auth.school_id');
           $map['group_id']=3;
           $map['state']=1;
           if (I('post.name')){
               $map['name']=I('post.name');
           }
           if (I('post.class_id')){
               $map['class_id']=I('post.class_id');
           }           
                    
           
           $first=$this->setpage($teacher,$map,'page_teacher');
           
           $allTeacher=$teacher
                  ->relation(true)
                  ->where($map)
                  ->field('id,uid,name,content,sex,class_id')
                  ->limit($first,C('PAGE_SIZE'))
                  ->select();
           

           $this->assign('Teacher',$allTeacher);
           $this->assign('Class',$allClass);
           $this->display();
        }
    }
    
    public function addTeacher(){
        if (IS_AJAX){
               $teacher=D("Teacher");
               $id=$teacher->addTeacher();
               $this->ajaxReturn($id);
        }
    }
    
    public function update(){
        if (IS_AJAX){
            $teacher=D("Teacher");
            $id=$teacher->updateTeacher();
            $this->ajaxReturn($id);
        }
    }
    
    public function getone(){
        if (IS_AJAX){
            $user=D('User');
            $teacher=D('Teacher');
            $one=$teacher->relation(true)->field('id,uid,name,content,sex,class_id,birthday')->find(I('post.id'));
            $one['birthday']=date('Y/m/d',$one['birthday']);
            $this->ajaxReturn($one);
        }
    }
}