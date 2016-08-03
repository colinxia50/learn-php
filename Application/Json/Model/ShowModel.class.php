<?php

namespace Json\Model;

use Think\Model\RelationModel;

class ShowModel extends RelationModel
{
    protected $_link = array(

        'Child' => array(
            'mapping_type' => self::BELONGS_TO,
            'class_name' => 'Child',
            'mapping_name' => 'child',
            'foreign_key' => 'child_id',
            'as_fields' => 'name:child_name',
        ),

        'Class' => array(
            'mapping_type' => self::BELONGS_TO,
            'class_name' => 'Class',
            'mapping_name' => 'class',
            'foreign_key' => 'class_id',
            'as_fields' => 'class_name',
        ),


    );


}