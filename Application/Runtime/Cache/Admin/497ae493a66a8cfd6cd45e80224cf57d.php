<?php if (!defined('THINK_PATH')) exit();?><div class="header">
    <!--<h1 class="page-header">-->
        <!--&lt;!&ndash;Dashboard <small>Welcome John Doe</small>&ndash;&gt;-->
    <!--</h1>-->
    <ol class="breadcrumb">
        <li><a href="#">图书借阅管理</a></li>
        <li class="active">书本库存管理</li>
    </ol>
</div>
<div class="header">
    <p style="margin-left:20px;">
        <button class="btn btn-large btn-success" type="button" data-target="#addSchool" data-toggle="modal" style="float: right;margin-right: 100px;">入库新书</button>
        <span class="col-xs-4">
            <input type="text" class="form-control" placeholder="条形码/书名" id="searchText">
        </span>
        <button class="btn btn-large btn-primary" type="button" id="search">搜索</button>
    </p>



    <div class="table-responsive col-xs-12" style="margin-top:10px;">
        <table class="table">
            <tr><th></th><th>条形码</th></th><th>入库日期</th><th>书名</th><th>出版商</th><th>书价</th><th>借书费用 </th><th>总仓库数</th><th>出库数 </th><th>剩余数 </th><th>操作</th></tr>
            <?php if(isset($Stock)): if(is_array($Stock)): $i = 0; $__LIST__ = $Stock;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
                        <td><?php echo ($key+1); ?></td>
                        <td><?php echo ($vo["barcode"]); ?></td>
                        <td><?php echo ($vo["inTime"]); ?></td>
                        <td><?php echo ($vo["bookname"]); ?></td>
                        <td><?php echo ($vo["pubname"]); ?></td>
                        <td><?php echo ($vo["price"]); ?></td>
                        <td><?php echo ($vo["rent"]); ?></td>
                        <td><?php echo ($vo["number"]); ?></td>
                        <td><?php echo ($vo["outdepot"]); ?></td>
                        <td><?php echo ($vo['number']-$vo['outdepot']); ?></td>
                        <td>
                            <a data-target="#editSchool" data-toggle="modal" class="btn btn-info School_update" href="#" xid="<?php echo ($vo["barcode"]); ?>">修改</a>
                            <a data-target="#delSchool"  data-toggle="modal" class="btn btn-danger School_delete" href="#" xid="<?php echo ($vo["barcode"]); ?>">删除</a>
                        </td>
                    </tr><?php endforeach; endif; else: echo "" ;endif; endif; ?>
        </table>
    </div>
    <?php if(isset($searchText)): ?><div class="searchText" style="display:none;"><?php echo ($searchText); ?></div><?php endif; ?>
    <div id="page" style="text-align:center;">
        <nav><?php echo ($page); ?></nav>
    </div>

    <div class="modal" id="addSchool">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close"  data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title">入库新书</h4>
                </div>
                <div class="modal-body">
                    <form role="form" id="add">
                        <div class="form-group">
                            <label for="name">条形码</label>
                            <input type="text" class="form-control" name="barcode"
                                   placeholder="请输入条形码">
                        </div>
                       <div class="form-group">
                            <label for="name">书名</label>
                            <input type="text" class="form-control" name="bookname"
                                   placeholder="请输入书名">
                        </div>
                        <div class="form-group">
                            <label for="name">出版商</label>
                           	<select name="ISBN" id="ISBN" >
                             <?php if(is_array($Publishing)): $i = 0; $__LIST__ = $Publishing;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo["ISBN"]); ?>"><?php echo ($vo["pubname"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="name">书价</label>
                            <input type="text" class="form-control" name="price"
                                   placeholder="请输入书价">
                        </div>
                                                <div class="form-group">
                            <label for="name">借书费用</label>
                            <input type="text" class="form-control" name="rent"
                                   placeholder="请输入借书费用" id="rent">
                        </div>
                                                <div class="form-group">
                            <label for="name">总仓库数</label>
                            <input type="text" class="form-control" name="phone"
                                   placeholder="请输入总仓库数">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default btn_close" data-dismiss="modal">关闭</button>
                    <button type="button" class="btn btn-primary" id="add_School">保存</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <div class="modal" id="editSchool">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close"  data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title">编辑库存书本</h4>
                </div>

                <div class="modal-body">
                    <form role="form" id="edit">
                                                <div class="form-group">
                            <label for="name">条形码</label>
                            <input type="text" class="form-control" name="barcode"
                                   placeholder="请输入条形码" id="barcode">
                        </div>
                       <div class="form-group">
                            <label for="name">书名</label>
                            <input type="text" class="form-control" name="bookname"
                                   placeholder="请输入书名" id="bookname">
                        </div>
                        <div class="form-group">
                            <label for="name">出版商</label>
                           	<select name="ISBN" id="ISBN" >
                             <?php if(is_array($Publishing)): $i = 0; $__LIST__ = $Publishing;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo["ISBN"]); ?>"><?php echo ($vo["pubname"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="name">书价</label>
                            <input type="text" class="form-control" name="price"
                                   placeholder="请输入书价" id="price">
                        </div>
                        <div class="form-group">
                            <label for="name">借书费用(每月/每年)</label>
                            <input type="text" class="form-control" name="rent"
                                   placeholder="请输入借书费用" id="rentt">
                        </div>
                          <div class="form-group">
                            <label for="name">总仓库数</label>
                            <input type="text" class="form-control" name="number"
                                   placeholder="请输入总仓库数" id="number">
                        </div>
                        <input type="hidden" name="id">
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default btn_close" data-dismiss="modal">关闭</button>
                    <button type="button" class="btn btn-primary" id="edit_School">保存</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>

    <div class="modal modal_update" id="delSchool">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title">删除图书</h4>
                </div>
                <div class="modal-body">
                    <p style="color:red;">删除后借还管理将会丢失此书信息？请谨慎操作！</p>
                    <input type="hidden" name="delid">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default btn_close" data-dismiss="modal">取消</button>
                    <button type="button" class="btn btn-primary" id="del_School">删除</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>

</div>

<script type="text/javascript" src="/Public/Admin/js/stock.js"></script>