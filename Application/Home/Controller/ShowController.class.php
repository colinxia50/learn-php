<?php
namespace Home\Controller;
use Think\Controller;
class ShowController extends Controller {

    public function index(){

        if (IS_AJAX){
            $this->display();
        }
    }

    public function lists(){
        if (IS_AJAX){
            $model = D('show');
            $list = $model->relation(true)->select();
            $this->assign('lists',$list);
            $this->display();
        }
    }



}