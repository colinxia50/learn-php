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
    $('select[name=school_id]').change(function(){
        if($(this).val() != ""){
            $.ajax({
                url:ThinkPHP['MODULE']+'/User/getClass',
                type:'POST',
                data:{
                    school_id:$(this).val(),
                },
                success:function(data,response,status){
                    if(data){
                        $('select[name=class_id]').children().remove();
                        $.each(data,function(i,n){
                            $('select[name=class_id]').append("<option value='"+n.id+"'>"+n.class_name+"</option>");
                        })
                    }
                }
            });
        }
    });

    $('#page li a').click(function(){
        $.ajax({
            url:ThinkPHP['MODULE']+'/User/index',
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
            url:ThinkPHP['MODULE']+'/User/index',
            type:'POST',
            data:{
                searchText:$('#searchText').val(),
            },
            success:function(data,response,status){
                $('#page-wrapper').html(data);
            }
        });
    });

    $('.User_delete').click(function(){
        $('input[name=delid]').val($(this).attr('xid'));
    })

    $('#del_User').click(function(){
        $.ajax({
            url:ThinkPHP['MODULE']+'/User/reMove',
            type:'POST',
            data:{
                ids:$('input[name=delid]').val(),
            },
            success:function(data,response,status){
                $('#delUser').modal('hide');
                $('#page-wrapper').html(data);
            }
        });
    })

    $('#add_User').click(function(){
        if($('#group_id').val() == ""){
            alert('请输入身份信息！');
            return false;
        }
        $.ajax({
            url:ThinkPHP['MODULE']+'/User/register',
            type:'POST',
            data:$('#add').serialize(),
            success:function(data,response,status){
                if(data < 0){
                    switch (data){
                        case -1:
                            alert('请输入2-20位的名称');
                            break;
                        case -2:
                            alert('手机格式不正确');
                            break;
                        case -3:
                            alert("邮箱格式不正确");
                            break;
                        case -4:
                            alert("邮箱被占用");
                            break;
                        case -5:
                            alert("手机号被占用");
                            break;
                        case -6:
                            alert("手机号被占用");
                            break;
                        case -7:
                            alert("手机号被占用");
                            break;
                        case -8:
                            alert("学校不能为空");
                            break;
                        case -9:
                            alert("班级不能为空");
                            break;
                        default:
                            alert(data);
                    }
                }else{
                    $('#addUser').modal('hide');
                    $('#page-wrapper').html(data);
                }
            }
        });
    });

    $('.User_update').click(function(){
        $.ajax({
            url:ThinkPHP['MODULE']+'/User/getUser',
            type:'POST',
            data:{
                id:$(this).attr('xid'),
            },
            success:function(data,response,status){
                if(data){
                    $('#user').val(data.user);
                    $('#mobile').val(data.mobile);
                    $('#nick_name').val(data.nick_name);
                    $('#email').val(data.email);
                    $('input[name=id]').val(data.id);
                }
            }
        });
    })

    $('#edit_User').click(function(){
        var formdata = $('#edit').serialize();
        formdata.id = $(this).attr('xid');
        if($('#edit_group').val() == ""){
            alert('请输入身份信息！');
            return false;
        }
        $.ajax({
            url:ThinkPHP['MODULE']+'/User/update',
            type:'POST',
            data:formdata,
            success:function(data,response,status){
                if(data < 0){
                    switch (data){
                        case -1:
                            alert('请输入2-20位的名称');
                            break;
                        case -2:
                            alert('手机格式不正确');
                            break;
                        case -3:
                            alert("邮箱格式不正确");
                            break;
                        case -4:
                            alert("邮箱被占用");
                            break;
                        case -5:
                            alert("手机号被占用");
                            break;
                        case -6:
                            alert("手机号被占用");
                            break;
                        case -7:
                            alert("手机号被占用");
                            break;
                        case -8:
                            alert("学校不能为空");
                            break;
                        case -9:
                            alert("班级不能为空");
                            break;
                        default:
                            alert(data);
                    }
                }else{
                    $('#editUser').modal('hide');
                    $('#page-wrapper').html(data);
                }
            }
        });
    });
