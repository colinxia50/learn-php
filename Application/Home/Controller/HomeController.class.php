<?php
namespace Home\Controller;
use Think\Controller;

class HomeController extends Controller {
	
	//构造方法
	protected function _initialize() {
		
	}
	
	//通过Aajx轮询执行方法
	public function getRefer() {
		if (IS_AJAX) {
		    $arr=explode(',',I('post.ids'));
		    foreach ($arr as $value){
		        if (S($value)){
		            $i=S($value);
		            S($value,$i+1);
		        }else{
		            S($value,1);
		        }
		    }
		} else {
			$this->error('非法操作！');
		}
	}
	
	//检测用户登录状态
	protected function login() {
	   
		//处理自动登录，当cookie存在，且session不存在的情况下，生成session
		if (!is_null(cookie('auto')) && !session('?user_auth')) {
			$value = explode('|', encryption(cookie('auto'), 1));
			list($username, $ip) = $value;
			if ($ip == get_client_ip()) {
				$map['user'] = $username;
				$User = D('User');
				$userObj = $User->field('id,user,cover,nick_name,group_id,class_id,school_id,one')->where($map)->find();



				//自动登录验证后写入登录信息
				$update = array(
						'id'=>$userObj['id'],
						'last_login'=>NOW_TIME,
						//'last_ip'=>get_client_ip(1),
				);
				$User->save($update);
				
				//将记录写入到cookie和session中去
				$auth = array(
				    'id'=>$userObj['id'],
				    'name'=>$userObj['nick_name'],
				    'user'=>$userObj['user'],
				    'group_id'=>$userObj['group_id'],
				    'class_id'=>$userObj['class_id'],
				    'school_id'=>$userObj['school_id'],
				    'one'=>$userObj['one'],
				    'face'=>json_decode($userObj['cover']),
				    'last_login'=>NOW_TIME,

				);
				$studentData = M('child')->where(array('uid' => $userObj['id']))->find();
				session('class_id', $studentData['id']);
				//写入到session
				session('user_auth', $auth);


			}
		}
		
		
		//检测session是否存在
		if (session('?user_auth')) {
			return 1;
		} else {
			$this->redirect('Login/index');
		}
	}


