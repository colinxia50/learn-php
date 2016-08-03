$(function(){
	
	$('.form_date').datetimepicker({
        language:  'fr',
        weekStart: 1,
        todayBtn:  1,
		autoclose: 1,
		todayHighlight: 1,
		startView: 2,
		minView: 2,
		forceParse: 0
    });
	
	$('.update').click(function(){
		var id=$(this).attr('iid');
		var score=$(this).attr('isc');
		var name=$(this).attr('ina');
		var dateline=$(this).attr('idate');
		var user=$(this).attr('iiu');
		$('input[name=user]').val(user);
		$('input[name=name]').val(name);
		$('input[name=score]').val(score);
		$('input[name=dateline]').val(dateline);
		$('input[name=id]').val(id);
		$('#editResult').modal('show');
	});
   
	$('#edit-result').click(function(){
		$.ajax({
			url:ThinkPHP['MODULE']+'/Result/edit',
			type:'POST',
			data:{
				id:$('input[name=id]').val(),
				name:$('input[name=name]').val(),
				score:$('input[name=score]').val(),
		        dateline:$('input[name=dateline]').val(),
			},
			success:function(data,response,status){
				if(data>0){
					$('#editResult').modal('hide');
					setTimeout(function(){
						getRes();
					},500);
				}else{
                	$('#myTishi p').text('未知错误!');
                	$('#myTishi').modal('show');					
				}
			}
		});
	});
	
	$('.del').click(function(){
		$.ajax({
			url:ThinkPHP['MODULE']+'/Result/del',
			type:'POST',
			data:{
				id:$(this).attr('iid'),
			},
			success:function(data,response,status){
				if(data>0){
					getRes();
				}else{
                	$('#myTishi p').text('未知错误!');
                	$('#myTishi').modal('show');					
				}
			}
		});
	});
	
	
	function getRes(){
		uid=$('input[name=uid]').val();
	    $.ajax({
	    	url:ThinkPHP['MODULE']+'/Result/viewList',
	    	type:'POST',
	    	data:{
	    		id:uid,
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
	    	},
	    });		
	}
	
});

