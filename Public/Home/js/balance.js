$(function(){
	$('.get-result').click(function(){
		var id=$(this).attr('iid');
        var name=$(this).attr('ina');
        $('input[name=user]').val(name);
        $('input[name=id]').val(id);
        $('#addResult').modal('show');
	});
	
	$('.get-info').click(function(){
		var id=$(this).attr('iid');
        var info=$(this).attr('iinfo');
        $('textarea[name=info]').val(info);
        $('input[name=id2]').val(id);		
		$('#myInfo').modal('show');
	});
	
	$('#edit-info').click(function(){
		$.ajax({
			url:ThinkPHP['MODULE']+'/Balance/editinfo',
			type:'POST',
			data:{
		       info:$('textarea[name=info]').val(),
		       id:$('input[name=id2]').val(),
			},
			success:function(data,response,status){
				if(data>0){
					$('#myInfo').modal('hide');
				}
			}
		});
	});
	
	
	$('.view-result').click(function(){
		var id=$(this).attr('iid');
        $.ajax({
        	url:ThinkPHP['MODULE']+'/Balance/view',
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
        	},
        });
	});
	
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
	
	$('#add-result').click(function(){
		$.ajax({
			url:ThinkPHP['MODULE']+'/Balance/addResult',
			type:'POST',
			data:{
				uid:$('input[name=id]').val(),
				name:$('input[name=name]').val(),
				score:$('input[name=score]').val(),
				dateline:$('input[name=dateline]').val(),
			},
			beforeSend:function(){
			 $('#add-result').attr('disabled','disabled');
			 $('#add-result').text('数据提交中..');
		    },			
			success:function(data,response,status){
				 $('#add-result').attr('disabled',false);
				 $('#add-result').text('保存');				
				if(data>0){
					$('#addResult').modal('hide');
					$('input[name=name]').val('');
					$('input[name=score]').val('');
					$('input[name=dateline]').val('');
				}
			}
		});
	});
	
	  $('#search').click(function(){
	      $.ajax({
	    	  url:ThinkPHP['MODULE']+'/Balance/index',
	          type:'POST',
	          data:{
	  				name:$('input[name=search-name]').val(),
	  				class_id:$('select[name=search-class]').val(),
	  			},
				beforeSend:function(){
					$('.main-right').empty();
					$('#loadin').show();
				},
	  		success:function(data,response,status){
		      if(data){	    					
					$('#loadin').hide();
					$('.main-right').append(data);
					$('#search-class').val($('input[name=xz-class]').val());
		    	}
	  		}
	   	});	 
	  });
	   //ajax分页点击
	$('.main-right').unbind().on('click','.page_balance',function(){
		var page=$(this).attr('page');
		$.ajax({
			url:ThinkPHP['MODULE']+'/Balance/index',
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