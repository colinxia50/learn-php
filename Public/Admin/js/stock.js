 $(function(){
	$('#page li a').click(function(){
		$.ajax({
			url:ThinkPHP['MODULE']+'/Stock/index',
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
			url:ThinkPHP['MODULE']+'/Stock/index',
			type:'POST',
			data:{
				searchText:$('#searchText').val(),
			},
			success:function(data,response,status){
				$('#page-wrapper').html(data);
			}
		});
	});

	$('.School_delete').click(function(){
		$('input[name=delid]').val($(this).attr('xid'));
	})

	$('#del_School').click(function(){
		$.ajax({
			url:ThinkPHP['MODULE']+'/Stock/reMove',
			type:'POST',
			data:{
				barcode:$('input[name=delid]').val(),
			},
			success:function(data,response,status){
				$('#delSchool').modal('hide');
				$('#page-wrapper').html(data);
			}
		});
	})

	$('#add_School').click(function(){
		var inbn=document.getElementById('ISBN').value;
		if(inbn<1){
			alert('请选择出版商');
			return true;
		}
		$.ajax({
			url:ThinkPHP['MODULE']+'/Stock/addSchool',
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

	$('.School_update').click(function(){
		$.ajax({
			url:ThinkPHP['MODULE']+'/Stock/getSchool',
			type:'POST',
			data:{
				sobook:$(this).attr('xid'),
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
		});
	})

	$('#edit_School').click(function(){
		var formdata = $('#edit').serialize();
		formdata.id = $(this).attr('xid');
		$.ajax({
			url:ThinkPHP['MODULE']+'/Stock/update',
			type:'POST',
			data:formdata,
			success:function(data,response,status){
				if(data < 0){
					switch (data){
						case -1:
							alert('请输入2-20位的名称');//更新不验证了
							break;
						case -2:
							alert('请输入4-40位的地址');
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

	//查询借阅人
	$("input#schoolname").blur(function(){
		
		$.ajax({
			url:ThinkPHP['MODULE']+'/Stock/getagent',
			type:'POST',
			data:{
				schoolname:$('input[name=schoolname]').val(),
			},
			success:function(data,response,status){
				if(data){
					$('input[name=schoolid]').val(data);
					$('button').prop('disabled', false);
				}else{
					alert('输入学校有误！请输入与您对应的学校，或检查该学校是否属于当前代理商');
					$('#add_School').prop('disabled', true);

				}
			}
		});
	})
	
}); 
