<?php if (!defined('THINK_PATH')) exit();?><div class="row">
 <div class="col-md-12 ">
  <div class="edit-opus">
              <ol class="breadcrumb">
			  <li>我要发稿</li>
			  <li class="active">修改稿件</li>
		     </ol> 
  <h3>修改稿件</h3>
  <form class="form-horizontal editopus">
  <div class="form-group">
    <label for="class" class="col-sm-2 control-label">学生班级:</label>
    <div class="col-sm-5">
       <p class="form-control-static"><?php echo ($Opus["class_name"]); ?></p>
   </div>
  </div> 
  <div class="form-group">
    <label for="child" class="col-sm-2 control-label">学生姓名:</label>
    <div class="col-sm-5">
       <p class="form-control-static"><?php echo ($Opus["student_name"]); ?></p>
   </div>
  </div> 
  <div class="form-group">
    <label for="title" class="col-sm-2 control-label">标题:</label>
    <div class="col-sm-5">
      <input type="text" class="form-control" name="title" value="<?php echo ($Opus["title"]); ?>" >
    </div>
  </div> 
  <div class="form-group">
    <label for="content" class="col-sm-2 control-label">内容:</label>
    <div class="col-sm-5">
      <textarea class="form-control" rows="3" name="content" style="resize: none;width:600px;height:400px;"><?php echo ($Opus["content"]); ?></textarea>
    </div>
  </div> 
  <div class="form-group">
    <label for="pic" class="col-sm-2 control-label">上传图片:</label>
    <div class="col-sm-5">
      <input type="file" name="file" id="file">
    </div>
  </div>

    <div class="content-thumb" style="margin:10px 0">
     <?php if(is_array($Opus["img"])): $i = 0; $__LIST__ = $Opus["img"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div class='content-thumb-pic'>
          <input type='hidden' name='images' class='imagess' value='<?php echo ($vo["json"]); ?>'/>
          <img src="/<?php echo ($vo["thumb"]); ?>" alt='图片' class='img-thumbnail growing-img'>
          <span class='color'></span>
          <span class='zt'>删除</span>
          </div><?php endforeach; endif; else: echo "" ;endif; ?>
    </div>

  <div class="form-group">
    <div class="col-sm-offset-6 col-sm-4 ">
      <input type="hidden" name="classid" value="<?php echo ($Opus["class_id"]); ?>">
      <input type="hidden" name="id" value="<?php echo ($Opus["id"]); ?>">
      <input type="hidden" name="count" value="<?php echo ($Opus["count"]); ?>">
      <input type="submit" class="btn btn-default" id="edit-opus" value="修改">
    </div>
  </div>
</form>
  
  
  
  </div>
  </div>
</div>
<script type="text/javascript" src="/Public/Home/uploadify/jquery.uploadify.min.js"></script>
<script type="text/javascript" src="/Public/Home/js/editarticles.js"></script>
<link rel="stylesheet" type="text/css" href="/Public/Home/uploadify/uploadify.css" />
<style>
.edit-opus{
	background:#fff;
	border-radius:4px;
	min-height:600px;
	margin-top:20px;
}
.edit-opus h3{
	padding-left:139px;
	font-weight:bold;
	height:50px;
	line-height:50px;
	color:#a8a8a8;
}
</style>