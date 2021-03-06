<?php if (!defined('THINK_PATH')) exit();?><div class="teacher">
		        	 <ol class="breadcrumb">
					  <li><a href="#">校园设置</a></li>
					  <li><a href="#">成员管理</a></li>
					  <li class="active">老师管理</li>
					</ol>
					
			<div class="btn-group" role="group" aria-label="...">			  
			  <a class="btn btn-default" data-toggle="modal" data-target="#addteacher"><span class="glyphicon glyphicon-plus"></span> 增加</a>
			  <a class="btn btn-default"  id="tch" ><span class="glyphicon glyphicon-pencil"></span> 修改</a>	
			  <a class="btn btn-default"   ><span class="glyphicon glyphicon-pencil"></span> 转班</a>	
			  <a class="btn btn-default"   ><span class="glyphicon glyphicon-pencil"></span> 离校</a>	
			  <a class="btn btn-default"  id="search" ><span class="glyphicon glyphicon-search"></span> 查询</a>
			</div>					
					
			   <div class=" row edit-top">
			     <div class="col-md-3">
			      <select class="form-control" name="search-class">
					 <option value="">所有</option>
					 <?php if(is_array($Class)): $i = 0; $__LIST__ = $Class;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vv): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vv["id"]); ?>"><?php echo ($vv["class_name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                  </select>
			    </div>
			    <div class="col-md-3">		    
				<input type="text" class="form-control" name="search-name" placeholder="查询名称">
			    </div>			     
		       </div> 
		       <div>
					 <table class="table table-striped table-hover" id="teachertb">
			         <thead>
			         
			           <tr class="success"><th>编号</th><th>账号</th><th>姓名</th><th>性别</th><th>班级</th><th>手机</th><th>资历</th></tr>
			         </thead>
			         <tbody>
			         <?php if(is_array($Teacher)): $i = 0; $__LIST__ = $Teacher;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?><tr>
			           	  <td style="display:none"><input  type="checkbox" value="<?php echo ($v["id"]); ?>" name="id"/></td>
			              <th><?php echo ($key+1); ?></th>
			              <td><?php echo ($v["user"]); ?></td>
			              <td><?php echo ($v["name"]); ?></td>
			              <td><?php if($v["sex"] == 1): ?>男<?php else: ?>女<?php endif; ?></td>
			              <td><?php echo ($v["class_name"]); ?></td>
			              <td><?php echo ($v["mobile"]); ?></td>
			              <td>
			              <a tabindex="0" class="btn btn-danger btn-sm tanchu" role="button" data-placement="top" data-toggle="popover" data-trigger="focus" title="介绍" data-content="<?php echo ($v["content"]); ?>">查看</a>
                          </td>
			            </tr><?php endforeach; endif; else: echo "" ;endif; ?>
			         </tbody>	         
			      </table> 
			   </div>
			 <div id="page">
				 <nav><?php echo ($page); ?></nav>
			 </div>				      
			<div class="modal fade" id="editteacher" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
			  <div class="modal-dialog" role="document">
			    <div class="modal-content">
			      <div class="modal-header">
			        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			        <h4 class="modal-title" id="exampleModalLabel">修改老师</h4>
			      </div>
			      <div class="modal-body">
			        <form  class="form-horizontal  editTeacher">
			          <div class="form-group">
			            <label for="edit-name" class="col-sm-2">老师名称 :</label>
			            <div class="col-sm-7">
			            	<input type="text" class="form-control" name="edit-name" >
			            </div>
			            
			          </div>
			          <div class="form-group">
			            <label for="edit-mobile" class="col-sm-2">老师手机 :</label>
			            <div  class="col-sm-7">
			            	<input type="text" class="form-control" name="edit-mobile">
			            </div>			            
			          </div>
			          <div class="form-group">
			            <label for="edit-email" class="col-sm-2">老师邮箱 :</label>
			            <div  class="col-sm-7">
			            	<input type="text" class="form-control" name="edit-email">
			            </div>			            
			          </div>
			          <div class="form-group">
			            <label for="edit-content" class="col-sm-2">资历介绍 :</label>
			            <div  class="col-sm-7">
			            	<textarea class="form-control"  name="edit-content"></textarea>
			            </div>			            
			          </div>				          				          			          
			          <div class="form-group">
			            <label class="col-sm-2">性别:</label>
			            <div class="col-sm-7">
						<label class="radio-inline">
						  <input type="radio" name="edit-sex"  value="1" checked> 男
						</label>
						<label class="radio-inline">
						  <input type="radio" name="edit-sex"  value="0"> 女
						</label>
						</div>			            
			          </div>
			          <div class="form-group">
			            <label for="edit-birthday" class="col-sm-2">出生日期:</label>
			            <div class="col-sm-7">
			            	<input type="date" class="form-control" name="edit-birthday" placeholder="YY/MM/DD">
			            </div>			            
			          </div>
			          <div class="form-group">
			            <label for="edit_class_id" class="col-sm-2">班级:</label>
			            <div class="col-sm-4">
			            	<select class="form-control" name="edit_class_id" id="edit_class_id">
								  <option value="">请选择班级</option>
								  <?php if(is_array($Class)): $i = 0; $__LIST__ = $Class;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo["id"]); ?>"><?php echo ($vo["class_name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                           </select>
			            </div>			            
			          </div>
			          <div style="text-align:right">
			          <input type="hidden" name="teacherid">
			          <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
			          <button type="submit" class="btn btn-success"  id="editTe">保存</button>
			          </div>
			        </form>
			       </div> 
			    </div>
			  </div>
			</div>		
				      

			<div class="modal fade" id="addteacher" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
			  <div class="modal-dialog" role="document">
			    <div class="modal-content">
			      <div class="modal-header">
			        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			        <h4 class="modal-title" id="exampleModalLabel">增加老师</h4>
			      </div>
			      <div class="modal-body">
			        <form  class="form-horizontal  regTeacher">
			          <div class="form-group">
			            <label for="name" class="col-sm-2">老师名称 :</label>
			            <div class="col-sm-7">
			            	<input type="text" class="form-control" name="name" >
			            </div>
			            
			          </div>
			          <div class="form-group">
			            <label for="mobile" class="col-sm-2">老师手机 :</label>
			            <div  class="col-sm-7">
			            	<input type="text" class="form-control" name="mobile">
			            </div>			            
			          </div>
			          <div class="form-group">
			            <label for="email" class="col-sm-2">老师邮箱 :</label>
			            <div  class="col-sm-7">
			            	<input type="text" class="form-control" name="email">
			            </div>			            
			          </div>
			          <div class="form-group">
			            <label for="content" class="col-sm-2">资历介绍 :</label>
			            <div  class="col-sm-7">
			            	<textarea class="form-control"  name="content"></textarea>
			            </div>			            
			          </div>			          			          
			          <div class="form-group">
			            <label class="col-sm-2">性别:</label>
			            <div class="col-sm-7">
						<label class="radio-inline">
						  <input type="radio" name="sex"  value="1" checked> 男
						</label>
						<label class="radio-inline">
						  <input type="radio" name="sex"  value="0"> 女
						</label>
						</div>			            
			          </div>
			          <div class="form-group">
			            <label for="birthday" class="col-sm-2">出生日期:</label>
			            <div class="col-sm-7">
			            	<input type="date" class="form-control" name="birthday" placeholder="YY/MM/DD">
			            </div>			            
			          </div>
			          <div class="form-group">
			            <label for="date" class="col-sm-2">班级:</label>
			            <div class="col-sm-4">
			            	<select class="form-control" name="class_id">
								  <option value="">请选择班级</option>
								  <?php if(is_array($Class)): $i = 0; $__LIST__ = $Class;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo["id"]); ?>"><?php echo ($vo["class_name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                           </select>
			            </div>			            
			          </div>
			          <div style="text-align:right">
			          <input type="hidden" name="group_id" value="3">			          
			          <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
			          <button type="submit" class="btn btn-success"  id="addTe">保存</button>
			          </div>
			        </form>
			       </div> 
			    </div>
			  </div>
			</div>		
			      
<script type="text/javascript" src="/Public/Home/js/teacher.js"></script>
<script>
$(function(){
	$('.tanchu').popover();
});
</script>			       
</div>