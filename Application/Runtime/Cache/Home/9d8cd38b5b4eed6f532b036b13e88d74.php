<?php if (!defined('THINK_PATH')) exit();?><div class="row">
 <div class="col-md-12 ">
  <div class="add-infos">
              <ol class="breadcrumb">
			  <li>校园新闻</li>
			  <li class="active">添加新闻</li>
		     </ol> 
  <h3>添加新闻</h3>
  <form class="form-horizontal addinfos">
  <div class="form-group">
    <label for="title" class="col-sm-2 control-label">标题:</label>
    <div class="col-sm-5">
      <input type="text" class="form-control" name="title" >
    </div>
  </div>
  <div class="form-group">
    <label for="content" class="col-sm-2 control-label">内容:</label>
    <div class="col-sm-5">
      <textarea class="form-control" rows="3" name="content"></textarea>
    </div>
  </div>
  <div class="form-group">
    <label for="pic" class="col-sm-2 control-label">图片:</label>
    <div class="col-sm-5">
      <input type="file" name="file" id="file">
    </div>
  </div>

  <div class="content-thumb" style="margin:10px 0"></div>

  <div class="form-group">
    <div class="col-sm-offset-6 col-sm-4 ">
      <input type="submit" class="btn btn-default" id="fb-infos" value="发布">
    </div>
  </div>
</form>
  
  
  
  </div>
  </div>
</div>
<script type="text/javascript" src="/Public/Home/uploadify/jquery.uploadify.min.js"></script>
<script type="text/javascript" src="/Public/Home/js/infos.js"></script>
<link rel="stylesheet" type="text/css" href="/Public/Home/uploadify/uploadify.css" />
<link rel="stylesheet" type="text/css" href="/Public/Home/css/addinfos.css" />