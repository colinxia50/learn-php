<?php
namespace Home\Controller;
class IndexController extends HomeController {
    public function index(){
       if ($this->login()) {
       	$this->_oauth();
       	$school=M("School");
       	$map['id']=session('user_auth.school_id');
       	$one=$school->where($map)->field('name')->find();
       	$this->assign('One',session('user_auth.one'));
       	$this->assign('School',$one);
       	$this->display();
       };
    }
    
   public function getMessage(){
       if (IS_AJAX){
           if(S(session('user_auth.id'))){
              $a= S(session('user_auth.id'));
              echo  $a;
           }else{
              echo 0;
           }
       }
   }
}