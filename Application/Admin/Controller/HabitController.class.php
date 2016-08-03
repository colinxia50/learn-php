<?php
namespace Admin\Controller;


use Think\Controller;
class HabitController extends Controller {
    public function index(){
        $pay_list = M('pay_article_list');
        $articles = M('articles');
        $child = M('child');
        $map = array();
        $first = $this->page($pay_list,$map,'page_habit',10);
        $pay_list_data = $pay_list->where($map)->order('id desc')->limit($first,10)->select();
        foreach($pay_list_data as $k => $v){
            $articlesData = $articles->where(array('id' => $v['article_id']))->find();
            $pay_list_data[$k]['article'] = $articlesData['title'];
            $childData = $child->where(array('id' => $v['pay_child_id']))->find();
            $pay_list_data[$k]['child'] = $childData['name'];
        }
        $this->assign('HabitData',$pay_list_data);
        $this->display();
    }

    public function lists(){
        $articles = M('articles');
        $map = array();
        $first = $this->page($articles,$map,'page_habit',10);
        $list_data = $articles->where($map)->order('id desc')->limit($first,10)->select();
        
        $this->assign('HabitData',$list_data);
        $this->display();
    }


    public function reMove(){
        if (IS_AJAX){
            $result=D("Articles");
            $id=$result->delete(I('post.id'));
            $this->ajaxReturn($id);
        }
    }

    


    public function getArticle(){
        if (IS_AJAX) {
            $User=D('Articles');
            $this->ajaxReturn($User->getArticle());
        }else{
            $this->error('非法操作');
        }
    }

    public function updateArticle(){
        $User=D('Articles');
        $data = $User->updateArticle();
        if($data < 0){
            return $data;
        }else{
            return $this->index();
        }
    }

    public function addArticle(){
        $User=D('Article');
        $data = $User->addArticle();
        
        if($data < 0){
            return $data;
        }else{
            return $this->index();
        }
    }
    
    
    public function search(){
        echo I('post.name');exit;
        $pay = M('pay_articles');
        $map = array('teacher_id' => session('user_auth.id'));
        $first=$this->setpage($pay,$map,'page_result',1);
        $payData = $pay->where($map)->limit($first,1)->order('id desc')->select();
        if($payData){
            $article = M('articles');
            $child = M('child');
            $class = M('class');
            foreach($payData as $k => $v){
                $articleData = $article->where(array('id' => $v['article_id']))->find();
                $childData = $child->where(array('id' => $v['student_id']))->find();
                $classData = $class->where(array('id' => $v['class_id']))->find();
                $payData[$k]['title'] = $articleData['title'];
                $payData[$k]['student'] = $childData['name'];
                $payData[$k]['class'] = $classData['class_name'];
            }
        }
        $this->assign('Child',$payData);
        $this->display();
    }
    public function addResult(){
        if (IS_AJAX){
            $result=D("Result");
            $id=$result->addResult();
            $this->ajaxReturn($id);
        }
    }


    //查看单人所有成绩
    public function viewList(){
        if (IS_AJAX){
            $result=D("Result");
            $child=D("Child");
            $one=$child->field('name,info')->find(I('post.id'));//学生评价
            $all=$result->viewList();
            $this->assign('Info',$one);
            $this->assign('Result',$all);
            $this->display();
        }
    }
    //修改成绩
    public function edit(){
        if (IS_AJAX){
            $result=D("Result");
            $id=$result->edit();
            $this->ajaxReturn($id);
        }
    }

    //修改评价
    public function editinfo(){
        if (IS_AJAX){
            $child=D('Child');
            $data=array(
                'id'=>I('post.id'),
                'info'=>I('post.info'),
            );
            $id=$child->save($data);
            $this->ajaxReturn($id);
        }
    }

    public function del(){
        if (IS_AJAX){
            $result=D("Result");
            $id=$result->delete(I('post.id'));
            $this->ajaxReturn($id);
        }
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