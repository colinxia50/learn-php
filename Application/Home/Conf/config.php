<?php
return array(
	//'配置项'=>'配置值'
    //设置模版替换变量
    'TMPL_PARSE_STRING' => array(
        '__CSS__'=>__ROOT__.'/Public/'.MODULE_NAME.'/css',
        '__JS__'=>__ROOT__.'/Public/'.MODULE_NAME.'/js',
        '__IMG__'=>__ROOT__.'/Public/'.MODULE_NAME.'/img',
        '__IMAGE__'=>__ROOT__.'/Public/'.MODULE_NAME.'/image',
        '__UPLOADIFY__'=>__ROOT__.'/Public/'.MODULE_NAME.'/uploadify',
        '__DATETIMEPICKER__'=>__ROOT__.'/Public/Admin/datetimepicker',
    ),
    
        //自定义跳转页面
//     'TMPL_ACTION_ERROR'=>'Public/jump',
//     'TMPL_ACTION_SUCCESS'=>'Public/jump',
);
