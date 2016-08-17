<?php
namespace Admin\Controller;
use Think\Auth;

class StockController extends AuthController {
    
    public function index(){
        $stockData = M('Bookinfo');
        $map = array();
        if (session('admin.manager')!='admin'){
            $map['agentid'] = session('admin.id');
        }
        $search = I('post.searchText');
        if(I('post.searchText')){
            $map['barcode'] = array('like',"%{$search}%");
            $map['bookname'] = array('like',"%{$search}%");
            $map['_logic'] = 'OR';
            $this->assign('searchText',I('post.searchText'));
        }
        $publishing = M('publishing')->select();
    
        $first = $this->page($stockData,$map,'page_stock',5);
        $stockDatas = $stockData->join('publishing ON bookinfo.ISBN = publishing.ISBN')->where($map)->limit($first,5)->select();
        // echo $stockData->getLastSql();
        $this->assign('Stock',$stockDatas);
        $this->assign('Publishing',$publishing);
        $this->display('index_new');
    }


    public function getList(){
        if (IS_AJAX) {
            $School=D('bookinfo');
            $this->ajaxReturn($School->getList(I('post.page'),I('post.rows'),I('post.sort'),I('post.order'),I('post.name')));
        }else{
            $this->error('非法操作');
        }
    }
    
    public function addSchool(){
        if (IS_AJAX){
            $School=D('bookinfo');
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
            $School=D('bookinfo');
            $this->ajaxReturn($School->getSchool());
        }else{
            $this->error('非法操作');
        }
    }
    
    public function getagent(){ //查询代理商对应的学校
        if (IS_AJAX) {
            $School=D('school');
            $this->ajaxReturn($School->getagent());
        }else{
            $this->error('非法操作');
        }
    }
    
    public function reMove(){
        if (IS_AJAX) {
            $School=D('bookinfo');
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
            $School=D('bookinfo');
            $data = $School->update();
            if($data < 0){
                $this->ajaxReturn($data);
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