<?php if (!defined('THINK_PATH')) exit();?><div class="row">
 <div class="col-md-12">
  <div class="manage">
     <h4><span class="glyphicon glyphicon-wrench"></span> 校园设置
     <span class="manage-right">(园长):<?php echo session('user_auth.name');?></span></h4>
     <ul class="nav nav-tabs" id="myTabs">
	  <li role="presentation" class="active"><a href="#" sf="1">展示</a></li>
	  <li role="presentation"><a href="#" sf="2">求知</a></li>
    </ul>
     <div class="conn">
     		     <div id="member">
		      <div class="row">

		        <!-- 动态加载学生表和老师表 -->
		       <div class="col-md-10 tabcon">
			       <div id="tabcon-loading" style="position:relative;display:none;">
				     <span style="font-size:20px;position:absolute;top:115px;left:200px;">数据加载中,请稍后....</span>
				    <img alt="" src="/Public/Home/img/loadin.gif" style="display:block;width:300px;height:250px;position:absolute;top:0;left:0;">
				   </div>
				   <div class="main-tabcon"></div>
		       </div>
		      </div>
		     </div>


	   <div id="class-loading" style="position:relative;display:none;'">
		<span style="font-size:20px;position:absolute;top:115px;left:400px;">数据加载中,请稍后....</span>
		<img alt="" src="/Public/Home/img/loadin.gif" style="display:block;width:300px;height:250px;position:absolute;top:0;left:200px;">
	   </div>
	</div>
  </div>
 </div>
</div>



<script type="text/javascript" src="/Public/Home/js/show.js"></script>
<link rel="stylesheet" type="text/css" href="/Public/Home/css/manage.css" />