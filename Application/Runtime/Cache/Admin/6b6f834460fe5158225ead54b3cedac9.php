<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>习惯树管理系统</title>
    <link rel="stylesheet" type="text/css" href="/Public/Admin/easyui/themes/bootstrap/easyui.css" />
    <link rel="stylesheet" type="text/css" href="/Public/Admin/easyui/themes/icon.css" />
    <link rel="stylesheet" type="text/css" href="/Public/Admin/css/index.css" />
    <!-- Bootstrap Styles-->
    <link href="/Public/Home/assets/css/bootstrap.css" rel="stylesheet" />
    <!-- FontAwesome Styles-->
    <link href="/Public/Home/assets/css/font-awesome.css" rel="stylesheet" />
    <!-- Morris Chart Styles-->
    <link href="/Public/Home/assets/js/morris/morris-0.4.3.min.css" rel="stylesheet" />
    <!-- Custom Styles-->
    <link href="/Public/Home/assets/css/custom-styles.css" rel="stylesheet" />
    <!-- Google Fonts-->
    <link href='http://fonts.useso.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
    <link rel="stylesheet" href="/Public/Home/assets/js/Lightweight-Chart/cssCharts.css">
    <script type="text/javascript">
        var ThinkPHP = {
            'ROOT' : '',
            'MODULE' : '/index.php/Admin',
            'INDEX' : '<?php echo U("Index/index");?>',
            'IMG' : '/Public/Admin/img',
        };
    </script>
</head>
<!--<body class="easyui-layout">
<div region="north" title="后台页面" split="true" style="height:100px;">
    <div class="logo">后台管理</div>
    <div class="logout">您好，<?php echo session('admin.manager');?>  <a href="<?php echo U('Login/out');?>" id="logout">退出</a></div>
</div>
<div region="west" split="true" title="导航" style="width:180px;" iconCls="icon-earth">
    <ul id="nav"></ul>
</div>
<div region="center"  style="overflow:hidden;">
    <div id="tabs">
        <div class="welcome" title="起始页"  iconCls="icon-house" style="padding:0 10px;color:#fff;">
            <p style="color:red;">欢迎来到后台管理系统！</p>
        </div>
    </div>
