<?php if (!defined('THINK_PATH')) exit();?><!-- 班级列表 -->
<div id="class">

    <div class="btn-group edit-top" role="group" aria-label="...">
        <a class="btn btn-default" data-toggle="modal" data-target="#addclass"><span
                class="glyphicon glyphicon-plus"></span> 缴费</a>
        <a class="btn btn-default" id="scl"><span class="glyphicon glyphicon-pencil"></span> 修改</a>
        <a class="btn btn-default" href="javascript:void(0)" id="del"><span class="glyphicon glyphicon-remove"></span>
            删除</a>
    </div>
    <div>
        <table class="table table-striped table-hover" id="childtb">
            <thead>
            <tr class="success">
                <th>编号</th>
                <th>账号</th>
                <th>学生卡号</th>
                <th>姓名</th>
                <th>性别</th>
                <th>班级</th>
                <th>学费</th>
                <th>学期</th>
                <th>状态</th>
                <th>缴费日期</th>
            </tr>
            </thead>
            <tbody>
            <?php if(is_array($fee)): $i = 0; $__LIST__ = $fee;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
                    <td style="display:none"><input type="checkbox" value="<?php echo ($vo["id"]); ?>" name="id"/></td>
                    <td><?php echo ($key+1); ?></td>
                    <td><?php echo ($vo["user"]); ?></td>
                    <td><?php echo ($vo["card"]); ?></td>
                    <td><?php echo ($vo["name"]); ?></td>
                    <td>
                        <?php if($vo["sex"] == 1): ?>男
                            <?php else: ?>
                            女<?php endif; ?>
                    </td>
                    <td><?php echo ($vo["class_name"]); ?></td>
                    <td><?php echo ($vo["fee"]); ?></td>
                    <td><?php echo ($vo["term"]); ?></td>
                    <td>
                        <?php if($vo["status"] == 0): ?><span style="color: red;">未缴费</span>
                            <?php elseif($vo["status"] == 1): ?>
                            已缴费<?php endif; ?>
                    </td>
                    <td>
                        <?php echo date('Y-m-d H:i:s',$vo['dateline']); ?>
                    </td>
                </tr><?php endforeach; endif; else: echo "" ;endif; ?>
            </tbody>
        </table>
    </div>
    <div id="page">
        <nav><?php echo ($page); ?></nav>
    </div>

    <div class="modal fade" id="addclass" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="exampleModalLabel">添加费用</h4>
                </div>
                <div class="modal-body">

                    <form>
                        <div class="form-group">
                            <label for="class" class="control-label">选择班级 :</label>

                            <select class="form-control" name="classid">
                                <option value="">请选择班级</option>
                                <?php if(is_array($Class)): $i = 0; $__LIST__ = $Class;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo["id"]); ?>"><?php echo ($vo["class_name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                            </select>

                        </div>
                        <div class="form-group">
                            <label for="term" class="control-label">选择学期:</label>
                            <select class="form-control" name="term" id="term">
                                <option value="one">第一学期</option>
                                <option value="two">第二学期</option>
                            </select>
                        </div>
                    </form>


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
                    <button type="button" class="btn btn-success" id="addCl">保存</button>
                </div>
            </div>
        </div>
    </div>


    <script type="text/javascript" src="/Public/Home/js/fee.js"></script>

</div>