// $('#group_id').change(function(){
//	if($(this).val()==4){
//		$('#ru1_name').show();
//		$('#ru2_name').show();
//	}else{
//		$('#ru1_name').hide();
//		$('#ru2_name').hide();
//	}
// });
//
//
// $('#user').datagrid({
// 	url:ThinkPHP['MODULE']+'/User/getList',  //导入数据
// 	fit:true,//全屏自适应
// 	fitColumns:true,  //让表格自适应
// 	rownumbers:true, //自动编号
// 	border:false,//去掉边框
// 	striped:true,//斑马线效果
// 	toolbar:'#user_tool',   //在上方增加一个工具栏
// 	pagination:true,//引入分页
// 	pageList:[10,20,30,40,50],  //设置分页每页面显示多少的选项
// 	pageNumner:1,   //默认显示第几页
// 	pageSize:20,//设置每页显示多少条
// 	sortName:'reg_time',//默认以什么字段排序
// 	sortOrder:'DESC', //默认排序方法
// 	columns:[[
//          {
//                field:'id',
//                title:'编号',
//                checkbox:true,
//                width:100,
//          },
//          {
//                field:'nick_name',
//                title:'用户名',
//                width:100,
//          },
//          {
//              field:'group_id',
//              title:'用户类型',
//              formatter : function(value){
//                if(value==2){
//                	return '园长';
//                }else if(value==3){
//                	return '老师';
//                }else if(value==4){
//                	return '学生';
//                }
//              },
//              width:100,
//          },
//          {
//              field:'school_name',
//              title:'学校名称',
//              width:100,
//          },
//          {
//            field:'class_name',
//            title:'班极名称',
//            width:100,
//          },
//           {
//                field:'reg_time',
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
//$('#user_add').dialog({
//    title:'新增用户',
//    width:350,
//    iconCls:'icon-add',
//    modal:true,
//    closed:true,
//    buttons:[
//      {
//        text:'提交',
//        iconCls:'icon-ok',
//        handler : function(){
//          if ($('#user_add').form('validate')) {   //表示如果表单时的数据都验证成功后再执行
//            　　　　　　　　　          $.ajax({
//                              url:ThinkPHP['MODULE']+'/User/register',
//                              type:'POST',
//                              data:{
//                                nick_name:$.trim($('input[name=nick_name]').val()),
//                                group_id:$("#group_id").val(),
//                                rule1_name:$("input[name=rule1_name]").val(),
//                                rule2_name:$("input[name=rule2_name]").val(),
//                                email:$.trim($('input[name=email]').val()),
//                                mobile:$.trim($('input[name=mobile]').val()),
//                                birthday:$("input[name=birthday]").val(),
//                                school_id:$('#school_id').val(),
//                                class_id:$('#class_id').val(),
//                                sex:$("input[name=sex]:checked").val(),
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
//                                        msg: '用户新增成功!',
//                                      });
//                                      $('#user_add').dialog('close');
//                                      $('#user').datagrid('load');
//                                 }else if( data == -4 ){
//                                    $.messager.alert('警告操作','用户邮箱被占用!','warning',function(){
//                                      $('input[name="email"]').select();
//                                    });
//                                 }else if( data == -5 ){
//                                    $.messager.alert('警告操作','手机被占用!','warning',function(){
//                                      $('input[name="mobile"]').select();
//                                    });
//                                 }else{
//                                	 alert(data);
//                                //  $.messager.alert('警告操作','未知错误','warning');
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
//           $('#user_add').dialog('close');  //关闭dialog
//        },
//      },
//    ],
//
//     onClose : function(){ //关闭时候触发的事件
//        $('#user_add').form('reset');
//		$('#ru1_name').hide();
//		$('#ru2_name').hide();
//        }
//});
//
//
//
//$('#user_edit').dialog({
//    title:'修改用户',
//    width:350,
//    iconCls:'icon-edit',
//    modal:true,
//    closed:true,
//    buttons:[
//      {
//        text:'修改',
//        iconCls:'icon-ok',
//        handler : function(){
//          if ($('#user_edit').form('validate')) {   //表示如果表单时的数据都验证成功后再执行
//            　　　　　　　　$.ajax({
//                              url:ThinkPHP['MODULE']+'/User/update',
//                              type:'POST',
//                              data:{
//                                id:$('input[name="id"]').val(),
//                                nick_name:$.trim($('input[name=edit_name]').val()),
//                                group_id:$("#edit_group").val(),
//                                rule1_name:$("input[name=edit_rule1]").val(),
//                                rule2_name:$("input[name=edit_rule2]").val(),
//                                email:$.trim($('input[name=edit_email]').val()),
//                                mobile:$.trim($('input[name=edit_mobile]').val()),
//                                birthday:$("input[name=edit_birthday]").val(),
//                                school_id:$('#edit_school').val(),
//                                class_id:$('#edit_class').val(),
//                                sex:$("input[name=edit_sex]:checked").val(),
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
//                                        msg: '用户修改成功!',
//                                      });
//                                      $('#user_edit').dialog('close');
//                                      $('#user').datagrid('load');
//                                 }else if( data == -6 ){
//                                    $.messager.alert('警告操作','邮箱被占用!','warning',function(){
//                                      $('input[name="edit_email"]').select();
//                                    });
//                                 }else if( data == -7 ){
//                                     $.messager.alert('警告操作','手机号码被占用!','warning',function(){
//                                         $('input[name="edit_mobile"]').select();
//                                       });
//                                    }else if( data == 0 ){
//                                      $.messager.alert('警告操作','没有做任何修改!','warning');
//                                    }else{
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
//           $('#user_edit').dialog('close');  //关闭dialog
//        },
//      },
//    ],
//
//     onClose : function(){ //关闭时候触发的事件
//        $('#user_edit').form('reset');
//	   	  $('#edit_ru1').hide();
//		  $('#edit_ru2').hide();
//        }
//});
//
//$('#school_id').change(function(){
//　　　　$.ajax({
//		    url:ThinkPHP['MODULE']+'/User/getClass',
//		    type:'POST',
//		    data:{
//		    	school_id:$('#school_id').val(),
//		    },
//		    success:function(data,response,status){
//		       if (data) {
//		    	   $('#class_id').find('*').remove();
//		    	   $.each(data,function(n,value){
//		              $('#class_id').append('<option value="'+value.id+'">'+value.class_name+'</option>');
//		    	   });
//		       }
//		    },
//		  });
//});
//
//$('#edit_school').change(function(){
//　　　　$.ajax({
//		    url:ThinkPHP['MODULE']+'/User/getClass',
//		    type:'POST',
//		    data:{
//		    	school_id:$(this).val(),
//		    },
//		    success:function(data,response,status){
//		       if (data) {
//		    	   $('#edit_class').find('*').remove();
//		    	   $.each(data,function(n,value){
//		              $('#edit_class').append('<option value="'+value.id+'">'+value.class_name+'</option>');
//		    	   });
//		       }
//		    },
//		  });
//});
//
//
//
//$('#search_school_id').change(function(){
//　　　　$.ajax({
//		    url:ThinkPHP['MODULE']+'/User/getClass',
//		    type:'POST',
//		    data:{
//		    	school_id:$(this).val(),
//		    },
//		    success:function(data,response,status){
//		       if (data) {
//		    	   $('#search_class_id').find('.activ').remove();
//		    	   $.each(data,function(n,value){
//		              $('#search_class_id').append('<option class="activ" value="'+value.id+'">'+value.class_name+'</option>');
//		    	   });
//		       }
//		    },
//		  });
//});
//
//
//
//$('#user_see').dialog({
//    title:'查看用户',
//    width:350,
//    iconCls:'icon-see',
//    modal:true,
//    closed:true,
//    buttons:[
//      {
//        text:'关闭',
//        iconCls:'icon-no',
//        handler : function(){
//           $('#user_see').dialog('close');  //关闭dialog
//           $('.f').hide();
//           $('.m').hide();
//        },
//      },
//    ],
//    onBeforeClose:function(){
//        $('.f').hide();
//        $('.m').hide();
//    }
//});
//
//$('input[name="nick_name"]').validatebox({
//    required:true,
//    validType:'length[2,10]',
//    missingMessage:'请输入用户名称!',
//    invalidMessage:'用户名在2到10位之间!',
//});
//
//$('input[name="rule1_name"],input[name="rule2_name"]').validatebox({
//    validType:'length[2,10]',
//    invalidMessage:'用户名在2到10位之间!',
//});
//
//$('input[name="mobile"],input[name="edit_mobile"]').validatebox({
//	required:true,
//    validType : 'mobile',
//});
//$('input[name="email"],input[name="edit_email"]').validatebox({
//    validType : 'email',
//    missingMessage:'请输入电子邮件!',
//    invalidMessage:'电子邮件格式不正确!'
//});
//
//$('#group_id').validatebox({
//	required:true,
//	missingMessage:'请选择用户类型!',
//});
//
//$('#school_id').validatebox({
//	required:true,
//	missingMessage:'请选择用户所在学校!',
//});
//
//$('#class_id').validatebox({
//	required:true,
//	missingMessage:'请选择用户所在班级!',
//});
//
//$('input[name=birthday]').validatebox({
//	required:true,
//	missingMessage:'请输入用户生日!',
//});
//
//
//  user_tool={
//	  	reload : function(){
//	    $('#user').datagrid('load');  //reload当前页刷新 load 刷新到首页
// 	  	},
// 	  	redo : function(){
//        $('#user').datagrid('unselectAll');  //取消选定
// 	  	},
//      add : function(){
//       $('#user_add').dialog('open');
//       $('input[name="username"]').focus();
//      },
//	  see : function(){
//	    	var rows=$('#user').datagrid('getSelections');  //取得选中的数据
//	          if(rows.length>1) {
//	              $.messager.alert('警告操作','只能选择一条数据进行查看!','warning');
//	              }else if (rows.length==1) {
//	            	  $('#user_see').dialog('open');
//                      $.ajax({
//                          url:ThinkPHP['MODULE']+'/User/getUser',
//                          type:'POST',
//                          data:{
//                            id :  rows[0].id,//把数据按逗号方式分隔
//                          },
//                          beforeSend:function(){
//                             $.messager.progress({
//                                 text:'正在加载数据....',
//                             });
//                          },
//                          success:function(data,response,status){
//                           $.messager.progress('close');
//                          if (data) {
//                        	  $('.see_group').text(data.group);
//                              $('.see_name').text(data.nick_name);
//                              $('.see_user').text(data.user);
//                              $('.see_mobile').text(data.mobile);
//                              $('.see_email').text(data.email);
//                              $('.see_birthday').text(data.birthday);
//                              if(data.group_id==4){
//                            	  $('.f').show();
//                            	  $('.see_f').text(data.rule1_name);
//                            	  $('.m').show();
//                            	  $('.see_m').text(data.rule2_name);
//                              }
//
//                              if(data.sex==0){
//                            	  $('.see_sex').text(' 女');
//                              }else{
//                            	  $('.see_sex').text(' 男');
//                              }
//                              if(data.cover.length>0){
//                            	  $('#cover').attr('src',ThinkPHP['ROOT']+'/'+data.cover);
//                              }else{
//                            	  $('#cover').attr('src',ThinkPHP['IMG']+'/small_face.jpg');
//                              }
//
//                            };
//                          },
//                        });
//	              }else if (rows.length==0) {
//	                  $.messager.alert('警告操作','请选择一条数据进行查看!','warning');
//	              };
//	    },
//      edit : function(){
//          var rows=$('#user').datagrid('getSelections');  //取得选中的数据
//          if(rows.length>1) {
//          $.messager.alert('警告操作','只能选择一条数据进行修改!','warning');
//          }else if (rows.length==1) {
//            $('#user_edit').dialog('open');
//                      $.ajax({
//                              url:ThinkPHP['MODULE']+'/User/getUser',
//                              type:'POST',
//                              data:{
//                                id :  rows[0].id,//把数据按逗号方式分隔
//                              },
//                              beforeSend:function(){
//                            	  $('#edit_class').find('*').remove();
//                                 $.messager.progress({
//                                     text:'正在加载数据....',
//                                 });
//                              },
//                          success:function(data,response,status){
//                             $.messager.progress('close');
//                              if (data) {
//                            	  var cl_id=data.class_id;
//                            	$.ajax({
//                        		    url:ThinkPHP['MODULE']+'/User/getClass',
//                        		    type:'POST',
//                        		    data:{
//                        		    	school_id:data.school_id,
//                        		    },
//                        		    success:function(data,response,status){
//                        		       if (data) {
//                        		    	   $.each(data,function(n,value){
//                        		    		  if(value.id==cl_id){
//                            		              $('#edit_class').append('<option selected="selected" value="'+value.id+'">'+value.class_name+'</option>');
//                        		    		  }else{
//                            		              $('#edit_class').append('<option  value="'+value.id+'">'+value.class_name+'</option>');
//                        		    		  }
//                        		    	   });
//                        		       }
//                        		    },
//                        		  });
//                                  $('#user_edit').form('load',{
//                                     'id':data.id,
//                                     'edit_name':data.nick_name,
//                                     'edit_email':data.email,
//                                     'edit_mobile':data.mobile,
//                                     'edit_birthday':data.birthday,
//                                     'edit_sex':data.sex,
//                                     'edit_school':data.school_id,
//                                     'edit_group':data.group_id,
//                                     'edit_rule1':data.rule1_name,
//                                     'edit_rule2':data.rule2_name,
//                                  });
//                                  if(data.group_id==4){
//                                	  $('#edit_ru1').show();
//                                	  $('#edit_ru2').show();
//                                  }
//                                };
//                              },
//                            });
//          }else if (rows.length==0) {
//          $.messager.alert('警告操作','请选择一条数据进行修改!','warning');
//          };
//      },
// 	  	remove : function(){
//          var rows=$('#user').datagrid('getSelections');  //取得选中的数据
//          if(rows.length>0) {
//            $.messager.confirm('确认操作','您真的要删除所选的<strong>'+rows.length+'</strong>条记录吗!',function(flag){
//                if (flag) {
//                                  var ids=[];
//                                     for (var i = 0; i <rows.length; i++) {
//                                        ids.push(rows[i].id);
//                                     };
//                            $.ajax({
//                              url:ThinkPHP['MODULE']+'/User/reMove',
//                              type:'POST',
//                              data:{
//                                ids :  ids.join(','),//把数据按逗号方式分隔
//                              },
//                              beforeSend:function(){
//                                            $('#user').datagrid('loading');   //删除时显示加载框
//                              },
//                              success:function(data,response,status){
//                                              if (data) {
//                                $('#user').datagrid('loaded');   //删除完清空加载框
//                                $('#user').datagrid('reload');
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
// 	  	search : function() {
// 	  		$('#user').datagrid('load',{
// 	  			  nick_name:$.trim($('input[name="search_username"]').val()),
//                  group_id:$('#search_group_id').val(),
//                  school_id:$('#search_school_id').val(),
//                  class_id:$('#search_class_id').val(),
// 	  		});
// 	  	},
// 	  	clear : function(){
//              $('input[name="search_username"]').val('');
//          //    $('input[name="date_from"]').combo('setText','');
//          //    $('input[name="date_from"]').datebox("setValue","2012-12-12");
//          //    $('input[name="date_to"]').val('');
//
// 	  	},
//	 }
});