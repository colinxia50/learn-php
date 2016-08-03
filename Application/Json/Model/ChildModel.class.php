<?php

namespace Json\Model;

use Think\Model\RelationModel;

class ChildModel extends RelationModel
{
    protected $_link = array(

        'User' => array(
            'mapping_type' => self::BELONGS_TO,
            'class_name' => 'User',
            'mapping_name' => 'user',
            'foreign_key' => 'uid',
            'as_fields' => 'cover,f_mobile,m_mobile',
        )




    );


}