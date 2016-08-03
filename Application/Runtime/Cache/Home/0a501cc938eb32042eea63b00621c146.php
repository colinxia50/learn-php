<?php if (!defined('THINK_PATH')) exit();?><div class="row">
 <div class="col-md-12 ">
  <div class="infos">

             <ol class="breadcrumb">
			  <li>习惯稿件</li>
			  <li class="active">稿件列表</li>

				  <li style="float:right;"><a href="javascript:void(0)" id="add-infos">我要发言</a></li>
				  <?php if(isAdmin()): endif; ?>
		     </ol>

     <div class="row infos-list">
         <div class="col-md-10 col-md-offset-1"> 
                   <?php if(is_array($Infos)): $i = 0; $__LIST__ = $Infos;if( count($__LIST__)==0 ) : echo "$empty" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div class="media list-content">
						  <div class="media-left media-middle">
						    <a href="javascript:void(0)">
							    <?php if(empty($vo['img'][0]['thumb'])): ?><img class="media-object" src="/Public/Home/img/book.jpg" alt="">
						        <?php else: ?>
								  <img class="media-object" src="/<?php echo ($vo['img'][0]['thumb']); ?>" alt="" style="width:119px;height: 89px;"><?php endif; ?>
						    </a>
						  </div>
						  <div class="media-body">
						    <p><?php echo ($vo["title"]); ?></p>
							  <?php echo ($vo["pass_status"]); ?><span class="tt">审核状态：</span>
						    <p style="font-size:11px;">学生：<?php echo ($vo["student"]); ?></p>
						    <span class="tt">发布时间:<?php echo ($vo["create_time"]); ?></span>
							  <p style="color:grey;font-size:10px;"><?php echo ($vo["content"]); ?></p>
						  </div>
					   <!--<?php if(isAdmin()): ?>-->
					   <!--<span class="infos-close" ><a data-toggle="tooltip" iid="<?php echo ($vo["id"]); ?>" class="del" data-placement="left" title="删除新闻">&times;</a></span>-->
					   <!--<span class="infos-edit" ><a data-toggle="tooltip" iid="<?php echo ($vo["id"]); ?>" class="edit" data-placement="left" title="修改新闻">√</a></span>-->
					   <!--<?php endif; ?>-->
					  </div><?php endforeach; endif; else: echo "$empty" ;endif; ?>	
			 <div id="page" style="text-align:center;">
				 <nav><?php echo ($page); ?></nav>
			 </div>			               
            </div>
         </div>
     </div>
  </div>
  </div>
  <script>
  $(function () {
	  $('[data-toggle="tooltip"]').tooltip()
	}) 
  </script>
<script type="text/javascript" src="/Public/Home/uploadify/jquery.uploadify.min.js"></script>
<link rel="stylesheet" type="text/css" href="/Public/Home/uploadify/uploadify.css"/>
 <script type="text/javascript" src="/Public/Home/js/pass.js"></script>
<link rel="stylesheet" type="text/css" href="/Public/Home/css/infos.css" />