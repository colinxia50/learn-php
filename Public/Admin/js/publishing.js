
  //自定义验证个必域名
 $.extend($.fn.validatebox.defaults.rules, {
	 phone: {
   validator: function(value, param){
   return /^(0|86|17951)?(13[0-9]|15[012356789]|17[678]|18[0-9]|14[57])[0-9]{8}$/.test(value);
   },
   message: '您输入的手机号码格式不正确!',
   }
 }); 

$(function(){
	$('#page li a').click(function(){
		$.ajax({
			url:ThinkPHP['MODULE']+'/Publishing/index',
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
			url:ThinkPHP['MODULE']+'/Publishing/index',
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
			url:ThinkPHP['MODULE']+'/Publishing/reMove',
			type:'POST',
			data:{
				ids:$('input[name=delid]').val(),
			},
			success:function(data,response,status){
				$('#delSchool').modal('hide');
				$('#page-wrapper').html(data);
			}
		});
	})

	$('#add_School').click(function(){
		var province=document.getElementById('province').value;
		var city=document.getElementById('city').value;
		var area=document.getElementById('area').value;
		if(province<1){
			alert('请选择省份');
			return true;
		}
		if(city<1){
			alert('请选择市');
			 return true;
		}
		if(area<1){
			alert('请选择地区');
			 return true;
		}
		var vprovince=$('#province option:selected').text();
		var vcity=$('#city option:selected').text();
		var varea=$('#area option:selected').text();
		var address= vprovince+'-'+vcity+'-'+varea;
		$("#address").val(address);
		$.ajax({
			url:ThinkPHP['MODULE']+'/Publishing/addSchool',
			type:'POST',
			data:$('#add').serialize(),
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
					$('#addSchool').modal('hide');
					$('#page-wrapper').html(data);
				}
			}
		});
	});

	$('.School_update').click(function(){
		$.ajax({
			url:ThinkPHP['MODULE']+'/Publishing/getSchool',
			type:'POST',
			data:{
				id:$(this).attr('xid'),
			},
			success:function(data,response,status){
				if(data){
					$('#ISBN').val(data.ISBN);
					$('#pubname').val(data.pubname);
					$('#eaddress').val(data.address);
					$('#eaddress1').val(data.address1);
					$('#phone').val(data.phone);
					$('#qq').val(data.qq);
					$('#email').val(data.email);
					$('#contacts').val(data.contacts);
					$('input[name=id]').val(data.id);
				}
			}
		});
	})

	$('#edit_School').click(function(){
		var formdata = $('#edit').serialize();
		formdata.id = $(this).attr('xid');
		$.ajax({
			url:ThinkPHP['MODULE']+'/Publishing/update',
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
