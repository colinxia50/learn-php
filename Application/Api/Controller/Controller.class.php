<?php
namespace Api\Controller;
use Think\Controller as BaseController;
use Think\Exception;

/**
 *   Author: Alixez
 *   E-Mail: alixe.z@outlook.com
 * CreateAt: 16-7-11 上午10:25
 *  Company: 成都计速科技
 */
class Controller extends BaseController
{
    public  static $result=array("code"=>"","msg"=>"","data"=>array());

    const OAUTHKEY = "Marks" ;
    const ACCESSTOKENEXPIRY = 86400;

    const ROLES_TEACHER = 3;
    const ROLES_STUDENT = 4;
    const ROLES_DIRECTOR = 2;

    protected $except = [
        'Api/User/login',
        'Api/User/register',
    ];

    protected $group = [
        4 => '学生',
        3 => '老师',
        2 => '园长',
    ];

    protected $user;
    
    public function _initialize()
    {
        $currentAction = MODULE_NAME.'/'.CONTROLLER_NAME.'/'.ACTION_NAME;

        if(in_array($currentAction, $this->except)) {
            return;
        }
        // access_token 认证通过
        $uid = $this->authCheck();

        //if($userInfo = session('API_LOGIN_USER')) {
        //    $this->user = $userInfo;
        //} else {
            $this->user = M('user')->find($uid);
            reset($this->user['password']);
        //    session('API_LOGIN_USER', $this->user);
        //}


        // 权限认证
        /*
        $roles = $this->getRolesByUid($uid);
        foreach ($roles as $role) {
            $roleNames[] = $role['name'];
        }
        if(!in_array($currentAction, $roleNames)) {
            return $this->doFailed('抱歉，您没有访问该接口的权限');
        }
        */
    }

    protected function getUser()
    {
        return $this->user;
    }

    public static function doSuccess($list=array()){
        header('Content-Type:application/json; charset=UTF-8');
        echo json_encode(array('code' => '200', 'msg' => '成功', 'data' => $list), JSON_UNESCAPED_UNICODE);exit;
    }

    public static function doFailed($msg='',$code='-1'){
        header('Content-Type:application/json; charset=UTF-8');
        echo json_encode(array('code' => $code, 'msg' => $msg, 'data' => array()), JSON_UNESCAPED_UNICODE);exit;
    }


    public static function smsSend($mobile,$message)
    {

        if(empty($message))
        {
            return false;
        }

        $message = sprintf("您注册的验证码是：%s",$message);
        $ac = "1001@501102340001";
        $authkey = "3051E9A547B7DFA4AF19A061E5CABB44";
//         		$message=iconv('utf-8','gb2312',$message);
        $content = "";
        $url="http://smsapi.c123.cn/OpenPlatform/OpenApi?action=sendOnce&ac=$ac&authkey=$authkey&cgid=52&m=$mobile&c=".rawurlencode($message);
        if($fd = fopen($url,"r"))
        {
            while (!feof($fd))
            {
                $content.= fread($fd, 1);
            }
            fclose($fd);
        }
        return  (int)substr($content, strripos($content,"result")+8,1);
    }


    /*
         * 获取密钥
         */
    public function auth() {

        try{
            $user_name = Util::getSaveString ( "nick_name" );
            $password = Util::getSaveString ( "password" );
            $id = self::getid($user_name, $password);
            if($id)
            {
                $member ['access_token'] = ($this->authcode($id,"Marks"));
                $this->doSuccess($member);
            }else
            {
                $this->doFailed('用户信息不正确！');
            }
        }catch (Exception $e){
            $this->doFailed($e->getMessage());
        }
    }


    public static  function getid($user_name, $password){
        $model = M('member');
        $where['user_name'] = $user_name;
        $member = $model->where($where)->find();
        $truePassword = md5(md5($password).$member['salt']);
        $where['password'] = $truePassword;
        $list = $model->field('id')->where($where)->find();
        return $list['id'];
    }

