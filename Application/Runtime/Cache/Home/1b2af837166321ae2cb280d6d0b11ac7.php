<?php if (!defined('THINK_PATH')) exit();?><div id="class">
					
			   <div class=" row edit-top">

	    
			    <p style="margin-left:20px;">
			        <span class="col-xs-4">
			            <input type="text" class="form-control" placeholder="用户名/用户昵称/书名/条形码/学校名" id="searchText">
			        </span>
			        <button class="btn btn-large btn-primary" type="button" id="search">搜索已借出书记录</button>
			    </p>
		     
		       </div> 
		       <div>
					 <table class="table table-striped table-hover" id="teachertb">
			         <thead>
			         
			           <tr class="success"><th></th></th><th>用户名</th><th>书名</th><th>借书日期</th><th>还书日期</th><th>借书费用 </th><th>库存数</th><th>操作</th></tr>
			         </thead>
			         <tbody>
			         <?php if(is_array($Borrow)): $i = 0; $__LIST__ = $Borrow;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
                        <td><?php echo ($key+1); ?></td>
                        <td><?php echo ($vo["user"]); ?></td>
                        <td><?php echo ($vo["bookname"]); ?></td>
                        <td><?php echo ($vo["borrowTime"]); ?></td>
                        <td><?php echo ($vo["backTime"]); ?></td>
                        <td><?php echo ($vo["rental"]); ?></td>
                        <td><?php echo ($vo['number']-$vo['outdepot']); ?></td>
                        <td>
                        <?php if(($vo["ifback"] == 1)): ?><a data-target="#editSchool" data-toggle="modal" class="btn btn-info School_update" href="#" bid="<?php echo ($vo["bookid"]); ?>" xid="<?php echo ($vo["id"]); ?>">图书归还</a><?php endif; ?>
                        </td>
                    </tr><?php endforeach; endif; else: echo "" ;endif; ?>
			         </tbody>	         
			      </table> 
			   </div>
	<?php if(isset($searchText)): ?><div class="searchText" style="display:none;"><?php echo ($searchText); ?></div><?php endif; ?>
    <div id="page" style="text-align:center;">
        <nav><?php echo ($page); ?></nav>
    </div>			      
	
				      

    <div class="modal" id="editSchool">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close"  data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title">图书归还</h4>
                </div>

                <div class="modal-body">
                    <form role="form" id="edit">
			
                        <div class="form-group">
                            <label for="name">确定归还此书吗？</label>
                        </div>
                       <div class="form-group">
    					<p style='color: red;'>请核对图书信息，确定点击保存！</p>
                        </div>
                        <input type="hidden" name="id"/>
                        <input type="hidden" name="bookid"/>
                        <input type="hidden" name="ifback" value='0' />
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default btn_close" data-dismiss="modal">关闭</button>
                    <button type="button" class="btn btn-primary" id="edit_School">保存</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>



</div>
<script type="text/javascript">
$(function(){
	$('#page li a').click(function(){
		$.ajax({
			url:ThinkPHP['MODULE']+'/Bookback/index',
			type:'POST',
			data:{
				page:$(this).attr('page'),
				searchText:$('.searchText').html(),
			},
			success:function(data,response,status){
				$('#page-wrapper').html(data);
			}
		});
	});

	//搜索
	$('#search').click(function(){
		$.ajax({
			url:ThinkPHP['MODULE']+'/Bookback/index',
			type:'POST',
			data:{
				searchText:$('#searchText').val(),
			},
			success:function(data,response,status){
				$('#page-wrapper').html(data);
			}
		});
	});
	
	
$('.School_update').click(function(){  //没必要
	$('input[name=id]').val($(this).attr('xid'));
	$('input[name=bookid]').val($(this).attr('bid'));


		//$('input[name=id]').val($(this).attr('xid'));
})

	$('#edit_School').click(function(){
		var formdata = $('#edit').serialize();
		$.ajax({
			url:ThinkPHP['MODULE']+'/Bookback/update',
			type:'POST',
			data:formdata,
			success:function(data,response,status){
				if(data < 0){
					switch (data){
						case -1:
							alert('失败！！');
							break;
						default:
							alert(data);
					}
				}else{
					$('#editSchool').modal('hide');
					$('#page-wrapper').html(data);
				}
			}
		});
	});
	
});
</script>
</div>