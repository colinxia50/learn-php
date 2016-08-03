
jQuery(document).ready(function() {

	$('#Login').click(function(){
		if($('#manager').val() != "" && $('#password').val() != ""){
			alert();
			$.ajax({
				url:ThinkPHP['MODULE']+'/Login/checkManager',
				type:'POST',
				data:{
					manager : $('#manager').val(),
					password : $('#password').val(),
				},
				success:function(data,response,status){
					if(data>0){
						alert(data);
						location.href = ThinkPHP['INDEX'];
					}else{
						alert('登录失败！管理员帐号或密码不正确！');
						$('#password').val('');
					}

				},
			});
		}
	});
    /*
        Fullscreen background
    */
    $.backstretch("/Public/Admin/assets/img/backgrounds/bg.jpg");
    
    /*
        Form validation
    */
    $('.login-form input[type="text"], .login-form input[type="password"], .login-form textarea').on('focus', function() {
    	$(this).removeClass('input-error');
    });
    
    $('.login-form').on('submit', function(e) {
    	
    	$(this).find('input[type="text"], input[type="password"], textarea').each(function(){
    		if( $(this).val() == "" ) {
    			e.preventDefault();
    			$(this).addClass('input-error');
    		}
    		else {
    			$(this).removeClass('input-error');
    		}
    	});
    	
    });
    
    
});
