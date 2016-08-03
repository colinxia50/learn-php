<?php
return array(
	//'配置项'=>'配置值'
    //设置可访问目录
    'MODULE_ALLOW_LIST'=>array('Home','Admin','Json','Api'),
    //设置默认目录
    'DEFAULT_MODULE'=>'Home',
    //设置模版后缀
    //	'TMPL_TEMPLATE_SUFFIX'=>'.tpl',
    //设置默认主题目录
    'DEFAULT_THEME'=>'Default',
    //数据库配置

/*     'DB_TYPE' => 'mysql',
    'DB_USER' => 'zzbUser',
    'DB_PWD' => 'zzbUserPass',
    'DB_PREFIX' => '',
    'DB_NAME' => 'zzb',
    'DB_PORT' => '3306',
//    'DB_HOST' => 'localhost',
    'DB_HOST' => '121.42.42.248', */
    'URL_MODEL' => 0,

   'DB_TYPE'=>'mysql', //数据库类型
   'DB_HOST'=>'localhost', //服务器地址
   'DB_NAME'=>'zzb', //数据库名
   'DB_USER'=>'root', //用户名
   'DB_PWD'=>'', //密码
   'DB_PORT'=>3306, //端口

    //分页，每页显示多少条
    'PAGE_SIZE'=>9,
    //控制数字分页前后显示的条数
    'PAGE_NUM'=>4,

    //区别数据库字段大小写
    'DB_PARAMS'    =>    array(\PDO::ATTR_CASE => \PDO::CASE_NATURAL),
    //图片上传路径
    'UPLOAD_PATH'=>'./Uploads/',
    //头像地址
    'FACE_PATH'=>'./Uploads/face/',
    'RT'=>"http://".$_SERVER ['HTTP_HOST'],
);
