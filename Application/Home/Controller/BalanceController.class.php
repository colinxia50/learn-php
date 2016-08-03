<?php
namespace Home\Controller;


use Org\Util\Tool;
class BalanceController extends HomeController {
    public function index(){
        if (IS_AJAX){
            $balance = M('balance_info');
            $map = array('user_id' => session('user_auth.id'),'type' => 2);
            $first=$this->setpage($balance,$map,'page_balance',1);
            $balanceData = $balance->where($map)->limit($first,1)->order('id desc')->select();
            $presentBalance = $balance->where(array('user_id' => session('user_auth.id')))->order('id desc')->find();
            if($presentBalance){
                $presentBalance = $presentBalance['total_coin'];
            }else{
                $presentBalance = 0;
            }
            $this->assign('Balance',$presentBalance);
            $this->assign('Child',$balanceData);
            $this->display();
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

}