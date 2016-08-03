<?php
namespace Home\Model;

use Think\Model\RelationModel;
class InfosImgModel extends RelationModel{
   
	public function addimg($img,$gid){
	    foreach ($img as $key=>$value){
	        $data=array(
	            'data'=>$value,
	            'iid'=>$gid,
	        );
	        if (!$this->add($data)){
	            return 0;
	        }
	    }
	    
	    return 1;

	}

   
}