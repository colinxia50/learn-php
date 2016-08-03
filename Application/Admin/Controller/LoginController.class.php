<?php
namespace Admin\Controller;
use Think\Controller;
class LoginController extends Controller {
    public function index(){
         $this->display('index');
    }
    
    public function checkManager(){
        if (IS_AJAX) {
            $Manage = D('Manage');
            $mid = $Manage->checkManager();
            echo $mid;
        } else {
            $this->error('非法操作！');
        }
    }
    
    //退出登录
    public function out() {
        session('admin',null);
        $this->redirect('Login/index');
    }
}