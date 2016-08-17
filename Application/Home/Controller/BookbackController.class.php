<?php
namespace Home\Controller;

class BookbackController extends HomeController {

    public function index(){
        $borrow = M('borrow');
        $map = array();
        $map['borrow.schoolid']=session('user_auth.school_id');
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
        $this->display();
        
    }

    public function update(){ 
        if (IS_AJAX) {
            $School=M('borrow');
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