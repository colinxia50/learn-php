$(function(){



	
	//进入页面先加载学生表
	$.ajax({
		url:ThinkPHP['MODULE']+'/child/index',
		type:'POST',
		beforeSend:function(){
			$('#tabcon-loading').show();
		},
		success:function(data,response,status){
			if(data){
				$('#tabcon-loading').hide();
				$('.main-tabcon').append(data);
			}
		}
	});
	
	
	//使用AJAX添加班级表
	$('#myTabs a').click(function (e) {
		  e.preventDefault();
		  $(this).tab('show');
	      if($(this).attr('sf')=='1'){
	    	  $('#member').show();
	    	  $('#class').remove();
	    	  $('#school').remove();
	      }else if($(this).attr('sf')=='2'){
	    	  $('#class').remove();
	    		$.ajax({
	    			url:ThinkPHP['MODULE']+'/class/index',
	    			type:'POST',
	    			beforeSend:function(){
	    				$('#member').hide();
	    				$('#school').remove();
	    				$('#class-loading').show();
	    			},
	    			success:function(data,response,status){
	    				if(data){
	    					$('#class-loading').hide();	    					
	    					$('.conn').append(data);
	    				}
	    			}
	    		})
	      }else if($(this).attr('sf')=='3'){
	    	  $('.main-tabcon').empty();
	    	  $('#class').remove();
	    		$.ajax({
	    			url:ThinkPHP['MODULE']+'/school/index',
	    			type:'POST',
	    			beforeSend:function(){
	    				$('#member').hide();
	    		    	$('#class').remove();
	    				$('#class-loading').show();
	    			},
	    			success:function(data,response,status){
	    				if(data){
	    					$('#class-loading').hide();	    					
	    					$('.conn').append(data);
	    				}
	    			}
	    		})
	      }else if($(this).attr('sf')=='4'){
			  $('#class').remove();
			  $.ajax({
				  url:ThinkPHP['MODULE']+'/fee/index',
				  type:'POST',
				  beforeSend:function(){
					  $('#member').hide();
					  $('#class').remove();
					  $('#class-loading').show();
				  },
				  success:function(data,response,status){
					  if(data){
						  $('#class-loading').hide();
						  $('.conn').append(data);
					  }
				  }
			  })
		  }else if($(this).attr('sf')=='5'){ //增加图书管理
	    	  $('#class').remove();
			  $.ajax({
				  url:ThinkPHP['MODULE']+'/books/index',
				  type:'POST',
				  beforeSend:function(){
					  $('#member').hide();
					  $('#class-loading').show();
				  },
				  success:function(data,response,status){
					  if(data){
						  $('#class-loading').hide();
						  $('.conn').append(data);
					  }
				  }
			  })
		  }else if($(this).attr('sf')=='6'){ //借
	    	  $('#class').remove();
	    		$.ajax({
	    			url:ThinkPHP['MODULE']+'/Bookborrow/index',
	    			type:'POST',
	    			beforeSend:function(){
	    				
						  $('#member').hide();
						  $('#class-loading').show();
	    				
	    			},
	    			success:function(data,response,status){
	    				
	    				if(data){	    					
							  $('#class-loading').hide();
							  $('.conn').append(data);
	    				}
	    			}
	    		})
	      } else if($(this).attr('sf')=='7'){ //还
	    	  $('#class').remove();
	    		$.ajax({
	    			url:ThinkPHP['MODULE']+'/Bookback/index',
	    			type:'POST',
	    			beforeSend:function(){
	    				$('#member').hide();
	    				$('#class-loading').show();
	    			},
	    			success:function(data,response,status){	    				
	    				if(data){	    					
	    					$('#class-loading').hide();	    					
	    					$('.conn').append(data);
	    				}
	    			}
	    		})
	      }
	      
		})


   //使用节点AJAX加载学生表和老师表
	$('#member a').click(function (e) {
		  e.preventDefault();
	      if($(this).attr('sf')=='1'){
	    		$.ajax({
	    			url:ThinkPHP['MODULE']+'/child/index',
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
	    		})
	      }else if($(this).attr('sf')=='2'){
	    		$.ajax({
	    			url:ThinkPHP['MODULE']+'/Teacher/index',
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
	    		})
	      }
		})
		
		


});