<?php if (!defined('THINK_PATH')) exit();?><div class="row">
 <div class="col-md-12 ">
  <div class="result">
             <ol class="breadcrumb">
			  <li>能量币管理</li>
			  <li class="active">提领记录</li>
		     </ol>
			   <div class="row" style="padding:10px 0;">
				    <div class="col-md-3">
						<span style="margin-top: 20px;margin-left:20px;">
							当前能量币余额：<span style="color:red;"><?php echo ($Balance); ?></span>
						</span>
						<?php if(($Balance) > "0"): ?><button style="margin-top: 20px;margin-left:20px;" type="button" class="btn btn-primary">我要提取</button><?php endif; ?>
				      <!--<select class="form-control" name="search-class" id="search-class">-->
						 <!--<option value="">所有</option>-->
						 <!--<?php if(is_array($Class)): $i = 0; $__LIST__ = $Class;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vv): $mod = ($i % 2 );++$i;?>-->
						 <!--<option value="<?php echo ($key); ?>"><?php echo ($vv); ?></option>-->
	                      <!--<?php endforeach; endif; else: echo "" ;endif; ?>-->
	                  <!--</select>-->
				    </div>
			    <!--<div class="col-md-3">		    -->
				<!--<input type="text" class="form-control" name="search-name" placeholder="查询名称">-->
			    <!--</div>-->
			   <!--<a class="btn btn-default"  id="search" ><span class="glyphicon glyphicon-search"></span> 查询</a>			    -->
		       </div>
		       <!--<input type="hidden" value="<?php echo ($Search); ?>" name="xz-class"/>		     -->
		       <table class="table table-striped table-hover table-bordered">
			         <thead>
			           <tr class="success"><th>日期时间</th><th>提现能量币</th><th>剩余能量币</th></tr>
			         </thead>
			         <tbody>
					 <?php if(!empty($Child)): if(is_array($Child)): $i = 0; $__LIST__ = $Child;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
							  <td><?php echo ($vo["create_time"]); ?></td>
							  <td style="color:limegreen;"><?php echo ($vo["coin"]); ?></td>
							  <td style="color:red;"><?php echo ($vo["total_coin"]); ?></td>
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
  
  

<script type="text/javascript" src="/Public/Home/js/bootstrap-datetimepicker.min.js"></script>
<script type="text/javascript" src="/Public/Home/js/locales/bootstrap-datetimepicker.fr.js" charset="UTF-8"></script>
<script type="text/javascript" src="/Public/Home/js/balance.js"></script>
<link rel="stylesheet" type="text/css" href="/Public/Home/css/result.css" />
<link href="/Public/Home/css/bootstrap-datetimepicker.min.css" rel="stylesheet" media="screen">