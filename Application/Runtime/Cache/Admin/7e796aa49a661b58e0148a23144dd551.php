<?php if (!defined('THINK_PATH')) exit();?><div class="header">
    <!--<h1 class="page-header">-->
        <!--&lt;!&ndash;Dashboard <small>Welcome John Doe</small>&ndash;&gt;-->
    <!--</h1>-->
    <ol class="breadcrumb">
        <li><a href="#">系统设置</a></li>
        <li class="active">管理员管理</li>
    </ol>
</div>
<div class="header">
    <p style="margin-left:20px;">
        <button class="btn btn-large btn-success" type="button" data-target="#addadmin" data-toggle="modal" style="float: right;margin-right: 100px;">添加管理员</button>
        <span class="col-xs-4">
            <input type="text" class="form-control" placeholder="查询账号" id="searchText">
        </span>
        <button class="btn btn-large btn-primary" type="button" id="search">搜索</button>
    </p>



    <div class="table-responsive col-xs-12" style="margin-top:10px;">
        <table class="table">
            <tr><th></th><th>管理员账号</th><th>所属角色</th><th>所属管理员</th><th>注册时间</th><th>最后登录时间</th><th>最后登录IP</th><th>操作</th></tr>
            <?php if(isset($Manager)): if(is_array($Manager)): $i = 0; $__LIST__ = $Manager;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
                        <td><?php echo ($key+1); ?></td>
                        <td><?php echo ($vo["manager"]); ?></td>
                        <td><?php echo ($vo["title"]); ?></td>
                        <td><?php echo ($vo["admin"]); ?></td>
                        <td><?php echo (date('Y-m-d H:i:s',$vo["create"])); ?></td>
                        <td><?php echo (date('Y-m-d H:i:s',$vo["last_login"])); ?></td>
                        <td><?php echo ($vo["last_ip"]); ?></td>
                        <td>
                            <a data-target="#editadmin" data-toggle="modal" class="btn btn-info manage_update" href="#" xid="<?php echo ($vo["id"]); ?>">修改</a>
                            <a data-target="#deladmin"  data-toggle="modal" class="btn btn-danger manage_delete" href="#" xid="<?php echo ($vo["id"]); ?>">删除</a>
                        </td>
                    </tr><?php endforeach; endif; else: echo "" ;endif; endif; ?>
        </table>
    </div>
    <?php if(isset($searchText)): ?><div class="searchText" style="display:none;"><?php echo ($searchText); ?></div><?php endif; ?>
    <div id="page" style="text-align:center;">
        <nav><?php echo ($page); ?></nav>
    </div>

    <div class="modal" id="addadmin">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close"  data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title">添加管理员</h4>
                </div>
                <div class="modal-body">
                    <form role="form" id="add">
                        <div class="form-group">
                            <label for="name">管理员账号</label>
                            <input type="text" class="form-control" name="manager"
                                   placeholder="请输入账号">
                        </div>
                        <div class="form-group">
                            <label for="name">管理员密码</label>
                            <input type="password" class="form-control" name="password"
                                   placeholder="请输入密码">
                        </div>
                        <div class="form-group">
                            <label for="name">权限</label>
                            <select class="form-control" name="role">
                                <option value="">请选择权限</option>
                                <?php if(is_array($Access)): $i = 0; $__LIST__ = $Access;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?><option value="<?php echo ($v["id"]); ?>"><?php echo ($v["title"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="name">代理商姓名</label>
                            <input type="input" class="form-control" name="real_name"
                                   placeholder="请输入姓名">
                        </div>
                        <div class="form-group">
                            <label for="name">代理名</label>
                            <input type="input" class="form-control" name="name"
                                   placeholder="请输入代理名">
                        </div>
                        <div class="form-group">
                            <label for="name">联系电话</label>
                            <input type="input" class="form-control" name="mobile"
                                   placeholder="请输入联系电话">
                        </div>
                        <div class="form-group">
                            <label for="name">广告收入利率(单位:%)</label>
                            <input type="input" class="form-control" name="adv_coin"
                                   placeholder="利率%" style="width:100px;">
                        </div>
                        <div class="form-group">
                            <label for="name">文章利率(单位:%)</label>
                            <input type="input" class="form-control" id='article' name="article"
                                   placeholder="利率%" style="width:100px;">
                        </div>
                        <div class="form-group">
                            <label for="name">地址</label>
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
                            <label for="name">邮箱</label>
                            <input type="input" class="form-control" name="mail"
                                   placeholder="请输入邮箱">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default btn_close" data-dismiss="modal">关闭</button>
                    <button type="button" class="btn btn-primary" id="add_manager">保存</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <div class="modal" id="editadmin">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close"  data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title">修改管理员</h4>
                </div>
                <div class="modal-body">
                    <form role="form" id="edit">
                        <div class="form-group">
                            <label for="name">管理员账号</label>
                            <input type="text" class="form-control" name="manager"
                                   placeholder="请输入账号" id="manager"  disabled="disabled">
                        </div>
                        <div class="form-group">
                            <label for="name">管理员密码</label>
                            <input type="password" class="form-control" name="password"
                                   placeholder="请输入密码" id="password">
                        </div>
                        <div class="form-group">
                            <label for="name">权限</label>
                            <select class="form-control" id="role" name="role">
                                 <option value="">请选择权限</option>
                                <?php if(is_array($Access)): $i = 0; $__LIST__ = $Access;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?><option value="<?php echo ($v["id"]); ?>"><?php echo ($v["title"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="name">代理商姓名</label>
                            <input type="input" class="form-control" name="real_name"
                                   placeholder="请输入姓名" id="real_name">
                        </div>
                        <div class="form-group">
                            <label for="name">代理名</label>
                            <input type="input" class="form-control" name="name"
                                   placeholder="请输入代理名" id="name">
                        </div>
                        <div class="form-group">
                            <label for="name">联系电话</label>
                            <input type="input" class="form-control" name="mobile"
                                   placeholder="请输入联系电话" id="mobile">
                        </div>
                        <div class="form-group">
                            <label for="name">广告收入利率(单位:%)</label>
                            <input type="input" class="form-control" name="adv_coin"
                                   placeholder="利率%" style="width:100px;" id="adv_coin">
                        </div>
                        <div class="form-group">
                            <label for="name">文章利率(单位:%)</label>
                            <input type="input" class="form-control" name="article"
                                   placeholder="利率%" style="width:100px;" id="article1">
                        </div>
                        <div class="form-group">
                            <label for="name">地址</label>
                            <input type="input" class="form-control" readonly="true" name="address"
                                   placeholder="请输入地址" id="address">
                        </div>
                        <div class="form-group">
                            <label for="name">邮箱</label>
                            <input type="input" class="form-control" name="mail"
                                   placeholder="请输入邮箱" id="mail">
                        </div>
                        <input type="hidden" name="id" id="id">
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default btn_close" data-dismiss="modal">关闭</button>
                    <button type="button" class="btn btn-primary" id="up_manager">保存</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <div class="modal modal_update" id="deladmin">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title">删除管理员</h4>
                </div>
                <div class="modal-body">
                    <p style="color:red;">您确定要删除这个管理员吗？请谨慎操作！</p>
                    <input type="hidden" name="delid">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default btn_close" data-dismiss="modal">取消</button>
                    <button type="button" class="btn btn-primary" id="del">删除</button>
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
<script type="text/javascript" src="/Public/Admin/js/manage.js"></script>