<?php
namespace Home\Controller;
use Think\Controller;
class FeeController extends Controller {


    public function index(){
        if (IS_AJAX){
            $fee=D("fee");
            $one = $fee->relation(true)->select();
            $class=D("Class");
            $all=$class->getClass();
            $this->assign('Class',$all);
            $this->assign('fee',$one);
            $this->display();
        }
    }


    public function save(){
        if (IS_AJAX){
            $fee=D("fee");
            $class_id = I('classid');
            $term = I('term');

//            $id=$fee->update();
            $this->ajaxReturn($class_id,$term);
        }
    }


}