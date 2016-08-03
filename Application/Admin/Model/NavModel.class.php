<?php
namespace Admin\Model;
use  Think\Model;


class NavModel extends Model {
	
	//获取菜单导航
	public  function getNav($id=0,$texts){
		$map['nid']=$id;
		$map['text']=array('in',$texts);
		$obj = $this->field('id,text,state,iconCls,url')->where($map)->select();
		return $obj ? $obj : '';
	}
	

}