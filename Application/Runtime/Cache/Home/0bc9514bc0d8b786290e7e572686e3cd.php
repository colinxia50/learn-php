<?php if (!defined('THINK_PATH')) exit();?><div class="row">
 <div class="col-md-12 ">
 <div id="avatar">
   <h3>头像设置</h3>
   <p class="face_info">请上传一张头像图片，尺寸大小不低于200px*200px</p>
     <div class="face">
     <?php if(empty($bigFace)): ?><img id="face" alt="" src="/Public/Home/img/big.jpg">
     <?php else: ?>
        <img id="face" alt="" src="/<?php echo ($bigFace); ?>"><?php endif; ?>

     <span id="preview_box" class="crop_preview"><img id="crop_preview" src="/Public/Home/img/big.jpg" /></span>
     <a href="javascript:void(0)" class="btn btn-success save" style="display:none;margin:10px 0 10px 0;">保存</a>
	 <a href="javascript:void(0)" class="btn btn-warning cancel" style="display:none;margin:10px 0 10px 0;">取消</a>
     <input type="hidden" id="x" name="x">
	 <input type="hidden" id="y" name="y">
	 <input type="hidden" id="w" name="w">
	 <input type="hidden" id="h" name="h">
	 <input type="hidden" id="url" name="url">
     <input type="file" name="file" id="file">
     </div>
 </div>
 </div>
 </div>
 <script type="text/javascript" src="/Public/Home/js/jquery-migrate-1.2.1.js"></script>
 <script type="text/javascript" src="/Public/Home/uploadify/jquery.uploadify.min.js"></script>
<script type="text/javascript" src="/Public/Home/js/jquery.Jcrop.min.js"></script>
<script type="text/javascript" src="/Public/Home/js/face.js"></script>
<link rel="stylesheet" type="text/css" href="/Public/Home/uploadify/uploadify.css" />
<link rel="stylesheet" type="text/css" href="/Public/Home/css/jquery.Jcrop.css" />
<link rel="stylesheet" type="text/css" href="/Public/Home/css/face.css" />