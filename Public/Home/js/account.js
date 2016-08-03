$(function(){

	$('#edit-face').click(function(){
		$.ajax({
			url:ThinkPHP['MODULE']+'/Account/face',
			type:'POST',
			success:function(data,response,status){
				$('.main-right').empty();
				if(data){
					$('.main-right').append(data);
				}
			},
		})
	})
	
	
    //新增验证
    $('.save-pass').bootstrapValidator({
    message: 'This value is not valid',
    feedbackIcons: {
        valid: 'glyphicon glyphicon-ok',
        invalid: 'glyphicon glyphicon-remove',
        validating: 'glyphicon glyphicon-refresh'
    },
    fields: {
            password: {
                message: '请输入原密码',
                validators: {
                    notEmpty: {
                        message: '原密码不得为空'
                    },
                    stringLength: {
                        min: 6,
                        max: 20,
                        message: '密码长度为6到20位之间'
                    },
                }
            },
            newpassword: {
                message: '请输入新密码',
                validators: {
                    notEmpty: {
                        message: '新密码不得为空'
                    },
                    stringLength: {
                        min: 6,
                        max: 20,
                        message: '新密码长度为6到20位之间'
                    },
                }
            },
            notpassword: {
                message: '请输入新密码确认',
                validators: {
                    notEmpty: {
                        message: '密码确认不得为空'
                    },
                    identical: {
                        field: 'newpassword',
                        message: '两次输入不一致!'
                    },
                }
            },            

    }
});
	
	  //禁用表单自动提交
    $(".save-pass").submit(function(e){
    	e.preventDefault();
    });

	
	$('#edit-pass').click(function(){
		$.ajax({
			url:ThinkPHP['MODULE']+'/user/setPass',
			type:'POST',
			data:{
				password:$('input[name=password]').val(),
				newpassword:$('input[name=newpassword]').val(),
				notpassword:$('input[name=notpassword]').val(),
			},
			beforeSend:function(){
				 $('#edit-pass').attr('disabled','disabled');
				 $('#edit-pass').text('数据修改中..');
			},
			success:function(data,response,status){
				if(data){
					 $('#edit-pass').attr('disabled',false);
					 $('#edit-pass').text('修改');
					 $('input[name=password]').val(''),
					 $('input[name=newpassword]').val(''),
					 $('input[name=notpassword]').val(''),
					 $('#mypass').modal('hide');
				}
			},
		});
	});
})