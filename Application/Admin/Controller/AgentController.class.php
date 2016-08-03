<?php
namespace Admin\Controller;

use Think\Controller;

class AgentController extends Controller{

    public function index(){
        $group = M('auth_group');
        $manager = M('manage');
        $access = M('auth_group_access');
        $groupData = $group->where(array('title' => '代理商'))->find();
        $accessData = $access->field('uid')->where(array('group_id' => $groupData['id']))->select();
        $count = count($accessData);
        $accessMap = array();
        foreach($accessData as $k => $v){
            $accessMap[] = $v['uid'];
        }
        $search = I('post.searchText');
        if($search){
            $where['address'] = array('like',"%{$search}%");
            $where['name'] = array('like',"%{$search}%");
            $where['real_name'] = array('like',"%{$search}%");
            $where['mobile'] = array('like',"%{$search}%");
            $where['mail'] = array('like',"%{$search}%");
            $where['_logic'] = 'or';
            $map['_complex'] = $where;
            $this->assign('searchText',$search);
            $managerData = $manager->where($map)->order('total_coin desc')->select();
            $sortStart = 1;
        }else{
            $map['id'] = array('in',$accessMap);
            $per = 10;
            $page=I('post.page')? I('post.page')-1 :0;
            $first = $this->page($count,$map,'page_agent',$per);
            $managerData = $manager->where($map)->limit($first,$per)->order('total_coin desc')->select();
            $sortStart = $per * $page +1;
        }
        foreach($managerData as $k => $v){
            $managerData[$k]['sort'] = $sortStart;
            $sortStart++;
        }
        $this->assign('Agent',$managerData);
        $this->display('index');
    }

    public function getAdvert(){
        if(I('post.id')){
            $advData = M('advert')->where(array('id' => I('post.id')))->find();
            $this->ajaxReturn($advData);
        }
    }

    public function add(){
        $data['name'] = I('post.name');
        $data['address'] = I('post.address');
        $data['mobile'] = I('post.mobile');
        $data['coin'] = I('post.coin');
        $data['create_time'] = date('Y-m-d H:i:s',time());
        $advData = M('advert')->add($data);
        if($advData > 0){
            return $this->index();
        }else{
            return $advData;
        }
    }

    public function update(){
        $data['name'] = I('post.name');
        $data['address'] = I('post.address');
        $data['mobile'] = I('post.mobile');
        $data['coin'] = I('post.coin');
        $advert = M('advert');
        $up = $advert->where(array('id' => I('post.id')))->save($data);
        return $this->index();
    }

    function page($count,$map,$class,$p = 1,$join = ''){
        $total=ceil($count/$p);
        $page=I('post.page')?:1;
        $first=($page-1)*$p;
        $pghtml=PageList($page,$total,$class);
        $this->assign('page',$pghtml);
        return $first;
    }
}