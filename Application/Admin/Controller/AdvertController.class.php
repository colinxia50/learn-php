<?php
namespace Admin\Controller;

use Think\Controller;

class AdvertController extends Controller{

    public function index(){
        $advert = M('advert');
        $map = array();
        $search = I('post.searchText');
        if($search){
            $map['name'] = array('like',"%{$search}%");
            $map['address'] = array('like',"%{$search}%");
            $map['mobile'] = array('like',"%{$search}%");
            $map['_logic'] = 'or';
            $this->assign('searchText',$search);
        }
        $first = $this->page($advert,$map,'page_advert',10);
        $advertData = $advert->where($map)->limit($first,10)->select();
        $list=array();
        $l=array();
        if($advertData){
        	foreach ($advertData as $a){
        		 $manage=D('manage')->where(array('id'=>$a['agent_id']))->find();
        		 $a['managename']=$manage['name']?$manage['name']:'----';
        		 $list[]=$a;
        		 
        	}
        	
        }
        
        $this->assign('Advert',$list);
        $this->assign('agent',session('admin.name'));
        $this->display('index');
    }

    public function getAdvert(){
        if(I('post.id')){
            $advData = M('advert')->where(array('id' => I('post.id')))->find();
            $this->ajaxReturn($advData);
        }
    }

    public function add(){
        if(!I('post.agent_id')){
            return false;
        }
        $data['agent_id'] = session('admin.id');
        $data['name'] = I('post.name');
        $data['address'] = I('post.address');
        $data['mobile'] = I('post.mobile');
        $data['coin'] = I('post.coin');
        $data['income'] = I('post.income');
        $data['status'] = I('post.status');
        $data['create_time'] = date('Y-m-d H:i:s',time());
        $advData = M('advert')->add($data);
        //添加代理商提成
        $agentData = M('manage')->where(array('id' => $data['agent_id']))->find();
        M('manage')
            ->where(array('id' => $data['agent_id']))
            ->save(array(
            'adv_coin' => $agentData['adv_coin'] + (ceil($data['coin'] * $agentData['rate'] / 100)),
            'total_coin' => $agentData['total_coin'] + (ceil($data['coin'] * $agentData['rate'] / 100)),
            
            ));

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