<?php if (!defined('THINK_PATH')) exit();?><div class="row">
 <div class="col-md-12 ">
  <div class="message">

 
  <div class="set-message">
     <div class="set-user">对 <a href="javascript:void(0)" data-toggle="modal" data-target="#myUser" class="xz-all-user">选择收件人</a> 发送留言</div>
     <div><textarea class="set-info" name="message"></textarea></div>
     <input type="hidden" name="cid" />
     <div class="set-btn"><a class="btn btn-info" id="fb-message">发布</a></div>
  </div>
 <div class="message-nav">
  <!-- Nav tabs -->
  <ul class="nav nav-tabs" role="tablist" id="navv">
    <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab" iid="1">我收到的留言</a></li>
    <li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab" iid="2">我发送的留言</a></li>
  </ul>

  <!-- Tab panes -->
  <div class="tab-content">
    <div role="tabpanel" class="tab-pane active" id="home"></div>
    <div role="tabpanel" class="tab-pane" id="profile"></div>
  </div>

</div> 
  
  </div>
  </div>
  </div>

<div class="modal fade" id="myUser" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">选择用户</h4>
      </div>
      <div class="modal-body">
        <div class="container-fluid">
           <div class="row">
               <div class="col-md-2 xzus xzus-a" >
                  <div class="xz-class">
                    <p>选择班级--</p>
                    <?php if(is_array($Class)): $i = 0; $__LIST__ = $Class;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><a href="javascript:void(0)" iid="<?php echo ($vo["id"]); ?>"><?php echo ($vo["class_name"]); ?></a><?php endforeach; endif; else: echo "" ;endif; ?>                 
                  </div>
               </div>
               <div class="col-md-3 xzus" >
                  <div class="xz-user">
	                <a>选择用户--</a>                 
                  </div>               
               </div>
               <div class="col-md-6  col-md-offset-1 xzus" >
                 <div class="xz-all"></div>
               </div>
           </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
        <button type="button" class="btn btn-success" id="xzstu">选择</button>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript" src="/Public/Home/js/message.js"></script>
<link rel="stylesheet" type="text/css" href="/Public/Home/css/message.css" />