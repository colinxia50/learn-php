<?php if (!defined('THINK_PATH')) exit();?><div class="row">
    <div class="col-md-12 ">
        <div class="add-opus">
            <ol class="breadcrumb">
                <li>宝宝作品</li>
                <li class="active">添加宝宝作品</li>
            </ol>
            <h3>添加宝宝作品</h3>
            <form class="form-horizontal addopus">
                <div class="form-group">
                    <label for="class" class="col-sm-2 control-label">选择班级:</label>
                    <div class="col-sm-5">
                        <select class="form-control" name="class">
                            <option value="">请选择班级</option>
                            <?php if(is_array($Class)): $i = 0; $__LIST__ = $Class;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo["id"]); ?>"><?php echo ($vo["class_name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="child" class="col-sm-2 control-label">选择学生:</label>
                    <div class="col-sm-5">
                        <select class="form-control" name="child"></select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="title" class="col-sm-2 control-label">标题:</label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" name="title" required="required">
                    </div>
                </div>
                <div class="form-group">
                    <label for="content" class="col-sm-2 control-label">内容:</label>
                    <div class="col-sm-5">
                        <textarea class="form-control" rows="3" name="content"
                                  style="resize: none;width:600px;height:400px;"></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label for="pic" class="col-sm-2 control-label">上传图片:</label>
                    <div class="col-sm-5">
                        <input type="file" name="file" id="file">
                    </div>
                </div>

                <div class="content-thumb" style="margin:10px 0"></div>

                <div class="form-group">
                    <div class="col-sm-offset-6 col-sm-4 ">
                        <input type="submit" class="btn btn-default" id="fb-opus" value="发布">
                    </div>
                </div>
            </form>


        </div>
    </div>
</div>
<script type="text/javascript" src="/Public/Home/uploadify/jquery.uploadify.min.js"></script>
<script type="text/javascript" src="/Public/Home/js/addopus.js"></script>
<link rel="stylesheet" type="text/css" href="/Public/Home/uploadify/uploadify.css"/>
<style>
    .add-opus {
        background: #fff;
        border-radius: 4px;
        min-height: 600px;
        margin-top: 20px;
    }

    .add-opus h3 {
        padding-left: 139px;
        font-weight: bold;
        height: 50px;
        line-height: 50px;
        color: #a8a8a8;
    }
</style>