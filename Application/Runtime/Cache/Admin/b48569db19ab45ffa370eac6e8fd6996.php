<?php if (!defined('THINK_PATH')) exit();?><div class="header">
    <!--<h1 class="page-header">-->
    <!--&lt;!&ndash;Dashboard <small>Welcome John Doe</small>&ndash;&gt;-->
    <!--</h1>-->
    <ol class="breadcrumb">
        <li><a href="#">新闻管理</a></li>
        <li class="active">新闻详情</li>
    </ol>
</div>
<div class="header">
    <div class="container-fluid">
        <div class="row-fluid">
            <p class="span12">
                <h3 class="text-center">
                    <?php echo ($new["title"]); ?>
                </h3>
                <div class="row-fluid">
                    <div class="span4">
                        <blockquote class="pull-left">
                             <small>已有<?php echo ($new["see"]); ?>人看过</small>
                        </blockquote>
                    </div>
                    <div class="span4">
                    </div>
                    <div class="span4">
                        <blockquote class="pull-right">
                            <small>作者：<?php echo ($new["author"]); ?> 于 <?php echo ($new["create_time"]); ?>创建</small>
                        </blockquote>
                    </div>
                </div>
                <p class="text-left text-info" style="margin-top:50px;">
                    <?php echo ($new["content"]); ?>
                </p>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript" src="/zzb/Public/Admin/js/news.js"></script>