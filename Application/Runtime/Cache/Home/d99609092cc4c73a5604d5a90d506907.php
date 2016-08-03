<?php if (!defined('THINK_PATH')) exit();?>
<div class="row">
 <div class="col-md-12 ">
  <div class="opus">

             <ol class="breadcrumb">
			  <li>宝宝作品</li>
			  <li class="active">宝宝作品列表</li>
				  <?php if(isAdmin()): ?><li style="float:right;"><a href="javascript:void(0)" id="add-opus">添加宝宝作品</a></li><?php endif; ?>
		     </ol>
		   <div class="list">
			<div class="row">
			 <div class="col-md-10 col-md-offset-1">
			 <div class='row'>
		<?php if(is_array($Opus)): $i = 0; $__LIST__ = $Opus;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div class="col-sm-6 col-md-4">
			    <div class="thumbnail">
			      <img src="/<?php echo ($vo['opus_img'][0]['thumb']); ?>" alt="">
			      <div class="caption">
			        <h4><?php echo ($vo["name"]); ?></h4>
			        <p><?php echo ($vo["title"]); ?></p>
			        <p>
			        <a href="javascript:void(0)" class="btn btn-primary view" role="button" sid="<?php echo ($vo["id"]); ?>">查看</a>
			        <?php if(isAdmin()): ?><a href="javascript:void(0)" class="btn btn-success edit" role="button" sid="<?php echo ($vo["id"]); ?>">修改</a>
			        <a href="javascript:void(0)" class="btn btn-danger del" role="button" sid="<?php echo ($vo["id"]); ?>" >删除</a><?php endif; ?>
			        </p>
			      </div>
			    </div>
			  </div><?php endforeach; endif; else: echo "" ;endif; ?>
         </div>			  
       </div>			  		  
			</div>
		   </div>  
		   
		   	  <div id="page" style="text-align:center;">
				 <nav><?php echo ($page); ?></nav>
			 </div>	
		   
		   
   </div>
   </div>
</div>		     
 <script type="text/javascript" src="/Public/Home/js/opus.js"></script>
<link rel="stylesheet" type="text/css" href="/Public/Home/css/opus.css" />