<?php
namespace Home\Controller;
class BooksController extends HomeController {
 
    public function index(){
        if (IS_AJAX){
            /*
        $borrow = M('Bookinfo');
        $map = array();
        $map['schoolid']=session('user_auth.school_id');
        $search = I('post.searchText');
        if(I('post.searchText')){
            $map['user'] = array('like',"%{$search}%");
            $map['bookname'] = array('like',"%{$search}%");
            $map['_logic'] = 'OR';
            $this->assign('searchText',I('post.searchText'));
        }
        
        $publishing = M('publishing')->select();
        $first = $this->setpage($borrow,$map,'page_stock',5);
        $stockData = $borrow->join('publishing ON bookinfo.ISBN = publishing.ISBN')->where($map)->limit($first,5)->select();
        //echo $borrow->getLastSql();
        $this->assign('Borrow',$stockData);
        $this->assign('Publishing',$publishing);
        $this->display();
        */
            $borrow = M('agentBorrow');
            $map = array();
            $map['schoolid']=session('user_auth.school_id');
            $search = I('post.searchText');
            if(I('post.searchText')){
                $map['bookname'] = array('like',"%{$search}%");
                $map['barcode'] = array('like',"%{$search}%");
                $map['_logic'] = 'OR';
                $this->assign('searchText',I('post.searchText'));
            }
            
            $first = $this->setpage($borrow,$map,'page_stock',5);
            $stockData = $borrow->field('*,agent_borrow.id')->join('bookinfo as B ON agent_borrow.bookid =B.id')->join('school as S ON agent_borrow.schoolid =S.id')->where($map)->limit($first,5)->select();
            //echo $borrow->getLastSql();
            //var_dump($stockData);
            //exit;
            $this->assign('Borrow',$stockData);
            $this->display();
        }
    }
    

    
    
    
    public function backbook(){
        $borrow = M('borrow');
        $map = array();
        $map['B.schoolid']=session('user_auth.school_id');
        $search = I('post.searchText');
        if(I('post.searchText')){
            $map['user'] = array('like',"%{$search}%");
            $map['bookname'] = array('like',"%{$search}%");
            $map['barcode'] = array('like',"%{$search}%");
            $map['nick_name'] = array('like',"%{$search}%");
            $map['name'] = array('like',"%{$search}%");
            $map['_logic'] = 'OR';
            $this->assign('searchText',I('post.searchText'));
        }
        
        $first = $this->page($borrow,$map,'page_stock',5);
        $stockData = $borrow->field('*,borrow.id')->join('user as U ON borrow.userid =U.id')->join('bookinfo as B ON borrow.bookid =B.id')->where($map)->limit($first,5)->select();
        // echo $borrow->getLastSql();
        
        $this->assign('Borrow',$stockData);
        $this->display('index_new');
    }
    
    public function addSchool(){ //以下都不另写模型了
        if (IS_AJAX){
            $School=M('bookinfo');            
            $data=array(
                'barcode'=>I('post.barcode'),
                'ISBN'=>I('post.ISBN'),
                'bookname'=>I('post.bookname'),
                'rent'=>I('post.rent'),
                'price'=>I('post.price'),
                'number'=>I('post.number'),
                'schoolid'=>session('user_auth.school_id'),
                'inTime'=>date('Y-m-d H:i:s',time()),
            );
            
            if ($School->create($data)) {
                $uid = $this->add();
                    if($uid < 0){
                        $this->ajaxReturn($uid);
                    }else{
                        //return $this->index();
                    }
            } else {
                return $this->getError();
            }    

        }else{
            $this->error('非法操作');
        }
    }
    
    public function getSchool(){
        if (IS_AJAX) {
            
            $sobook=I('post.sobook');
            if (empty($sobook)){
                $map['id']=I('post.id');
            }else {
                $map['barcode'] = array('like',"%{$sobook}%");
                $map['bookname'] = array('like',"%{$sobook}%");
                $map['_logic'] = 'OR';
            }
            $school=D('bookinfo');
            $school= $school->where($map)->select();

            
            $this->ajaxReturn($school);
        }else{
            $this->error('非法操作');
        }
    }
    
    
    public function reMove(){
        if (IS_AJAX) {
            $School=M('bookinfo');
            $data = $School->delete(I('post.ids'));
            if($data < 0){
                return $data;
            }else{
                //return $this->index();
            }
        }else{
            $this->error('非法操作');
        }
    }
    
    public function update(){
        if (IS_AJAX) {
            $School=D('bookinfo');
            $data=array(
                'id'=>I('post.id'),
                'barcode'=>I('post.barcode'),
                'ISBN'=>I('post.ISBN'),
                'bookname'=>I('post.bookname'),
                'rent'=>I('post.rent'),
                'price'=>I('post.price'),
                'number'=>I('post.number'),
            );
            
            if ($School->create($data)) {
                $uid = $School->save();
                if($uid < 0){
                    return $uid ? $uid : 0;
                }
            } else {
                return $this->getError();
            }
        }else{

            $this->error('非法操作');
        }
    }
    
}