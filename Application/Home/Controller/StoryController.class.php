<?php
namespace Home\Controller;


class StoryController extends HomeController {
    public function index(){
        if (IS_AJAX){
            $story=D("Story");
            
            $map=array();
                      
            $first=$this->setpage($story,$map,'page_story');
            
            
            $all=$this->farmatt($story
                ->relation(true)
                ->field('id,title,content,dateline')
                ->limit($first,C('PAGE_SIZE'))
                ->order('dateline desc')
                ->select(),'story_img');

            foreach ($all as $key=>$value){
                $all[$key]['content']=mb_substr($all[$key]['content'],0,40,'utf-8').'....';
            }
            $this->assign('Story',$all);
            $this->display();
        }      
    }
    
    public function add(){
        if (IS_AJAX){
            $this->display();
        }
    }
    
    public function addstory(){
        if (IS_AJAX){
            $story=D("Story");
            $gid=$story->addstory();
            if ($gid){
                $images=I('POST.images','',false);
                if (is_array($images)){
                    $Img=D("StoryImg");
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
                $story=D("Story");
                $one=$story->relation(true)->find(I('post.id'));
                foreach ($one['story_img'] as $key=>$value){
                    $one['story_img'][$key]=json_decode($value['data'],true);
                    $one['story_img'][$key]['data']=$value['data'];
                }
                $one['count']=count($one['story_img']);
                $this->assign('Story',$one);
                $this->display();
            }
        }
        //查看
        public function view(){
            if (IS_AJAX){
                $story=D("Story");
                $one=$story->relation(true)->find(I('post.id'));
                foreach ($one['story_img'] as $key=>$value){
                    $one['story_img'][$key]=json_decode($value['data'],true);
                }
                $one['dateline']=date('Y-m-d',$one['dateline']);
                $one['count']=count($one['story_img']);
                $this->assign('Story',$one);
                $this->display();
            }
        }
    
        //修改新闻
        public function update(){
            if (IS_AJAX){
                $images=I('POST.images','',false);
                if (is_array($images)){
                    $Img=D("StoryImg");
                    $map['sid']=array('in',I('post.id'));
                    $Img->where($map)->delete();
                    $id=$Img->addimg($images,I('post.id'));
                }
                $story=D("Story");
                $gid=$story->update();
                if ($gid){
                    $this->ajaxReturn($gid);
                }elseif ($id){
                    $this->ajaxReturn($id);
                }
            }
        }
        public function delete(){
            if (IS_AJAX){
                $story=D("Story");
                $id=$story->relation(true)->delete(I('post.id'));
                $this->ajaxReturn($id);
            }
        }


}