	public function _oauth(){
//		$s_menu = array(array("title"=>"宝宝动态","u"=>"/growing/index","href"=>"javascript:void(0)",aclass=>"glyphicon glyphicon-home"),
//		    array("title" => "幼儿知识","u"=>"/story/index", "href"=>"javascript:void(0)", aclass => "glyphicon glyphicon-picture"),
//		    array("title" => "宝宝作品","u"=>"/opus/index", "href"=>"javascript:void(0)", aclass => "glyphicon glyphicon-send"),
//		    array("title" => "互动留言","u"=>"/message/index", "href"=>"javascript:void(0)", aclass => "glyphicon glyphicon-pencil"),
//		    array("title" => "校园新闻","u"=>"/infos/index", "href"=>"javascript:void(0)", aclass => "glyphicon glyphicon-envelope"),
//		    array("title" => "成绩查询","u"=>"/result/index", "href"=>"javascript:void(0)", aclass => "glyphicon glyphicon-education"),
//		    array("title"=>"个人设置","u"=>"/account/index","href"=>"javascript:void(0)",aclass=>"glyphicon glyphicon-cog"),
//			array("title"=>"求知展示","u"=>"/show/index","href"=>"javascript:void(0)",aclass=>"glyphicon glyphicon-cog"),
//		);//家长
		$s_menu = array(
			array("title"=>"我的文章","u"=>"/articles/index","href"=>"javascript:void(0)",aclass=>"glyphicon glyphicon-home"),
			array("title" => "习惯库","u"=>"/habit/index", "href"=>"javascript:void(0)", aclass => "glyphicon glyphicon-education"),
			array("title" => "我的能量币","u"=>"/coin/index", "href"=>"javascript:void(0)", aclass => "glyphicon glyphicon-education"),
			array("title" => "提领记录","u"=>"/balance/index", "href"=>"javascript:void(0)", aclass => "glyphicon glyphicon-education"),
			array("title" => "我的同学","u"=>"/student/index", "href"=>"javascript:void(0)", aclass => "glyphicon glyphicon-wrench"),
			array("title" => "校园新闻","u"=>"/infos/index", "href"=>"javascript:void(0)", aclass => "glyphicon glyphicon-envelope"),
			array("title" => "我的积分","u"=>"/myPoints/index", "href"=>"javascript:void(0)", aclass => "glyphicon glyphicon-envelope"),
			array("title"=>"个人设置","u"=>"/account/index","href"=>"javascript:void(0)",aclass=>"glyphicon glyphicon-cog"),
		);//家长
		$t_menu = array(
			array("title"=>"我要发稿","u"=>"/articles/index","href"=>"javascript:void(0)",aclass=>"glyphicon glyphicon-home"),
			array("title" => "习惯稿件","u"=>"/articles/pass", "href"=>"javascript:void(0)", aclass => "glyphicon glyphicon-envelope"),
			array("title" => "缴费列表","u"=>"/pay/index", "href"=>"javascript:void(0)", aclass => "glyphicon glyphicon-education"),
			array("title" => "习惯库","u"=>"/habit/index", "href"=>"javascript:void(0)", aclass => "glyphicon glyphicon-education"),
			array("title" => "我的能量币","u"=>"/coin/index", "href"=>"javascript:void(0)", aclass => "glyphicon glyphicon-education"),
			array("title" => "提领记录","u"=>"/balance/index", "href"=>"javascript:void(0)", aclass => "glyphicon glyphicon-education"),
			array("title" => "我的学生","u"=>"/student/index", "href"=>"javascript:void(0)", aclass => "glyphicon glyphicon-wrench"),
			array("title" => "校园新闻","u"=>"/infos/index", "href"=>"javascript:void(0)", aclass => "glyphicon glyphicon-envelope"),
			array("title" => "我的积分","u"=>"/myPoints/index", "href"=>"javascript:void(0)", aclass => "glyphicon glyphicon-envelope"),
				
			array("title"=>"个人设置","u"=>"/account/index","href"=>"javascript:void(0)",aclass=>"glyphicon glyphicon-cog"),
//			array("title" => "校园设置","u"=>"/manage/index", "href"=>"javascript:void(0)", aclass => "glyphicon glyphicon-wrench"),
//			array("title"=>"校园动态","u"=>"/growing/index","href"=>"javascript:void(0)",aclass=>"glyphicon glyphicon-home"),
//		    array("title" => "幼儿知识","u"=>"/story/index", "href"=>"javascript:void(0)", aclass => "glyphicon glyphicon-picture"),
//		    array("title" => "宝宝作品","u"=>"/opus/index", "href"=>"javascript:void(0)", aclass => "glyphicon glyphicon-send"),
//		    array("title" => "互动留言","u"=>"/message/index", "href"=>"javascript:void(0)", aclass => "glyphicon glyphicon-pencil"),
//		    array("title" => "成绩查询","u"=>"/result/index", "href"=>"javascript:void(0)", aclass => "glyphicon glyphicon-education"),
//		    array("title"=>"个人设置","u"=>"/account/index","href"=>"javascript:void(0)",aclass=>"glyphicon glyphicon-cog"),
//			array("title"=>"求知展示","u"=>"/show/index","href"=>"javascript:void(0)",aclass=>"glyphicon glyphicon-cog"),
//			array("title" => "积分兑换","u"=>"/points/index", "href"=>"javascript:void(0)", aclass => "glyphicon glyphicon-gift"),
//			array("title"=>"个人设置","u"=>"/account/index","href"=>"javascript:void(0)",aclass=>"glyphicon glyphicon-cog"),
//			array("title"=>"求知展示","u"=>"/show/index","href"=>"javascript:void(0)",aclass=>"glyphicon glyphicon-cog"),
		);//老师
//		$y_menu = array(array("title"=>"宝宝动态","u"=>"/growing/index","href"=>"javascript:void(0)",aclass=>"glyphicon glyphicon-home"),
//		    array("title" => "幼儿知识","u"=>"/story/index", "href"=>"javascript:void(0)", aclass => "glyphicon glyphicon-picture"),
//		    array("title" => "宝宝作品","u"=>"/opus/index", "href"=>"javascript:void(0)", aclass => "glyphicon glyphicon-send"),
//		    array("title" => "互动留言","u"=>"/message/index", "href"=>"javascript:void(0)", aclass => "glyphicon glyphicon-pencil"),
//		    array("title" => "校园新闻","u"=>"/infos/index", "href"=>"javascript:void(0)", aclass => "glyphicon glyphicon-envelope"),
//		    array("title" => "成绩查询","u"=>"/result/index", "href"=>"javascript:void(0)", aclass => "glyphicon glyphicon-education"),
//		    array("title" => "积分兑换","u"=>"/points/index", "href"=>"javascript:void(0)", aclass => "glyphicon glyphicon-gift"),
//		    array("title" => "校园设置","u"=>"/manage/index", "href"=>"javascript:void(0)", aclass => "glyphicon glyphicon-wrench"),
//		    array("title"=>"个人设置","u"=>"/account/index","href"=>"javascript:void(0)",aclass=>"glyphicon glyphicon-cog"),
//			array("title"=>"求知展示","u"=>"/show/index","href"=>"javascript:void(0)",aclass=>"glyphicon glyphicon-cog"),
//		);//园长
		$y_menu = array(
			array("title"=>"已发文章","u"=>"/articles/index","href"=>"javascript:void(0)",aclass=>"glyphicon glyphicon-home"),
			array("title" => "已通过文章","u"=>"/articles/pass", "href"=>"javascript:void(0)", aclass => "glyphicon glyphicon-envelope"),
			array("title" => "习惯库","u"=>"/habit/index", "href"=>"javascript:void(0)", aclass => "glyphicon glyphicon-education"),
			array("title" => "能量币","u"=>"/balance/index", "href"=>"javascript:void(0)", aclass => "glyphicon glyphicon-education"),
			array("title" => "校园设置","u"=>"/manage/index", "href"=>"javascript:void(0)", aclass => "glyphicon glyphicon-wrench"),
			array("title" => "校园新闻","u"=>"/infos/index", "href"=>"javascript:void(0)", aclass => "glyphicon glyphicon-envelope"),
			array("title" => "积分管理（预留）","u"=>"/infos/index", "href"=>"javascript:void(0)", aclass => "glyphicon glyphicon-envelope"),
			array("title"=>"个人设置","u"=>"/account/index","href"=>"javascript:void(0)",aclass=>"glyphicon glyphicon-cog"),
		);//园长
		$memus =array();
		switch (session("user_auth.group_id"))
		{
		    case "4":
		        $memus = $s_menu;break;     //家长
		    case "3":
		        $memus = $t_menu;break;    //老师
		    case "2":
		        $memus = $y_menu;break;     //园长
		    default:
		        $memus = "";
		        	
		}
		$defaultRoute = $memus[0]['u'];
		if($memus)
		{
			
			foreach ($memus as $memu)
			{				
				$memus_html .=sprintf('<li><a u="%s" href="%s"><span class="%s"></span> %s </a></li>',$memu['u'],$memu['href'],$memu['aclass'],$memu['title']);
			}
		}
		$this->assign('defaultRoute',$defaultRoute);
		$user=session('user_auth');
        $this->assign('smallFace',$user['face']->small);
        $this->assign('bigFace',$user['face']->big);
		$this->assign("menus",$memus_html);
	}
	
	
	protected function nodata(){
	    $this->assign('empty','<div class="empty" style="color:red;text-align:center;">没有数据...</div>');	     
	}
	
	
	protected function setpage($infos,$map,$class,$p = 1,$join = ''){
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
	
	//格式化配图
	 protected  function farmatt($list,$table){
	    foreach ($list as $key=>$value){
	        if (!is_null($value[$table])){
	            foreach ($value[$table] as $k=>$v){
	                $value[$table][$k]=json_decode($v['data'],true);
	            }
	        }
	        $list[$key]=$value;
	        $time=NOW_TIME-$list[$key]['dateline'];
	        if ($time < 60) {
	            $list[$key]['time'] = '刚刚发布';
	        } else if ($time < 60 * 60) {
	            $list[$key]['time'] = floor($time / 60).'分钟之前';
	        } else if (date('Y-m-d') == date('Y-m-d', $list[$key]['dateline'])) {
	            $list[$key]['time'] = '今天'.date('H:i', $list[$key]['dateline']);
	        } else if (date("Y-m-d",strtotime("-1 day")) == date('Y-m-d',$list[$key]['dateline'])) {
	            $list[$key]['time'] = '昨天'.date('H:i', $list[$key]['dateline']);
	        } else if (date('Y') == date('Y', $list[$key]['create'])) {
	            $list[$key]['time'] = date('m月d日 H:i', $list[$key]['dateline']);
	        } else {
	            $list[$key]['time'] = date('Y年m月d日 H:i', $list[$key]['dateline']);
	        }
	         
	    }
	    return $list;
	}
}