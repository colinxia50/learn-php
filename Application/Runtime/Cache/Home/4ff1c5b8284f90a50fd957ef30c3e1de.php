<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>掌中宝</title>
<link rel="stylesheet" type="text/css" href="/Public/Home/css/bootstrap.min.css" />
<link rel="stylesheet" type="text/css" href="/Public/Home/css/basic.css" />
<link rel="stylesheet" type="text/css" href="/Public/Home/css/index.css" />
<link rel="shortcut icon" href="/Public/Home/img/logo.jpg" type="image/x-icon"> 
</head>
<style type="text/css">
	.success img{
		widows: 20px;
		height: 20px; 
		padding-left: 10px;
		
	}
</style>
<script type="text/javascript">
var ThinkPHP = {
	'ROOT':'',
	'MODULE' : '/index.php/Home',
	'INDEX' : '<?php echo U("Index/index");?>',
	'UPLOADIFY':'/Public/Home/uploadify',
	'IMGURL' : '<?php echo U("file/upload");?>',
	'IMGPIC' : '<?php echo U("file/pic");?>',
	'IMGPST' : '<?php echo U("file/story");?>',
	'IMGONE' : '<?php echo U("file/one");?>',
	'FACEURL' : '<?php echo U("file/face");?>',
	'BIGFACE':'<?php echo ($bigFace); ?>',
	'IMG': '/Public/Home/img',
};
</script>
<body>
<header>
  <div class="container">
   <h1 class="sr-only">幼儿园</h1>
	<nav class="navbar login-top navbar-fixed-top">
	 <h2 class="sr-only">主页面</h2>
	 <div class="container-fluid">
	    <div class="navbar-header">
	      <a class="navbar-brand" href="javascript:void(0)">
	        <img alt="logo" src="/Public/Home/img/king.png">
	     </a>
       </div>
       <p class="navbar-text navbar-right" style="padding-right:20px;"><?php echo ($School["name"]); ?></p>
       <p class="navbar-text navbar-right get-message" style="padding-right:20px;">您有<span class="badge" style="background:red;">  </span>条未读留言!</p>      
     </div>
	</nav>
  </div>
</header>

<!-- Button trigger modal -->
<div class="defaultRoute" style="display: none;"><?php echo ($defaultRoute); ?></div>
<div id="main">
	<div class="container">
		<div class="row">
			<div class="col-md-2 col-md-offset-1  left">
				<nav>
					<h2 class="sr-only">导航菜单</h2>		
					<ul class="nav mn-nav">
                     <?php echo ($menus); ?>
					</ul>
				</nav>
				<div class="user">
				    <a href="javascript:void(0)">
				    <?php if(empty($smallFace)): ?><img src="/Public/Home/img/face_growing2.jpg" alt="" class="img-rounded small-face">
				    <?php else: ?>
				       <img src="/<?php echo ($smallFace); ?>" alt="" class="img-rounded small-face"><?php endif; ?>			
					</a>					
					<span><?php echo session('user_auth.name');?></span>
					<a href="<?php echo U('Login/logout');?>" class="logout" >退出</a>
				</div>
			</div>
			<div class="col-md-9 col-md-offset-3   col-xs-9 col-xs-offset-3 right">
			   <div id="loadin">
			     <span>数据加载中,请稍后....</span>
			    <img alt="" src="/Public/Home/img/loadin.gif">
			   </div>
			   <div class="main-right"></div>
			</div>
		</div>
	</div>
	
</div>




<!-- Modal -->
<input type="hidden" name="one" value="<?php echo ($One); ?>" >
<div class="modal  bs-example-modal-sm" id="myTishi" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"><span class="glyphicon glyphicon-alert"></span> 提示</h4>
      </div>
      <div class="modal-body">
       <p></p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
      </div>
    </div>
  </div>
</div>


<!-- 加载框  提交框-->
<div class="modal fade success" data-backdrop="static" id="loading" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document" style="width:150px;height:200px;">
    <div class="modal-content ">
      <img src="/Public/Home/img/loading.gif">
      <span>数据加载中...</span>
    </div>
  </div>
</div>
<!-- 加载框  成功框-->
<div class="modal fade success" data-backdrop="static" id="success" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document" style="width:150px;height:200px;">
    <div class="modal-content ">
      <img src="/Public/Home/img/loading.gif">
      <span>数据提交成功...</span>
    </div>
  </div>
</div>
<script src="//cdn.bootcss.com/jquery/1.11.3/jquery.min.js"></script>
<script src="//cdn.bootcss.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
<script type="text/javascript" src="/Public/Home/js/bootstrapValidator.min.js"></script>
<script type="text/javascript" src="/Public/Home/js/index.js"></script>
<script>

	$('#loading,#success,#myTishi').modal('hide').css({
	'margin-top': function () {
	return $(window).height()/2-40;
    }	
    });
	$('#myTishi').modal('hide').css({
		'margin-top': function () {
		return $(window).height()/2-120;
	    }	
	});

	var habit_is_exec = false;
</script>
</body>
</html>