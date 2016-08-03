<?php
namespace Admin\Controller;

class BookbackController extends AuthController {

    public function index(){
        $borrow = M('borrow');
        $map = array();
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
        $stockData = $borrow->field('*,borrow.id')->join('user as U ON borrow.userid =U.id')->join('bookinfo as B ON borrow.bookid =B.id')->join('school as S ON borrow.schoolid =S.id')->where($map)->limit($first,5)->select();
        //echo $borrow->getLastSql();
        //var_dump($stockData);
        //exit;
        $this->assign('Borrow',$stockData);
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
    

    
    public function update(){ 
        if (IS_AJAX) {
            $School=D('borrow');
            $data=array(
                'id'=>I('post.id'),
                'ifback'=>0
            );
            
            if ($School->create($data)) {//更新借阅状态
                $uid = $School->save();
                //echo $this->getLastSql();
                
            } else {
                return $School->getError();
            }
            
            $books = M('bookinfo'); //库存加一
            $datas = array(
                'id' =>I('post.bookid'),
                'outdepot'=>array('exp',"outdepot-1")
            );
            if ($books->create($datas)) {
                $uid = $books->save();
            }

   
            return $uid ? $uid : 0;
            

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