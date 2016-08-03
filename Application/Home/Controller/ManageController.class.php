<?php
namespace Home\Controller;
use Think\Controller;
class ManageController extends Controller {
    public function index(){
        if (IS_AJAX){
            $this->display();
        }
       
    }
}