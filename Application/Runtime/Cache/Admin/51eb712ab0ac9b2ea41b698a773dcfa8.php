<?php if (!defined('THINK_PATH')) exit();?><div class="header">
    <!--<h1 class="page-header">-->
        <!--&lt;!&ndash;Dashboard <small>Welcome John Doe</small>&ndash;&gt;-->
    <!--</h1>-->
    <ol class="breadcrumb">
        <li><a href="#">系统设置</a></li>
        <li class="active">权限管理</li>
    </ol>
</div>
<div class="header">
    <p style="margin-left:20px;">
        <button class="btn btn-large btn-success" type="button" data-target="#addAuth" data-toggle="modal" style="float: right;margin-right: 100px;">添加权限</button>
        <!--<span class="col-xs-4">-->
            <!--<input type="text" class="form-control" placeholder="查询账号" id="searchText">-->
        <!--</span>-->
        <!--<button class="btn btn-large btn-primary" type="button" id="search">搜索</button>-->
    </p>



    <div class="table-responsive col-xs-12" style="margin-top:10px;">
        <table class="table">
            <tr><th></th><th>角色名称</th><th>拥有的权限</th><th>操作</th></tr>
            <?php if(isset($AuthData)): if(is_array($AuthData)): $i = 0; $__LIST__ = $AuthData;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
                        <td><?php echo ($key+1); ?></td>
                        <td><?php echo ($vo["title"]); ?></td>
                        <td><?php echo ($vo["rules"]); ?></td>
                        <td>
                            <a data-target="#editAuth" data-toggle="modal" class="btn btn-info auth_update" href="#" xid="<?php echo ($vo["id"]); ?>">修改</a>
                            <a data-target="#delAuth"  data-toggle="modal" class="btn btn-danger auth_delete" href="#" xid="<?php echo ($vo["id"]); ?>">删除</a>
                        </td>
                    </tr><?php endforeach; endif; else: echo "" ;endif; endif; ?>
        </table>
    </div>
    <?php if(isset($searchText)): ?><div class="searchText" style="display:none;"><?php echo ($searchText); ?></div><?php endif; ?>
    <div id="page" style="text-align:center;">
        <nav><?php echo ($page); ?></nav>
    </div>

    <div class="modal" id="addAuth">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close"  data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title">添加权限</h4>
                </div>
                <div class="modal-body">
                    <form role="form" id="add">
                        <div class="form-group">
                            <label for="name">角色名称</label>
                            <input type="text" class="form-control" name="title"
                                   placeholder="请输入账号">
                        </div>
                        <div class="form-group">
                            <label for="name">拥有权限</label>
                            <?php if(is_array($Rule)): $i = 0; $__LIST__ = $Rule;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><input type="checkbox" value="<?php echo ($vo["id"]); ?>" name="rules[]"><?php echo ($vo["title"]); endforeach; endif; else: echo "" ;endif; ?>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default btn_close" data-dismiss="modal">关闭</button>
                    <button type="button" class="btn btn-primary" id="add_auth">保存</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <div class="modal" id="editAuth">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close"  data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title">添加权限</h4>
                </div>

                <div class="modal-body">
                    <form role="form" id="edit">
                        <div class="form-group">
                            <label for="name">角色名称</label>
                            <input type="text" class="form-control" name="title"
                                   placeholder="请输入账号" id="title">
                        </div>
                        <div class="form-group">
                            <label for="name">拥有权限</label>
                            <?php if(is_array($Rule)): $i = 0; $__LIST__ = $Rule;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><input type="checkbox" value="<?php echo ($vo["id"]); ?>" name="rules[]"><?php echo ($vo["title"]); endforeach; endif; else: echo "" ;endif; ?>
                        </div>
                        <input type="hidden" name="id">
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default btn_close" data-dismiss="modal">关闭</button>
                    <button type="button" class="btn btn-primary" id="edit_auth">保存</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>

    <div class="modal modal_update" id="delAuth">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title">删除角色</h4>
                </div>
                <div class="modal-body">
                    <p style="color:red;">您确定要删除这个角色权限吗？请谨慎操作！</p>
                    <input type="hidden" name="delid">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default btn_close" data-dismiss="modal">取消</button>
                    <button type="button" class="btn btn-primary" id="del_auth">删除</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>

</div>
<script type="text/javascript" src="/Public/Admin/js/authgroup.js"></script>