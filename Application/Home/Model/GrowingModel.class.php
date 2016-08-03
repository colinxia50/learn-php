<?php
namespace Home\Model;

use Think\Model\RelationModel;
class GrowingModel extends RelationModel{
   
    
    protected $_link=array(
        'img'=>array(
            'mapping_type'=>self::HAS_MANY,
            'class_name'=>'Img',
            'foreign_key'=>'gid',
            'mapping_fields'=>'data'
        ),
    );
    
    //获取微博列表
    public function getlist($first,$total){
        $school=session('user_auth.school_id');
        $growingList=$this->farmat($this
            ->relation(true)
            ->table('__GROWING__ a, __USER__ b')
            ->field('a.id,a.info,a.dateline,b.nick_name,b.cover')
            ->limit($first,$total)
            ->order('a.dateline desc')
            ->where("a.uid=b.id AND a.school_id=$school")
            ->select());
        return $growingList;
    }
    
    //格式化配图
    public function farmat($list){
        foreach ($list as $key=>$value){
            if (!is_null($value['img'])){
                foreach ($value['img'] as $k=>$v){
                    $value['img'][$k]=json_decode($v['data'],true);
                }
            }
            $list[$key]=$value;
            $list[$key]['count']=count($value['img']);
            $time=NOW_TIME-$list[$key]['dateline'];
            if ($time < 60) {
                $list[$key]['time'] = '刚刚发布';
            } else if ($time < 60 * 60) {
                $list[$key]['time'] = floor($time / 60).'分钟之前';
            } else if (date('Y-m-d') == date('Y-m-d', $list[$key]['dateline'])) {
                $list[$key]['time'] = '今天'.date('H:i', $list[$key]['dateline']);
            } else if (date("Y-m-d",strtotime("-1 day")) == date('Y-m-d',$list[$key]['dateline'])) {
                $list[$key]['time'] = '昨天'.date('H:i', $list[$key]['dateline']);
            } else if (date('Y') == date('Y', $list[$key]['create'])) {
                $list[$key]['time'] = date('m月d日 H:i', $list[$key]['dateline']);
            } else {
                $list[$key]['time'] = date('Y年m月d日 H:i', $list[$key]['dateline']);
            }
            
            $list[$key]['face']=json_decode($value['cover'])->small;
        }
        return $list;
    }
    
    
    public function addgrowing($info,$pid){
        $data=array(
          'info'=>$info,
          'dateline'=>time(),
          'uid'=>session('user_auth.id'),
        );
        $childID=explode(',',$pid);
        if ($this->create($data)){
            $growing_id=$this->add();
            if ($growing_id){
                $child=M("GrowingChild");
                foreach ($childID as $key=>$value){
                    $info=array(
                        'growing_id'=>$growing_id,
                        'cid'=>$value,
                    );
                    $child->add($info);
                }
                return $growing_id;
            }else{
                return 0;
            }
        }
    }
}