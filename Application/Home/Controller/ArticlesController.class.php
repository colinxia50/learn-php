<?php
namespace Home\Controller;


class ArticlesController extends HomeController {
    public function index(){
        $articleModel = M('articles');
        //如果是老师，显示自己已发的，如果是园长，显示学校的
        if(isTeacher()){
            $map = array('teacher_id' => session('user_auth.id'));
        }elseif(isAdmin()){
            $map = array('school_id' => session('user_auth.school_id'));
        }elseif(isStudent()){
            $map = array('student_id' => session('student_id'),'is_pass' => 1);
        }
        $first=$this->setpage($articleModel,$map,'page_opus',C('PAGE_SIZE'));
        $articleData = $articleModel->where($map)->limit($first,C('PAGE_SIZE'))->order('id desc')->select();
        foreach($articleData as $k => $v){
            $name = M('child')->where(array('id' => $v['student_id']))->find();
            $articleData[$k]['name'] = $name['name'];
            $articleData[$k]['opus_img'] = json_decode($v['img'],true);
        }
        $this->assign('data',$articleData);
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

    public function addarticle(){
        if (IS_AJAX){
            $img = $_POST['images'];
            if($img){
                $imgData = array();
                foreach($img as $k => $v){
                    $imgData[] = json_decode($v,true);
                }
                $img = json_encode($imgData);
            }else{
                $img = '';
            }
            $dataArr = array(
                'title' => I('post.title'),
                'content' => I('post.content'),
                'img' => $img,
                'teacher_id' => session('user_auth.id'),
                'student_id' => I('post.cid'),
                'school_id' => session('user_auth.school_id'),
                'class_id' => session('user_auth.class_id'),
                'create_time' => date('Y-m-d H:i:s',time()),
                'is_pass' => 0,
            );
            $articles = M('Articles')->add($dataArr);
            if($articles){
                $this->ajaxReturn($articles);
            }else{
                return $articles->getError();
            }
        }
    }

    //取得修改列表
    public function edit(){
        if (IS_AJAX){
            $articleModel = M('articles');
            $articleData = $articleModel->where(array('id' => I('post.id')))->find();
            $classData = M('class')->where(array('id' => $articleData['class_id']))->find();
            $studentData = M('child')->where(array('id' => $articleData['student_id']))->find();
            $articleData['class_name'] = $classData['class_name'];
            $articleData['student_name'] = $studentData['name'];
            $articleData['img'] = json_decode($articleData['img'],true);
            foreach($articleData['img'] as $k => $v){
                $articleData['img'][$k]['json'] = json_encode($v);
            }
            $this->assign('Opus',$articleData);
            $this->display();
        }
    }
    //查看
    public function view(){
        if (IS_AJAX){
            $articleData = M('articles')->where(array('id' => I('post.id')))->find();
            $articleData['img'] = json_decode($articleData['img'],true);
            $articleData['count'] = $articleData['img'];
            $teacherData = M('user')->where(array('id' => $articleData['teacher_id']))->find();
            $articleData['name'] = $teacherData['nick_name'];
            //观看次数
            M('articles')->where(array('id' => I('post.id')))->save(array('see_num' => $articleData['see_num']+1));
            $this->assign('Opus',$articleData);
            $this->display();
        }
    }

    //修改作品
    public function update(){
        if (IS_AJAX){
            $img = $_POST['images'];
            if($img){
                $imgData = array();
                foreach($img as $k => $v){
                    $imgData[] = json_decode($v,true);
                }
                $img = json_encode($imgData);
            }else{
                $img = '';
            }
            $dataArr = array(
                'title' => I('post.title'),
                'content' => I('post.content'),
                'img' => $img,
                //'teacher_id' => session('user_auth.id'),
                'student_id' => I('post.cid'),
                'school_id' => session('user_auth.school_id'),
                'class_id' => session('user_auth.class_id'),
                'create_time' => date('Y-m-d H:i:s',time()),
                'is_pass' => 0,
            );
            $articles = M('Articles')->where(array('id' => I('post.id')))->save($dataArr);
           $this->ajaxReturn($articles);
        }
    }

    public function delete(){
        if (IS_AJAX){
            $articles = M('articles')->delete(I('post.id'));
            $this->ajaxReturn($articles);
        }
    }

    public function pass(){
        if(IS_AJAX){
            $article = M('articles');
            $child = M('child');
            //如果是老师，则显示老师的数据，如果是园长，显示园内所有通过数据
            if(isAdmin()){
                $map = array('school_id' => session('user_auth.school_id'));
                $map = array('is_pass' => 1);
            }else if(isTeacher()){
                $map = array('teacher_id' => session('user_auth.id'));
            }
            $first=$this->setpage($article,$map,'page_infos',10);
            $article = $article->where($map)->limit($first,10)->order('id desc')->select();
            foreach($article as $k => $v){
                $studentData = $child->where(array('id' => $v['student_id']))->find();
                $article[$k]['student'] = $studentData['name'];
                $article[$k]['img'] = json_decode($article[$k]['img'],true);
                $article[$k]['content'] = mb_substr($v['content'],0,15,'utf-8').'...';
                switch($v['is_pass']){
                    case 0:
                        $pass_status = '待审核';
                        $color = 'grey';
                        break;
                    case 1:
                        $pass_status = '审核通过';
                        $color = 'green';
                        break;
                    case 2:
                        $pass_status = '未通过审核';
                        $color = 'red';
                        break;
                }
                $article[$k]['pass_status'] = "<span style='color:{$color}' class=\"tt\">{$pass_status}</span>";
            }
            $this->assign('Infos',$article);
            $this->display();
        }
    }
}