<?php
namespace Admin\Controller;

use Think\Controller;
class AuthController extends Controller{
    
    protected function _initialize(){
       if (!session('admin')){
           $this->redirect('Login/index');
       }
    }
    
}