<?php if (!defined('THINK_PATH')) exit();?>
<div class="row">
 <div class="col-md-12 ">
  <div class="opus">
			<?php if(isTeacher()): ?><ol class="breadcrumb">
					  <li>我要发稿</li>
					  <li class="active">稿件列表</li>
					  <li style="float:right;"><a href="javascript:void(0)" id="add-opus">发表稿件</a></li>
					  <?php if(isAdmin()): endif; ?>
				  </ol>
				<?php else: ?>
				<ol class="breadcrumb">
					<li>已发文章</li>
					<li class="active">文章列表</li>
				</ol><?php endif; ?>
		   <div class="list">
			<div class="row">
			 <div class="col-md-10 col-md-offset-1">
			 <div class='row'>
		<?php if(is_array($data)): $i = 0; $__LIST__ = $data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div class="col-sm-6 col-md-4">
			    <div class="thumbnail">
					<div style="text-align: right"><?php echo ($vo['create_time']); ?></div>
			      <img src="/<?php echo ($vo['opus_img'][0]['thumb']); ?>" alt="">
			      <div class="caption">
			        <h4><?php echo ($vo["name"]); ?></h4>
			        <p><?php echo ($vo["title"]); ?></p>
			        <p>
					<?php if(isStudent()): ?><a href="javascript:void(0)" class="btn btn-primary view" role="button" sid="<?php echo ($vo["id"]); ?>">支付</a>
					<?php else: ?>
						<a href="javascript:void(0)" class="btn btn-primary view" role="button" sid="<?php echo ($vo["id"]); ?>">查看</a>
						<a href="javascript:void(0)" class="btn btn-success edit" role="button" sid="<?php echo ($vo["id"]); ?>">修改</a>
						<a href="javascript:void(0)" class="btn btn-danger del" role="button" sid="<?php echo ($vo["id"]); ?>" >删除</a><?php endif; ?>
						<?php if(isAdmin()): endif; ?>
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
 <script type="text/javascript" src="/Public/Home/js/articles.js"></script>
<link rel="stylesheet" type="text/css" href="/Public/Home/css/opus.css" />