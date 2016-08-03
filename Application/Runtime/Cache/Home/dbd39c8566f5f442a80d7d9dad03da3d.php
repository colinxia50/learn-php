<?php if (!defined('THINK_PATH')) exit();?><div class="row">
 <div class="col-md-12 ">
  <div class="infos">

             <ol class="breadcrumb">
			  <li>校园新闻</li>
			  <li class="active">新闻列表</li>
				  <?php if(isAdmin()): ?><li style="float:right;"><a href="javascript:void(0)" id="add-infos">添加新闻</a></li><?php endif; ?>
		     </ol>

     <div class="row infos-list">
         <div class="col-md-10 col-md-offset-1"> 
                   <?php if(is_array($Infos)): $i = 0; $__LIST__ = $Infos;if( count($__LIST__)==0 ) : echo "$empty" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div class="media list-content">
						  <div class="media-left media-middle">
						    <a href="javascript:void(0)">
							    <?php if(empty($vo['infos_img'][0]['thumb'])): ?><img class="media-object" src="/zzb/Public/Home/img/book.jpg" alt="">
						        <?php else: ?>
								  <img class="media-object" src="/zzb/<?php echo ($vo['infos_img'][0]['thumb']); ?>" alt=""><?php endif; ?>
						    </a>
						  </div>
						  <div class="media-body">
						    <h4 class="media-heading"><?php echo ($vo["title"]); ?></h4>
						    <p><?php echo ($vo["content"]); ?></p>
						    <span class="tt">发布时间:<?php echo ($vo["time"]); ?></span>
						  </div>
					   <?php if(isAdmin()): ?><span class="infos-close" ><a data-toggle="tooltip" iid="<?php echo ($vo["id"]); ?>" class="del" data-placement="left" title="删除新闻">&times;</a></span>
					   <span class="infos-edit" ><a data-toggle="tooltip" iid="<?php echo ($vo["id"]); ?>" class="edit" data-placement="left" title="修改新闻">√</a></span><?php endif; ?>
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

 
 <script type="text/javascript" src="/zzb/Public/Home/js/infos.js"></script>
<link rel="stylesheet" type="text/css" href="/zzb/Public/Home/css/infos.css" />