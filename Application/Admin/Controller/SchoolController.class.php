<?php
namespace Admin\Controller;

class SchoolController extends AuthController {

    public function index(){
        $school = M('school');
        $map = array();
        $search = I('post.searchText');
        if(I('post.searchText')){
            $map['name'] = array('like',"%{$search}%");
            $map['address'] = array('like',"%{$search}%");
            $map['content'] = array('like',"%{$search}%");
            $map['mobile'] = array('like',"%{$search}%");
            $map['_logic'] = 'OR';
            $this->assign('searchText',I('post.searchText'));
        }
        $first = $this->page($school,$map,'page_school',10);
        $schoolData = $school->where($map)->limit($first,10)->select();
        
        $json=file_get_contents('./address.json');
        $json=json_decode($json,true);
        $this->assign('address',$json);
        $this->assign('agent',session('admin.manager'));
        $this->assign('School',$schoolData);
        $this->display('index_new');
    }
    
    public function getList(){
        if (IS_AJAX) {
            $School=D('School');
            $this->ajaxReturn($School->getList(I('post.page'),I('post.rows'),I('post.sort'),I('post.order'),I('post.name')));
        }else{
            $this->error('非法操作');
        }
    }
    
    public function addSchool(){
        if (IS_AJAX){
            $School=D('School');
            $data = $School->addSchool();
            if($data < 0){
                $this->ajaxReturn($data);
            }else{
                return $this->index();
            }
        }else{
            $this->error('非法操作');
        }
    }
    public function getSchool(){
        if (IS_AJAX) {
            $School=D('School');
            $this->ajaxReturn($School->getSchool());
        }else{
            $this->error('非法操作');
        }
    }
    
    public function reMove(){
        if (IS_AJAX) {
            $School=D('School');
            $data = $School->reMove(I('post.ids'));
            if($data < 0){
                return $data;
            }else{
                return $this->index();
            }
        }else{
            $this->error('非法操作');
        }
    }
    
    public function update(){
        if (IS_AJAX) {
            $School=D('School');
            $data = $School->update();
            if($data < 0){
                return $data;
            }else{
                return $this->index();
            }
        }else{
            $this->error('非法操作');
        }
    }
    public function is_up(){
        if (IS_AJAX) {
            $School=D('School');
            $data = $School->is_up(I('post.ids'));
            if($data < 0){
                return $data;
            }else{
                return $this->index();
            }
        }else{
            $this->error('非法操作');
        }
    }

    function page($infos,$map,$class,$p = 1,$join = ''){
        if($join){
            $count = $infos->join($join)->where($map)->count();
        }else{
            $count=$infos->where($map)->count();
        }
        $total=ceil($count/$p);
        $page=I('post.page')?:1;
        $first=($page-1)*$p;
        $pghtml=PageList($page,$total,$class);
        $this->assign('page',$pghtml);
        return $first;
    }
}