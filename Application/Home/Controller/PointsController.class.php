<?php
namespace Home\Controller;


class pointsController extends HomeController {
    public function index(){
        if ($this->login()){

            $map['school_id']=session('user_auth.school_id');
            $infos=D("Infos");
            
            $first=$this->setpage($infos,$map,'page_infos');

            $infosList=$this->farmatt($infos
                    ->relation(true)
                    ->field('id,title,content,dateline')
                    ->where($map)
                    ->order('dateline desc')
                    ->limit($first,C('PAGE_SIZE'))
                    ->select(),'infos_img');
            $this->assign('Infos',$infosList);           
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