<?php
namespace Home\Controller;


class GrowingController extends HomeController {
    public function index(){
        if ($this->login()){
        	$class=D("Class");
        	$all=$class->getClass();       	
        	$growing=D("Growing");
            $growingList=$growing->getlist(0,10);
            $user=session('user_auth');
            $this->assign('bigFace',$user['face']->big); //大头像
            $this->assign('smallFace',$user['face']->small);//小头像
            
        	$this->assign('Growing',$growingList);
        	$this->assign('Class',$all);
            $this->display();
        }
       
    }
    
    //ajax获取列表
    public function ajaxList(){
        if (IS_AJAX){
        $growing=D("Growing");
        $ajaxList=$growing->getlist(I('post.first'),10);
        $this->assign('ajaxList',$ajaxList);
        $this->display();
        }
    }
    //ajax获取总页码
    public function ajaxCount(){
        if (IS_AJAX){
            $growing=D("Growing");
            $count=$growing->where('1=1')->count();
            echo ceil($count/10);
        }
    }
    public function addgrowing(){
    	if (IS_AJAX) {   		
    		$growing=D("Growing");
    		$gid=$growing->addgrowing(I('post.info'),I('post.cid'));
    		if ($gid){
    		       $images=I('POST.images','',false);
    		        if (is_array($images)){
    		         	$Img=D("Img");
    		        	$iid=$Img->addimg($images,$gid);
    		        	 echo $iid?$gid:0;
    		         }else{
    		             echo $gid;
    		         }   		    
    		}  		
    	}
    }
}