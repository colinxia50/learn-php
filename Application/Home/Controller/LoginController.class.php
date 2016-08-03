<?php
namespace Home\Controller;
use Think\Controller;
class LoginController extends Controller {
    public function index(){
       $this->display();
    }



    public function login(){
         if (IS_AJAX){
             $user=D('User');
             $id=$user->login();
           $this->ajaxReturn($id);
        }       
    }
    
    
    //退出登录
    public function logout() {
        //清理session
        session(null);
        //清除自动登录的cookie
        cookie('auto', null);
        //跳转到正确跳转页
        $this->success('退出成功！', U('Login/index'));
    }
}