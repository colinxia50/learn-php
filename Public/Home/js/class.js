

$(function(){
	//增加班级
	$('#addCl').click(function(){
		$.ajax({
			url:ThinkPHP['MODULE']+'/class/addClass',
			type:'POST',
			data:{
				class_name:$('input[name=class-name]').val(),
				class_info:$('textarea[name=class-info]').val(),
			},
			beforeSend:function(){
				$('#addCl').attr('disabled','disabled');
				$('#addCl').text('数据提交中..');
			},
			success:function(data,response,status){
				if(data>0){
			      	$('#class').remove();  //移除节点
			      	$('.modal-backdrop').remove();//移除模态框遮罩
			    	$.ajax({
			    			url:ThinkPHP['MODULE']+'/class/index',
			    			type:'POST',
			    			success:function(data,response,status){
			    				$('#member').hide();
			    				if(data){
			    					$('.conn').append(data);
			    				}
			    			}
			    		})
				}else{
					$('#addCl').removeAttr('disabled');
					$('#addCl').text('提交');
				}
			}
		});
	});
	
    //选择要修改的班级
    $('#scl').click(function(){
    	var ids=0;
		var num=0;
       	$("input[name=id]").each(function() {
            if ($(this).attr("checked")) {
                ids=$(this).val(); 
                num++;
            }
        }); 

        if (num==0) {
        	$('#myTishi p').text('请选择一条要修改的数据!');
        	$('#myTishi').modal('show');
        }else if (num==1) {
        	$.ajax({
               url:ThinkPHP['MODULE']+'/class/getone',
               type:'POST',
               data:{
	    				id:ids
	    			},
	    		success:function(data,response,status){
                 if (data) {
                 	$('input[name=save-class-name]').val(data.class_name);
                 	$('textarea[name=save-class-info]').val(data.class_info);
                 	$('input[name=cid]').val(data.id);
                 };
          
	    	   }
        	});
        	$('#saveclass').modal('show');
        }else if(num>1){
        	$('#myTishi p').text('只能选择一条数据!');
        	$('#myTishi').modal('show');
        }
    });

    $('#saveCl').click(function(){


    	     $.ajax({
               url:ThinkPHP['MODULE']+'/class/update',
               type:'POST',
               data:{
	    				id:$('input[name=cid]').val(),
	    				class_name:$('input[name=save-class-name]').val(),
	    				class_info:$('textarea[name=save-class-info]').val(),
	    			},
	    		success:function(data,response,status){
                 if (data>0) {
			      	$('#class').remove();  //移除节点
			      	$('.modal-backdrop').remove();//移除模态框遮罩
			    	$.ajax({
			    			url:ThinkPHP['MODULE']+'/class/index',
			    			type:'POST',
			    			success:function(data,response,status){
			    				$('#member').hide();
			    				if(data){
			    					$('.conn').append(data);
			    				}
			    			}
			    		})
                 }else{
                	$('#myTishi p').text('修改失败!');
                	$('#myTishi').modal('show');
                 }
          
	    	   }
        	});
    })



	//删除班级
	$('#del').click(function(){
		var text="";
		var num=0;
		$("input[name=id]").each(function() {  
            if ($(this).attr("checked")) {  
                text +=$(this).val()+ ","; 
                num++;
            }  
        });  
		var ids=text.substr(0,text.length-1);
		if(ids==''){
        	$('#myTishi p').text('请选择一条要删除的数据!');
        	$('#myTishi').modal('show');
		}else{
			if(confirm('您真的要删除选中的'+num+'条数据吗!')){
	    		$.ajax({
	    			url:ThinkPHP['MODULE']+'/class/del',
	    			type:'POST',
	    			data:{
	    				ids:ids
	    			},
	    			beforeSend:function(){
	    				$('#del').attr('disabled','disabled');
	    				$('#del').text('数据删除中..');
	    			},
	    			success:function(data,response,status){
                        if(data>0){
    			    		$.ajax({
    			    			url:ThinkPHP['MODULE']+'/class/index',
    			    			type:'POST',
    			    			success:function(data,response,status){
    			    				$('#class').remove();
    			    				if(data){
    			    					$('.conn').append(data);
    			    				}
    			    			}
    			    		});
                        }else if(data==-1){
                        	$('#myTishi p').text('错误:该班级下面还有人员,不能删除!');
                        	$('#myTishi').modal('show');
    	    				$('#del').attr('disabled',false);
                        	$('#del').html('<span class="glyphicon glyphicon-remove"></span> 删除');                         	
                       }else{
                       	$('#myTishi p').text('未知错误!');
                    	$('#myTishi').modal('show');
    	    			$('#del').attr('disabled',false);
                        $('#del').html('<span class="glyphicon glyphicon-remove"></span> 删除');
 
                        }
	    			}
	    		})
			}
		}
	});
	
	//选中框 点击之后变色
	$('#classtb tr').click(function(){
		if($(this).is('.danger')){
			$(this).removeClass('danger');
			$(this).children('td').eq(0).children("input:checkbox").removeAttr('checked');
		}else{
			$(this).addClass('danger');
			$(this).children('td').eq(0).children("input:checkbox").attr('checked',true);
		}
		
		
	});
	
	
	   //ajax分页点击
	$('.conn').on('click','.page_class',function(){
		var page=$(this).attr('page');
		$.ajax({
			url:ThinkPHP['MODULE']+'/class/index',
			type:'POST',
			data:{
				page:page,
			},
			success:function(data,response,status){
				if(data){
					$('#class').remove();
					$('.conn').append(data);
					$(this).parent().addClass('active');
				}
			}
		});
	});
	
	
});