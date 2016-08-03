<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>幼儿园</title>
<link rel="stylesheet" type="text/css" href="/zzb/Public/Home/css/bootstrap.min.css" />
<link rel="stylesheet" type="text/css" href="/zzb/Public/Home/css/basic.css" />
<link rel="stylesheet" type="text/css" href="/zzb/Public/Home/css/login.css" />
</head>
<script type="text/javascript">
var ThinkPHP = {
	'MODULE' : '/zzb/index.php/Home',
	'INDEX' : '<?php echo U("Index/index");?>',
};
</script>
<body class="loginPage">
<div id="header">
<header>
  <div class="container">
   <h1 class="sr-only">幼儿园</h1>
	<nav class="navbar login-top navbar-fixed-top">
	 <h2 class="sr-only">登陆导航</h2>
	 <div class="container-fluid">
	    <div class="navbar-header">
	      <a class="navbar-brand" href="#">
	        <img alt="图标" src="/zzb/Public/Home/image/icon2.jpg" width="45px" height="45px" style="margin-top: -10px;">
	     </a>
    </div>
  </div>
	</nav>
  </div>
</header>
</div>
<div id="login-main" class="bd">
    <div class="container">
    <div class="row">
       <div class="col-md-12 zt">
         <h3 style="color:white;font-weight: bold;">让每一个孩子从小就养成一个好习惯</h3>
       </div>
    </div>
    <div class="row">
    <div class="col-md-4 col-md-offset-4">
      <form>
        <div class="from-group a">
        <label for="inputEmail" class="sr-only">用戶名</label>
        <input type="text"  name="user" class="form-control text" placeholder="账号" required autofocus>
        </div>
        <div class="from-group a">
        <label for="inputPassword" class="sr-only">密碼</label>
        <input type="password" id="inputPassword" name="pass" class="form-control text" placeholder="密码" required>
        </div>
        <p style="margin-top:20px; display:none;color:red;" class="error">账号或者密码错误!</p>
        <a style="margin-top:20px;"class="btn btn-lg btn-primary btn-block" href="javascript:vodi(0)" id="login">登陆</a>
      </form>
      </div>
   </div>
    </div>
</div>

<div id="footer">
<footer>
<!--<nav class="nav">-->
 <!--<h2 class="sr-only">联系方式</h2>-->
   <!--<ul>-->
     <!--<li><a href="javascript:void(0)">习惯树</a></li>-->
     <!--<li><a href="javascript:void(0)">联系我们</a></li>-->
     <!--<li><a href="javascript:void(0)">招贤纳士</a></li>-->
     <!--<li><a href="javascript:void(0)">开放加盟</a></li>-->
     <!--<li><a href="javascript:void(0)">服务条款</a></li>-->
     <!--<li><a href="javascript:void(0)">隐私政策</a></li>-->
     <!--<li><a href="javascript:void(0)">合作伙伴入口</a></li>-->
   <!--</ul>-->
<!--</nav>-->
</footer>
</div>
<script type="text/javascript" src="/zzb/Public/Home/js/jquery.min.js"></script>
<script type="text/javascript" src="/zzb/Public/Home/js/login.js"></script>
</body>
</html>