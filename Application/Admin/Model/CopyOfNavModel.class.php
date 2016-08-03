<?php
namespace Admin\Model;
use  Think\Model;


class NavModel extends Model {
	
	//获取菜单导航
	public  function getNav($nid=0,$id){
		$map['nid']=$nid;
		$map['id']=array('in',$id);
		$obj = $this->field('id,text,state,iconCls,url,nid')->where($map)->select();
		return $obj ? $obj : '';
	}
	

}