$(function(){
	
	
	$.ajax({
		url:ThinkPHP['MODULE']+'/Message/getMessage',
		type:'POST',
		success:function(data,response,status){
			if(data){
                $('#home').find('*').remove();
                $('#home').append(data);
			}
		},
	});
	
	
	$('.xz-class a').click(function(){
		$('.xz-class a').each(function(){
			$(this).css('background','#fff');
		});
		$(this).css('background','#ccc');
		var id=$(this).attr('iid');
		$.ajax({
			url:ThinkPHP['MODULE']+'/User/getUser',
			type:'POST',
			data:{
				id:id,
			},
			success:function(data,response,status){
				if(data){
					$('.xz-user').find('*').remove();
					$.each(data,function(n,value){
						$('.xz-user').append('<a href="javascript:void(0)"  iid='+value.id+'>'+value.nick_name+'</a>');
					});
				}
			},
		});
	});
	

	
	$('.xz-user').on('click','a',function(){
		var id=$(this).attr('iid');
		var tc=$(this).text();
		var i=0;
		$(".xz-all a").each(function(){
			 if($(this).attr('iid')==id){
				i=1;
			 }  
	    });
		if(i==0){
			$('.xz-all').append('<a class="btn btn-info " iid='+id+'>'+tc+'</a>');	
		}
						
	});
	
	$('.xz-all').on('click','a',function(){
       $(this).remove();
	});
	
	
	$('#xzstu').click(function(){
		var id=new Array;
		var i=0;
		$('.xz-all a').each(function(){		
			id[i]=$(this).attr('iid');
			i++;
		});
		$('input[name=cid]').val(id.join());
		$('#myUser').modal('hide');
	});
	
	
	$('#fb-message').click(function(){
		var ids=$('input[name=cid]').val();
		if(ids.length<1){
        	$('#myTishi p').text('请选择要发送消息的用户!');
        	$('#myTishi').modal('show');
		}else{
			$.ajax({
				url:ThinkPHP['MODULE']+'/message/addMessage',
				type:'POST',
				data:{
					ids:ids,
					content:$('textarea[name=message]').val(),
				},
				beforeSend:function(){
					$('#loading').modal('show');
				},				
				success:function(data,response,status){
					$('#loading').modal('hide');
					$('textarea[name=message]').val('');
					if(data<0){
			        	$('#myTishi p').text('错误!');
			        	$('#myTishi').modal('show');						
					}
				},
			});			
		}
	})
	
	
	$('#navv a').on('show.bs.tab', function () {
		   if($(this).attr('iid')==2){
				$.ajax({
					url:ThinkPHP['MODULE']+'/Message/setMessage',
					type:'POST',
					success:function(data,response,status){
						if(data){
			                $('#profile').find('*').remove();
			                $('#profile').append(data);
						}
					},
				});			  
		   }else{
				$.ajax({
					url:ThinkPHP['MODULE']+'/Message/getMessage',
					type:'POST',
					success:function(data,response,status){
						if(data){
			                $('#home').find('*').remove();
			                $('#home').append(data);
						}
					},
				});				   
		   }
		});
})