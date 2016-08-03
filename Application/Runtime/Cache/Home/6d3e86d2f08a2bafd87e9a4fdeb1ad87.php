<?php if (!defined('THINK_PATH')) exit();?>     <?php if(is_array($ajaxList)): $i = 0; $__LIST__ = $ajaxList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div class="comment">
	     <div class="media" style="padding:5px;">
			  <div class="media-left">
			    <a href="javascript:void(0)">			    
			    	<?php if(empty($vo["face"])): ?><img class="media-object" src="/Public/Home/img/face_growing2.jpg" alt="">
			        <?php else: ?>
			          <img class="media-object" src="/<?php echo ($vo["face"]); ?>" alt=""><?php endif; ?>
			    </a>
			  </div>
			  <div class="media-body">
			    <h4 class="media-heading"><a href="javascript:void(0)"><?php echo ($vo["nick_name"]); ?></a></h4>
			    <p><?php echo ($vo["info"]); ?></p>
			    <div class="row">
			    <?php switch($vo["count"]): case "0": break;?>
			      <?php case "1": ?><div class="img-th" style="display:block">
						 <div class="col-xs-6 col-md-3">
						    <a href="javascript:void(0)" class="thumbnail">
						      <img src="/<?php echo ($vo['img'][0]['thumb']); ?>" >
						    </a>
						 </div>
					  </div>
						 <div class="col-xs-6 col-md-10  col-md-offset-1 img-zoom" style="display:none;">
						     <ol class="nav">
						        <li class="in"><a href="javascript:void(0)"><span class="glyphicon glyphicon-home"></span> 缩小</a></li>
						        <li class="yuantu"><a href="/<?php echo ($vo['img'][0]['source']); ?>" target="_blank"><span class="glyphicon glyphicon-new-window"></span> 查看原图</a></li>
						     </ol>
						    <a href="javascript:void(0)" class="thumbnail">
						      <img data="/<?php echo ($vo['img'][0]['unfold']); ?>" src="/Public/Home/img/loading_100.gif" >
						    </a>
					    </div><?php break;?>
			      <?php default: ?>
			         <?php $__FOR_START_398012310__=0;$__FOR_END_398012310__=$vo["count"];for($i=$__FOR_START_398012310__;$i < $__FOR_END_398012310__;$i+=1){ ?><div class="col-xs-6 col-md-3 imgs">
					    <a href="javascript:void(0)" class="thumbnail">
					      <img src="/<?php echo ($vo['img'][$i]['thumb']); ?>" unfold-src="/<?php echo ($vo['img'][$i]['unfold']); ?>" source-src="/<?php echo ($vo['img'][$i]['source']); ?>">
					    </a>
					  </div><?php } endswitch;?>
				 </div>
				<div class="footer">
				   <span class="time"><?php echo ($vo["time"]); ?></span>
				   <span class="handler">
				   <a class="btn btn-default"><i class="glyphicon glyphicon-heart" style="color:red;"></i> <span>2</span></a>
				   <a class="btn btn-default">评论</a>
				   </span>
				</div>
			  </div>
	     </div>	     
       </div><?php endforeach; endif; else: echo "" ;endif; ?>