<?php if (!defined('THINK_PATH')) exit();?><div class="header">
    <!--<h1 class="page-header">-->
        <!--&lt;!&ndash;Dashboard <small>Welcome John Doe</small>&ndash;&gt;-->
    <!--</h1>-->
    <ol class="breadcrumb">
        <li><a href="#">会员管理</a></li>
        <li class="active">会员列表</li>
    </ol>
</div>
<div class="header">
    <p style="margin-left:20px;">
        <button class="btn btn-large btn-success" type="button" data-target="#addUser" data-toggle="modal" style="float: right;margin-right: 100px;">添加会员</button>
        <span class="col-xs-4">
            <input type="text" class="form-control" placeholder="查询账号" id="searchText">
        </span>
        <button class="btn btn-large btn-primary" type="button" id="search">搜索</button>
    </p>



    <div class="table-responsive col-xs-12" style="margin-top:10px;">
        <table class="table">
            <tr><th></th><th>用户名</th><th>用户类型</th><th>学校名称</th><th>班级名称</th><th>注册时间</th><th>最后登录时间</th><th>最后登录IP</th><th>操作</th></tr>
            <?php if(isset($User)): if(is_array($User)): $i = 0; $__LIST__ = $User;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
                        <td><?php echo ($key+1); ?></td>
                        <td><?php echo ($vo["user"]); ?></td>
                        <td><?php echo ($vo["group"]); ?></td>
                        <td><?php echo ($vo["school"]); ?></td>
                        <td><?php echo ($vo["class"]); ?></td>
                        <td><?php echo ($vo["reg_time"]); ?></td>
                        <td><?php echo ($vo["last_login"]); ?></td>
                        <td><?php echo ($vo["last_ip"]); ?></td>
                        <td>
                            <a data-target="#editUser" data-toggle="modal" class="btn btn-info User_update" href="#" xid="<?php echo ($vo["id"]); ?>">修改</a>
                            <a data-target="#delUser"  data-toggle="modal" class="btn btn-danger User_delete" href="#" xid="<?php echo ($vo["id"]); ?>">删除</a>
                        </td>
                    </tr><?php endforeach; endif; else: echo "" ;endif; endif; ?>
        </table>
    </div>
    <?php if(isset($searchText)): ?><div class="searchText" style="display:none;"><?php echo ($searchText); ?></div><?php endif; ?>
    <div id="page" style="text-align:center;">
        <nav><?php echo ($page); ?></nav>
    </div>

    <div class="modal" id="addUser">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close"  data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title">添加会员</h4>
                    <h6 style="color:red">默认密码为：123456</h6>
                </div>
                <div class="modal-body">
                    <form role="form" id="add">
                        <div class="form-group">
                            <label for="name">学校名称</label>
                            <select name="school_id">
                                <option value="">请选择学校</option>
                                <?php if(is_array($SchoolData)): $i = 0; $__LIST__ = $SchoolData;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo["id"]); ?>"><?php echo ($vo["name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="name">班级名称</label>
                            <select name="class_id">
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="name">身份信息</label>
                            <select name="group_id" id="group_id">
                                <option value="">请选择身份</option>
                                <option value="4">学生</option>
                                <option value="3">老师</option>
                                <option value="2">园长</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="name">用户名</label>
                            <input type="text" class="form-control" name="user"
                                   placeholder="请输入用户名">
                        </div>
                        <div class="form-group">
                            <label for="name">昵称</label>
                            <input type="text" class="form-control" name="nick_name"
                                   placeholder="请输入用户名">
                        </div>
                        <div class="form-group">
                            <label for="name">手机号</label>
                            <input type="text" class="form-control" name="mobile"
                                   placeholder="请输入手机号">
                        </div>
                        <div class="form-group">
                            <label for="name">电子邮箱</label>
                            <input type="text" class="form-control" name="email"
                                   placeholder="请输入电子邮箱">
                        </div>
                        <div class="form-group">
                            <label for="name">性别</label>
                            <input type="radio" name="sex" value="0">女
                            <input type="radio" name="sex" value="1">男
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default btn_close" data-dismiss="modal">关闭</button>
                    <button type="button" class="btn btn-primary" id="add_User">保存</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <div class="modal" id="editUser">
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
                            <select name="school_id">
                                <option value="">请选择学校</option>
                                <?php if(is_array($SchoolData)): $i = 0; $__LIST__ = $SchoolData;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo["id"]); ?>"><?php echo ($vo["name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="name">班级名称</label>
                            <select name="class_id">
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="name">身份信息</label>
                            <select name="group_id" id="edit_group">
                                <option value="">请选择身份</option>
                                <option value="4">学生</option>
                                <option value="3">老师</option>
                                <option value="2">园长</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="name">用户名</label>
                            <input type="text" class="form-control" name="user"
                                   placeholder="请输入用户名" id="user">
                        </div>
                        <div class="form-group">
                            <label for="name">昵称</label>
                            <input type="text" class="form-control" name="nick_name"
                                   placeholder="请输入昵称" id="nick_name">
                        </div>
                        <div class="form-group">
                            <label for="name">手机号</label>
                            <input type="text" class="form-control" name="mobile"
                                   placeholder="请输入手机号" id="mobile">
                        </div>
                        <div class="form-group">
                            <label for="name">电子邮箱</label>
                            <input type="text" class="form-control" name="email"
                                   placeholder="请输入电子邮箱" id="email">
                        </div>
                        <div class="form-group">
                            <label for="name">性别</label>
                            <input type="radio" name="sex" value="0">女
                            <input type="radio" name="sex" value="1">男
                        </div>
                        <input type="hidden" name="id">
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default btn_close" data-dismiss="modal">关闭</button>
                    <button type="button" class="btn btn-primary" id="edit_User">保存</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>

    <div class="modal modal_update" id="delUser">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title">删除会员</h4>
                </div>
                <div class="modal-body">
                    <p style="color:red;">您确定要删除这个会员？请谨慎操作！</p>
                    <input type="hidden" name="delid">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default btn_close" data-dismiss="modal">取消</button>
                    <button type="button" class="btn btn-primary" id="del_User">删除</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>

</div>
<script type="text/javascript" src="/Public/Admin/js/user.js"></script>