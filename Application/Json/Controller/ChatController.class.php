<?php

namespace Json\Controller;

use Think\Controller;
use Think\Exception;


class ChatController extends BaseController
{

    public function getAllInfo(){
        self::doCheck("userData");
        $userData = Util::getSaveString('userData');
        try{
            $model = M('user');
            $array=explode(',',$userData);
            $list = array();
            foreach($array as $v){
                $member = $model->field(array('user,nick_name,cover'))->where(array('user'=>$v))->find();
                $list[] = $member;
            }
            $this->doSuccess($list);
        }catch (Exception $e){
            $this->doFailed($e->getMessage());
        }
    }




}