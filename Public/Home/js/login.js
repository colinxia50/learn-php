$(function(){
	$('#login').click(function(){
		$.ajax({
			url:ThinkPHP['MODULE']+'/Login/login',
			type:'POST',
			data:{
				user:$('input[name=user]').val(),
		        password:$('input[name=pass]').val(),
			},
			success:function(data,response,status){
				if(data>0){
					location.href = ThinkPHP['INDEX'];
				}else{
					$('.error').show();
				}
			}
		});
	});
});