$('.manage_add_action').click(function(){
    $('.modal_add').addClass('show');
})
$('.btn_close').click(function(){
    $('.window').removeClass('show');
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
                $('#addadmin').modal('hide');
                $('#page-wrapper').html(data);
            }
        }
    });
});

$('.manage_update').click(function(){
    $.ajax({
        url:ThinkPHP['MODULE']+'/Manage/getManage',
        type:'POST',
        data:{
            id:$(this).attr('xid'),
        },
        success:function(data,response,status){
            if(data){
                $('#manager').val(data.manager);
                $('#id').val(data.id);
                $('#address').val(data.address);
                $('#article1').val(data.article);
                $('#adv_coin').val(data.adv_coin);
                $('#name').val(data.name);
                $('#mobile').val(data.mobile);
                $('#real_name').val(data.real_name);
                $('#mail').val(data.mail);
                $('input[name=id]').val(data.id);
            }
        }
    });
})

$('#up_manager').click(function(){
    var formdata = $('#edit').serialize();
    //formdata.id = $(this).attr('xid');
    
    var article=document.getElementById('article1').value;
	var adv_coin=document.getElementById('adv_coin').value;
	
	if(article<1){
		alert('请填写文章利率');
		 return true;
	}
	if(article>100){
		alert('文章利率最大值为100');
		return true;
	}
	if(adv_coin>100){
		alert('文广告收入利率最大值为100');
		return true;
	}
    $.ajax({
        url:ThinkPHP['MODULE']+'/Manage/update',
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
                $('#editadmin').modal('hide');
                $('#page-wrapper').html(data);
            }
        }
    });
});
//分页
$('#page li a').click(function(){
    $.ajax({
        url:ThinkPHP['MODULE']+'/Manage/index',
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
        url:ThinkPHP['MODULE']+'/Manage/index',
        type:'POST',
        data:{
            searchText:$('#searchText').val(),
        },
        success:function(data,response,status){
            $('#page-wrapper').html(data);
        }
    });
});

$('.manage_delete').click(function(){
    $('input[name=delid]').val($(this).attr('xid'));
})

$('#del').click(function(){
    $.ajax({
        url:ThinkPHP['MODULE']+'/Manage/remove',
        type:'POST',
        data:{
            ids:$('input[name=delid]').val(),
        },
        success:function(data,response,status){
            $('#deladmin').modal('hide');
            $('#page-wrapper').html(data);
        }
    });
})

