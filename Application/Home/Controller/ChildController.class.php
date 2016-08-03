<?php
namespace Home\Controller;
use Org\Util\Tool;
class ChildController extends HomeController {
 
    public function index(){
        if (IS_AJAX){
           $child=D('Child');
           $class=D('Class');
           $map['school_id']=session('user_auth.school_id');
           $map['state']=1;
           if (I('post.name')){
               $map['name']=I('post.name');
           }
           if (I('post.class_id')){
               $map['class_id']=I('post.class_id');
           }
           
           $allClass=$class->getClass();
           $allClass=Tool::setFormItem($allClass,'id','class_name');
           


           
           
          $first=$this->setpage($child,$map,'page_student');
           
           
           $all=$child
              ->relation(true)
              ->where($map)
              ->limit($first,C('PAGE_SIZE'))
              ->select();




           $this->assign('Class',$allClass);
           $this->assign('Child',$all);
           $this->display();
        }
    }

    public function getone(){
        if (IS_AJAX) {
            $User=M("User");
            $child=M("Child");
            $map['id']=I('post.id');
            $oneChild=$child->where($map)->field('uid,card')->find();          
            $m['id']=$oneChild['uid'];
            $one=$User->where($m)->field('id,nick_name,email,mobile,rule1_name,rule2_name,sex,birthday,class_id')->find();
            $one['birthday']=date('Y-m-d',$one['birthday']);
            $one['card']=$oneChild['card'];
            $this->ajaxReturn($one);
        }
    }
    public function addChild(){
    	if (IS_AJAX){
           $child=D("Child");
           $id=$child->addChild();
           $this->ajaxReturn($id);
        }
    }
 
    public function update(){
        if (IS_AJAX) {
            $child=D("Child");
            $id=$child->update();
            $this->ajaxReturn($id);
        }
    }

   public function allChild(){
    if (IS_AJAX) {
       $child=D("Child");
       $all=$child->allChild();
       $this->ajaxReturn($all);
    }
   }


}