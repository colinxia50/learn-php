$(function(){
	$('#login').dialog({
		'title':'管理员登陆',
		'width':300,
		'height':180,
		'closable': false,   //不要关闭按钮
		'modal':true,
		'buttons':'#btn'
	});
	
	$('#manager').validatebox({
		required:true,
		missingMessage:'请输入管理员帐号!',
		invalidMessage:'帐号不能为空',
	});
	
	$('#password').validatebox({
		required:true,
		validType : 'length[6,30]',
		missingMessage:'请输入管理员密码!',
		invalidMessage:'密码必须要6到30位之间!'
	});
	
	//加载后定位光标至输入框
	if(!$('#manager').validatebox('isValid')){
		$('#manager').focus();
	}else if (!$('#password').validatebox('isValid')) {
		$('#password').focus();
	}
	
	//登陆
	$('#Login').click(function(){
		if($('#manager').val() == "" || $('#password').val() == ""){
			alert('账号或密码不能为空！');
		}else{
			$.ajax({
				url:ThinkPHP['MODULE']+'/Login/checkManager',
				type:'POST',
				data:{
					manager : $('#manager').val(),
					password : $('#password').val(),
				},
				success:function(data,response,status){
					//$.messager.progress('close');
					if(data>0){
						location.href = ThinkPHP['INDEX'];
					}else{
						alert('账号或密码不正确！');
						$('#password').val('');
						//$.messager.alert('登录失败！', '管理员帐号或密码不正确！', 'warning', function () {
						//	$('#password').select();
						//});
					}
					
				},
			});
		}
	});
	
	
	//自定义验证规则
//	$.extend($.fn.validatebox.defaults.rules, {
//		minLength: {
//		validator: function(value, param){
//		return value.length >= param[0];
//		},
//		message: '密码不得小于 {0} 位.'
//		}
//	}); 
})