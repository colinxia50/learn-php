<?php
namespace Home\Controller;
use Org\Util\Tool;
class StudentController extends HomeController {

    public function index(){
        if (IS_AJAX){
            $student = M('child');
            $teacher = M('teacher');
            $class = M('class');
            if(isTeacher()){
                $teacherData = $teacher->where(array('uid' => session('user_auth.id')))->find();

                $classData = $class->where(array('id' => $teacherData['class_id']))->find();
            }elseif(isStudent()){
                $person = M('child')->where(array('id' => session('student_id')))->find();
                $teacherData = $teacher->where(array('id' => $person['teacher_id']))->find();
                $classData = $class->where(array('school_id' => $person['school_id']))->find();
                var_dump($classData);exit;
            }



            if(I('post.name')){
                $condition = I('post.name');
                $con['user.user'] = array('like',"%{$condition}%");//[['like',["%{$condition}%"]],'OR'];
                $con['user.mobile'] =array('like',"%{$condition}%");// [['like',["%{$condition}%"]],'OR'];
                $con['child.name'] = array('like',"%{$condition}%");//[['like',["%{$condition}%"]],'OR'];
                $con['_logic'] = 'or';
                $map['_complex'] = $con;
                $map['child.class_id'] = $teacherData['class_id'];
                $map['_logic'] = 'and';
                $join = array(
                    'user on user.id = child.uid',
                );
                $first=$this->setpage($student,$map,'page_student',1,$join);
                $studentData = $student->join('user on user.id = child.uid')
                    ->where($map)
                    ->limit($first,1)
                    ->order('child.coin desc')
                    ->field('user.mobile mobile,user.user user,child.name name,child.sex sex,child.id id,child.coin coin')
                    ->select();
                if($studentData){
                    foreach($studentData as $k => $v){
                        $studentData[$k]['class_name'] = $classData['class_name'];
                    }
                }
                $this->assign('search_name',$condition);
            }else{
                $map = array('class_id' => $teacherData['class_id']);

                $first=$this->setpage($student,$map,'page_student',1);
                $studentData = $student->where($map)->limit($first,1)->order('coin desc')->select();
                if($studentData){
                    $user = M('user');
                    foreach($studentData as $k => $v){
                       $userData = $user->where(array('id' => $v['uid']))->find();
                       $studentData[$k]['class_name'] = $classData['class_name'];
                       $studentData[$k]['user'] = $userData['user'];
                       $studentData[$k]['mobile'] = $userData['mobile'];
                    }
                }
            }
            $this->assign('Child',$studentData);
            $this->display();
        }
    }

    public function getone(){
        if (IS_AJAX) {
            $User=M("User");
            $child=M("Child");
            $map['id']=I('post.id');
            $oneChild=$child->where($map)->field('uid,card')->find();
            $m['id']=$oneChild['uid'];
            $one=$User->where($m)->field('id,nick_name,email,mobile,rule1_name,rule2_name,sex,birthday,class_id')->find();
            $one['birthday']=date('Y-m-d',$one['birthday']);
            $one['card']=$oneChild['card'];
            $this->ajaxReturn($one);
        }
    }
    public function addChild(){
        if (IS_AJAX){
            $child=D("Child");
            $id=$child->addChild();
            $this->ajaxReturn($id);
        }
    }

    public function update(){
        if (IS_AJAX) {
            $child=D("Child");
            $id=$child->update();
            $this->ajaxReturn($id);
        }
    }

    public function allChild(){
        if (IS_AJAX) {
            $child=D("Child");
            $all=$child->allChild();
            $this->ajaxReturn($all);
        }
    }


}