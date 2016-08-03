$(function(){
	$('#page li a').click(function(){
		$.ajax({
			url:ThinkPHP['MODULE']+'/AuthGroup/index',
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

	$('.auth_delete').click(function(){
		$('input[name=delid]').val($(this).attr('xid'));
	})

	$('#del_auth').click(function(){
		$.ajax({
			url:ThinkPHP['MODULE']+'/AuthGroup/remove',
			type:'POST',
			data:{
				ids:$('input[name=delid]').val(),
			},
			success:function(data,response,status){
				$('#delAuth').modal('hide');
				$('#page-wrapper').html(data);
			}
		});
	})

	$('#add_auth').click(function(){
		$.ajax({
			url:ThinkPHP['MODULE']+'/AuthGroup/addRole',
			type:'POST',
			data:$('#add').serialize(),
			success:function(data,response,status){
				if(data < 0){
					switch (data){
						case -1:
							alert('请输入2-30位的账号');
							break;
						case -2:
							alert('请输入6-30位的密码');
							break;
						case -3:
							alert("账号已存在");
							break;
						default:
							alert(data);
					}
				}else{
					$('#addAuth').modal('hide');
					$('#page-wrapper').html(data);
				}
			}
		});
	});

	$('.auth_update').click(function(){
		$.ajax({
			url:ThinkPHP['MODULE']+'/AuthGroup/getAuthGroup',
			type:'POST',
			data:{
				id:$(this).attr('xid'),
			},
			success:function(data,response,status){
				if(data){
					$('#title').val(data.title);
					$('input[name=id]').val(data.id);
				}
			}
		});
	})

	$('#edit_auth').click(function(){
		var formdata = $('#edit').serialize();
		formdata.id = $(this).attr('xid');
		$.ajax({
			url:ThinkPHP['MODULE']+'/AuthGroup/update',
			type:'POST',
			data:formdata,
			success:function(data,response,status){
				if(data < 0){
					switch (data){
						case -1:
							alert('请输入2-30位的账号');
							break;
						case -2:
							alert('请输入6-30位的密码');
							break;
						case -3:
							alert("账号已存在");
							break;
						default:
							alert(data);
					}
				}else{
					$('#editAuth').modal('hide');
					$('#page-wrapper').html(data);
				}
			}
		});
	});
	//$('#authgroup').datagrid({
	//	url:ThinkPHP['MODULE']+'/AuthGroup/getList',
	// 	fit:true,//全屏自适应
	// 	fitColumns:true,  //让表格自适应
	// 	rownumbers:true, //自动编号
	// 	border:false,//去掉边框
	// 	striped:true,//斑马线效果
	// 	toolbar:'#authgroup_tool',   //在上方增加一个工具栏
	// 	pagination:true,//引入分页
	// 	pageList:[10,20,30,40,50],  //设置分页每页面显示多少的选项
	// 	pageNumner:1,   //默认显示第几页
	// 	pageSize:20,//设置每页显示多少条
	// 	columns:[[
	//          {
	//                field:'id',
	//                title:'编号',
	//                checkbox:true,
	//                width:100,
	//          },
	//          {
	//                field:'title',
	//                title:'角色名称',
	//                width:100,
	//          },
	//          {
	//        	  field:'auth',
	//        	  title:'拥有的权限',
	//        	  width:100,
	//          },
	// 	    ]],
	//});
	//
	//$('#authgroup_add').dialog({
	//    title:'新增角色',
	//    width:350,
	//    iconCls:'icon-add',
	//    modal:true,
	//    closed:true,
	//    buttons:[
	//      {
	//        text:'提交',
	//        iconCls:'icon-ok',
	//        handler : function(){
	//          if ($('#authgroup_add').form('validate')) {  //表示如果表单时的数据都验证成功后再执行
     //           $.ajax({
     //               url:ThinkPHP['MODULE']+'/AuthGroup/addRole',
     //               type:'POST',
     //               data:{
     //                   title:$.trim($('input[name="title"]').val()),
     //                  // rules:$('#auth_nav').combotree('getValues').join(','), //得到树型下拉框选中的values
     //                 rules:$('#auth_nav').combotree('getText'), //得到树型下拉框的text值
     //                 },
     //                 beforeSend:function(){
     //                    $.messager.progress({
     //                        text:'正在尝试提交....',
     //                    });
     //                 },
     //                 success:function(data,response,status){
     //               	  $.messager.progress('close');
     //               	  if (data>0) {
     //                         $.messager.show({  //右下角显示一个提醒框
     //                           title:'操作提醒',
     //                           msg: '用户角色成功!',
     //                         });
     //                         $('#authgroup_add').dialog('close');
     //                         $('#authgroup').datagrid('load');
     //                    };
     //                 },
     //           });
	//          };
	//        },
	//      },
	//      {
	//        text:'取消',
	//        iconCls:'icon-no',
	//        handler : function(){
	//           $('#authgroup_add').dialog('close');  //关闭dialog
	//        },
	//      },
	//    ],
    //
	//     onClose : function(){ //关闭时候触发的事件
	//        $('#authgroup_add').form('reset');
	//        }
	//});
	//
	//
	//$('#authgroup_edit').dialog({
	//    title:'修改角色',
	//    width:350,
	//    iconCls:'icon-save',
	//    modal:true,
	//    closed:true,
	//    buttons:[
	//      {
	//        text:'修改',
	//        iconCls:'icon-ok',
	//        handler : function(){
	//          if ($('#authgroup_edit').form('validate')) {  //表示如果表单时的数据都验证成功后再执行
     //           $.ajax({
     //               url:ThinkPHP['MODULE']+'/AuthGroup/update',
     //               type:'POST',
     //               data:{
     //               //    title:$.trim($('input[name="title"]').val()),
     //                  // rules:$('#auth_nav').combotree('getValues').join(','), //得到树型下拉框选中的values
     //                   id:$('input[name="id"]').val(),
     //               	rules:$('#edit_auth_nav').combotree('getText'), //得到树型下拉框的text值
     //                 },
     //                 beforeSend:function(){
     //                    $.messager.progress({
     //                        text:'正在尝试提交....',
     //                    });
     //                 },
     //                 success:function(data,response,status){
     //               	  $.messager.progress('close');
     //               	  if (data>0) {
     //                         $.messager.show({  //右下角显示一个提醒框
     //                           title:'操作提醒',
     //                           msg: '角色修改成功!',
     //                         });
     //                         $('#authgroup_edit').dialog('close');
     //                         $('#authgroup').datagrid('load');
     //                    };
     //                 },
     //           });
	//          };
	//        },
	//      },
	//      {
	//        text:'取消',
	//        iconCls:'icon-no',
	//        handler : function(){
	//           $('#authgroup_edit').dialog('close');  //关闭dialog
	//        },
	//      },
	//    ],
    //
	//     onClose : function(){ //关闭时候触发的事件
	//        $('#authgroup_edit').form('reset');
	//        }
	//});
	//$('input[name="title"]').validatebox({
	//    required:true,
	//    validType:'length[2,20]',
	//    missingMessage:'请输入角色名称!',
	//    invalidMessage:'角色名称在2到20位之间!',
	//});
	//
	//
	//$('#auth_nav,#edit_auth_nav').combotree({
	//	url:ThinkPHP['MODULE']+'/Index/getNav',
	//	required:true,//必选
	//	lines:true,
	//	multiple:true,//可以多选
	//	checkbox:true,//显示选择框
	//	onlyLeafCheck:true,//只能选择子节点
	//	onLoadSuccess:function(node,data){  //表示数据成功加载之后执行  ps:让图标自动展开
     //         var _this=this;
     //         if(data){  //如果有数据则执行
     //         	$(data).each(function(){
     //               if(this.state == 'closed'){
     //                    $(_this).tree('expandAll');
     //               }
     //         	});
     //         }
	//	},
	//});
	//
	//
	//authgroup_tool={
	//	  	reload : function(){
	//	    $('#authgroup').datagrid('load');  //reload当前页刷新 load 刷新到首页
	// 	  	},
	// 	  	redo : function(){
	//        $('#authgroup').datagrid('unselectAll');  //取消选定
	// 	  	},
	//      add : function(){
	//       $('#authgroup_add').dialog('open');
	//       $('input[name="title"]').focus();
	//      },
	//      edit : function(){
	//          var rows=$('#authgroup').datagrid('getSelections');  //取得选中的数据
	//          if(rows.length>1) {
	//          $.messager.alert('警告操作','只能选择一条数据进行修改!','warning');
	//          }else if (rows.length==1) {
	//            $('#authgroup_edit').dialog('open');
	//                      $.ajax({
	//                              url:ThinkPHP['MODULE']+'/AuthGroup/getAuthGroup',
	//                              type:'POST',
	//                              data:{
	//                                id :  rows[0].id,//把数据按逗号方式分隔
	//                              },
	//                              beforeSend:function(){
	//                                 $.messager.progress({
	//                                     text:'正在加载数据....',
	//                                 });
	//                              },
	//                              success:function(data,response,status){
	//                                $.messager.progress('close');
	//                              if (data) {
	//                                  $('#authgroup_edit').form('load',{
	//                                     'id':data.id,
	//                                     'edit_title':data.title,
	//                                  });
	//                                  $('#edit_auth_nav').combotree('setValues',data.rules);
	//                                };
	//                              },
	//                            });
	//          }else if (rows.length==0) {
	//          $.messager.alert('警告操作','请选择一条数据进行修改!','warning');
	//          };
	//      },
	// 	  	remove : function(){
	//          var rows=$('#authgroup').datagrid('getSelections');  //取得选中的数据
	//          if(rows.length>0) {
	//            $.messager.confirm('确认操作','您真的要删除所选的<strong>'+rows.length+'</strong>条记录吗!',function(flag){
	//                if (flag) {
	//                                  var ids=[];
	//                                     for (var i = 0; i <rows.length; i++) {
	//                                        ids.push(rows[i].id);
	//                                     };
	//                            $.ajax({
	//                              url:ThinkPHP['MODULE']+'/AuthGroup/remove',
	//                              type:'POST',
	//                              data:{
	//                                ids :  ids.join(','),//把数据按逗号方式分隔
	//                              },
	//                              beforeSend:function(){
	//                                            $('#authgroup').datagrid('loading');   //删除时显示加载框
	//                              },
	//                              success:function(data,response,status){
	//                                              if (data) {
	//                                $('#authgroup').datagrid('loaded');   //删除完清空加载框
	//                                $('#authgroup').datagrid('reload');
	//                                $.messager.show({  //右下角显示一个提醒框
	//                                  title:'操作提醒',
	//                                  msg: data +'个用户被成功删除!',
	//                                });
	//                              };
	//                              },
	//                            });
	//                };
	//            });
    //
	//          }else{
	//          	$.messager.alert('警告操作','请至少选择一条要删除的数据!','warning');
	//          }
	// 	  	},
	//	 }
});