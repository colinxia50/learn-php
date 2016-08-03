<?php if (!defined('THINK_PATH')) exit();?><div class="header">
    <!--<h1 class="page-header">-->
        <!--&lt;!&ndash;Dashboard <small>Welcome John Doe</small>&ndash;&gt;-->
    <!--</h1>-->
    <ol class="breadcrumb">
        <li><a href="#">学校管理</a></li>
        <li class="active">学校列表</li>
    </ol>
</div>
<div class="header">
    <p style="margin-left:20px;">
        <button class="btn btn-large btn-success" type="button" data-target="#addSchool" data-toggle="modal" style="float: right;margin-right: 100px;">添加学校</button>
        <span class="col-xs-4">
            <input type="text" class="form-control" placeholder="查询名字/地址/电话/简介" id="searchText">
        </span>
        <button class="btn btn-large btn-primary" type="button" id="search">搜索</button>
    </p>



    <div class="table-responsive col-xs-12" style="margin-top:10px;">
        <table class="table">
            <tr><th></th><th>学校名称</th><th>学校电话</th><th>学校地址</th><th>代理商</th><th>是否上线</th><th>注册时间</th><th>操作</th></tr>
            <?php if(isset($School)): if(is_array($School)): $i = 0; $__LIST__ = $School;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
                        <td><?php echo ($key+1); ?></td>
                        <td><?php echo ($vo["name"]); ?></td>
                        <td><?php echo ($vo["mobile"]); ?></td>
                        <td><?php echo ($vo["address"]); ?></td>
                        <td><?php echo ($vo["agent"]); ?></td>
                        <td><?php if($vo["is_up"] == 1): ?>上线<?php else: ?>未上线<?php endif; ?></td>
                        <td><?php echo (date('Y-m-d H:i:s',$vo["dateline"])); ?></td>
                        <td>
                            <?php if($vo["is_up"] == 1): ?><a class="btn btn-danger School_up" href="#" xid="<?php echo ($vo["id"]); ?>">下线</a>
                            <?php else: ?>
                                <a class="btn btn-success School_up" href="#" xid="<?php echo ($vo["id"]); ?>">上线</a><?php endif; ?>
                            <a data-target="#editSchool" data-toggle="modal" class="btn btn-info School_update" href="#" xid="<?php echo ($vo["id"]); ?>">修改</a>
                            <a data-target="#delSchool"  data-toggle="modal" class="btn btn-danger School_delete" href="#" xid="<?php echo ($vo["id"]); ?>">删除</a>
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
                    <h4 class="modal-title">添加学校</h4>
                </div>
                <div class="modal-body">
                    <form role="form" id="add">
                        <div class="form-group">
                            <label for="name">代理商</label>
                           <input type="text" class="form-control" readonly="true" value="<?php echo ($agent); ?>">
                        </div>
                        <div class="form-group">
                            <label for="name">学校名称</label>
                            <input type="text" class="form-control" name="name"
                                   placeholder="请输入学校名称">
                        </div>
                        <div class="form-group">
                            <label for="name">学校地址</label>
                           	省 <select name="province" id="province" onchange="doFindPID(this.options[this.options.selectedIndex].value)">
                             <?php if(is_array($address["province"])): $i = 0; $__LIST__ = $address["province"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo["pid"]); ?>"><?php echo ($vo["name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                            </select>
                            
                 		          市 <select name="city" id="city" onchange="doFindCID(this.options[this.options.selectedIndex].value)">
                            		<option value='0'>--请选择--</option>
                            		 <?php if(is_array($address["city"])): $i = 0; $__LIST__ = $address["city"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i; if(($vo["pid"] == 1)): ?><option value="<?php echo ($vo["cid"]); ?>"><?php echo ($vo["name"]); ?></option><?php endif; endforeach; endif; else: echo "" ;endif; ?>
                            </select>
                            
                                                                                        区<select name="area" id="area">
                            		<option value='0'>--请选择--</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="name">联系电话</label>
                            <input type="text" class="form-control" name="mobile"
                                   placeholder="请输入联系电话">
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
                    <h4 class="modal-title">修改学校</h4>
                </div>

                <div class="modal-body">
                    <form role="form" id="edit">
                        <div class="form-group">
                            <label for="name">学校名称</label>
                            <input type="text" class="form-control" name="name"
                                   placeholder="请输入学校名称" id="name">
                        </div>
                        <div class="form-group">
                            <label for="name">学校地址</label>
                            <input type="text" class="form-control" readonly="true" name="address"
                                   placeholder="请输入学校地址" id="address">
                        </div>
                        <div class="form-group">
                            <label for="name">联系电话</label>
                            <input type="text" class="form-control" name="mobile"
                                   placeholder="请输入联系电话" id="mobile">
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
                    <h4 class="modal-title">删除学校</h4>
                </div>
                <div class="modal-body">
                    <p style="color:red;">您确定要删除这个学校？请谨慎操作！</p>
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
function doFindPID(pid){
	$.ajax({
		url:ThinkPHP['MODULE']+'/Manage/city?pid='+pid,
		type:'POST',
		success: function(data) {
				  var strs= new Array(); //定义一数组 
			 	  strs=data.split("&*"); //字符分割 
			 	 document.getElementById('city').options.length=0;
			 	 document.getElementById('area').options.length=0;
			 	document.getElementById("city").options.add(new Option('--请选择--','0'));
			 	document.getElementById("area").options.add(new Option('--请选择--','0'));
				  for (i=0;i<strs.length-1 ;i++ ) 
					{ 
						 var strs2= new Array(); //定义一数组 
					    strs2=strs[i].split(",#"); //字符分割
						document.getElementById("city").options.add(new Option(strs2[1],strs2[0]));
					}
		},
	});
	
}
function doFindCID(cid){
	$.ajax({
		url:ThinkPHP['MODULE']+'/Manage/area?cid='+cid,
		type:'POST',
		success: function(data) {
				  var strs= new Array(); //定义一数组 
			 	  strs=data.split("&*"); //字符分割 
			 	 document.getElementById('area').options.length=0;
			 	document.getElementById("area").options.add(new Option('--请选择--','0'));
				  for (i=0;i<strs.length-1 ;i++ ) 
					{ 
						 var strs2= new Array(); //定义一数组 
					    strs2=strs[i].split(",#"); //字符分割
						document.getElementById("area").options.add(new Option(strs2[1],strs2[0]));
					}
		},
	});
	
}
</script>
<script type="text/javascript" src="/Public/Admin/js/school.js"></script>