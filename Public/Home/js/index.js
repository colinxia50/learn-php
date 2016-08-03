$(function(){
	

	
	var h=$(window).height()-50;
	$('.left').css('height',h);		
	$.ajax({
		url:ThinkPHP['MODULE']+$('.defaultRoute').html(),
		type:'POST',
		beforeSend:function(){
			$('#loadin').show();
		},
		success:function(data,response,status){
			if(data){
				$('#loadin').hide();
				$('.main-right').append(data);
			}
		}
	});
	
	if($('input[name=one]').val()==0){
		//alert('您是第一次登陆,请在个人设置中修改您的密码!');
	}
	
	$('.left li a').click(function(){
		$('.main-right').empty();
		$.ajax({
			url:ThinkPHP['MODULE']+$(this).attr('u'),
			type:'POST',
			beforeSend:function(){
				$('#loadin').show();
			},
			success:function(data,response,status){
				if(data){
					$('#loadin').hide();
					$('.main-right').append(data);
				}
			}
		})
	});
	
	$('.mn-nav a').eq(0).css('background','#cecece');

	$('.mn-nav a').click(function(){
		$('.mn-nav a').each(function(){
			$(this).css('background','#eee');
		});
		$(this).css('background','#cecece');
	});
	
	
	//10秒轮询
	getMessge();
	function getMessge() {
		$.ajax({
			url : ThinkPHP['MODULE'] + '/Index/getMessage',
			type : 'POST',
			success : function(data, response, status){
				if (data>0) {
					$('.get-message').show();
					$('.get-message span').text(' '+data+' ');	               

				}else{
					$('.get-message').hide();
					$('.get-message span').text(' '+data+' ');				
				}
			}
		});
		setTimeout(function () {
			getMessge();
		}, 10000);
	}
	
});