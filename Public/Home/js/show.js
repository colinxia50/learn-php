$(function(){



	
	//进入页面先加载学生表
	$.ajax({
		url:ThinkPHP['MODULE']+'/show/lists',
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

	//学生全选
	$('#quan').click(function(){
		if($(this).attr('n')==1){
			$(this).removeClass('btn-default');
			$(this).addClass('btn-success');
			$(this).text('取消全选');
			$(this).attr('n','2');
			$('.std .hx').show();
			$('.std a').attr('n','2');
		}else if($(this).attr('n')==2){
			$(this).removeClass('btn-success');
			$(this).addClass('btn-default');
			$(this).text('全选');
			$(this).attr('n','1');
			$('.std .hx').hide();
			$('.std a').attr('n','1');
		}
	});

	//动态添加点击单个学生选择事件
	$('.std').on('click','a',function(){
		if($(this).attr('n')==1){
			$(this).attr('n',2);
			$(this).parent().find('.hx').show();
		}else if($(this).attr('n')==2){
			$(this).attr('n',1);
			$(this).parent().find('.hx').hide();
		}
	})
	//动态添加学生
	$('#ClassStu').change(function(){
		var id=$(this).val();
		$.ajax({
			url:ThinkPHP['MODULE']+'/child/allChild',
			type:'POST',
			data:{
				id:id,
			},
			success:function(data,response,status){
				if (data) {
					$('.std').find('*').remove();
					$.each(data,function(n,value){
						$('.std').append('<div class="col-md-2"><a class="btn btn-default" n="1" uid="'+value.id+'">'+value.name+' <span class="glyphicon glyphicon-heart hx" style="color:red;display:none;"></span></a></div>');
					})
				};
			}
		});
	})
	//选择学生
	$('#xzstu').click(function(){
		var arr = new Array();
		var arr1 = new Array();
		var i=0;
		var stu=$('.std a');
		var len=stu.length;
		$('.std a').each(function(){
			if ($(this).attr('n')==2) {
				arr[i]=$(this).attr('uid');
				arr1[i]=$(this).text();
				i++;
			};
		});
		var l=arr1.length;
		switch(l){
			case 0:
				alert('请选择至少一名学生');
				break;
			case 1:
				$('.xzchild').text(arr1.join());
				break;
			case 2:
				$('.xzchild').text(arr1.join()+'等2名学生..');
				break;
			default:
				var b=arr1.join();
				$('.xzchild').text(b.substr(0,6)+'等'+l+'名学生..');
				break;
		}

		$('#myStudent').modal('hide');
		$('input[name=allStu]').val(arr.join());

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
		  }
		})


   ////使用节点AJAX加载学生表和老师表
	//$('#member a').click(function (e) {
	//	  e.preventDefault();
	//	  $(this).tab('show');
	//      if($(this).attr('sf')=='1'){
	//    		$.ajax({
	//    			url:ThinkPHP['MODULE']+'/child/index',
	//    			type:'POST',
	//    			beforeSend:function(){
	//    				$('.main-tabcon').empty();
	//    				$('#tabcon-loading').show();
	//    			},
	//    			success:function(data,response,status){
	//
	//    				if(data){
	//    					$('#tabcon-loading').hide();
	//    					$('.main-tabcon').append(data);
	//    				}
	//    			}
	//    		})
	//      }else if($(this).attr('sf')=='2'){
	//    		$.ajax({
	//    			url:ThinkPHP['MODULE']+'/Teacher/index',
	//    			type:'POST',
	//    			beforeSend:function(){
	//    				$('.main-tabcon').empty();
	//    				$('#tabcon-loading').show();
	//    			},
	//    			success:function(data,response,status){
	//    				if(data){
	//    					$('#tabcon-loading').hide();
	//    					$('.main-tabcon').append(data);
	//    				}
	//    			}
	//    		})
	//      }
	//	})





});