    /**
     * @param $string
     * @param string $operation DECODE 解密 其他字符串加密
     * @param string $key
     * @param int $expiry
     * @return string
     */
    public  function authcode($string, $operation = 'DECODE', $key = self::OAUTHKEY, $expiry = self::ACCESSTOKENEXPIRY) {
        // 动态密匙长度，相同的明文会生成不同密文就是依靠动态密匙
        $ckey_length = 4;

        // 密匙
        $key = md5 ( $key ? $key : $GLOBALS ['discuz_auth_key'] );

        // 密匙a会参与加解密
        $keya = md5 ( substr ( $key, 0, 16 ) );
        // 密匙b会用来做数据完整性验证
        $keyb = md5 ( substr ( $key, 16, 16 ) );
        // 密匙c用于变化生成的密文
        $keyc = $ckey_length ? ($operation == 'DECODE' ? substr ( $string, 0, $ckey_length ) : substr ( md5 ( microtime () ), - $ckey_length )) : '';
        // 参与运算的密匙
        $cryptkey = $keya . md5 ( $keya . $keyc );
        $key_length = strlen ( $cryptkey );
        // 明文，前10位用来保存时间戳，解密时验证数据有效性，10到26位用来保存$keyb(密匙b)，解密时会通过这个密匙验证数据完整性
        // 如果是解码的话，会从第$ckey_length位开始，因为密文前$ckey_length位保存 动态密匙，以保证解密正确
        $string = $operation == 'DECODE' ? base64_decode ( substr ( $string, $ckey_length ) ) : sprintf ( '%010d', $expiry ? $expiry + time () : 0 ) . substr ( md5 ( $string . $keyb ), 0, 16 ) . $string;
        $string_length = strlen ( $string );
        $result = '';
        $box = range ( 0, 255 );
        $rndkey = array ();
        // 产生密匙簿
        for($i = 0; $i <= 255; $i ++) {
            $rndkey [$i] = ord ( $cryptkey [$i % $key_length] );
        }
        // 用固定的算法，打乱密匙簿，增加随机性，好像很复杂，实际上对并不会增加密文的强度
        for($j = $i = 0; $i < 256; $i ++) {
            $j = ($j + $box [$i] + $rndkey [$i]) % 256;
            $tmp = $box [$i];
            $box [$i] = $box [$j];
            $box [$j] = $tmp;
        }
        // 核心加解密部分
        for($a = $j = $i = 0; $i < $string_length; $i ++) {
            $a = ($a + 1) % 256;
            $j = ($j + $box [$a]) % 256;
            $tmp = $box [$a];
            $box [$a] = $box [$j];
            $box [$j] = $tmp;
            // 从密匙簿得出密匙进行异或，再转成字符
            $result .= chr ( ord ( $string [$i] ) ^ ($box [($box [$a] + $box [$j]) % 256]) );
        }
        if ($operation == 'DECODE') {
            // substr($result, 0, 10) == 0 验证数据有效性
            // substr($result, 0, 10) - time() > 0 验证数据有效性
            // substr($result, 10, 16) == substr(md5(substr($result, 26).$keyb), 0, 16) 验证数据完整性
            // 验证数据有效性，请看未加密明文的格式
            if ((substr ( $result, 0, 10 ) == 0 || substr ( $result, 0, 10 ) - time () > 0) && substr ( $result, 10, 16 ) == substr ( md5 ( substr ( $result, 26 ) . $keyb ), 0, 16 )) {
                return substr ( $result, 26 );
            } else {
                return '';
            }
        } else {
            // 把动态密匙保存在密文里，这也是为什么同样的明文，生产不同密文后能解密的原因
            // 因为加密后的密文可能是一些特殊字符，复制过程可能会丢失，所以用base64编码
            return $keyc . str_replace ( '=', '', base64_encode ( $result ) );
        }
    }

    function authCheck(){
        $token = Util::getSaveString('access_token');
        $id = self::authcode($token,"DECODE");
        if(!$id)  $this->doFailed('非法访问','0');
        return $id;
    }

    public function doJson($result)
    {

        $serviceJson=new ServicesJSON();

        echo $serviceJson->encodeUnsafe(Util::nullToString($result));
        exit;
    }

    public function doCheck($array,$option='')
    {

        if(is_array($var=Util::IsNull($array,$option)))
        {
            self::doJson($var);
        }

        return true;
    }

    public static function userInfo($user_name ,$password)
    {
        try{
            $model = M('member');
            if(!$user_name || !$password)
            {
                throw new Exception("用户名或密码不能为空！");
            }

            $where['user_name'] = $user_name;
            $member = $model->where($where)->find();

            if(empty($member))
            {
                throw new Exception("帐号不存在！");
            }

            if($member['password']!=md5(md5($password).$member['salt']))
            {
                throw new Exception("密码输入不正确！");
            }

            return $member;
        }catch (Exception $e){

        }
    }

    public static function getUserId($user_name){
        $model = M('member');
        $list = $model->field('id')->where("user = '$user_name'")->find();
        if($list){
            return $list['id'];
        }else{
            self::doFailed('用户不存在');
        }
    }

    public function getRolesByUid($uid)
    {
        return $this->getGroupByUid($uid)['rules'];
    }

    public function getGroupByUid($uid)
    {
        if(!$group = S('ZZB_API_ROLES_'.$uid)) {
            try {
                $gid = M('user')->find($uid)['group_id'];
                $group = M('AuthGroup')->where(array('id' => $gid, 'status' => 1))->find();
                $ruleList = explode(',', $group['rules']);
                foreach ($ruleList as &$rid) {
                    $rid = M('AuthRule')->where(array('status' => 1, 'id' => $rid))->find();
                }
                $group['rules'] = $ruleList;
                S('ZZB_API_ROLES_'.$uid, $group, ['expire' => 60]);
            } catch (Exception $e) {
                return ['rules' => ''];
            }
        }
        return $group;
    }

    public function getGroupIdByUid($uid)
    {
        return M('user')->find($uid)['group_id'];
    }
}