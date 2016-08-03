<?php
//检测验证码
function check_verify($code, $id = 1) {
	$Verify = new \Think\Verify();
	$Verify->reset = false;
	return $Verify->check($code, $id);
}

//cookie加密
function encryption($username, $type = 0) {
	$key = sha1(C('COOKIE_key'));
	
	if (!$type) {
		return base64_encode($username ^ $key);
	}
	
	$username = base64_decode($username);
	return $username ^ $key;
}


function isStudent(){
  if(session("user_auth.group_id")==4){
        return true;
    }

    return false;
}

function isTeacher(){
    if(session("user_auth.group_id")==3){
        return true;
    }
    return false;
}

function isAdmin(){
    
    if(session("user_auth.group_id")==2){
        return true;
    }
    return false;
}

function isAgent(){
    $id = session('admin.id');
    $accessData = M('auth_group_access')->where(array('uid' => $id))->find();
    $groupData = M('auth_group')->where(array('id' => $accessData['group_id']))->find();
    if($groupData['title'] == '代理商'){
        return true;
    }else{
        return false;
    }
}

function getAgent(){
    $auth_group = M('auth_group');
    $auth_group_access = M('auth_group_access');
    $manage = M('manage');
    $agent_group = $auth_group->where(array('title' => '代理商'))->find();
    $agent_group_access = $auth_group_access->where(array('group_id' => $agent_group['id']))->select();
    $agent_data = array();
    foreach($agent_group_access as $key => $value){
        $rs = $manage->where(array('id' => $value['uid']))->find();
        if ($rs) {
        	$agent_data[]=$rs;
        }
    }
    return $agent_data;
}

function msubstr($str, $start=0, $length, $charset="utf-8", $suffix=true) {
    if(function_exists("mb_substr"))
        $slice = mb_substr($str, $start, $length, $charset);
    elseif(function_exists('iconv_substr')) {
        $slice = iconv_substr($str,$start,$length,$charset);
        if(false === $slice) {
            $slice = '';
        }
    }else{
        $re['utf-8']   = "/[\x01-\x7f]|[\xc2-\xdf][\x80-\xbf]|[\xe0-\xef][\x80-\xbf]{2}|[\xf0-\xff][\x80-\xbf]{3}/";
        $re['gb2312'] = "/[\x01-\x7f]|[\xb0-\xf7][\xa0-\xfe]/";
        $re['gbk']    = "/[\x01-\x7f]|[\x81-\xfe][\x40-\xfe]/";
        $re['big5']   = "/[\x01-\x7f]|[\x81-\xfe]([\x40-\x7e]|\xa1-\xfe])/";
        preg_match_all($re[$charset], $str, $match);
        $slice = join("",array_slice($match[0], $start, $length));
    }
    $fix='';
    if(strlen($slice) < strlen($str)){
        $fix='...';
    }
    return $suffix ? $slice.$fix : $slice;
}

?>