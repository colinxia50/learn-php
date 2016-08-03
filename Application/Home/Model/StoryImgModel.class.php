<?php
namespace Home\Model;

use Think\Model;
class StoryImgModel extends Model{
   
	public function addimg($img,$gid){
	    foreach ($img as $key=>$value){
	        $data=array(
	            'data'=>$value,
	            'sid'=>$gid,
	        );
	        if (!$this->add($data)){
	            return 0;
	        }
	    }
	    
	    return 1;

	}

   
}