 $(function(){
	

     //新增验证
	    $('.regTeacher').bootstrapValidator({
        message: 'This value is not valid',
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
	            name: {
	                message: '请输入老师姓名',
	                validators: {
	                    notEmpty: {
	                        message: '老师姓名不得为空'
	                    },
	                    stringLength: {
	                        min: 2,
	                        max: 10,
	                        message: '老师姓名长度为2到10位之间'
	                    },
	                }
	            },
	            content: {
	                message: '请输入老师资历',
	                validators: {
	                    notEmpty: {
	                        message: '老师资历不得为空'
	                    },
	                    stringLength: {
	                        min: 2,
	                        max: 200,
	                        message: '老师姓名长度为2到200位之间'
	                    },
	                }
	            },	            
	            mobile:{
	                validators: {
	                    notEmpty: {
	                        message: '老师手机不得为空'
	                    },
	                    regexp: {
	                        regexp: /^(0|86|17951)?(13[0-9]|15[012356789]|17[678]|18[0-9]|14[57])[0-9]{8}$/,
	                        message: '手机格式不正确'
	                    },
	                }            	
	            },
	            email:{
	            	validators: {
	                    emailAddress: {
	                        message: '邮箱格式不正确'
	                    },	            		
	            	}
	            },
	            birthday: {
                validators: {
  	                notEmpty: {
	                        message: '老师生日不得为空'
	                    },              	
                    date: {
                        format: 'YYYY/MM/DD',
                        message: '日期格式不正确'
                    },
                }
            },
        }
    });
		

//禁用表单自动提交
$(".regTeacher").submit(function(e){
	e.preventDefault();
});
//新增老师
$('#addTe').click(function(){
			$.ajax({
			url:ThinkPHP['MODULE']+'/teacher/addTeacher',
			type:'POST',
			data:{
                name:$('input[name=name]').val(),
                mobile:$('input[name=mobile]').val(),
                email:$('input[name=email]').val(),
                content:$('textarea[name=content]').val(),
                sex:$("input[name=sex]:checked").val(),
                birthday:$('input[name=birthday]').val(),
                class_id:$('select[name=class_id]').val(),
                group_id:$('input[name=group_id]').val(),
			},
			beforeSend:function(){
				 $('#addTe').attr('disabled','disabled');
				 $('#addTe').text('数据提交中..');
			},
			success:function(data,response,status){
                if (data>0) {
                 $('.teacher').remove();  //移除节点
			     $('.modal-backdrop').remove();//移除模态框遮罩
			     getTeacher();
                }else if(data==-11){
                	$('#myTishi p').text('电话号码以存在!');
                	$('#myTishi').modal('show');
	   				 $('#addTe').attr('disabled',false);
					 $('#addTe').text('提交');
                }else if(data== -15){
  	                $('#myTishi p').text('邮箱以存在!');
	                $('#myTishi').modal('show');
		    		$('#addTe').text('保存');
		    		$('#addTe').attr('disabled',false);                    	  
                 }else{
                	$('#myTishi p').text('未知错误!');
                	$('#myTishi').modal('show');
	   				$('#addTe').attr('disabled',false);
					$('#addTe').text('提交');
                }
			}
		});
})


	//选中框 点击之后变色
	$('#teachertb tr').click(function(){
		if($(this).is('.danger')){
			$(this).removeClass('danger');
			$(this).children('td').eq(0).children("input:checkbox").removeAttr('checked');
		}else{
			$(this).addClass('danger');
			$(this).children('td').eq(0).children("input:checkbox").attr('checked',true);
		}		
	});

    //选择要修改的班级
    $('#tch').click(function(){
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
               url:ThinkPHP['MODULE']+'/teacher/getone',
               type:'POST',
               data:{
	    				id:ids
	    			},
	    		success:function(data,response,status){
                 if (data) {
                    $('input[name=edit-name]').val(data.name);
                    $('input[name=edit-mobile]').val(data.mobile);
                    $('input[name=edit-email]').val(data.email);
                    $('textarea[name=edit-content]').val(data.content);
                    $('input[name=edit-birthday]').val(data.birthday);
                    $('input[name=teacherid]').val(data.uid);
                    $("input[name='edit-sex'][value='"+data.sex+"']").attr("checked",true); 
                    $('#edit_class_id').val(data.class_id);
                 }else{
                	$('#myTishi p').text('未知错误!');
                	$('#myTishi').modal('show');
                 }
          
	    	   }
        	});
        	$('#editteacher').modal('show');
        }else if(num>1){
        	$('#myTishi p').text('只能选择一条数据!');
        	$('#myTishi').modal('show');
        }
    });

  //禁用表单自动提交
    $(".editTeacher").submit(function(e){
    	e.preventDefault();
    });

    
        $('#editTe').click(function(){
          
    	      $.ajax({
                url:ThinkPHP['MODULE']+'/teacher/update',
                type:'POST',
                data:{
	    				id:$('input[name=teacherid]').val(),
	    				name:$('input[name=edit-name]').val(),
		                mobile:$('input[name=edit-mobile]').val(),
		                content:$('textarea[name=edit-content]').val(),
		                email:$('input[name=edit-email]').val(),
		                sex:$("input[name=edit-sex]:checked").val(),
		                birthday:$('input[name=edit-birthday]').val(),
                        class_id:$("#edit_class_id").val(),
	    			},
	    		beforeSend:function(){
	   				 $('#editTe').attr('disabled','disabled');
	   				 $('#editTe').text('数据修改中..');
	   			},
	    		success:function(data,response,status){
                      if (data>0) {
                        $('.teacher').remove();  //移除节点
			        	$('.modal-backdrop').remove();//移除模态框遮罩

			        	getTeacher();
                      }else if(data==-11){
                      	$('#myTishi p').text('电话号码以存在!');
                    	$('#myTishi').modal('show');
    	   				 $('#editTe').attr('disabled',false);
    					 $('#editTe').text('提交');
                    }else if(data== -15){
      	                $('#myTishi p').text('邮箱以存在!');
    	                $('#myTishi').modal('show');
    		    		$('#editTe').text('保存');
    		    		$('#editTe').attr('disabled',false);                    	  
                     }else{
                    	$('#myTishi p').text('未知错误!');
                    	$('#myTishi').modal('show');
    	   				$('#editTe').attr('disabled',false);
    					$('#editTe').text('提交');
                    }
	    		}
         	});
    })
    
    //取得老师列表节点
    function getTeacher(){
    		$.ajax({
    			url:ThinkPHP['MODULE']+'/teacher/index',
    			type:'POST',
    			success:function(data,response,status){
    				if(data){
    					$('.main-tabcon').append(data);
    				}
    			}
    		})      	
        }
    
        $('#search').click(function(){
            $.ajax({
          	  url:ThinkPHP['MODULE']+'/teacher/index',
                type:'POST',
                data:{
        				name:$('input[name=search-name]').val(),
        				class_id:$('select[name=search-class]').val(),
        			},
      			beforeSend:function(){
      				$('.main-tabcon').empty();
      				$('#tabcon-loading').show();
      			},
        		success:function(data,response,status){
      	      if(data){	    					
      	    		$('#tabcon-loading').hide();	    					
      	    		$('.main-tabcon').append(data);
      	    	}
        		}
         	});	 
        });
        
        
        
        
  	   //ajax分页点击
    	$('.conn').on('click','.page_teacher',function(){
    		var page=$(this).attr('page');
    		$.ajax({
    			url:ThinkPHP['MODULE']+'/teacher/index',
    			type:'POST',
    			data:{
    				page:page,
    			},
    			success:function(data,response,status){
    				if(data){
    					$('.main-tabcon').find('*').remove();
    					$('.main-tabcon').append(data);
    					$(this).parent().addClass('active');
    				}
    			}
    		});
    	});  
        
     
 });