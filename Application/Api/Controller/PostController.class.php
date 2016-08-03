<?php
/**
 *   Author: Alixez
 *   E-Mail: alixe.z@outlook.com
 * CreateAt: 16-7-11 下午1:49
 *  Company: 成都计速科技
 */

namespace Api\Controller;


use Think\Exception;

class PostController extends Controller
{

    public function article()
    {
        $user = $this->getUser();
        //dump($user);
        if($user['group_id'] != self::ROLES_TEACHER) {
            $this->doFailed('抱歉，您没有发布文章的权限!');
        }

        try {
            $model = M('infos');
            self::doCheck(array(
                'student_id',
                'title',
                'content',
            ));
            $student_id = Util::getSaveInteger('student_id');
            $title = Util::getSaveString('title');
            $content = Util::getSaveString('content');

            $data = [
                'title' => $title,
                'content' => $content,
                'teacher_id' => $user['id'],
                'student_id' => $student_id,
                'school_id' => $user['school_id'],
                'class_id' => $user['class_id'],
                'create_time' => date('Y-m-d H:i:s',time()),
                'is_pass' => 0,
            ];
            if($model->where(array('title' => $title))->find()) {
                throw new Exception('该文章标题已经存在！');
            }else if(mb_strlen($content, 'utf-8') > 600) {
                throw new Exception('文章内容不能超过600字');
            }else if(!$article = M('Articles')->add($data)) {
                throw new Exception('系统错误:'.$article->getError());
            }
            
        } catch (Exception $e) {
            $this->doFailed($e->getMessage());
        }
        
        $this->doSuccess(array('article' => $article));

    }

    public function checkTitle()
    {

    }
}