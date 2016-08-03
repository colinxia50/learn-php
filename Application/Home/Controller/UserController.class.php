<?php
namespace Home\Controller;
use Think\Controller;
class UserController extends Controller {
    public function index(){
       $this->display();
    }
    
    public function setPass(){
        if (IS_AJAX){
            $user=D("User");
            $id=$user->setPass();
            $this->ajaxReturn($id);
        }
    }
    
    //发送留言模块中取得所选择用户
    public function getUser(){
        if (IS_AJAX){
            $user=D("User");
            $all=$user->getUser();
            $this->ajaxReturn($all);
        }
    }
}