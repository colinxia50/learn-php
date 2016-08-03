<?php
return array(
    //设置模版替换变量
    'TMPL_PARSE_STRING' => array(
        '__EASYUI__'=>__ROOT__.'/Public/'.MODULE_NAME.'/easyui',
        '__CSS__'=>__ROOT__.'/Public/'.MODULE_NAME.'/css',
        '__JS__'=>__ROOT__.'/Public/'.MODULE_NAME.'/js',
        '__IMG__'=>__ROOT__.'/Public/'.MODULE_NAME.'/img',
        '__UPLOADIFY__'=>__ROOT__.'/Public/'.MODULE_NAME.'/uploadify',
        '__DATETIMEPICKER__'=>__ROOT__.'/Public/'.MODULE_NAME.'/datetimepicker',
    ),
    'TMPL_CACHE_ON' => false,

);
