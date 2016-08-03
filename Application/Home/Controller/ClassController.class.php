<?php
namespace Home\Controller;
class ClassController extends HomeController {
 
    
    public function index(){
        if (IS_AJAX){
            $class=D("Class");
            $user=D('User');
            $map['school_id']=session('user_auth.school_id');

            
            $first=$this->setpage($class,$map,'page_class');
            
            
            $all=
            $class
            ->where($map)
            ->field('id,class_name')
            ->limit($first,C('PAGE_SIZE'))
            ->select();
            
            //计算学生数
            foreach ($all as $key=>$value){
                $map['school_id']=session('user_auth.school_id');
                $map['class_id']=$value['id'];
                $map['group_id']=4;
                $map['state']=1;
                $all[$key]['child']=$user->where($map)->count();
            }
            foreach ($all as $key=>$value){
                $map['school_id']=session('user_auth.school_id');
                $map['class_id']=$value['id'];
                $map['group_id']=3;
                $map['state']=1;
                $all[$key]['teacher']=$user->where($map)->count();
            }           
            
            $this->assign('Class',$all);                                
            $this->display();
        }
    } 
     
    public function getone(){
        if (IS_AJAX) {
            $class=D("Class");
            $map['id']=I('post.id');
            $one=$class->where($map)->find();
            $this->ajaxReturn($one);
        }
    } 
    
    //添加班级
    public function addClass(){
        if (IS_AJAX){
            $class=D("Class");
            $id=$class->addClass();
            $this->ajaxReturn($id);
        }
    }
   

    //修改班级
    public function update(){
        if (IS_AJAX) {
            $class=D("Class");
            $id=$class->update();
            $this->ajaxReturn($id);
        }
    }

    //删除班级
    public function del(){
        if (IS_AJAX){
            $class=D("Class");
            $user=D('User');
            $map['class_id']=array('in',I('post.ids'));
            $a=$user->field('id')->where($map)->select();
            if ($a){
                $this->ajaxReturn(-1);
            }else{
                $id=$class->delete(I('post.ids'));
                $this->ajaxReturn($id);
            }
        }  
    }
}