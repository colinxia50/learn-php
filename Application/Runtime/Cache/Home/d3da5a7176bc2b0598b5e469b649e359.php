<?php if (!defined('THINK_PATH')) exit();?><div id="school">
<div class="row">
  <div class="col-md-8 col-md-offset-1" style="margin-top:30px;">
<form>
  <div class="form-group">
    <label for="name">学校名称</label>
    <input type="text" class="form-control" name="school-name" value="<?php echo ($School["name"]); ?>">
  </div>
  <div class="form-group">
    <label for="address">学校地址</label>
    <input type="text" class="form-control" name="school-address" value="<?php echo ($School["address"]); ?>">
  </div>
  <div class="form-group">
    <label for="mobile">联系电话</label>
      <input type="text" class="form-control" name="school-mobile" value="<?php echo ($School["mobile"]); ?>">
  </div>
  <div class="form-group">
    <label for="user">园长名称</label>
      <input type="text" class="form-control" name="user" value="<?php echo ($YZ); ?>" disabled>
  </div>
  <div class="form-group">
    <label for="user">校园介绍</label>
      <textarea class="form-control" rows="3" name="school-content"><?php echo ($School["content"]); ?></textarea>
  </div>
  <input type="hidden" name="cover"  value="<?php echo ($School["cover"]); ?>"/> 
  <button type="button" class="btn btn-default" id="save">修改</button>
</form>   
  </div>
  <div class="col-md-2">
     <div class="face" style="margin-top:60px;">
     <img src="/<?php echo ($School["cover"]); ?>" alt="" class="img-thumbnail" style="height:100px;width:100px;">
     </div>
     <div style="margin-top:20px;">
       <input type="file" name="file" id="file">
     </div>
  </div>
</div>
<div class="row" style="hegiht:20px;">&nbsp;</div>
<script type="text/javascript" src="/Public/Home/uploadify/jquery.uploadify.min.js"></script>
<link rel="stylesheet" type="text/css" href="/Public/Home/uploadify/uploadify.css" />
<script type="text/javascript" src="/Public/Home/js/school.js"></script>
</div>