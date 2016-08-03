<?php
namespace Home\Model;
use Think\Model;

class ImgModel extends Model {
	//动态配图绑定入库

	public function addimg($img,$gid){
	    foreach ($img as $key=>$value){
	        $data=array(
	            'data'=>$value,
	            'gid'=>$gid,
	        );
	        if (!$this->add($data)){
	            return 0;
	        }
	    }
	    
	    return 1;

	}

}