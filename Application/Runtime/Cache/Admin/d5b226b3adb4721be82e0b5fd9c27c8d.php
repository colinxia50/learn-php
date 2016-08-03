<?php if (!defined('THINK_PATH')) exit();?><div class="header">
    <!--<h1 class="page-header">-->
    <!--&lt;!&ndash;Dashboard <small>Welcome John Doe</small>&ndash;&gt;-->
    <!--</h1>-->
    <ol class="breadcrumb">
        <li><a href="#">新闻管理</a></li>
        <li class="active">新闻列表</li>
    </ol>
</div>
<div class="header">
    <p style="margin-left:20px;">
        <?php if(!isAgent()): ?><button class="btn btn-large btn-success" type="button" data-target="#addNews" data-toggle="modal" style="float: right;margin-right: 100px;">添加新闻</button><?php endif; ?>
        <span class="col-xs-4">
            <input type="text" class="form-control" placeholder="查询标题/内容" id="searchText">
        </span>
        <button class="btn btn-large btn-primary" type="button" id="search">搜索</button>
    </p>



    <div class="table-responsive col-xs-12" style="margin-top:10px;">
        <table class="table">
            <tr><th></th><th>发布人</th><th>标题</th><th>多少人看过</th><th>创建时间</th><th>操作</th></tr>
            <?php if(isset($News)): if(is_array($News)): $i = 0; $__LIST__ = $News;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
                        <td><?php echo ($key+1); ?></td>
                        <td><?php echo ($vo["author"]); ?></td>
                        <td><?php echo ($vo["title"]); ?></td>
                        <td><?php echo ($vo["see"]); ?></td>
                        <td><?php echo ($vo["create_time"]); ?></td>
                        <td>
                            <?php if(!isAgent()): ?><a data-target="#editNews" data-toggle="modal" class="btn btn-info News_update" href="#" xid="<?php echo ($vo["id"]); ?>">修改</a>
                                <a data-target="#delNews"  data-toggle="modal" class="btn btn-danger News_delete" href="#" xid="<?php echo ($vo["id"]); ?>">删除</a><?php endif; ?>
                            <a class="btn btn-success News_see" href="#" xid="<?php echo ($vo["id"]); ?>">查看</a>
                        </td>
                    </tr><?php endforeach; endif; else: echo "" ;endif; endif; ?>
        </table>
    </div>
    <?php if(isset($searchText)): ?><div class="searchText" style="display:none;"><?php echo ($searchText); ?></div><?php endif; ?>
    <div id="page" style="text-align:center;">
        <nav><?php echo ($page); ?></nav>
    </div>

    <div class="modal" id="addNews">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close"  data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title">添加新闻</h4>
                </div>
                <div class="modal-body">
                    <form role="form" id="add">
                        <div class="form-group">
                            <label for="name">标题</label>
                            <input type="text" class="form-control" name="title"
                                   placeholder="请输入标题">
                        </div>
                        <div class="form-group">
                            <label for="name">内容</label>
                            <textarea class="form-control" id="addcontent"
                                   placeholder="请输入内容"></textarea>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default btn_close" data-dismiss="modal">关闭</button>
                    <button type="button" class="btn btn-primary" id="add_News">保存</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <div class="modal" id="editNews">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close"  data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title">修改新闻</h4>
                </div>

                <div class="modal-body">
                    <form role="form" id="edit">
                        <div class="form-group">
                            <label for="name">标题</label>
                            <input type="text" class="form-control" name="title"
                                   placeholder="请输入标题" id="title">
                        </div>
                        <div class="form-group">
                            <label for="name">内容</label>
                            <textarea class="form-control" id="editcontent"
                                      placeholder="请输入内容"></textarea>
                        </div>
                        <input type="hidden" name="id" id="id">
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default btn_close" data-dismiss="modal">关闭</button>
                    <button type="button" class="btn btn-primary" id="edit_News">保存</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>

    <div class="modal modal_update" id="delNews">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title">删除新闻</h4>
                </div>
                <div class="modal-body">
                    <p style="color:red;">您确定要删除这个新闻？请谨慎操作！</p>
                    <input type="hidden" name="delid">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default btn_close" data-dismiss="modal">取消</button>
                    <button type="button" class="btn btn-primary" id="del_News">删除</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>

</div>
<script type="text/javascript" src="/Public/Admin/js/news.js"></script>