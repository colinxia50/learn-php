<?php if (!defined('THINK_PATH')) exit();?><div class="row">
 <div class="col-md-12 ">
  <div class="result">
             <ol class="breadcrumb">
			  <li>能量币管理</li>
			  <li class="active">能量币列表</li>
		     </ol>
			   <div class="row" style="padding:10px 0;">
			   <?php if(isAdmin()): ?><div class="col-md-3">
				      <select class="form-control" name="search-class" id="search-class">
						 <option value="">所有</option>
						 <?php if(is_array($Class)): $i = 0; $__LIST__ = $Class;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vv): $mod = ($i % 2 );++$i;?><option value="<?php echo ($key); ?>"><?php echo ($vv); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
	                  </select>
				    </div><?php endif; ?>
			    <div class="col-md-3">		    
				<input type="text" class="form-control" name="search-name" placeholder="查询名称">
			    </div>
			   <a class="btn btn-default"  id="search" ><span class="glyphicon glyphicon-search"></span> 查询</a>			    
		       </div> 	
		       <input type="hidden" value="<?php echo ($Search); ?>" name="xz-class"/>		     
		       <table class="table table-striped table-hover table-bordered">
			         <thead>
			           <tr class="success"><th>日期时间</th><th>文章标题</th><th>学生名</th><th>能量币</th><th>我的等级</th><th>累计能量币</th></tr>
			         </thead>
			         <tbody>
					 <?php if(!empty($Child)): if(is_array($Child)): $i = 0; $__LIST__ = $Child;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
							  <td><?php echo ($vo["pay_time"]); ?></td>
							  <td><?php echo ($vo["title"]); ?></td>
							  <td><?php echo ($vo["student"]); ?></td>
							  <td style="color:limegreen;">
								  +<?php echo ($vo["pay_coin"]); ?>
								  <!--<?php if($vo["is_pay"] == 1): ?>-->
									  <!--<a style="margin-left:20px;" class="btn btn-info btn-sm view-result" href="javascript:void(0)" iid="<?php echo ($vo["article_id"]); ?>"> 查看</a>-->
								  <!--<?php endif; ?>-->
							  </td>
							  <td>
								等级
								<!--<a class="btn btn-info btn-sm get-result" href="javascript:void(0)" iid="<?php echo ($vo["id"]); ?>" ina="<?php echo ($vo["name"]); ?>"> 添加成绩</a>-->
								<!--<a class="btn btn-info btn-sm get-info" href="javascript:void(0)"  iid="<?php echo ($vo["id"]); ?>" iinfo="<?php echo ($vo["info"]); ?>"> 评价</a>-->
							  </td>
							   <td style="color:red;">
									<?php echo ($vo["total_coin"]); ?>
								   <!--<?php if($vo["is_pay"] == 1): ?>-->
									   <!--<span style="color:green;">已支付</span>-->
									   <!--<?php else: ?>-->
									   <!--<span style="color:red;">未支付</span>-->
									<!--<?php endif; ?>-->
							   </td>
						   </tr><?php endforeach; endif; else: echo "" ;endif; endif; ?>
			         </tbody>
			      </table> 
			      
			 <div id="page" style="text-align:center;">
				 <nav><?php echo ($page); ?></nav>
			 </div>	
  </div>
  </div>
  </div>
  <div id="search_name" style="display: none;"><?php if(search_name): echo ($search_name); else: endif; ?></div>
 <div class="modal fade" id="addResult" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">添加成绩</h4>
      </div>
      <div class="modal-body">
             <form  class="form-horizontal  regChild">
			          <div class="form-group">
			            <label for="user" class="col-sm-2">学生名称 :</label>
			            <div class="col-sm-7">
			            	<input type="text" class="form-control" name="user" disabled>
			            </div>			            
			          </div>
			          <div class="form-group">
			            <label for="name" class="col-sm-2">科目:</label>
			            <div class="col-sm-7">
			            	<input type="text" class="form-control" name="name" >
			            </div>			            
			          </div>
			          <div class="form-group">
			            <label for="score" class="col-sm-2">成绩:</label>
			            <div class="col-sm-7">
			            	<input type="text" class="form-control" name="score" >
			            </div>			            
			          </div>
					  <div class="form-group">
			                <label for="dtp_input2" class="col-sm-2 ">日期:</label>
			                <div style="padding-left:17px;"class="input-group date form_date col-md-5" data-date="" data-date-format="yyyy-mm-dd" data-link-field="dtp_input2" data-link-format="yyyy-mm-dd">
			                    <input class="form-control"  type="text"  name="dateline" readonly>
			                    <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
								<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
			                </div>
							<input type="hidden" id="dtp_input2" value="" /><br/>
			            </div>       
			          <input type="hidden" name="id"/>
			  </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
        <button type="button" class="btn btn-primary" id='add-result'>保存</button>
      </div>
    </div>
  </div>
</div> 
  
<div class="modal fade" id="myInfo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">学生评价</h4>
      </div>
      <div class="modal-body">
        <div class="row">
           <div class="col-md-10 col-md-offset-1">
              <textarea class="form-control" name="info" style="height:300px;resize:none"></textarea>
              <p style="margin:10px 0;color:red;">(250个字以内)</p>
           </div>
        </div>
      </div>
      <div class="modal-footer">
        <input type="hidden" name="id2"/>
        <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
        <button type="button" class="btn btn-primary" id="edit-info">修改</button>
      </div>
    </div>
  </div>
</div> 
  
  

<script type="text/javascript" src="/zzb/Public/Home/js/bootstrap-datetimepicker.min.js"></script>
<script type="text/javascript" src="/zzb/Public/Home/js/locales/bootstrap-datetimepicker.fr.js" charset="UTF-8"></script>
<script type="text/javascript" src="/zzb/Public/Home/js/coin.js"></script>
<link rel="stylesheet" type="text/css" href="/zzb/Public/Home/css/result.css" />
<link href="/zzb/Public/Home/css/bootstrap-datetimepicker.min.css" rel="stylesheet" media="screen">