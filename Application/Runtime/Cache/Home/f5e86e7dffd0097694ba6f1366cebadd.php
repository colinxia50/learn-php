<?php if (!defined('THINK_PATH')) exit();?><div class="row">
 <div class="col-md-12 ">
  <div class="view-opus">
              <ol class="breadcrumb">
			  <li>查看稿件</li>
			  <li class="active">查看详情</li>
		     </ol> 
   <div class="view">
         <h3><?php echo ($Opus["title"]); ?></h3> 
         <p class="time"><?php echo ($Opus["create_time"]); ?> ---- 来源:<?php echo ($Opus["name"]); ?></p>
         
  <div id="demo1" class="slideBox">
    <ul class="items">
    <?php if(is_array($Opus["img"])): $i = 0; $__LIST__ = $Opus["img"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li><a href="/<?php echo ($vo["source"]); ?>" target="_blank"><img src="/<?php echo ($vo["unfold"]); ?>"></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
  </ul>
  </div>                                           
   <p class="content"><span>介绍:</span><?php echo ($Opus["content"]); ?></p>  
   </div >
  
  </div>
  </div>
</div>


 <script type="text/javascript" src="/Public/Home/js/jquery.slideBox.min.js"></script>
  <script type="text/javascript" src="/Public/Home/js/viewopus.js"></script>
<link rel="stylesheet" type="text/css" href="/Public/Home/css/viewopus.css" />
<link rel="stylesheet" type="text/css" href="/Public/Home/css/jquery.slideBox.css" />