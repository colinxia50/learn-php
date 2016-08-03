$(function(){
	
	$('#add-opus').click(function(){
		$.ajax({
			url:ThinkPHP['MODULE']+'/Opus/add',
			type:'POST',
			data:{
				id:$('input[name=classid]').val(),
			},
			beforeSend:function(){
				$('.main-right').empty();
				$('#loadin').show();
			},
			success:function(data,response,status){
				if(data){
					$('#loadin').hide();
					$('.main-right').append(data);
				}
			}
		});	
	});
	
	
	$('.view').click(function(){
		var id=$(this).attr('sid');
		$.ajax({
			url:ThinkPHP['MODULE']+'/opus/view',
			type:'POST',
            data:{
            	id:id,
            },
			beforeSend:function(){
				$('.main-right').empty();
				$('#loadin').show();
			},
			success:function(data,response,status){
				if(data){
					$('#loadin').hide();
					$('.main-right').append(data);
				}
			}
		});
	});	
	
	
	$('.del').click(function(){
		var id=$(this).attr('sid');
		var news=$(this);
		$.ajax({
			url:ThinkPHP['MODULE']+'/opus/delete',
			type:'POST',
            data:{
            	id:id,
            },
			success:function(data,response,status){
				if(data){
					news.parent().parent().parent().parent().remove();
				}
			}
		});
	});
	
	
	$('.edit').click(function(){
		var id=$(this).attr('sid');
		$.ajax({
			url:ThinkPHP['MODULE']+'/opus/edit',
			type:'POST',
            data:{
            	id:id,
            },
			beforeSend:function(){
				$('.main-right').empty();
				$('#loadin').show();
			},
			success:function(data,response,status){
				if(data){
					$('#loadin').hide();
					$('.main-right').append(data);
				}
			}
		});
	});
	
	   //ajax分页点击
	$('.main-right').on('click','.page_opus',function(){
		var page=$(this).attr('page');
		$.ajax({
			url:ThinkPHP['MODULE']+'/opus/index',
			type:'POST',
			data:{
				page:page,
			},
			success:function(data,response,status){
				if(data){
					$('.main-right').find('*').remove();
					$('.main-right').append(data);
					$(this).parent().addClass('active');
				}
			}
		});
	});
});