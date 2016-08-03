<?php
namespace Admin\Controller;

class PublishingController extends AuthController {

    public function index(){
        $publishing = M('publishing');
        $map = array();
        $search = I('post.searchText');
        if(I('post.searchText')){
            $map['ISBN'] = array('like',"%{$search}%");
            $map['pubname'] = array('like',"%{$search}%");
            $map['address'] = array('like',"%{$search}%");
            $map['phone'] = array('like',"%{$search}%");
            $map['contacts'] = array('like',"%{$search}%");
            $map['_logic'] = 'OR';
            $this->assign('searchText',I('post.searchText'));
        }
        $first = $this->page($publishing,$map,'page_publishing',5);
        $publishingData = $publishing->where($map)->limit($first,5)->select();
        $json=file_get_contents('./address.json');
        $json=json_decode($json,true);
        $this->assign('address',$json);
        $this->assign('Publishing',$publishingData);
        $this->display('index_new');
    }
    
    
    public function addSchool(){
        if (IS_AJAX){
            $School=D('Publishing');
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
            $School=D('publishing');
            $this->ajaxReturn($School->getSchool());
        }else{
            $this->error('非法操作');
        }
    }
    
    public function reMove(){
        if (IS_AJAX) {
            $School=D('publishing');
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
            $School=D('publishing');
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