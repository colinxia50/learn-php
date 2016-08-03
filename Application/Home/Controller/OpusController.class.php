<?php
namespace Home\Controller;


class OpusController extends HomeController {
    public function index(){
            $class=D("Class");
            $all=$class->getClass();
            $this->assign('Class',$all);            
            $opus=D("Opus");
            $map=array();
            $first=$this->setpage($opus,$map,'page_opus');
            $all=$this->farmatt(
                $opus
                ->relation(true)
                ->where($map)
                ->limit($first,C('PAGE_SIZE'))
                ->order('dateline desc')
                ->select(),'opus_img');
            

            
            $this->assign('Opus',$all);                      
            $this->display();

    }
    
    public function add(){
        if (IS_AJAX){
            $class=D("Class");
            $all=$class->getClass();
            $this->assign('Class',$all);
            $this->display();
        }
    }
    
    public function addopus(){
            if (IS_AJAX){
            $opus=D("Opus");
            $gid=$opus->addopus();
            if ($gid){
                $images=I('POST.images','',false);
                if (is_array($images)){
                    $Img=D("OpusImg");
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
            $opus=D("Opus");
            $one=$opus->relation(true)->find(I('post.id'));
            foreach ($one['opus_img'] as $key=>$value){
                $one['opus_img'][$key]=json_decode($value['data'],true);
                $one['opus_img'][$key]['data']=$value['data'];
            }
            $one['count']=count($one['opus_img']);
            $this->assign('Opus',$one);
            $this->display();
        }
    }
    //查看
    public function view(){
        if (IS_AJAX){
            $opus=D("Opus");
            $one=$opus->relation(true)->find(I('post.id'));
            foreach ($one['opus_img'] as $key=>$value){
                $one['opus_img'][$key]=json_decode($value['data'],true);
            }
            $one['dateline']=date('Y-m-d',$one['dateline']);
            $one['count']=count($one['story_img']);
            $this->assign('Opus',$one);
            $this->display();
        }
    }   
    
    //修改作品
    public function update(){
        if (IS_AJAX){
            $images=I('POST.images','',false);
            if (is_array($images)){
                $Img=D("OpusImg");
                $map['oid']=array('in',I('post.id'));
                $Img->where($map)->delete();
                $id=$Img->addimg($images,I('post.id'));
            }
            $opus=D("Opus");
            $gid=$opus->update();
            if ($gid){
                $this->ajaxReturn($gid);
            }elseif ($id){
                $this->ajaxReturn($id);
            }
        }
    }
    
    public function delete(){
        if (IS_AJAX){
            $opus=D("Opus");
            $id=$opus->relation(true)->delete(I('post.id'));
            $this->ajaxReturn($id);
        }
    }   

}