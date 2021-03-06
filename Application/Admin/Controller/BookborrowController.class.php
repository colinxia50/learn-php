<?php
namespace Admin\Controller;
use Think\Auth;

class BookborrowController extends AuthController {

    public function index(){
        $borrow = M('agentBorrow');
        $map = array();
        if (session('admin.manager')!='admin'){
            $map['agent_borrow.agentid'] = session('admin.id');
            $maps['agent'] = session('admin.manager');
            $School = M('School')->where($maps)->select();
        }
        $search = I('post.searchText');
        if(I('post.searchText')){
            $map['bookname'] = array('like',"%{$search}%");
            $map['barcode'] = array('like',"%{$search}%");
            $map['_logic'] = 'OR';
            $this->assign('searchText',I('post.searchText'));
        }
        
        $first = $this->page($borrow,$map,'page_stock',5);
        $stockData = $borrow->field('*,agent_borrow.id')->join('bookinfo as B ON agent_borrow.bookid =B.id')->join('school as S ON agent_borrow.schoolid =S.id')->where($map)->limit($first,5)->select();
        //echo $borrow->getLastSql();
        //var_dump($stockData);
        //exit;
        $this->assign('Borrow',$stockData);
        $this->assign('School',$School);
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
    
    public function addBorrow(){ //添加出库记录
        if (IS_AJAX){
            $AgentBorrow=D('AgentBorrow');
            $data = $AgentBorrow->addBorrow();
            if($data < 0){
                $this->ajaxReturn($data);
            }else{
                return $this->index();
            }
        }else{
            $this->error('非法操作');
        }
    }
    public function getSchool(){ //取图书信息 借书操作用
        if (IS_AJAX) {
            $School=D('bookinfo');
            $this->ajaxReturn($School->getSchool());
        }else{
            $this->error('非法操作');
        }
    }
    public function getUser_name(){ //取用户信息 借书操作用
        if (IS_AJAX) {
            $School=D('AgentBorrow');
            $this->ajaxReturn($School->getUser());
        }else{
            $this->error('非法操作');
        }
    }
    public function getschoolinfo(){ //取学校信息 借书操作用
        if (IS_AJAX) {
            $School=D('AgentBorrow');
            $this->ajaxReturn($School->getschoolinfo());
        }else{
            $this->error('非法操作');
        }
    }
    
    public function getborrow(){   //取借阅信息 
            if (IS_AJAX) {
            $School=D('AgentBorrow');
            $this->ajaxReturn($School->getborrowinfo());
        }else{
            $this->error('非法操作');
        }
    }
    
    public function update(){
        if (IS_AJAX) {
            $School=D('AgentBorrow');
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