<?php if (!defined('THINK_PATH')) exit();?><div class="row">
 <div class="col-md-12 ">
  <div class="infos">

             <ol class="breadcrumb">
			  <li>我的积分</li>
			  <li class="active">积分列表</li>
		     </ol>

     <div class="row infos-list">
         <div class="col-md-10 col-md-offset-1"> 
                   <?php if(is_array($record)): $i = 0; $__LIST__ = $record;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div class="media list-content">
						  <div class="media-left media-middle">
						  
							      <?php if($vo["is_do"] == Y): ?><img class="media-object" src="/zzb/Public/Home/img/true.png" alt="" width="300">
						        <?php else: ?>
								  <img class="media-object" src="/zzb/Public/Home/img/false.png" alt="" width="300"><?php endif; ?>
						  </div>
						  <div class="media-body">
						    <h4 class="media-heading">
						     <?php if($vo["is_do"] == Y): ?><img class="media-object" src="/zzb/Public/Home/img/80.png" alt="" width="100">
						        <?php else: ?>
								  <img class="media-object" src="/zzb/Public/Home/img/0.png" alt="" width="100"><?php endif; ?>
						    
						    </h4>
						    <span class="tt">发布时间:<?php echo ($vo["time"]); ?></span>
					  </div><?php endforeach; endif; else: echo "" ;endif; ?>	
			 <div id="page" style="text-align:center;">
				 <?php echo ($page); ?>
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