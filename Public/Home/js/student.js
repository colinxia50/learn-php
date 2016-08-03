 $(function(){
	

     //新增验证
	    $('.regChild').bootstrapValidator({
        message: 'This value is not valid',
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
	            name: {
	                message: '请输入学生姓名',
	                validators: {
	                    notEmpty: {
	                        message: '学生姓名不得为空'
	                    },
	                    stringLength: {
	                        min: 2,
	                        max: 10,
	                        message: '学生姓名长度为2到10位之间'
	                    },
	                }
	            },
	            mobile:{
	                validators: {
	                    notEmpty: {
	                        message: '家长手机不得为空'
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
	            rule1_name: {
	                message: '请输入父亲姓名',
	                validators: {
	                    notEmpty: {
	                        message: '父亲姓名不得为空'
	                    },
	                    stringLength: {
	                        min: 2,
	                        max: 10,
	                        message: '父亲姓名长度为2到10位之间'
	                    },
	                }
	            },
	            rule2_name: {
	                message: '请输入母亲姓名',
	                validators: {
	                    notEmpty: {
	                        message: '母亲姓名不得为空'
	                    },
	                    stringLength: {
	                        min: 2,
	                        max: 10,
	                        message: '母亲姓名长度为2到10位之间'
	                    },
	                }
	            },
	            birthday: {
                validators: {
  	                notEmpty: {
	                        message: '学生生日不得为空'
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
$(".regChild").submit(function(e){
	e.preventDefault();
});
//新增学生
$('#addCh').click(function(){
			$.ajax({
			url:ThinkPHP['MODULE']+'/Student/addChild',
			type:'POST',
			data:{
                name:$('input[name=name]').val(),
                card:$('input[name=card]').val(),
                mobile:$('input[name=mobile]').val(),
                email:$('input[name=email]').val(),
                rule1_name:$('input[name=rule1_name]').val(),
                rule2_name:$('input[name=rule2_name]').val(),
                sex:$("input[name=sex]:checked").val(),
                birthday:$('input[name=birthday]').val(),
                class_id:$('select[name=class_id]').val(),
                group_id:$('input[name=group_id]').val(),
			},
			beforeSend:function(){
				 $('#addCh').attr('disabled','disabled');
				 $('#addCh').text('数据提交中..');
			},
			success:function(data,response,status){
                if (data>0) {
                 $('.child').remove();  //移除节点
			     $('.modal-backdrop').remove();//移除模态框遮罩
		    		$.ajax({
		    			url:ThinkPHP['MODULE']+'/Student/index',
		    			type:'POST',
		    			success:function(data,response,status){
		    				if(data){
		    					$('.main-tabcon').append(data);
		    				}
		    			}
		    		})


                }else if(data==-11){
                	$('#myTishi p').text('电话号码以存在!');
                	$('#myTishi').modal('show');
	   				$('#addCh').attr('disabled',false);
					$('#addCh').text('提交');
                }else if(data== -15){
  	                $('#myTishi p').text('邮箱以存在!');
	                $('#myTishi').modal('show');
		    		$('#addCh').text('保存');
		    		$('#addCh').attr('disabled',false);                    	  
                 }else{
                	alert(data);
                	$('#myTishi p').text('未知错误!');
                	$('#myTishi').modal('show');
	   				$('#addCh').attr('disabled',false);
					$('#addCh').text('提交');
                }
			}
		});
})


	//选中框 点击之后变色
	$('#childtb tr').click(function(){
		if($(this).is('.danger')){
			$(this).removeClass('danger');
			$(this).children('td').eq(0).children("input:checkbox").removeAttr('checked');
		}else{
			$(this).addClass('danger');
			$(this).children('td').eq(0).children("input:checkbox").attr('checked',true);
		}		
	});


    //选择要修改的班级
    $('#sch').click(function(){
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
               url:ThinkPHP['MODULE']+'/Student/getone',
               type:'POST',
               data:{
	    				id:ids
	    			},
	    		success:function(data,response,status){
                 if (data) {
                    $('input[name=edit-name]').val(data.nick_name);
                    $('input[name=edit-card]').val(data.card);
                    $('input[name=edit-mobile]').val(data.mobile);
                    $('input[name=edit-email]').val(data.email);
                    $('input[name=edit-rule1_name]').val(data.rule1_name);
                    $('input[name=edit-rule2_name]').val(data.rule2_name);
                    $('input[name=edit-birthday]').val(data.birthday);
                    $('input[name=childid]').val(data.id);
                    $("input[name='edit-sex'][value='"+data.sex+"']").attr("checked",true); 
                    $('#edit_class_id').val(data.class_id);


                 }else{
                	$('#myTishi p').text('未知错误!');
                	$('#myTishi').modal('show');
                 }
          
	    	   }
        	});
        	$('#savechild').modal('show');
        }else if(num>1){
        	$('#myTishi p').text('只能选择一条数据!');
        	$('#myTishi').modal('show');
        }
    });

  //禁用表单自动提交
    $(".upChild").submit(function(e){
    	e.preventDefault();
    });

        $('#edit-Ch').click(function(){
          
    	      $.ajax({
                url:ThinkPHP['MODULE']+'/Student/update',
                type:'POST',
                data:{
	    				id:$('input[name=childid]').val(),
	    				name:$('input[name=edit-name]').val(),
	    				card:$('input[name=edit-card]').val(),
		                mobile:$('input[name=edit-mobile]').val(),
		                email:$('input[name=edit-email]').val(),
		                rule1_name:$('input[name=edit-rule1_name]').val(),
		                rule2_name:$('input[name=edit-rule2_name]').val(),
		                sex:$("input[name=edit-sex]:checked").val(),
		                birthday:$('input[name=edit-birthday]').val(),
                        class_id:$("#edit_class_id").val(),
	    			},
	    		beforeSend:function(){
	    			$('#edit-Ch').text('数据修改中');
	    			$('#edit-Ch').attr('disabled','disabled');
	    		},
	    		success:function(data,response,status){
                      if (data>0) {
                      	$('.child').remove();  //移除节点
			        	$('.modal-backdrop').remove();//移除模态框遮罩
			    		 $.ajax({
			    		    url:ThinkPHP['MODULE']+'/Student/index',
			    		    			type:'POST',
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
                      }else if(data==-11){
	                	$('#myTishi p').text('电话号码以存在!');
	                	$('#myTishi').modal('show');
		    			$('#edit-Ch').text('保存');
		    			$('#edit-Ch').attr('disabled',false);
                      }else if(data== -15){
  	                	$('#myTishi p').text('邮箱以存在!');
	                	$('#myTishi').modal('show');
		    			$('#edit-Ch').text('保存');
		    			$('#edit-Ch').attr('disabled',false);                    	  
                      }else{
  	                	$('#myTishi p').text('修改失败!');
	                	$('#myTishi').modal('show');
		    			$('#edit-Ch').text('保存');
		    			$('#edit-Ch').attr('disabled',false);                    	  
                      }
	    		}
         	});
    })
	
  $('#search').click(function(){
      $.ajax({
    	  url:ThinkPHP['MODULE']+'/Student/index',
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
			  $('.main-right').find('*').remove();
			  $('.main-right').append(data);
			  $('#search-class').val($('input[name=xz-class]').val());
	    	}
  		}
   	});	 
  });
        
        
 	   //ajax分页点击
    	//$('.main-right').unbind().on('click','.page_student',function(){
    	//	var page=$(this).attr('page');
    	//	$.ajax({
    	//		url:ThinkPHP['MODULE']+'/Student/index',
    	//		type:'POST',
    	//		data:{
    	//			page:page,
    	//		},
    	//		success:function(data,response,status){
    	//			if(data){
    	//				$('.main-tabcon').find('*').remove();
    	//				$('.main-tabcon').append(data);
    	//				$(this).parent().addClass('active');
    	//			}
    	//		}
    	//	});
    	//});
	 $('.main-right').unbind().on('click','.page_student',function(){
		 var page=$(this).attr('page');
		 $.ajax({
			 url:ThinkPHP['MODULE']+'/Student/index',
			 type:'POST',
			 data:{
				 page:page,
				 class_id:$('select[name=search-class]').val(),
				 name:$('#search_name').html(),
			 },
			 success:function(data,response,status){
				 if(data){
					 $('.main-right').find('*').remove();
					 $('.main-right').append(data);
					 $('#search-class').val($('input[name=xz-class]').val());
					 $(this).parent().addClass('active');
				 }
			 }
		 });
	 });

 });