<?php
namespace Admin\Controller;

class UserController extends AuthController {
    public $group =array(
      4 => '学生',
      3 => '老师',
      2 => '园长',
    );

  public function index(){
    $school = M('school');
    $user = M('user');
    $class = M('class');
    $map = array();
    $search = I('post.searchText');
    if($search){
        $map['user'] = array('like',"%{$search}%");
        $this->assign('searchText',$search);
    }
      $first = $this->page($user,$map,'page_user',10);
      $userData = $user->where($map)->limit($first,10)->select();
      if($userData){
          foreach($userData as $k => $v){
              $userData[$k]['group'] = $this->group[$v['group_id']];
              $classData = $class->where(array('id' => $v['class_id']))->find();
              $schoolData = $school->where(array('id' => $v['school_id']))->find();
              $userData[$k]['class'] = $classData['class_name'];
              $userData[$k]['school'] = $schoolData['name'];
              $userData[$k]['last_ip'] = long2ip($v['last_ip']);
              $userData[$k]['last_login'] = date('Y-m-d H:i:s',$v['last_login']);
              $userData[$k]['reg_time'] = date('Y-m-d H:i:s',$v['reg_time']);
          }
      }
    $schoolData = M('school')->select();
    $this->assign('SchoolData',$schoolData);
    $this->assign('User',$userData);
  	$this->display('index_new');
  }
  //获取会员数据  I('post.page')第几页,I('post.rows')每页显示多少条
  //I('post.sort')排序名,I('post.order')排序方法  数据表格自动发过来的分页和排序信息
  public function getList(){
     if (IS_AJAX) {
     	$User=D('User');
     	$this->ajaxReturn($User->getList(I('post.page'),I('post.rows'),I('post.sort'),I('post.order'),I('post.nick_name'),I('post.group_id'),I('post.school_id'),I('post.class_id')));
     }else{
     	$this->error('非法操作');
     }
  }
 

 public function register(){
        $User=D('User');
        $data = $User->register();
        if($data){
            //添加老师、学生表
            switch(I('post.group_id')){
                //老师
                case 4:
                    $a = M('teacher')->add(array(
                        'uid' => $data,
                        'school_id' => I('post.school_id'),
                        'class_id' => I('post.class_id'),
                        'name' => I('post.nick_name')?:I('post.user'),
                        'sex' => I('post.sex')?:0,
                    ));
                    var_dump($a);exit;
                    break;
                //学生
                case 3:
                    M('child')->add(array(
                        'uid' => $data,
                        'school_id' => I('post.school_id'),
                        'class_id' => I('post.class_id'),
                        'name' => I('post.nick_name')?:I('post.user'),
                        'sex' => I('post.sex')?:0,
                    ));
                    break;
                default:
                    echo 111;exit;
                    break;
            }
        }
        if($data < 0){
          return $data;
        }else{
          return $this->index();
        }
 }

  public function update(){
      $User=D('User');
      $data = $User->update();
      if($data < 0){
          return $data;
      }else{
          return $this->index();
      }
 }

  public function getUser(){
    if (IS_AJAX) {
      $User=D('User');
      $this->ajaxReturn($User->getUser());
     }else{
      $this->error('非法操作');
     }
 }

    public function reMove(){
     	$User=D('User');
        $data = $User->reMove(I('post.ids'));
        if($data < 0){
            return $data;
        }else{
            return $this->index();
        }
  }
  
  public function getClass(){
      $class=M("Class");
      $map['school_id']=I('post.school_id');
      $all=$class->where($map)->field('id,class_name')->select();
      $this->ajaxReturn($all);
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