$('#add_manager').click(function(){
	
	var province=document.getElementById('province').value;
	var city=document.getElementById('city').value;
	var area=document.getElementById('area').value;
	var article=document.getElementById('article').value;
	var adv_coin=document.getElementById('adv_coin').value;
	
	if(article<1){
		alert('请填写文章利率');
		 return true;
	}
	if(article>100){
		alert('文章利率最大值为100');
		return true;
	}
	if(adv_coin>100){
		alert('文广告收入利率最大值为100');
		return true;
	}
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
        url:ThinkPHP['MODULE']+'/Manage/addManage',
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
                $('#addadmin').modal('hide');
                $('#page-wrapper').html(data);
            }
        }
    });
})
//  //自定义验证个必域名
// $.extend($.fn.validatebox.defaults.rules, {
//   mobile: {
//   validator: function(value, param){
//   return /^(0|86|17951)?(13[0-9]|15[012356789]|17[678]|18[0-9]|14[57])[0-9]{8}$/.test(value);
//   },
//   message: '您输入的手机号码格式不正确!',
//   }
// });
//
//
//$(function(){
//
//
//
//
// $('#manage').datagrid({
// 	url:ThinkPHP['MODULE']+'/Manage/getList',  //导入数据
// 	fit:true,//全屏自适应
// 	fitColumns:true,  //让表格自适应
// 	rownumbers:true, //自动编号
// 	border:false,//去掉边框
// 	striped:true,//斑马线效果
// 	toolbar:'#manage_tool',   //在上方增加一个工具栏
// 	pagination:true,//引入分页
// 	pageList:[10,20,30,40,50],  //设置分页每页面显示多少的选项
// 	pageNumner:1,   //默认显示第几页
// 	pageSize:20,//设置每页显示多少条
// 	sortName:'create',//默认以什么字段排序
// 	sortOrder:'DESC', //默认排序方法
// 	columns:[[
//          {
//                field:'id',
//                title:'编号',
//                checkbox:true,
//                width:100,
//          },
//          {
//                field:'manager',
//                title:'管理员账号',
//                width:100,
//          },
//          {
//              field:'auth',
//              title:'所属角色',
//              width:100,
//              sortable:true,  //设置排序
//        },
//           {
//                field:'create',
//                title:'注册时间',
//                width:100,
//                sortable:true,  //设置排序
//          },
//            {
//                field:'last_login',
//                title:'最后登陆时间',
//                width:100,
//                sortable:true,  //设置排序
//          },
//            {
//                field:'last_ip',
//                title:'最后登陆IP',
//                width:100,
//          },
// 	    ]],
// });
//
//
//$('#manage_add').dialog({
//    title:'新增管理',
//    width:350,
//    iconCls:'icon-add',
//    modal:true,
//    closed:true,
//    buttons:[
//      {
//        text:'新增',
//        iconCls:'icon-ok',
//        handler : function(){
//          if ($('#manage_add').form('validate')) {   //表示如果表单时的数据都验证成功后再执行
//            　　　　　　　　　          $.ajax({
//                              url:ThinkPHP['MODULE']+'/Manage/addManage',
//                              type:'POST',
//                              data:{
//                                manager:$.trim($('input[name="manager"]').val()),
//                                password:$('input[name="password"]').val(),
//                                role:$('input[name="role"]').val(),
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
//                                        msg: '新增管理成功!',
//                                      });
//                                      $('#manage_add').dialog('close');
//                                      $('#manage').datagrid('load');
//                                 }else if(data== -3){
//                                	 $.messager.alert('警告操作','管理员名称被占用','warning',function(){
//                                		$('input[name="manager"]').select();
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
//           $('#manage_add').dialog('close');  //关闭dialog
//        },
//      },
//    ],
//
//     onClose : function(){ //关闭时候触发的事件
//        $('#manage_add').form('reset');
//        }
//});
//
//
//
//$('#manage_edit').dialog({
//    title:'修改管理员',
//    width:350,
//    iconCls:'icon-edit',
//    modal:true,
//    closed:true,
//    buttons:[
//      {
//        text:'修改',
//        iconCls:'icon-ok',
//        handler : function(){
//          if ($('#manage_edit').form('validate')) {   //表示如果表单时的数据都验证成功后再执行
//            　　　　　　　　$.ajax({
//                              url:ThinkPHP['MODULE']+'/Manage/update',
//                              type:'POST',
//                              data:{
//                                id:$('input[name="id"]').val(),
//                                password:$('input[name="edit_password"]').val(),
//                                role:$('input[name="edit_role"]').val(),
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
//                                        msg: '管理员修改成功!',
//                                      });
//                                      $('#manage_edit').dialog('close');
//                                      $('#manage').datagrid('load');
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
//           $('#manage_edit').dialog('close');  //关闭dialog
//        },
//      },
//    ],
//
//     onClose : function(){ //关闭时候触发的事件
//        $('#manage_edit').form('reset');
//        }
//});
//
//
//
//$('input[name="manager"]').validatebox({
//    required:true,
//    validType:'length[2,20]',
//    missingMessage:'请输入管理员帐号!',
//    invalidMessage:'用户名在2到20位之间!',
//});
//
//
//$('input[name="password"]').validatebox({
//    required:true,
//    validType : 'length[6,30]',
//    missingMessage:'请输入管理员密码!',
//    invalidMessage:'密码必须要6到30位之间!'
//});
//
//$('input[name="edit_password"]').validatebox({
//    validType : 'length[6,30]',
//    missingMessage:'请输入管理员密码!',
//    invalidMessage:'密码必须要6到30位之间!'
//});
//
//
//$('#role,#edit_role').combobox({
//	url : ThinkPHP['MODULE'] + '/AuthGroup/getListAll',
//	required : true,
//	editable : false,  //不能手动输入
//	valueField : 'id', //value值为id发送出去
//	textField : 'title',//文本中显示的值
//});
//
//
//
//manage_tool={
//	  	reload : function(){
//	    $('#manage').datagrid('load');  //reload当前页刷新 load 刷新到首页
// 	  	},
// 	  	redo : function(){
//        $('#manage').datagrid('unselectAll');  //取消选定
// 	  	},
//      add : function(){
//       $('#manage_add').dialog('open');
//       $('input[name="manager"]').focus();
//      },
//      edit : function(){
//          var rows=$('#manage').datagrid('getSelections');  //取得选中的数据
//          if(rows.length>1) {
//          $.messager.alert('警告操作','只能选择一条数据进行修改!','warning');
//          }else if (rows.length==1) {
//            $('#manage_edit').dialog('open');
//                      $.ajax({
//                              url:ThinkPHP['MODULE']+'/Manage/getManage',
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
//                                  $('#manage_edit').form('load',{
//                                     'edit_id':data.id,
//                                     'edit_manager':data.manager,
//                                     'edit_pass':'',
//                                  });
//                                  $('#edit_role').combobox('setValues',data.group_id);//设置列表框默认值
//                                };
//                              },
//                            });
//          }else if (rows.length==0) {
//          $.messager.alert('警告操作','请选择一条数据进行修改!','warning');
//          };
//      },
// 	  	remove : function(){
//          var rows=$('#manage').datagrid('getSelections');  //取得选中的数据
//          if(rows.length>0) {
//            $.messager.confirm('确认操作','您真的要删除所选的<strong>'+rows.length+'</strong>条记录吗!',function(flag){
//                if (flag) {
//                                  var ids=[];
//                                     for (var i = 0; i <rows.length; i++) {
//                                        ids.push(rows[i].id);
//                                     };
//                            $.ajax({
//                              url:ThinkPHP['MODULE']+'/Manage/remove',
//                              type:'POST',
//                              data:{
//                                ids :  ids.join(','),//把数据按逗号方式分隔
//                              },
//                              beforeSend:function(){
//                                            $('#manage').datagrid('loading');   //删除时显示加载框
//                              },
//                              success:function(data,response,status){
//                                              if (data) {
//                                $('#manage').datagrid('loaded');   //删除完清空加载框
//                                $('#manage').datagrid('reload');
//                                $.messager.show({  //右下角显示一个提醒框
//                                  title:'操作提醒',
//                                  msg: data +'个管理员被成功删除!',
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
// 	  	search : function() {
// 	  		$('#manage').datagrid('load',{
//                  manager:$.trim($('input[name="search_manager"]').val()),
// 	  		});
// 	  	},
// 	  	clear : function(){
//              $('input[name="search_manager"]').val('');
//
// 	  	},
//	 }
//});