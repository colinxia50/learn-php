<?php if (!defined('THINK_PATH')) exit();?><div class="header">
    <!--<h1 class="page-header">-->
    <!--&lt;!&ndash;Dashboard <small>Welcome John Doe</small>&ndash;&gt;-->
    <!--</h1>-->
    <ol class="breadcrumb">
        <li><a href="#">习惯库</a></li>
        <li class="active">文章列表</li>
    </ol>
</div>
<div class="header">
    <p style="margin-left:20px;">
        <button class="btn btn-large btn-success" type="button" data-target="#addUser" data-toggle="modal" style="float: right;margin-right: 100px;">添加文章</button>
        <!--<span class="col-xs-4">-->
            <!--<input type="text" class="form-control" placeholder="查询账号" id="searchText">-->
        <!--</span>-->
        <!--<button class="btn btn-large btn-primary" type="button" id="search">搜索</button>-->
    </p>



    <div class="table-responsive col-xs-12" style="margin-top:10px;">
        <table class="table">
            <tr><th></th><th>标题</th><th>内容</th><th>添加日期</th><th>审核</th><th>编辑</th></tr>
            <?php if(isset($HabitData)): if(is_array($HabitData)): $i = 0; $__LIST__ = $HabitData;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
                        <?php $user_statuses=array('0'=>'待审核','1'=>'通过审核','2'=>'审核未通过'); ?>
                        <td><?php echo ($key+1); ?></td>
                        <td><?php echo ($vo["title"]); ?></td>
                        <td><?php echo (msubstr($vo["content"],0,20,'utf-8',false)); ?></td>
                        <td><?php echo ($vo["create_time"]); ?></td>
                        <td><?php echo ($user_statuses[$vo['is_pass']]); ?></td>
                        <!--0=》待审核 1=》通过审核 2=》审核失败未通过-->
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
                    <h4 class="modal-title">添加文章</h4>
                </div>
                <div class="modal-body">
                    <form role="form" id="add">
                        <!--<div class="form-group">-->
                            <!--<label for="name">标题</label>-->
                            <!--<select name="school_id">-->
                                <!--<option value="">请选择学校</option>-->
                                <!--<?php if(is_array($SchoolData)): $i = 0; $__LIST__ = $SchoolData;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>-->
                                    <!--<option value="<?php echo ($vo["id"]); ?>"><?php echo ($vo["name"]); ?></option>-->
                                <!--<?php endforeach; endif; else: echo "" ;endif; ?>-->
                            <!--</select>-->
                        <!--</div>-->
                        <!--<div class="form-group">-->
                            <!--<label for="name">内容</label>-->
                            <!--<select name="class_id">-->
                            <!--</select>-->
                        <!--</div>-->
                        <!--<div class="form-group">-->
                            <!--<label for="name">身份信息</label>-->
                            <!--<select name="group_id">-->
                                <!--<option value="">请选择身份</option>-->
                                <!--<option value="4">学生</option>-->
                                <!--<option value="3">老师</option>-->
                                <!--<option value="2">园长</option>-->
                            <!--</select>-->
                        <!--</div>-->
                        <div class="form-group">
                            <label for="title">标题</label>
                            <input type="text" class="form-control" name="title"
                                   placeholder="请输入标题">
                        </div>
                        <div class="form-group">
                            <label for="content">内容</label>
                            <!--<input type="text" class="form-control" name="content"-->
                                   <!--placeholder="请输入内容">-->
                            <textarea rows="20" cols="40" name="content" class="form-control">  </textarea>
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
                    <h4 class="modal-title">修改文章</h4>
                </div>

                <div class="modal-body">
                    <form role="form" id="edit">
                        <!--<div class="form-group">-->
                            <!--<label for="name">学校名称</label>-->
                            <!--<select name="school_id">-->
                                <!--<option value="">请选择学校</option>-->
                                <!--<?php if(is_array($SchoolData)): $i = 0; $__LIST__ = $SchoolData;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>-->
                                    <!--<option value="<?php echo ($vo["id"]); ?>"><?php echo ($vo["name"]); ?></option>-->
                                <!--<?php endforeach; endif; else: echo "" ;endif; ?>-->
                            <!--</select>-->
                        <!--</div>-->
                        <!--<div class="form-group">-->
                            <!--<label for="name">班级名称</label>-->
                            <!--<select name="class_id">-->
                            <!--</select>-->
                        <!--</div>-->
                        <!--<div class="form-group">-->
                            <!--<label for="name">身份信息</label>-->
                            <!--<select name="group_id">-->
                                <!--<option value="">请选择身份</option>-->
                                <!--<option value="4">学生</option>-->
                                <!--<option value="3">老师</option>-->
                                <!--<option value="2">园长</option>-->
                            <!--</select>-->
                        <!--</div>-->
                        <div class="form-group">
                            <label for="title">标题</label>
                            <input type="text" class="form-control" name="title"
                                   placeholder="请输入标题" id="title">
                        </div>
                        <div class="form-group">
                            <label for="content">内容</label>
                            <!--<input type="text" class="form-control" name="content"-->
                                   <!--placeholder="请输入内容" id="content">-->
                            <textarea rows="20" cols="40" name="content" id="content" class="form-control">  </textarea>
                        </div>
                        <div class="form-group">
                            <label for="is_pass">审核</label>
                            <select name="is_pass">
                                <option value="0">请选择</option>
                                <option value="1">通过</option>
                                <option value="2">不通过</option>
                            </select>
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
                    <h4 class="modal-title">删除文章</h4>
                </div>
                <div class="modal-body">
                    <p style="color:red;">您确定要删除该篇文章？请谨慎操作！</p>
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
<script type="text/javascript" src="/Public/Admin/js/article.js"></script>