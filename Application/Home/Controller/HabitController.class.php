<?php
namespace Home\Controller;


use Org\Util\Tool;
class HabitController extends HomeController {
    public function index(){

        if (IS_AJAX){
            $pay = M('pay_articles');
            $pay_list = M('pay_article_list');
            if(I('post.name')){
                $condition = I('post.name');
                $con['articles.title'] = array('like',"%{$condition}%");//[['like',["%{$condition}%"]],'OR'];
                $con['child.name'] =  array('like',"%{$condition}%");//[['like',["%{$condition}%"]],'OR'];
                $con['class.class_name'] = array('like',"%{$condition}%");// [['like',["%{$condition}%"]],'OR'];
                $con['_logic'] = 'or';
                $map['_complex'] = $con;
                //如果是老师，只显示老师的数据
                if(isTeacher()){
                    $map['pay_articles.teacher_id'] = session('user_auth.id');
                }
                //如果是管理员，只显示本园内通过的数据
                if(isAdmin()){
                    $map['pay_articles.is_pass'] = 1;
                    $map['pay_articles.school_id'] = session('user_auth.school_id');
                }
                $map['_logic'] = 'and';
                $join =array(
                    'articles on articles.id = pay_articles.article_id',
                    'child on child.id = pay_articles.student_id',
                    'class on class.id = pay_articles.class_id',
                );
                $first=$this->setpage($pay,$map,'page_habit',1,$join);
                $payData = $pay->join('articles on articles.id = pay_articles.article_id')
                    ->join('child on child.id = pay_articles.student_id')
                    ->join('class on class.id = pay_articles.class_id')
                    ->where($map)
                    ->limit($first,1)
                    ->order('pay_articles.id desc')
                    ->select();
                if($payData){
                    foreach($payData as $k => $v){
                        $payData[$k]['student'] = $v['name'];
                        $payData[$k]['class'] = $v['class_name'];
                        $payList= $pay_list->where(array('article_id' => $v['article_id']))->order('id asc')->select();
                        if($payList){
                            $user = M('user');
                            foreach($payList as $key => $value){
                                $userData = $user->where(array('id' => $value['user_id']))->find();
                                $payList[$key]['user_name'] = $userData['user'];
                            }
                        }
                        $payData[$k]['pay_list'] = $payList;
                        $payData[$k]['pay_num'] = $pay_list->where(array('article_id' => $v['article_id']))->count();
                    }
                }
                $this->assign('search_name',$condition);
            }else{
                //如果是老师，只显示老师的数据
                if(isTeacher()){
                    $map = array('teacher_id' => session('user_auth.id'));
                }
                //如果是管理员，只显示通过的数据
                if(isAdmin()){
                    $map['is_pass'] = 1;
                    $map['school_id'] = session('user_auth.school_id');
                }
                $first=$this->setpage($pay,$map,'page_habit',1);
                $payData = $pay->where($map)->limit($first,1)->order('id desc')->select();
                if($payData){
                    $article = M('articles');
                    $child = M('child');
                    $class = M('class');
                    foreach($payData as $k => $v){
                        $articleData = $article->where(array('id' => $v['article_id']))->find();
                        $childData = $child->where(array('id' => $v['student_id']))->find();
                        $classData = $class->where(array('id' => $v['class_id']))->find();
                        $payList= $pay_list->where(array('article_id' => $v['article_id']))->order('id asc')->select();
                        if($payList){
                            $user = M('user');
                            foreach($payList as $key => $value){
                                $userData = $user->where(array('id' => $value['user_id']))->find();
                                $payList[$key]['user_name'] = $userData['user'];
                            }
                        }
                        $payData[$k]['pay_list'] = $payList;
                        $payData[$k]['pay_num'] = $pay_list->where(array('article_id' => $v['article_id']))->count();
                        $payData[$k]['title'] = $articleData['title'];
                        $payData[$k]['student'] = $childData['name'];
                        $payData[$k]['class'] = $classData['class_name'];
                        $payData[$k]['see_num'] = $articleData['see_num'];
                    }
                }
            }
            $this->assign('Child',$payData);
            $this->display();
        }

    }



    public function search(){
        echo I('post.name');exit;
        $pay = M('pay_articles');
        //如果是老师，显示班内数据，如果是园长，显示院内所有通过数据数据
        if(isTeacher()){
            $map = array('teacher_id' => session('user_auth.id'));
        }elseif(isAdmin()){
            $map = array('school_id' => session('user_auth.school_id'),'is_pass' => 1);
        }

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

}