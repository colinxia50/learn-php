<?php
/**
 *   Author: Alixez
 *   E-Mail: alixe.z@outlook.com
 * CreateAt: 16-7-11 上午10:26
 *  Company: 成都计速科技
 */

namespace Api\Controller;


use Think\Exception;

class UserController extends Controller
{

    
    /**
     * 登入接口: 字段是昵称 密码
     * @author Alixez <alixe.z@outlook.com>
     */
    public function login()
    {
        self::doCheck(array('user', 'password'));
        $login_name = Util::getSaveString('user');
        $password = Util::getSaveString('password');
        $model = M('user');
        $where['user'] = $login_name;
        $member = $model->where($where)->find();
        if ($member) {
            // 验证密码
            $_password = sha1( $password );
            
            if ($_password == $member ['password']) {
                $data = self::getUserBaseInfo ( $member ['id'] );
                $data['access_token'] = $this->authcode($member ['id'],'Marks');
                $model->where(array('nick_name'=>$login_name))->save(array('last_login'=>time(),'last_ip'=>ip2long($_SERVER["REMOTE_ADDR"])));
                $this->doSuccess($data);
                
            } else {
                $this->doFailed('输入的密码有误!');
            }
            
        } else {
            $this->doFailed('输入的账号不存在!');
        }
        
    }

    public function register()
    {
        try{
            self::doCheck ( array (
                "user",
                "password",
                //"code",
                "nick_name",
                "class_id",
                "school_id"
            ) );

            $mobile = Util::getSaveString ( "user" );
            //$code =  Util::getSaveString('code');
            //$this->checkCode ($mobile,$code);
            $password= Util::getSaveString ( "password" );
            $nick_name= Util::getSaveString ( "nick_name" );
            $class_id= Util::getSaveString ( "class_id" );
            $school_id= Util::getSaveString ( "school_id" );

            $data = array ();
            $data ['nick_name'] = $nick_name;
            $data ['user'] = $mobile;
            $data ['mobile'] = $mobile;
            $data ['class_id'] = $class_id;
            $data ['school_id'] = $school_id;

            $data ['reg_time'] = time();
            $data ['password'] =  sha1( $password );

            $model = M("user");
            $where['user'] =$mobile;
            $member = $model->where($where)->find();
            if (!Validator::is_mobile($data ['user'])) {
                throw new Exception ("手机号不正确！");
            } elseif (strlen ( $password) < 6) {
                throw new Exception ("密码至少6位！");
            } elseif ($member) {
                throw new Exception ("您的号码已经注册，请直接登陆！");
            } else {
                $model->create($data);
                $uid = $model->add($data);
                if ($uid) {
                    $balanceData = [
                        'user_id' => $uid,
                        'type' => 2,
                        'coin' => +30,
                        'total_coin' => 30,
                        'create_time' => date("Y-m-d H:i:s", time()),
                    ];
                    if(!M('BalanceInfo')->add($balanceData)) {
                        throw new Exception('能量币信息初始化失败');
                    }
                    $info = self::getUserBaseInfo($uid);
                    $info['access_token'] = $this->authcode($uid,'Marks');

                    $this->doSuccess($info);
                } else {
                    $this->doFailed();
                }
            }
        }catch (Exception $e){
            $this->doFailed($e->getMessage());
        }
    }

    public function checkCode($mobile,$code) {
        $model = M('code');
        $where['code'] = $code;
        $where['user'] = $mobile;
        $list = $model->where($where)->find();
        if (!$list) {
            $this->doFailed('验证码不正确');
        }
    }

    public static function getUserBaseInfo($uid)
    {
        if (empty ($uid)) return false;
        $model = M('user');
        $member = $model
            ->field('id,nick_name,user,password,mobile,email,cover,class_id,school_id,group_id,sex,one,birthday,score')
            ->where("id='$uid'")
            ->find()
        ;
        $member['school'] = M('school')->find($member['school_id']);
        $member['class'] = M('class')->find($member['class_id']);
        unset($member['password']);
        return $member;
    }

}