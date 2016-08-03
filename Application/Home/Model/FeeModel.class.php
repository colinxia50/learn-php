<?php
namespace Home\Model;

use Think\Model\RelationModel;

class FeeModel extends RelationModel
{


    protected $_link = array(


        'User'=>array(
            'mapping_type' =>self::BELONGS_TO,
            'foreign_key'=>'user_id',
            'mapping_fields'=>'user,mobile',
            'as_fields'=>'user,mobile'
        ),

        'Child' => array(
            'mapping_type' => self::BELONGS_TO,
            'foreign_key' => 'child_id',
            'mapping_fields' => 'name,card,sex',
            'as_fields' => 'name,card,sex'
        ),

        'Class' => array(
            'mapping_type' => self::BELONGS_TO,
            'foreign_key' => 'class_id',
            'mapping_fields' => 'class_name',
            'as_fields' => 'class_name'
        ),

    );


    public function getClass()
    {
        return $this->select();
    }

    public function allChild()
    {
        $map['class_id'] = I('post.id');
        $map['state'] = 1;
        $all = $this->where($map)->field('id,name')->select();
        return $all;
    }

    //增加学生
    public function addChild()
    {
        $user = D("User");
        $id = $user->addChild();
        if ($id > 0) {
            $data = array(
                'uid' => $id,
                'name' => I('post.name'),
                'card' => I('post.card'),
                'class_id' => I('post.class_id'),
                'school_id' => session('user_auth.school_id'),
                'birthday' => strtotime(I('post.birthday')),
                'sex' => I('post.sex')
            );
            if ($this->create($data)) {
                $id = $this->add();
                return $id ?: 0;
            }
        } else {
            return $id;
        }
    }


    public function update()
    {
        $user = D("User");
        $id = $user->updateChild();
        if ($id > 0) {
            $data = array(
                'name' => I('post.name'),
                'card' => I('post.card'),
                'class_id' => I('post.class_id'),
                'birthday' => strtotime(I('post.birthday')),
                'sex' => I('post.sex')
            );
            if ($this->create($data)) {
                $map['uid'] = I('post.id');
                $id = $this->where($map)->save();
                return $id ?: 0;
            }
        } else {
            return $id;
        }
    }
}