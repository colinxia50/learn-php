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
            url:ThinkPHP['MODULE']+'/Habit/lists',
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
            url:ThinkPHP['MODULE']+'/Habit/reMove',
            type:'POST',
            data:{
                id:$('input[name=delid]').val(),
            },
            success:function(data,response,status){
                $('#delUser').modal('hide');
                if(data){
                    alert('删除成功');
                    window.location.href = url;
                }else {
                    alert('删除失败');
                }
                // $('#page-wrapper').html(data);
            }
        });
    })

    $('#add_User').click(function(){
        $.ajax({
            url:ThinkPHP['MODULE']+'/Habit/addArticle',
            type:'POST',
            data:$('#add').serialize(),
            success:function(data,response,status){
                if(data < 0){
                    alert(data);
                }else{
                    $('#addUser').modal('hide');
                    $('#page-wrapper').html(data);
                }
            }
        });
    });

    $('.User_update').click(function(){
        $.ajax({
            url:ThinkPHP['MODULE']+'/Habit/getArticle',
            type:'POST',
            data:{
                id:$(this).attr('xid'),
            },
            success:function(data,response,status){
                if(data){
                    $('#title').val(data.title);
                    $('#content').val(data.content);
                    $('input[name=id]').val(data.id);
                }
            }
        });
    })

    $('#edit_User').click(function(){
        var formdata = $('#edit').serialize();
        formdata.id = $(this).attr('xid');
        $.ajax({
            url:ThinkPHP['MODULE']+'/Habit/updateArticle',
            type:'POST',
            data:formdata,
            success:function(data,response,status){
                if(data < 0){
                   alert(data);
                }else{
                    $('#editUser').modal('hide');
                    $('#page-wrapper').html(data);
                }
            }
        });
    });

});