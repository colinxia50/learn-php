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
                url:ThinkPHP['MODULE']+'/Habit/getClass',
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
            url:ThinkPHP['MODULE']+'/Habit/index',
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

});