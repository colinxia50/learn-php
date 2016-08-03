<?php if (!defined('THINK_PATH')) exit();?><!-- 班级列表 -->
<div id="class">

			<div class="btn-group edit-top" role="group" aria-label="...">			  
			  <a class="btn btn-default" data-toggle="modal" data-target="#addclass"><span class="glyphicon glyphicon-plus"></span> 增加</a>
			  <a class="btn btn-default"  id="scl"><span class="glyphicon glyphicon-pencil"></span> 修改</a>
			  <a class="btn btn-default" href="javascript:void(0)" id="del"><span class="glyphicon glyphicon-remove"></span> 删除</a>
			</div>	
		       <div>
		 		<table class="table table-striped table-hover" id="classtb">
			         <thead>
			           <tr class="success"><th>编号</th><th>班级名称</th><th>学生人数</th><th>老师人数</th></tr>
			         </thead>
			         <tbody>
			         <?php if(is_array($Class)): $i = 0; $__LIST__ = $Class;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr><td style="display:none"><input  type="checkbox" value="<?php echo ($vo["id"]); ?>" name="id"/></td><td><?php echo ($key+1); ?></td><td><?php echo ($vo["class_name"]); ?></td><td><?php echo ($vo["child"]); ?></td><td><?php echo ($vo["teacher"]); ?></td></tr><?php endforeach; endif; else: echo "" ;endif; ?>
			         </tbody>
			      </table>
			    </div> 
			  <div id="page">
				 <nav><?php echo ($page); ?></nav>
			 </div>	

			<div class="modal fade" id="addclass" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
			  <div class="modal-dialog" role="document">
			    <div class="modal-content">
			      <div class="modal-header">
			        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			        <h4 class="modal-title" id="exampleModalLabel">增加班级</h4>
			      </div>
			      <div class="modal-body">
			        <form>
			          <div class="form-group">
			            <label for="recipient-name" class="control-label">班级名称 :</label>
			            <input type="text" class="form-control" name="class-name" id="recipient-name">
			          </div>
			          <div class="form-group">
			            <label for="message-text" class="control-label">班级介绍:</label>
			            <textarea class="form-control" name="class-info" id="message-text"></textarea>
			          </div>
			        </form>
			      </div>
			      <div class="modal-footer">
			        <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
			        <button type="button" class="btn btn-success" id="addCl" >保存</button>
			      </div>
			    </div>
			  </div>
			</div>


			<div class="modal fade" id="saveclass" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
			  <div class="modal-dialog" role="document">
			    <div class="modal-content">
			      <div class="modal-header">
			        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			        <h4 class="modal-title" id="exampleModalLabel">修改班级</h4>
			      </div>
			      <div class="modal-body">
			        <form>
			          <div class="form-group">
			            <label for="recipient-name" class="control-label">班级名称 :</label>
			            <input type="text" class="form-control" name="save-class-name" id="recipient-name">
			          </div>
			          <div class="form-group">
			            <label for="message-text" class="control-label">班级介绍:</label>
			            <textarea class="form-control" name="save-class-info" id="message-text"></textarea>
			          </div>
			        </form>
			      </div>
			      <div class="modal-footer">
			        <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
			         <input type="hidden" name="cid">
			        <button type="button" class="btn btn-success" id="saveCl" >修改</button>
			      </div>
			    </div>
			  </div>
			</div>

<script type="text/javascript" src="/Public/Home/js/class.js"></script>
</div>