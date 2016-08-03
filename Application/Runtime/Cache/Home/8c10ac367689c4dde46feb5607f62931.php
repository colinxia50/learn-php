<?php if (!defined('THINK_PATH')) exit();?><div class="row">
<div class="growing">
 <div class="col-md-1">
  <?php if(empty($bigFace)): ?><img src="/Public/Home/img/face_growing2.jpg" alt="头像" class="img-rounded face">  
  <?php else: ?>
  <img src="/<?php echo ($bigFace); ?>" alt="头像" class="img-rounded face"><?php endif; ?>

 </div>
 <div class="col-md-10 col-md-offset-1">
   <div class="content">
      <textarea class="info" rows="3" id="info" name="info"></textarea>
      <div class="content-pic" style="display:none;">
         <input type="file" name="file" id="file">
      </div>
	      <div class="alert alert-warning alert-dismissible mesg" style="display:none" role="alert">
	      <strong>图片限制!</strong> 
	                    最多可上传<span class="all"style="font-size:20px;"> 6 </span>
	                    张图片,您现在以上传<em class="min" style="font-size:20px;padding:0 5px;">0</em>张
	      ,还能上传<em class="max" style="font-size:20px;padding:0 5px;">6</em>张图片
	      </div>
      <div class="content-thumb" style="margin:10px 0"></div><!-- DOM加载缩略图 -->
      <div class="content-fb">
       <a href="javascript:void(0)" class="btn btn-success fb-left xzchild" data-toggle="modal" data-target="#myStudent">选择学生  <span class="glyphicon glyphicon-plus"></span></a>
       <input type="hidden" name="allStu"/>     
       <a href="javascript:void(0)" class="btn btn-warning fb-right"  id="fbch">发布</a>
       </div>
   </div>
   <div class="list">
   
     <!-- 动态插入节点 -->
     <span class="z"></span>
     
     <?php if(is_array($Growing)): $i = 0; $__LIST__ = $Growing;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div class="comment">
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
			         <?php $__FOR_START_261764354__=0;$__FOR_END_261764354__=$vo["count"];for($i=$__FOR_START_261764354__;$i < $__FOR_END_261764354__;$i+=1){ ?><div class="col-xs-6 col-md-3 imgs">
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
       
       <div id="loadmore">加载更多<img alt="加载更多" src="/Public/Home/img/loadmore.gif"></div>
<!-- Modal  -->
<div class="modal" id="imgs" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" >
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">图片查看</h4>
      </div>
      <div class="modal-body img-con">
        <a href="javascript:void(0)" target="_blank">
        <img src="/Public/Home/img/loading_100.gif" alt="图片">
        </a>
      </div>
    </div>
  </div>
</div>    
      
       <!-- 无配图ajax加载 -->
       <div id="ajax-html1" style="display:none">
        <div class="comment">
	     <div class="media" style="padding:5px;">
			  <div class="media-left">
			    <a href="javascript:void(0)">			    
			    	<?php if(empty($smallFace)): ?><img src="/Public/Home/img/face_growing2.jpg" alt="" class="media-object">
				    <?php else: ?>
				       <img src="/<?php echo ($smallFace); ?>" alt="" class="img-rounded small-face"><?php endif; ?>				    			    		
			    </a>
			  </div>
			  <div class="media-body">
			    <h4 class="media-heading"><a href="javascript:void(0)"><?php echo ($_SESSION['user_auth']['name']); ?></a></h4>
			    <p>#内容#</p>
				<div class="footer">
				   <span class="time">刚刚发布</span>
				   <span class="handler">
				   <a class="btn btn-default"><i class="glyphicon glyphicon-heart" style="color:red;"></i> <span>0</span></a>
				   <a class="btn btn-default">评论</a>
				   </span>
				</div>
			  </div>
	     </div>	     
        </div>            
       </div>
   
       <!-- 一张配图ajax加载 -->
       <div id="ajax-html2" style="display:none">
        <div class="comment">
	     <div class="media" style="padding:5px;">
			  <div class="media-left">
			    <a href="javascript:void(0)">			    
			    	<?php if(empty($smallFace)): ?><img src="/Public/Home/img/face_growing2.jpg" alt="" class="media-object">
				    <?php else: ?>
				       <img src="/<?php echo ($smallFace); ?>" alt="" class="img-rounded small-face"><?php endif; ?>
			    </a>
			  </div>
			  <div class="media-body">
			    <h4 class="media-heading"><a href="javascript:void(0)"><?php echo ($_SESSION['user_auth']['name']); ?></a></h4>
			    <p>#内容#</p>
			    <div class="row">
			    	<div class="img-th" style="display:block">
						 <div class="col-xs-6 col-md-3">
						    <a href="javascript:void(0)" class="thumbnail">
						      <img src="#缩略图#" >
						    </a>
						 </div>
					 </div>
					 <div class="col-xs-6 col-md-10  col-md-offset-1 img-zoom" style="display:none;">
						     <ol class="nav">
						        <li class="in"><a href="javascript:void(0)"><span class="glyphicon glyphicon-home"></span> 缩小</a></li>
						        <li class="yuantu"><a href="#原图#" target="_blank"><span class="glyphicon glyphicon-new-window"></span> 查看原图</a></li>
						     </ol>
						    <a href="javascript:void(0)" class="thumbnail">
						      <img data="#放大图#" src="/Public/Home/img/loading_100.gif" >
						    </a>
					  </div>			    
			    </div>
				<div class="footer">
				   <span class="time">刚刚发布</span>
				   <span class="handler">
				   <a class="btn btn-default"><i class="glyphicon glyphicon-heart" style="color:red;"></i> <span>0</span></a>
				   <a class="btn btn-default">评论</a>
				   </span>
				</div>
			  </div>
	     </div>	     
        </div>            
       </div>
   
        <!-- 多配图ajax加载 -->
       <div id="ajax-html3" style="display:none">
        <div class="comment">
	     <div class="media" style="padding:5px;">
			  <div class="media-left">
			    <a href="javascript:void(0)">			    
			    	<?php if(empty($smallFace)): ?><img src="/Public/Home/img/face_growing2.jpg" alt="" class="media-object">
				    <?php else: ?>
				       <img src="/<?php echo ($smallFace); ?>" alt="" class="img-rounded small-face"><?php endif; ?>
			    </a>
			  </div>
			  <div class="media-body">
			    <h4 class="media-heading"><a href="javascript:void(0)"><?php echo ($_SESSION['user_auth']['name']); ?></a></h4>
			    <p>#内容#</p>
			    <div class="row"></div>
				<div class="footer">
				   <span class="time">刚刚发布</span>
				   <span class="handler">
				   <a class="btn btn-default"><i class="glyphicon glyphicon-heart" style="color:red;"></i> <span>0</span></a>
				   <a class="btn btn-default">评论</a>
				   </span>
				</div>
			  </div>
	     </div>	     
        </div>            
       </div>
 
 
       
   </div>
 </div>
 </div>
</div>
<!-- Modal -->
<div class="modal fade" id="myStudent" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">选择学生</h4>
      </div>
      <div class="modal-body">
        <div class="container-fluid">
          <div class="row cls" >
            <div class="col-md-4">
            <select class="form-control" id="ClassStu">
              <option>--请选择班极--</option>
              <?php if(is_array($Class)): $i = 0; $__LIST__ = $Class;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo["id"]); ?>"><?php echo ($vo["class_name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
            </select></div>
            <div class="col-md-2"><a class="btn btn-default" id="quan" n="1">全选</a></div>
          </div>
          <div class="row std">
          <!-- 动态添加学生列表-->          
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
<script type="text/javascript" src="/Public/Home/uploadify/jquery.uploadify.min.js"></script>
<script type="text/javascript" src="/Public/Home/js/jquery.scrollUp.js"></script>
<script type="text/javascript" src="/Public/Home/js/growing.js"></script>
<link rel="stylesheet" type="text/css" href="/Public/Home/css/growing.css" />
<link rel="stylesheet" type="text/css" href="/Public/Home/uploadify/uploadify.css" />