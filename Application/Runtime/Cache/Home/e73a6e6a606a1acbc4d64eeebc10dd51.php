<?php if (!defined('THINK_PATH')) exit();?><div class="row">
 <div class="col-md-12 ">
  <div class="account">
      <h3>账号资料</h3>
      <dl>
        <dd><p><span class="glyphicon glyphicon-user"></span> 头像:<a href="javascript:void(0)" id="edit-face">修改头像</a> </p>
        </dd>
        <dd><p><span class="glyphicon glyphicon-pencil"></span> 账号: <span class="acc-u"><?php echo ($User["user"]); ?></span></p></dd>
        <dd><p><span class="glyphicon glyphicon-phone"></span> 绑定的手机: <span class="acc-u"><?php echo ($User["mobile"]); ?></span></p></dd>
        <dd><p><span class="glyphicon glyphicon-lock"></span> 登录密码:&nbsp;&nbsp;&nbsp;<a href="javascript:void(0)" class="btn btn-info" data-toggle="modal" data-target="#mypass">修改密码</a></p></dd>
        <dd class="last"><p><span class="glyphicon glyphicon-home"></span> 幼儿园介绍:<span class="acc-u"><a class="btn btn-info" href="javascript:void(0)" data-toggle="modal" data-target="#mySchool">点击查看</a></span></p></dd>
      </dl>
  </div>
 </div>
</div>

<div class="modal fade" id="mySchool" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"><?php echo ($School["name"]); ?></h4>
      </div>
      <div class="modal-body">
 
<div>

  <!-- Nav tabs -->
  <ul class="nav nav-tabs" role="tablist">
    <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">学校介绍</a></li>
    <li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">老师介绍</a></li>
  </ul>

  <!-- Tab panes -->
  <div class="tab-content">
    <div role="tabpanel" class="tab-pane active" id="home" style="margin-top:10px;">
      <div class="media">
		  <div class="media-left">
		    <a href="javascript:void(0)">
		      <img class="media-object" src="/zzb/<?php echo ($School["cover"]); ?>" alt="">
		    </a>
		  </div>
		  <div class="media-body">
		    <p><?php echo ($School["content"]); ?></p>
            <h4>校园地址: <span class="label label-danger"><?php echo ($School["address"]); ?></span></h4>
            <h4>校园电话: <span class="label label-danger"><?php echo ($School["mobile"]); ?></span></h4>
		  </div>
	 </div>    
    </div>
    <div role="tabpanel" class="tab-pane" id="profile">
    
    
  <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
  
  <?php if(is_array($Teacher)): $i = 0; $__LIST__ = $Teacher;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?><div class="panel panel-default">
    <div class="panel-heading" role="tab" id="headingOne">
      <h4 class="panel-title">
        <a role="button" data-toggle="collapse" data-parent="#accordion" href="#<?php echo ($key); ?>" aria-expanded="true" aria-controls="collapseOne">
          <?php echo ($v["name"]); ?>----<?php echo ($v["sex"]); ?>----<?php echo ($v["class_name"]); ?>
        </a>
      </h4>
    </div>
    <div id="<?php echo ($key); ?>" class="panel-collapse collapse " role="tabpanel" aria-labelledby="headingOne">
      <div class="panel-body">
             <div class="media">
			  <div class="media-left">
			  
			  		<?php if(empty($v["face"])): ?><img src="/zzb/Public/Home/img/face_growing2.jpg" alt="" class="img-rounded small-face">
					    <?php else: ?>
					       <img src="/zzb/<?php echo ($v["face"]); ?>" alt="" class="img-rounded small-face"><?php endif; ?>		  		 
			  </div>
			  <div class="media-body">

			    <p>老师资历:<?php echo ($v["content"]); ?></p>
			    <p>联系电话: <span class="label label-danger"><?php echo ($v["mobile"]); ?></span></p>
	            <p>联系邮箱: <span class="label label-danger"><?php echo ($v["email"]); ?></span></p>
			  </div>
			</div>
     </div>
    </div>
  </div><?php endforeach; endif; else: echo "" ;endif; ?>

</div>  

    
    
    </div>
  </div>

</div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
      </div>
    </div>
  </div>
</div>





<div class="modal fade" id="mypass" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog  modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"><span class="glyphicon glyphicon-fire"></span> 修改密码</h4>
      </div>
      <div class="modal-body">
        <form class="form-horizontal save-pass" id="user_pass">
		  <div class="form-group">
		    <label for="password" class="col-sm-4 control-label">原密码</label>
		    <div class="col-sm-8">
		      <input type="password" class="form-control" name="password" autofocus="autofocus">
		    </div>
		  </div>
		  <div class="form-group">
		    <label for="newpassword" class="col-sm-4 control-label">新密码</label>
		    <div class="col-sm-8">
		      <input type="password" class="form-control" name="newpassword" >
		    </div>
		  </div>
		  <div class="form-group">
		    <label for="notpassword" class="col-sm-4 control-label">密码确认</label>
		    <div class="col-sm-8">
		      <input type="password" class="form-control" name="notpassword" >
		    </div>
		  </div>		  
       </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
        <button type="submit" class="btn btn-primary" id="edit-pass" form="user_pass">修改</button>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript" src="/zzb/Public/Home/js/account.js"></script>
<link rel="stylesheet" type="text/css" href="/zzb/Public/Home/css/account.css" />