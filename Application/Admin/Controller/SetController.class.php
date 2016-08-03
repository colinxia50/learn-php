<?php

namespace Admin\Controller;

use Think\Controller;

class SetController extends Controller{
    public function index(){
        $id = session('admin.id');
        $data = M('manage')->where(array('id' => $id))->find();
        $this->assign('Set',$data);
        $this->display('index');
    }

    public function update(){
        $manage = D('manage');
        $id = $manage->update(true);
        return $this->index();
    }
}