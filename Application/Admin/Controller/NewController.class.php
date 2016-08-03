<?php

namespace Admin\Controller;

use Think\Controller;

class NewController extends Controller{
    public function index(){
        $news = M('news');
        $manager = M('manage');
        $map = array();
        $search = I('post.searchText');
        if($search){
            $map['title'] = array('like',"%{$search}%");
            $map['content'] = array('like',"%{$search}%");
            $map['_logic'] = 'or';
            $this->assign('searchText',$search);
        }
        $first = $this->page($news,$map,'page_news',10);
        $newsData = $news->where($map)->limit($first,10)->order('create_time desc')->select();
        foreach($newsData as $k => $v){
            $manageData = $manager->where(array('id' => $v['uid']))->find();
            $newsData[$k]['author'] = $manageData['manager'];
        }
        $this->assign('News',$newsData);
        $this->display('index');
    }

    public function detail(){
        $news = M('news');
        $manager = M('manage');
        $newsData = $news->where(array('id' => I('post.id')))->find();
        $managerData = $manager->where(array('id' => $newsData['uid']))->find();
        $newsData['author'] = $managerData['manager'];
        $this->assign('new',$newsData);
        $news->where(array('id' => $newsData['id']))->save(array('see' => $newsData['see'] + 1));
        $this->display('detail');
    }

    public function update(){
        $news = M('news');
        $data['title'] = I('post.title');
        $data['content'] = I('post.content');
        $data['uid'] = session('admin.id');
        $news->where(array('id' => I('post.id')))->save($data);
        return $this->index();
    }

    public function getnew(){
        $this->ajaxReturn(M('news')->where(array('id' => I('post.id')))->find());
    }

    public function add(){
        $news = M('news');
        $data['title'] = I('post.title');
        $data['content'] = I('post.content');
        $data['see'] = 0;
        $data['create_time'] = date('Y-m-d H:i:s',time());
        $data['uid'] = session('admin.id');
        $news->add($data);
        return $this->index();
    }

    public function remove(){
        $news = M('news');
        $news->where(array('id' => I('post.ids')))->delete();
        return $this->index();
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