<?php if (!defined('THINK_PATH')) exit();?>        <link href="/Public/Admin/datetimepicker/css/bootstrap-datetimepicker.css" rel="stylesheet">
		<script src="/Public/Admin/datetimepicker/js/moment-with-locales.js"></script>
		<script src="/Public/Admin/datetimepicker/js/bootstrap-datetimepicker.js"></script>
<div class="header">
    <!--<h1 class="page-header">-->
        <!--&lt;!&ndash;Dashboard <small>Welcome John Doe</small>&ndash;&gt;-->
    <!--</h1>-->
    <ol class="breadcrumb">
        <li><a href="#">图书借阅管理</a></li>
        <li class="active">借书管理</li>
    </ol>
</div>
<div class="header">
    <p style="margin-left:20px;">
        <button class="btn btn-large btn-success" type="button" data-target="#addSchool" data-toggle="modal" style="float: right;margin-right: 100px;">出库/借出</button>
        <span class="col-xs-4">
            <input type="text" class="form-control" placeholder="书名/条形码/学校名" id="searchText">
        </span>
        <button class="btn btn-large btn-primary" type="button" id="search">搜索借出记录</button>
    </p>



    <div class="table-responsive col-xs-12" style="margin-top:10px;">
        <table class="table">
            <tr><th></th><th>幼儿园</th></th><th>书名</th><th>借书日期</th><th>还书日期</th><th>借书费用 </th><th>库存数(学校借书数)</th><th>操作</th></tr>
            <?php if(isset($Borrow)): if(is_array($Borrow)): $i = 0; $__LIST__ = $Borrow;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
                        <td><?php echo ($key+1); ?></td>
                        <td><?php echo ($vo["name"]); ?></td>
                        <td><?php echo ($vo["bookname"]); ?></td>
                        <td><?php echo ($vo["borrowTime"]); ?></td>
                        <td><?php echo ($vo["backTime"]); ?></td>
                        <td><?php echo ($vo["rental"]); ?></td>
                        <td><?php echo ($vo["borrownum"]); ?></td>
                        <td>
                        <?php if(($vo["ifback"] == 1)): ?><a data-target="#editSchool" data-toggle="modal" class="btn btn-info School_update" href="#" xid="<?php echo ($vo["id"]); ?>">续借/新加出库数</a><?php endif; ?>
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
                    <h4 class="modal-title">借阅图书</h4>
                </div>
                <div class="modal-body">
                    <form role="form" id="add">
                        <div class="form-group">
                            <label for="name">借阅图书名</label>
                            <input type="text" class="form-control" name="sousou"
                                   placeholder="请输入书名/条形码" autocomplete="off" id="sousou">
                            <input type="hidden" id="address" name="bookid"/>
                        </div>
                        <div class="form-group" id="sotable">

                        </div>
                         <div class="form-group">
                            <label for="name">所属学校</label>
                           	<select name="schoolid" id="schoolid" >
                             <?php if(is_array($School)): $i = 0; $__LIST__ = $School;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo["id"]); ?>"><?php echo ($vo["name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                            </select>
                        </div>
                        
                        <div class="form-group">
                            <label for="name">出库数量</label>
                            <input type="text" class="form-control" name="borrownum"
                                   placeholder="请输入要借出的数量">
                        </div>
                        <div class="form-group">
                            <label for="name">费用</label>
                            <input type="text" class="form-control" name="rental"
                                   placeholder="请输入要借出的数量">
                        </div>
                        <div class="form-group">
                            <label for="name">还书时间</label>
						                <div class='input-group date' id='datetimepicker1'>
						                    <input type='text' class="form-control" name="backTime" id='datetimepicker4'/>
						                    </span>
						                </div>
						                
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
                    <h4 class="modal-title">续借/增加</h4>
                </div>

                <div class="modal-body">
                    <form role="form" id="edit">
	                    <div class="form-group">
	                            <label for="name">日期延期到</label>
                <div class='input-group date' id='datetimepicker2'>
                    <input type='text' class="form-control" name="updatetime"/>
                    <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span>
                    </span>
                </div>
	                 </div>
			
                        <div class="form-group">
                            <label for="name">续费金额(延期所产生的费用)</label>
                            <input type="text" class="form-control" name=updaterent
                                   placeholder="请输入续费金额" id="rent">
                        </div>
                         <div class="form-group">
                            <label for="name">增加出库数量(只延期为空即可)</label>
                            <input type="text" class="form-control" name=borrownum
                                   placeholder="请输入续加的数量" id="borrownum">
                        </div>
                        <input type="hidden" name="id"/>
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
<script type="text/javascript">
$(function () {
	$('#datetimepicker4').datetimepicker({
        format: 'YYYY-MM-DD'
	});
});

$(function () {
	$('#datetimepicker2').datetimepicker({
        format: 'YYYY-MM-DD'
	});
});
</script>
<script type="text/javascript" src="/Public/Admin/js/borrow.js"></script>