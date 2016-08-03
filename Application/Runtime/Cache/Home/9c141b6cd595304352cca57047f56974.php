<?php if (!defined('THINK_PATH')) exit();?><div class="row">
 <div class="col-md-12 ">
  <div class="add-infos">
              <ol class="breadcrumb">
			  <li>校园新闻</li>
			  <li class="active">修改新闻</li>
		     </ol> 
  <h3>修改新闻</h3>
  <form class="form-horizontal editinfos">
  <div class="form-group">
    <label for="title" class="col-sm-2 control-label">标题:</label>
    <div class="col-sm-5">
      <input type="text" class="form-control" name="title" value="<?php echo ($Infos["title"]); ?>" >
    </div>
  </div>
  <div class="form-group">
    <label for="content" class="col-sm-2 control-label">内容:</label>
    <div class="col-sm-5">
      <textarea class="form-control" rows="3" name="content"><?php echo ($Infos["content"]); ?></textarea>
    </div>
  </div>
  <div class="form-group">
    <label for="pic" class="col-sm-2 control-label">图片:</label>
    <div class="col-sm-5">
      <input type="file" name="file" id="file">
    </div>
  </div>

  <div class="content-thumb" style="margin:10px 0">
     <?php if(is_array($Infos["infos_img"])): $i = 0; $__LIST__ = $Infos["infos_img"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div class='content-thumb-pic'>
          <input type='hidden' name='images' class='imagess' value='<?php echo ($vo["data"]); ?>'/>
          <img src="/<?php echo ($vo["thumb"]); ?>" alt='图片' class='img-thumbnail growing-img'>
          <span class='color'></span>
          <span class='zt'>删除</span>
          </div><?php endforeach; endif; else: echo "" ;endif; ?>
  </div>
  <div class="form-group">
    <div class="col-sm-offset-6 col-sm-4 ">
      <input type="hidden" name="count" value="<?php echo ($Infos["count"]); ?>">
      <input type="hidden" name="id" value="<?php echo ($Infos["id"]); ?>">
      <input type="submit" class="btn btn-default" id="edit-infos" value="发布">
    </div>
  </div>
</form>
  
  
  
  </div>
  </div>
</div>
<script type="text/javascript" src="/Public/Home/uploadify/jquery.uploadify.min.js"></script>
<script type="text/javascript" src="/Public/Home/js/editinfos.js"></script>
<link rel="stylesheet" type="text/css" href="/Public/Home/uploadify/uploadify.css" />
<link rel="stylesheet" type="text/css" href="/Public/Home/css/addinfos.css" />