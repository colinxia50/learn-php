<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="/Public/Admin/easyui/themes/bootstrap/easyui.css" />
<link rel="stylesheet" type="text/css" href="/Public/Admin/easyui/themes/icon.css" />
<link rel="stylesheet" type="text/css" href="/Public/Admin/css/login.css" />
<link rel="stylesheet" type="text/css" href="/Public/Admin/css/bootstrap.min.css" />
<link rel="stylesheet" href="/Public/Admin/assets/font-awesome/css/font-awesome.min.css">
<link rel="stylesheet" href="/Public/Admin/assets/css/form-elements.css">
<link rel="stylesheet" href="/Public/Admin/assets/css/style.css">
<meta charset="UTF-8">
<title>登陆页面</title>
</head>
<script type="text/javascript">
var ThinkPHP = {
		'ROOT' : '',
		'MODULE' : '/index.php/Admin',
		'INDEX' : '<?php echo U("Index/index");?>',
	};
</script>
<body style="height: 930px;">
<div class="row" style="margin-left: 35%;width:30%;padding-top: 650px;">
<div class="form-bottom">
	<form role="form" action="" method="post" class="login-form">
		<div class="form-group">
			<label class="sr-only" for="form-username">Username</label>
			<input id="manager" type="text" name="form-username" placeholder="账户名..." class="form-username form-control" id="form-username" style="border:5px solid purple">
		</div>
		<div class="form-group">
			<label class="sr-only" for="form-password">Password</label>
			<input id="password" type="password" name="form-password" placeholder="密码..." class="form-password form-control" id="form-password" style="border:5px solid purple">
		</div>
		<button type="button" class="btn btn-large btn-primary" id="Login" style="">登录</button>
	</form>
</div>
</div>
<!--<div id="login">-->
  <!--<p>管理员帐号:<input type="text"  id="manager" class="textbox"></p>-->
  <!--<p>管理员密码:<input type="password" id="password" class="textbox"></p>-->
<!--</div>-->

<!--<div id="btn">-->
<!--&lt;!&ndash;<a href="javascript:void()" class="easyui-linkbutton">登陆</a>&ndash;&gt;-->
<!--</div>-->
</body>
<script type="text/javascript" src="/Public/Admin/easyui/jquery.min.js"></script>
<script type="text/javascript" src="/Public/Admin/easyui/jquery.easyui.min.js"></script>
<script type="text/javascript" src="/Public/Admin/easyui/locale/easyui-lang-zh_CN.js" ></script>
<script type="text/javascript" src="/Public/Admin/js/login.js"></script>
</html>