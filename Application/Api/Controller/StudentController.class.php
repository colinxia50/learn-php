<?php
/**
 *   Author: Alixez
 *   E-Mail: alixe.z@outlook.com
 * CreateAt: 16-7-11 下午1:56
 *  Company: 成都计速科技
 */

namespace Api\Controller;


use Think\Exception;

class StudentController extends Controller
{
    public function listByTeacher()
    {
        $user = $this->getUser();
        if($user['group_id'] != self::ROLES_TEACHER) {
            $this->doFailed('抱歉，您不是老师，没有获取学生列表的权限');
        }
        try {
            $students = M('user')->field('id,user,class_id,school_id,group_id,cover,nick_name,one')->where(array(
                'group_id' => self::ROLES_STUDENT,
                'class_id' => $user['class_id'],
                'school_id' => $user['school_id'],
            ))->select();
            $this->doSuccess(array('students' => $students));
        } catch (Exception $e) {
            $this->doFailed('服务器出现错误,请稍后在试');
        }
    }
}