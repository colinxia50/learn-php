<?php
namespace Admin\Model;
use Think\Model;
use Think\Auth;

class ManageModel extends Model {
	
	//管理员帐号自动验证
	protected $_validate = array(
		//-1,'帐号长度不合法！'
		array('manager', '/^[^@]{2,20}$/i', -1, self::EXISTS_VALIDATE),
		//-2,'密码长度不合法！'
		array('password', '6,30', -2, self::EXISTS_VALIDATE,'length',self::MODEL_INSERT),
	    //-2,
	    array('password', '6,30', -2, self::VALUE_VALIDATE,'length',self::MODEL_UPDATE),
	    array('manager', '', -3, self::EXISTS_VALIDATE, 'unique', self::MODEL_UPDATE),
	);
	
	//用户表自动完成
	protected $_auto = array(
			array('password', 'sha1', self::MODEL_BOTH, 'function'),
			array('create', 'time', self::MODEL_INSERT, 'function'),
	);
	
	//获取管理员列表
	public function getList($page,$rows,$sort,$order,$manager){
	    $map=array();
	    if ($manager) {
	        $map['manager']=array('like','%'.$manager.'%');
	    }
	    $obj= $this->field('id,manager,create,last_login,last_ip')
	    ->where($map)
	    ->order(array($sort=>$order))
	    ->limit($rows*($page-1),$rows)
	    ->select();
	    foreach ($obj as $key => $value) {
	        $obj[$key]['create']=date('Y-m-d H:i:s',$value['create']);
	        $obj[$key]['last_login']=date('Y-m-d H:i:s',$value['last_login']);
	        $obj[$key]['last_ip']=long2ip($value['last_ip']);
	        
	        $Auth=new Auth();
	        $allAuth=$Auth->getGroups($value['id']);
	        foreach ($allAuth as $k=>$v){
	            $obj[$key]['auth']=$v['title'];
	        }
	         
	    }
	    //要用数据表格显示分页,就必须返回所有数据条数,和数据
	    return array(
	      	 'total'=>$this->where($map)->count(),
	        'rows'=>$obj?:'',
	    );
	}
	
	public function getManage(){
	    $map['id']=I('post.id');
	    $obj= $this->where($map)->find();
	    $auth=new Auth();
	    $a=$auth->getGroups($obj['id']);
	    $obj['group_id']=$a[0]['group_id'];
	    $json=file_get_contents('http://localhost/zzb/address.json');
	    $json=json_decode($json,true);
	    $province='';
	    $city='';
	    $area='';
	    foreach ($json['province'] as $p){
	    	if($p['pid']==$obj['pid']){
	    		$province=$p['name'];
	    	}
	    }
	    foreach ($json['city'] as $c){
	    	if($c['cid']==$obj['cid']){
	    		$city=$c['name'];
	    	}
	    }
	    foreach ($json['area'] as $a){
	    	if($a['aid']==$obj['aid']){
	    		$area=$a['name'];
	    	}
	    }
	    $obj['address']=$province.'-'.$city.'-'.$area;
	    return $obj;
	}
	
	//新增管理员
	public function addManage($Manager, $password, $role) {
	    $data = array(
	        'manager'=>$Manager,
	        'password'=>$password,
	        'pid'=>I('post.province'),
	        'cid'=>I('post.city'),
	        'aid'=>I('post.area'),
			'address' => I('post.address'),
			'adv_coin' => I('post.adv_coin'),
			'article' => I('post.article'),
			'name' => I('post.name'),
			'mobile' => I('post.mobile'),
			'real_name' => I('post.real_name'),
			'mail' => I('post.mail'),
			'total_coin' => 0,
			'adv_coin' => 0,
			'habit_coin' => 0,
			'admin' => session('admin.manager'),
	    );
	    if ($this->create($data)) {
	        $mid = $this->add();
	        if ($mid) {
	            $data = array(
	                'uid'=>$mid,
	                'group_id'=>$role,
	            );
	
	            $AuthGroupAccess = M('AuthGroupAccess');
	            $AuthGroupAccess->add($data);

	            return $mid;
	        } else {
	            return 0;
	        }
	    } else {
	        return $this->getError();
	    }
	}
	
	public function update($is_agent = false){
	    $data=array(
	        'id'=>I('post.id'),
			'address' => I('post.address'),
			'adv_coin' => I('post.adv_coin'),
			'article' => I('post.article'),
			'name' => I('post.name'),
			'mobile' => I('post.mobile'),
			'real_name' => I('post.real_name'),
			'mail' => I('post.mail'),
	    );
	   
		if(strlen(I('post.password'))>5){
			$data['password']=I('post.password');
			
		}
		//如果是代理商
		if($is_agent){
			unset($data['rate']);
			if ($this->create($data)) {
				$uid = $this->save();
				return $uid;
			}else{
				return $this->getError();
			}
		}

	    if ($this->create($data)) {
	        $uid = $this->save();
	            $data = array(	                
	                'group_id'=>I('post.role'),
	            );
	            $map['uid']=I('post.id');
	            $AuthGroupAccess = M('AuthGroupAccess');
	            $uid=$AuthGroupAccess->where($map)->save($data);
	            return $uid?:0;
	    } else {
	        return $this->getError();
	    }
	}
	
	public function remove($ids){
	    return $this->delete($ids);  //会返回影响的行数
	}
	
	//验证管理员登录
	public function checkManager(){
	    
		$data = array(
			'manager'=>I('post.manager'),
			'password'=>I('post.password'),
		);
		if ($this->create($data)) {
			$map['manager'] = I('post.manager');
			$map['password'] = sha1(I('post.password'));
			$obj = $this->field('id,manager,name')->where($map)->find();
			if ($obj) {
				session('admin', array(
					'id'=>$obj['id'],
					'manager'=>$obj['manager'],
					'name'=>$obj['name'],
				));
				//登录验证后写入登录信息
				$update = array(
						'id'=>$obj['id'],
						'last_login'=>NOW_TIME,
						'last_ip'=>get_client_ip(1),
				);
				$this->save($update);
				return $obj['id'];
			} else {
				return 0;
			}
		} else {
			return $this->getError();
		}
	}
	

}