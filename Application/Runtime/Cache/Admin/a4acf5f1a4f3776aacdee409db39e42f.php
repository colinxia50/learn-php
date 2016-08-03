<?php if (!defined('THINK_PATH')) exit();?><div class="header">
    <!--<h1 class="page-header">-->
    <!--&lt;!&ndash;Dashboard <small>Welcome John Doe</small>&ndash;&gt;-->
    <!--</h1>-->
    <ol class="breadcrumb">
        <li><a href="#">广告收入</a></li>
        <li class="active">赞助列表</li>
    </ol>
</div>
<div class="header">
    <p style="margin-left:20px;">
        <?php if(!isAgent()): ?><button class="btn btn-large btn-success" type="button" data-target="#addAdvert" data-toggle="modal" style="float: right;margin-right: 100px;">添加赞助</button><?php endif; ?>
        <span class="col-xs-4">
            <input type="text" class="form-control" placeholder="查询名称/电话/地址" id="searchText">
        </span>
        <button class="btn btn-large btn-primary" type="button" id="search">搜索</button>
    </p>



    <div class="table-responsive col-xs-12" style="margin-top:10px;">
        <table class="table">
            <tr>
            	<th>#</th>
            	<th>代理商</th>
	            <th>赞助单位</th>
	            <th>地址</th>
	            <th>电话</th>
	            <th>状态</th>
	            <th>广告收入</th>
	            <th>赞助的能量币</th>
            </tr>
            <?php if(isset($Advert)): if(is_array($Advert)): $i = 0; $__LIST__ = $Advert;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
                        <td><?php echo ($key+1); ?></td>
                        <td><?php echo ($vo["managename"]); ?></td>
                        <td><?php echo ($vo["name"]); ?></td>
                        <td><?php echo ($vo["address"]); ?></td>
                        <td><?php echo ($vo["mobile"]); ?></td>
                        <td>
                        <?php if(($vo["status"] == 1)): ?>正常 <?php else: ?> 关闭<?php endif; ?>
                        </td>
                        <td><?php echo ($vo["income"]); ?></td>
                        <td><?php echo ($vo["coin"]); ?></td>
                        <!--<td>-->
                            <!--<a data-target="#editAdvert" data-toggle="modal" class="btn btn-info Advert_update" href="#" xid="<?php echo ($vo["id"]); ?>">修改</a>-->
                            <!--&lt;!&ndash;<a data-target="#delAdvert"  data-toggle="modal" class="btn btn-danger Advert_delete" href="#" xid="<?php echo ($vo["id"]); ?>">删除</a>&ndash;&gt;-->
                        <!--</td>-->
                    </tr><?php endforeach; endif; else: echo "" ;endif; endif; ?>
        </table>
    </div>
    <?php if(isset($searchText)): ?><div class="searchText" style="display:none;"><?php echo ($searchText); ?></div><?php endif; ?>
    <div id="page" style="text-align:center;">
        <nav><?php echo ($page); ?></nav>
    </div>

    <div class="modal" id="addAdvert">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close"  data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title">添加赞助</h4>
                </div>
                <div class="modal-body">
                    <form role="form" id="add">
                          <div class="form-group">
                            <label for="name">代理商</label>
                            <input type="text" class="form-control"
                                   value="<?php echo ($agent); ?>" readonly="true">
                        </div>
                        <div class="form-group">
                            <label for="name">赞助商名称</label>
                            <input type="text" class="form-control" name="name"
                                   placeholder="请输入赞助商名称">
                        </div>
                        <div class="form-group">
                            <label for="name">赞助商地址</label>
                            <input type="text" class="form-control" name="address"
                                   placeholder="请输入赞助商地址">
                        </div>
                        <div class="form-group">
                            <label for="name">赞助商电话</label>
                            <input type="text" class="form-control" name="mobile"
                                   placeholder="请输入赞助商电话">
                        </div>
                        <div class="form-group">
                            <label for="name">赞助金额</label>
                            <input type="text" class="form-control" name="coin"
                                   placeholder="请输入赞助金额">
                        </div>
                        <div class="form-group">
                            <label for="name">广告收入</label>
                            <input type="text" class="form-control" name="income"
                                   placeholder="请输入广告收入">
                        </div>
                        <div class="form-group">
                            <label for="name">广告状态</label>
                              正常<input type="radio" value="1"  name="status" checked >
                              关闭<input type="radio" value="0" name="status">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default btn_close" data-dismiss="modal">关闭</button>
                    <button type="button" class="btn btn-primary" id="add_Advert">保存</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <div class="modal" id="editAdvert">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close"  data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title">修改学校</h4>
                </div>

                <div class="modal-body">
                    <form role="form" id="edit">
                        <div class="form-group">
                            <label for="name">赞助商名称</label>
                            <input type="text" class="form-control" name="name"
                                   placeholder="请输入赞助商名称" id="name">
                        </div>
                        <div class="form-group">
                            <label for="name">赞助商地址</label>
                            <input type="text" class="form-control" name="address"
                                   placeholder="请输入赞助商地址" id="address">
                        </div>
                        <div class="form-group">
                            <label for="name">赞助商电话</label>
                            <input type="text" class="form-control" name="mobile"
                                   placeholder="请输入赞助商电话" id="mobile">
                        </div>
                        <div class="form-group">
                            <label for="name">赞助金额</label>
                            <input type="text" class="form-control" name="coin"
                                   placeholder="请输入赞助金额" id="coin">
                        </div>
                        <input type="hidden" name="id">
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default btn_close" data-dismiss="modal">关闭</button>
                    <button type="button" class="btn btn-primary" id="edit_Advert">保存</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>

    <div class="modal modal_update" id="delAdvert">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title">删除赞助</h4>
                </div>
                <div class="modal-body">
                    <p style="color:red;">您确定要删除这个会员？请谨慎操作！</p>
                    <input type="hidden" name="delid">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default btn_close" data-dismiss="modal">取消</button>
                    <button type="button" class="btn btn-primary" id="del_Advert">删除</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>

</div>
<script type="text/javascript" src="/Public/Admin/js/advert.js"></script>