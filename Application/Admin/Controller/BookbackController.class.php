<?php
namespace Admin\Controller;
use Think\Auth;

class BookbackController extends AuthController {

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
            $map['name'] = array('like',"%{$search}%");
            $map['_logic'] = 'OR';
            $this->assign('searchText',I('post.searchText'));
        }
        
        $first = $this->page($borrow,$map,'page_stock',5);
        $stockData = $borrow->field('*,agent_borrow.id')->join('bookinfo as B ON agent_borrow.bookid =B.id')->join('school as S ON agent_borrow.schoolid =S.id')->where($map)->limit($first,5)->select();
        //echo $borrow->getLastSql();

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
            $School=M('agentBorrow');
            
            $bookinfos=$School->field('borrownum')
            ->where(array('id'=>I('post.id')))
            ->select();
            $num = $bookinfos['borrownum'];
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
                'outdepot'=>array('exp',"outdepot-$num")
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