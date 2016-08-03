<?php
namespace Home\Controller;


use Think\Page;
class MyPointsController extends HomeController {
    public function index(){
        if ($this->login()){
            $map['user_id']=session('user_auth.id');
            $infos=D("score_record");
            import('ORG.Util.Page');
            $count=M('score_record')->where($map)->count();
            $page=new Page($count,20);
            
            $limit=$page->firstRow.','.$page->listRows;
            $infosList=$infos->where($map)->select();
            $list=array();
            foreach ($infosList as $info){
            	$info['time']=date("Y-m-d H:i:s",$info['daytime']);
            	$list[]=$info;
            }
            $this->assign('record',$list);       
            $this->assign('page',$page->show());       
            $this->nodata();
            $this->display();
        }
       
    }
    
    
    
    
    public function addlist(){
        if (IS_AJAX){
         $this->display();
        }
    }
    
    public function addinfos(){
        if (IS_AJAX){
            $infos=D("Infos");
            $gid=$infos->addinfos();
            if ($gid){
                $images=I('POST.images','',false);
                if (is_array($images)){
                    $Img=D("InfosImg");
                    $iid=$Img->addimg($images,$gid);
                    echo $iid?$gid:0;
                }else{
                    echo $gid;
                }
            }
        }
    }
    
    //取得修改列表
    public function edit(){
        if (IS_AJAX){
            $infos=D("Infos");
            $one=$infos->relation(true)->find(I('post.id'));
            foreach ($one['infos_img'] as $key=>$value){
               $one['infos_img'][$key]=json_decode($value['data'],true);
               $one['infos_img'][$key]['data']=$value['data'];
            }
            $one['count']=count($one['infos_img']);
            $this->assign('Infos',$one);
            $this->display();
        }
    }
    //修改新闻
    public function update(){
        if (IS_AJAX){
            $images=I('POST.images','',false);
            if (is_array($images)){
                $Img=D("InfosImg");
                $map['iid']=array('in',I('post.id'));
                $Img->where($map)->delete();
                $id=$Img->addimg($images,I('post.id'));             
            }        
            $infos=D("Infos");
            $gid=$infos->update();
            if ($gid){
                $this->ajaxReturn($gid);
            }elseif ($id){
                $this->ajaxReturn($id);
            }
        }
    }
    public function delete(){
        if (IS_AJAX){
            $infos=D("Infos");
            $id=$infos->relation(true)->delete(I('post.id'));
            $this->ajaxReturn($id);
        }
    }
    

}