</div>
</body>-->
<body>
    <div id="wrapper">
        <nav class="navbar navbar-default top-navbar" role="navigation">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.html"><strong><img src="/Public/Admin/img/logo.png" style="width:60px;height: 60px;margin-top: -20px;">习惯树管理系统</strong></a>

                <div id="sideNav" href=""><i class="fa fa-caret-right"></i></div>
            </div>

            <ul class="nav navbar-top-links navbar-right">
                <!--<li class="dropdown">-->
                    <!--<a class="dropdown-toggle" data-toggle="dropdown" href="#" aria-expanded="false">-->
                        <!--<i class="fa fa-envelope fa-fw"></i> <i class="fa fa-caret-down"></i>-->
                    <!--</a>-->
                    <!--<ul class="dropdown-menu dropdown-messages">-->
                        <!--<li>-->
                            <!--<a href="#">-->
                                <!--<div>-->
                                    <!--<strong>John Doe</strong>-->
                                        <!--<span class="pull-right text-muted">-->
                                            <!--<em>Today</em>-->
                                        <!--</span>-->
                                <!--</div>-->
                                <!--<div>Lorem Ipsum has been the industry's standard dummy text ever since the 1500s...</div>-->
                            <!--</a>-->
                        <!--</li>-->
                        <!--<li class="divider"></li>-->
                        <!--<li>-->
                            <!--<a href="#">-->
                                <!--<div>-->
                                    <!--<strong>John Smith</strong>-->
                                        <!--<span class="pull-right text-muted">-->
                                            <!--<em>Yesterday</em>-->
                                        <!--</span>-->
                                <!--</div>-->
                                <!--<div>Lorem Ipsum has been the industry's standard dummy text ever since an kwilnw...</div>-->
                            <!--</a>-->
                        <!--</li>-->
                        <!--<li class="divider"></li>-->
                        <!--<li>-->
                            <!--<a href="#">-->
                                <!--<div>-->
                                    <!--<strong>John Smith</strong>-->
                                        <!--<span class="pull-right text-muted">-->
                                            <!--<em>Yesterday</em>-->
                                        <!--</span>-->
                                <!--</div>-->
                                <!--<div>Lorem Ipsum has been the industry's standard dummy text ever since the...</div>-->
                            <!--</a>-->
                        <!--</li>-->
                        <!--<li class="divider"></li>-->
                        <!--<li>-->
                            <!--<a class="text-center" href="#">-->
                                <!--<strong>Read All Messages</strong>-->
                                <!--<i class="fa fa-angle-right"></i>-->
                            <!--</a>-->
                        <!--</li>-->
                    <!--</ul>-->
                    <!--&lt;!&ndash; /.dropdown-messages &ndash;&gt;-->
                <!--</li>-->
                <!-- /.dropdown -->
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#" aria-expanded="false">
                        您好，<span style="color:red;font-weight: bold;"><?php echo session('admin.manager');?></span>
                        <i class="fa fa-user fa-fw"></i> <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="<?php echo U('Login/out');?>"><i class="fa fa-user fa-fw"></i> 退出</a>
                        </li>
                        <!--<li><a href="#"><i class="fa fa-gear fa-fw"></i> Settings</a>-->
                        <!--</li>-->
                        <!--<li class="divider"></li>-->
                        <!--<li><a href="#"><i class="fa fa-sign-out fa-fw"></i> Logout</a>-->
                        <!--</li>-->
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
        </nav>
        <!--/. NAV TOP  -->
        <nav class="navbar-default navbar-side" role="navigation">
            <div class="sidebar-collapse">
                <ul class="nav" id="main-menu">
                    <?php if(is_array($Nav)): $i = 0; $__LIST__ = $Nav;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li>
                            <a href="#"><i class="<?php echo ($vo["iconCls"]); ?>"></i><?php echo ($vo["text"]); ?><span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <?php if(is_array($vo["child"])): $i = 0; $__LIST__ = $vo["child"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$value): $mod = ($i % 2 );++$i;?><li>
                                        <a href="<?php echo ($value["url"]); ?>" onclick="return false;"><?php echo ($value["text"]); ?></a>
                                    </li><?php endforeach; endif; else: echo "" ;endif; ?>
                                <!--<li>-->
                                    <!--<a href="/AuthGroup/index"  onclick="return false;">权限管理</a>-->
                                <!--</li>-->
                                <!--<li>-->
                                    <!--<a href="#">Second Level Link<span class="fa arrow"></span></a>-->
                                    <!--<ul class="nav nav-third-level">-->
                                        <!--<li>-->
                                            <!--<a href="#">Third Level Link</a>-->
                                        <!--</li>-->
                                        <!--<li>-->
                                            <!--<a href="#">Third Level Link</a>-->
                                        <!--</li>-->
                                        <!--<li>-->
                                            <!--<a href="#">Third Level Link</a>-->
                                        <!--</li>-->

                                    <!--</ul>-->

                                <!--</li>-->
                            </ul>
                        </li><?php endforeach; endif; else: echo "" ;endif; ?>

                    <!--<li>-->
                        <!--<a href="#"><i class="icon-user"></i>学校管理<span class="fa arrow"></span></a>-->
                        <!--<ul class="nav nav-second-level">-->
                            <!--<li>-->
                                <!--<a href="/School/index"  onclick="return false;">学校列表</a>-->
                            <!--</li>-->
                        <!--</ul>-->
                    <!--</li>-->

                    <!--<li>-->
                        <!--<a href="#"><i class="fa fa-sitemap"></i>会员管理<span class="fa arrow"></span></a>-->
                        <!--<ul class="nav nav-second-level">-->
                            <!--<li>-->
                                <!--<a href="/User/index"   onclick="return false;">会员列表</a>-->
                            <!--</li>-->
                        <!--</ul>-->
                    <!--</li>-->
                    <!--<li>-->
                        <!--<a href="empty.html"><i class="fa fa-fw fa-file"></i> Empty Page</a>-->
                    <!--</li>-->
                </ul>

            </div>

        </nav>
        <!-- /. NAV SIDE  -->
        <div id="page-wrapper">

        </div>

        <!-- this is content -->
        <!-- /. PAGE WRAPPER  -->
    </div>

</body>
<!-- /. WRAPPER  -->
<!-- JS Scripts-->
<!-- jQuery Js -->
<script src="/Public/Home/assets/js/jquery-1.10.2.js"></script>
<script type="text/javascript" src="/Public/Admin/easyui/jquery.min.js"></script>
<script type="text/javascript" src="/Public/Admin/easyui/jquery.easyui.min.js"></script>

<script type="text/javascript" src="/Public/Admin/easyui/locale/easyui-lang-zh_CN.js" ></script>

<script type="text/javascript" src="/Public/Admin/js/index.js"></script>
<!-- Bootstrap Js -->
<script src="/Public/Home/assets/js/bootstrap.min.js"></script>

<!-- Metis Menu Js -->
<script src="/Public/Home/assets/js/jquery.metisMenu.js"></script>
<!-- Morris Chart Js -->
<!--<script src="/Public/Home/assets/js/morris/raphael-2.1.0.min.js"></script>-->
<!--<script src="/Public/Home/assets/js/morris/morris.js"></script>-->


<script src="/Public/Home/assets/js/easypiechart.js"></script>
<script src="/Public/Home/assets/js/easypiechart-data.js"></script>

<script src="/Public/Home/assets/js/Lightweight-Chart/jquery.chart.js"></script>

<!-- Custom Js -->
<script src="/Public/Home/assets/js/custom-scripts.js"></script>

</body>

</html>