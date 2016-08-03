<?php
namespace Home\Controller;


use Org\Util\Tool;
class ResultController extends HomeController {
    public function index(){
        if (IS_AJAX){
            $child=D('Child');
            
            

            
            if (isAdmin()){
                $class=D('Class');
                $map['school_id']=session('user_auth.school_id');
                $map['state']=1;
                $allClass=$class->getClass();
                $allClass=Tool::setFormItem($allClass,'id','class_name');
                $this->assign('Class',$allClass);
            }
            if (isTeacher() || isStudent()){
                $map['school_id']=session('user_auth.school_id');
                $map['state']=1;
                $map['class_id']=session('user_auth.class_id');
            }
            
            

            if (I('post.name')){
                $map['name']=I('post.name');
            }
            if (I('post.class_id')){
                $map['class_id']=I('post.class_id');
                $this->assign('Search',$map['class_id']);
            }
          
            $first=$this->setpage($child,$map,'page_result');
            
            
            
            $all=$child
                ->relation(true)
                ->where($map)
                ->limit($first,C('PAGE_SIZE'))
                ->select();


            $this->assign('Child',$all);
            $this->display();
        }
       
    }

    public function addResult(){
        if (IS_AJAX){
            $result=D("Result");
            $id=$result->addResult();
            $this->ajaxReturn($id);
        }
    }
    
    
    //查看单人所有成绩
    public function viewList(){
        if (IS_AJAX){
            $result=D("Result");
            $child=D("Child");
            $one=$child->field('name,info')->find(I('post.id'));//学生评价
            $all=$result->viewList();
            $this->assign('Info',$one);
            $this->assign('Result',$all);
            $this->display();
        }
    }
    //修改成绩
    public function edit(){
        if (IS_AJAX){
            $result=D("Result");
            $id=$result->edit();
            $this->ajaxReturn($id);
        }
    }
    
    //修改评价
    public function editinfo(){
        if (IS_AJAX){
            $child=D('Child');
            $data=array(
                'id'=>I('post.id'),
                'info'=>I('post.info'),
            );
            $id=$child->save($data);
            $this->ajaxReturn($id);
        }
    }
    
    public function del(){
        if (IS_AJAX){
            $result=D("Result");
            $id=$result->delete(I('post.id'));
            $this->ajaxReturn($id);
        }
    }
    
}