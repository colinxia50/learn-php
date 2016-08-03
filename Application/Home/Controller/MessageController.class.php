<?php
namespace Home\Controller;


class MessageController extends HomeController {
    public function index(){
        if (IS_AJAX){
            $class=D("Class");
            $allClass=$class->getClass();
            $this->assign("Class",$allClass);
            $this->display();
        }      
    }
    
    public function  addMessage(){
        if (IS_AJAX){
            $message=D("Message");
            $this->getRefer();
            $id=$message->addMessage();
            $this->ajaxReturn($id);
        }
    }
    
    public function getMessage(){
        if (IS_AJAX){
            $message=D("Message");
            S(session('user_auth.id'),null);//当用户点击查看留言的时候清空缓存里面的未读留言条数
            $map['cid']=session('user_auth.id');
            $allMessage=$message
            ->relation(true)
            ->where($map)
            ->order('dateline desc')
            ->select();
            
            $count=count($allMessage);
            
            foreach ($allMessage as $key=>$value){
                $allMessage[$key]['face']=json_decode($value['cover'],true);
                $allMessage[$key]['count']=$count;
                $count--;
            }
            $this->assign('count',count($allMessage));
            $this->assign('Message',$this->farmatt($allMessage));
            $this->display();
        }
    }
    
    public function setMessage(){
        if (IS_AJAX){
            $message=D("Message");
            $uid=session('user_auth.id');
            $allMessage=$message
                        ->table('__MESSAGE__ a, __USER__ b')
                        ->field('a.id,a.uid,a.cid,a.content,a.dateline,b.nick_name,b.cover')
                        ->where("a.cid=b.id AND a.uid=$uid")
                        ->order('dateline desc')
                        ->select();
            $count=count($allMessage);
            
            foreach ($allMessage as $key=>$value){
                $allMessage[$key]['face']=json_decode($value['cover'],true);
                $allMessage[$key]['count']=$count;
                $count--;
            }
            $this->assign('count',count($allMessage));
            $this->assign('Message',$this->farmatt($allMessage));
            $this->display();
        }
    }
    //格式化配图
    public  function farmatt($list){
        foreach ($list as $key=>$value){
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