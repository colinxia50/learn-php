 $(function(){
	$('#page li a').click(function(){
		$.ajax({
			url:ThinkPHP['MODULE']+'/Bookborrow/index',
			type:'POST',
			data:{
				page:$(this).attr('page'),
				searchText:$('.searchText').html(),
			},
			success:function(data,response,status){
				$('#page-wrapper').html(data);
			}
		});
	});

	//搜索
	$('#search').click(function(){
		$.ajax({
			url:ThinkPHP['MODULE']+'/Bookborrow/index',
			type:'POST',
			data:{
				searchText:$('#searchText').val(),
			},
			success:function(data,response,status){
				$('#page-wrapper').html(data);
			}
		});
	});


	$('#add_School').click(function(){
		var inbn=document.getElementById('sousou').value;
		if(inbn<1){
			alert('请输入书名/条形码');
			return true;
		}
		$.ajax({
			url:ThinkPHP['MODULE']+'/Bookborrow/addSchool',
			type:'POST',
			data:$('#add').serialize(),
			success:function(data,response,status){
				if(data < 0){
					switch (data){
						case -1:
							alert('请输入2-30位的书名');
							break;
						case -2:
							alert('此书已入库,搜索后编辑入库数量即可！');
							break;
						case -3:
							alert("条码不能为空");
							break;
						default:
							alert(data);
					}
				}else{
					$('#addSchool').modal('hide');
					$('#page-wrapper').html(data);
				}
			}
		});
	});
		
	
	//查询要借阅的书
	$("input#sousou").blur(function(){
		
		$.ajax({
			url:ThinkPHP['MODULE']+'/Bookborrow/getSchool',
			type:'POST',
			data:{
				//sobook:$("input#sousou").val(),
				sobook:$('input[name=sousou]').val(),
			},
			success:function(data,response,status){
				if(data){
					var str ="<table class='table table-condensed'>"
					str +="<tr>" +
							"<th>id</th>" +
							"<th>条形码</th>" +
							"<th>书名</th>" +
							"<th>书价</th>" +
							"<th>借书费用 </th>" +
							"<th>总仓库数</th>" +
							"<th>剩余数 </th>" +
							"</tr>"
		            
					for(var o in data){
						str += '<tr>';
		                 str += '<td><input type="radio" name="bookid" id="book'+data[o].id+'" value="'+data[o].id+'" checked></td>';
		                 str += '<td>'+data[o].barcode+'</td>';
		                 str += '<td>'+data[o].bookname+'</td>';
		                 str += '<td>'+data[o].price+'</td>';
		                 str += '<td>'+data[o].rent+'</td>';
		                 str += '<td>'+data[o].number+'</td>';
		                 str += '<td>'+eval(data[o].number - data[o].outdepot)+'</td>';
		                 str += '</tr>';
		              } 
		               str += '</table>'

		            	   //console.log(str)
		            	   $("#sotable").replaceWith("<div class='form-group' id='sotable'>"+str+"</div>");
					
					
					$('button').prop('disabled', false);
				}else{
					$("#sotable").replaceWith("<div class='form-group' id='sotable'><p style='color: red;'>没有此书相关信息</p></div>");
					  // $('#add_School').addClass('disabled'); // Disables visually
					   $('#add_School').prop('disabled', true);

				}
			}
		});
	})
	
		//查询借阅人
	$("input#user_name").blur(function(){
		
		$.ajax({
			url:ThinkPHP['MODULE']+'/Bookborrow/getUser_name',
			type:'POST',
			data:{
				user_name:$('input[name=user_name]').val(),
			},
			success:function(data,response,status){
				if(data){
					var str ="<table class='table table-condensed'>"
					str +="<tr>" +
							"<th>id</th>" +
							"<th>昵称</th>" +
							"<th>用户名</th>" +
							"<th>电话</th>" +
							"</tr>"
		            
					for(var o in data){
						str += '<tr>';
		                 str += '<td><input type="radio" name="userid" id="userid'+data[o].id+'" value="'+data[o].id+'" checked></td>';
		                 str += '<td>'+data[o].nick_name+'</td>';
		                 str += '<td>'+data[o].user+'</td>';
		                 str += '<td>'+data[o].mobile+'</td>';
		                 str += '</tr>';
		              } 
		               str += '</table>'

		            	   //console.log(str)
		            	   $("#usertable").replaceWith("<div class='form-group' id='usertable'>"+str+"</div>");
					
					
					$('button').prop('disabled', false);
				}else{
					$("#usertable").replaceWith("<div class='form-group' id='usertable'><p style='color: red;'>没有此用户信息</p></div>");
					  // $('#add_School').addClass('disabled'); // Disables visually
					   $('#add_School').prop('disabled', true);

				}
			}
		});
	})
	
			//查询借阅人所属学校
	$("input#shcool").blur(function(){
		
		$.ajax({
			url:ThinkPHP['MODULE']+'/Bookborrow/getschoolinfo',
			type:'POST',
			data:{
				shool_name:$('input[name=shcool]').val(),
			},
			success:function(data,response,status){
				if(data){
					var str ="<table class='table table-condensed'>"
					str +="<tr>" +
							"<th>id</th>" +
							"<th>学校名称</th>" +
							"<th>地址</th>" +
							"<th>电话</th>" +
							"<th>代理商</th>" +
							"</tr>"
		            
					for(var o in data){
						str += '<tr>';
		                 str += '<td><input type="radio" name="shcoolid" id="shcoolid'+data[o].id+'" value="'+data[o].id+'" checked></td>';
		                 str += '<td>'+data[o].name+'</td>';
		                 str += '<td>'+data[o].address+'</td>';
		                 str += '<td>'+data[o].mobile+'</td>';
		                 str += '<td>'+data[o].agent+'</td>';
		                 str += '</tr>';
		              } 
		               str += '</table>'

		            	   //console.log(str)
		            	   $("#shcooltable").replaceWith("<div class='form-group' id='shcooltable'>"+str+"</div>");
					
					
					$('button').prop('disabled', false);
				}else{
					$("#shcooltable").replaceWith("<div class='form-group' id='shcooltable'><p style='color: red;'>没有此学校信息</p></div>");
					  // $('#add_School').addClass('disabled'); // Disables visually
					   $('#add_School').prop('disabled', true);

				}
			}
		});
	})

		$('.School_update').click(function(){  //没必要
		/*$.ajax({
			url:ThinkPHP['MODULE']+'/Bookborrow/getSchool',
			type:'POST',
			data:{
				id:$(this).attr('xid'),
			},
			success:function(data,response,status){
				if(data){
					//console.log(data[0].rent)
					//console.log(data)
					$('#barcode').val(data[0].barcode);
					$('#bookname').val(data[0].bookname);
					$('#rentt').val(data[0].rent);
					$('#price').val(data[0].price);
					$('#number').val(data[0].number);
					$('input[name=id]').val(data[0].id);
				}
			}
		});*/

			$('input[name=id]').val($(this).attr('xid'));
	})
	
	$('#edit_School').click(function(){
		var formdata = $('#edit').serialize();
		$.ajax({
			url:ThinkPHP['MODULE']+'/Bookborrow/update',
			type:'POST',
			data:formdata,
			success:function(data,response,status){
				if(data < 0){
					switch (data){
						case -1:
							alert('请输入2-20位的名称');
							break;
						case -2:
							alert('请输入4-40位的地址');
							break;
						case -3:
							alert("手机格式不正确");
							break;
						case -4:
							alert("名称被占用");
							break;
						case -5:
							alert("手机号被占用");
							break;
						case -6:
							alert("邮箱格式不正确");
							break;
						default:
							alert(data);
					}
				}else{
					$('#editSchool').modal('hide');
					$('#page-wrapper').html(data);
				}
			}
		});
	});
	
	
}); 
