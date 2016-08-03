
  //自定义验证个必域名
 $.extend($.fn.validatebox.defaults.rules, {
   mobile: {
   validator: function(value, param){
   return /^(0|86|17951)?(13[0-9]|15[012356789]|17[678]|18[0-9]|14[57])[0-9]{8}$/.test(value);
   },
   message: '您输入的手机号码格式不正确!',
   }
 }); 

$(function(){
	$('#page li a').click(function(){
		$.ajax({
			url:ThinkPHP['MODULE']+'/School/index',
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
			url:ThinkPHP['MODULE']+'/School/index',
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
			url:ThinkPHP['MODULE']+'/School/reMove',
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
		$.ajax({
			url:ThinkPHP['MODULE']+'/School/addSchool',
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
							alert("学校名称被占用");
							break;
						case -5:
							alert("手机号被占用");
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
			url:ThinkPHP['MODULE']+'/School/getSchool',
			type:'POST',
			data:{
				id:$(this).attr('xid'),
			},
			success:function(data,response,status){
				if(data){
					$('#name').val(data.name);
					$('#address').val(data.address);
					$('#mobile').val(data.mobile);
					$('input[name=id]').val(data.id);
				}
			}
		});
	})

	$('#edit_School').click(function(){
		var formdata = $('#edit').serialize();
		formdata.id = $(this).attr('xid');
		$.ajax({
			url:ThinkPHP['MODULE']+'/School/update',
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
							alert("学校名称被占用");
							break;
						case -5:
							alert("手机号被占用");
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

	$('.School_up').click(function(){
		$.ajax({
			url:ThinkPHP['MODULE']+'/School/is_up',
			type:'POST',
			data:{
				ids:$(this).attr('xid'),
			},
			success:function(data,response,status){
				$('#delSchool').modal('hide');
				$('#page-wrapper').html(data);
			}
		});
	})

	//$('#School').datagrid({
	// 	url:ThinkPHP['MODULE']+'/School/getList',  //导入数据
	// 	fit:true,//全屏自适应
	// 	fitColumns:true,  //让表格自适应
	// 	rownumbers:true, //自动编号
	// 	border:false,//去掉边框
	// 	striped:true,//斑马线效果
	// 	toolbar:'#school_tool',   //在上方增加一个工具栏
	// 	pagination:true,//引入分页
	// 	pageList:[10,20,30,40,50],  //设置分页每页面显示多少的选项
	// 	pageNumner:1,   //默认显示第几页
	// 	pageSize:20,//设置每页显示多少条
	// 	sortName:'dateline',//默认以什么字段排序
	// 	sortOrder:'DESC', //默认排序方法
	// 	columns:[[
	//          {
	//                field:'id',
	//                title:'编号',
	//                checkbox:true,
	//                width:100,
	//          },
	//          {
	//                field:'name',
	//                title:'学校名称',
	//                width:100,
	//          },
	//          {
	//              field:'mobile',
	//              title:'学校电话',
	//              width:100,
	//           },
	//          {
	//              field:'address',
	//              title:'学校地址',
	//              width:100,
	//          },
	//          {
	//              field:'is_up',
	//              title:'是否审核上线',
	//              formatter : function(value){
     //                return value==1?'<span style="color:blue;">上线<span>':'<span style="color:red">未上线</span>';
	//                },
	//              width:100,
	//          },
	//           {
	//                field:'dateline',
	//                title:'注册时间',
	//                width:100,
	//                sortable:true,  //设置排序
	//          },
	// 	    ]],
	// });
    //
	//$('#school_add').dialog({
	//    title:'新增学校',
	//    width:350,
	//    iconCls:'icon-add',
	//    modal:true,
	//    closed:true,
	//    buttons:[
	//      {
	//        text:'新增',
	//        iconCls:'icon-ok',
	//        handler : function(){
	//          if ($('#school_add').form('validate')) {   //表示如果表单时的数据都验证成功后再执行
	//            　　　　　　　　　          $.ajax({
	//                              url:ThinkPHP['MODULE']+'/School/addSchool',
	//                              type:'POST',
	//                              data:{
	//                                name:$.trim($('input[name="name"]').val()),
	//                                address:$('input[name="address"]').val(),
	//                                mobile:$('input[name="mobile"]').val(),
	//                              },
	//                              beforeSend:function(){
	//                                 $.messager.progress({
	//                                     text:'正在尝试提交....',
	//                                 });
	//                              },
	//                              success:function(data,response,status){
	//                                 $.messager.progress('close');
	//                                 if (data>0) {
	//                                      $.messager.show({  //右下角显示一个提醒框
	//                                        title:'操作提醒',
	//                                        msg: '新增学校成功!',
	//                                      });
	//                                      $('#school_add').dialog('close');
	//                                      $('#School').datagrid('load');
	//                                 }else if(data== -4){
	//                                	 $.messager.alert('警告操作','学校名称被占用','warning',function(){
	//                                		$('input[name="name"]').select();
	//                                	 });
	//                                 }
	//                              },
	//                            });
	//          };
	//        },
	//      },
	//      {
	//        text:'取消',
	//        iconCls:'icon-no',
	//        handler : function(){
	//           $('#school_add').dialog('close');  //关闭dialog
	//        },
	//      },
	//    ],
    //
	//     onClose : function(){ //关闭时候触发的事件
	//        $('#school_add').form('reset');
	//        }
	//});
	//
    //
	//$('#school_edit').dialog({
	//    title:'修改学校',
	//    width:350,
	//    iconCls:'icon-edit',
	//    modal:true,
	//    closed:true,
	//    buttons:[
	//      {
	//        text:'修改',
	//        iconCls:'icon-ok',
	//        handler : function(){
	//          if ($('#school_edit').form('validate')) {   //表示如果表单时的数据都验证成功后再执行
	//            　　　　　　　　$.ajax({
	//                              url:ThinkPHP['MODULE']+'/School/update',
	//                              type:'POST',
	//                              data:{
	//                                id:$('input[name="id"]').val(),
	//                                name:$('input[name="edit_name"]').val(),
	//                                address:$.trim($('input[name="edit_address"]').val()),
	//                                mobile:$.trim($('input[name="edit_mobile"]').val()),
	//                              },
	//                              beforeSend:function(){
	//                                 $.messager.progress({
	//                                     text:'正在尝试提交....',
	//                                 });
	//                              },
	//                              success:function(data,response,status){
	//                                 $.messager.progress('close');
	//                                 if (data>0) {
	//                                      $.messager.show({  //右下角显示一个提醒框
	//                                        title:'操作提醒',
	//                                        msg: '学校修改成功!',
	//                                      });
	//                                      $('#school_edit').dialog('close');
	//                                      $('#School').datagrid('load');
	//                                 }else{
	//                                  $.messager.alert('警告操作','未知错误!','warning');
	//                                 }
	//                              },
	//                            });
	//          };
	//        },
	//      },
	//      {
	//        text:'取消',
	//        iconCls:'icon-no',
	//        handler : function(){
	//           $('#school_edit').dialog('close');  //关闭dialog
	//        },
	//      },
	//    ],
    //
	//     onClose : function(){ //关闭时候触发的事件
	//        $('#school_edit').form('reset');
	//        }
	//});
	//
	//
	//
	//$('input[name="name"],input[name="edit_name"]').validatebox({
	//    required:true,
	//    validType:'length[4,20]',
	//    missingMessage:'请输入学校名称!',
	//    invalidMessage:'学校名称在4到20位之间!',
	//});
    //
    //
	//$('input[name="mobile"],input[name="edit_mobile"]').validatebox({
	//	 required:true,
	//	 validType : 'mobile',
	//	 missingMessage:'请输入学校联系电话!',
	//});
    //
	//$('input[name="address"],input[name="edit_address"]').validatebox({
	//	required:true,
	//    validType : 'length[4,40]',
	//    missingMessage:'请输入学校地址!',
	//    invalidMessage:'学校地址4到40位之间!'
	//});
	//
	//
	//school_tool={
	//	  	reload : function(){
	//		    $('#School').datagrid('load');  //reload当前页刷新 load 刷新到首页
	//	 	  	},
	//		add:function(){
	//		   $('#school_add').dialog('open');
	//		   $('input[name="name"]').focus();
	//		},
	// 	  	search : function() {
	// 	  		$('#School').datagrid('load',{
	//                  name:$.trim($('input[name="search_name"]').val()),
	// 	  		});
	// 	  	},
	// 	  	clear:function(){
	// 	  		$('input[name="search_name"]').val('');
	// 	  	},
	// 	  	is_up:function(){
	// 	          var rows=$('#School').datagrid('getSelections');  //取得选中的数据
	// 	          if(rows.length>1) {
	// 	          $.messager.alert('警告操作','只能选择一条数据进行修改!','warning');
	// 	          }else if (rows.length==1) {
	// 	                      $.ajax({
	// 	                              url:ThinkPHP['MODULE']+'/School/is_up',
	// 	                              type:'POST',
	// 	                              data:{
	// 	                                id :  rows[0].id,//把数据按逗号方式分隔
	// 	                              },
	// 	                              beforeSend:function(){
	// 	                                 $.messager.progress({
	// 	                                     text:'正在加载数据....',
	// 	                                 });
	// 	                              },
	// 	                              success:function(data,response,status){
	// 	                                $.messager.progress('close');
	// 	                              if (data) {
	//	 	                                $('#School').datagrid('loaded');   //删除完清空加载框
	//	 	                                $('#School').datagrid('reload');
	//	 	                                $.messager.show({  //右下角显示一个提醒框
	//	 	                                  title:'操作提醒',
	//	 	                                  msg: '操作成功!',
	//	 	                                });
	// 	                                };
	// 	                              },
	// 	                            });
	// 	          }else if (rows.length==0) {
	// 	          $.messager.alert('警告操作','请选择一条数据进行修改!','warning');
	// 	          };
	// 	  	},
	// 	    edit : function(){
	// 	          var rows=$('#School').datagrid('getSelections');  //取得选中的数据
	// 	          if(rows.length>1) {
	// 	          $.messager.alert('警告操作','只能选择一条数据进行修改!','warning');
	// 	          }else if (rows.length==1) {
	// 	            $('#school_edit').dialog('open');
	// 	                      $.ajax({
	// 	                              url:ThinkPHP['MODULE']+'/School/getSchool',
	// 	                              type:'POST',
	// 	                              data:{
	// 	                                id :  rows[0].id,//把数据按逗号方式分隔
	// 	                              },
	// 	                              beforeSend:function(){
	// 	                                 $.messager.progress({
	// 	                                     text:'正在加载数据....',
	// 	                                 });
	// 	                              },
	// 	                              success:function(data,response,status){
	// 	                                $.messager.progress('close');
	// 	                              if (data) {
	// 	                                  $('#school_edit').form('load',{
	// 	                                     'id':data.id,
	// 	                                     'edit_name':data.name,
	// 	                                     'edit_address':data.address,
	// 	                                     'edit_mobile':data.mobile,
	// 	                                  });
	// 	                                };
	// 	                              },
	// 	                            });
	// 	          }else if (rows.length==0) {
	// 	          $.messager.alert('警告操作','请选择一条数据进行修改!','warning');
	// 	          };
	// 	      },
	// 	  	remove : function(){
	// 	          var rows=$('#School').datagrid('getSelections');  //取得选中的数据
	// 	          if(rows.length>0) {
	// 	            $.messager.confirm('确认操作','您真的要删除所选的<strong>'+rows.length+'</strong>条记录吗!',function(flag){
	// 	                if (flag) {
	// 	                                  var ids=[];
	// 	                                     for (var i = 0; i <rows.length; i++) {
	// 	                                        ids.push(rows[i].id);
	// 	                                     };
	// 	                            $.ajax({
	// 	                              url:ThinkPHP['MODULE']+'/School/reMove',
	// 	                              type:'POST',
	// 	                              data:{
	// 	                                ids :  ids.join(','),//把数据按逗号方式分隔
	// 	                              },
	// 	                              beforeSend:function(){
	// 	                                            $('#School').datagrid('loading');   //删除时显示加载框
	// 	                              },
	// 	                              success:function(data,response,status){
	// 	                               if (data) {
	// 	                                $('#School').datagrid('loaded');   //删除完清空加载框
	// 	                                $('#School').datagrid('reload');
	// 	                                $.messager.show({  //右下角显示一个提醒框
	// 	                                  title:'操作提醒',
	// 	                                  msg: data +'个学校被成功删除!',
	// 	                                });
	// 	                              };
	// 	                              },
	// 	                            });
	// 	                };
	// 	            });
    //
	// 	          }else{
	// 	          	$.messager.alert('警告操作','请至少选择一条要删除的数据!','warning');
	// 	          }
	// 	 	  	},
	//}
	//
	
	
}); 
