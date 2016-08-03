
$(function(){
    $('select[name=school_id]').change(function(){
        if($(this).val() != ""){
            $.ajax({
                url:ThinkPHP['MODULE']+'/New/getClass',
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
            url:ThinkPHP['MODULE']+'/New/index',
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
            url:ThinkPHP['MODULE']+'/New/index',
            type:'POST',
            data:{
                searchText:$('#searchText').val(),
            },
            success:function(data,response,status){
                $('#page-wrapper').html(data);
            }
        });
    });

    $('.News_delete').click(function(){
        $('input[name=delid]').val($(this).attr('xid'));
    })

    $('#del_News').click(function(){
        $.ajax({
            url:ThinkPHP['MODULE']+'/New/remove',
            type:'POST',
            data:{
                ids:$('input[name=delid]').val(),
            },
            success:function(data,response,status){
                $('#delNews').modal('hide');
                $('#page-wrapper').html(data);
            }
        });
    })

    $('#add_News').click(function(){
        var data = $('#add').serialize();
        data.content = $('#addcontent').html();
        $.ajax({
            url:ThinkPHP['MODULE']+'/New/add',
            type:'POST',
            data:data,
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
                    $('#addNews').modal('hide');
                    $('#page-wrapper').html(data);
                }
            }
        });
    });

    $('.News_update').click(function(){
        $.ajax({
            url:ThinkPHP['MODULE']+'/New/getnew',
            type:'POST',
            data:{
                id:$(this).attr('xid'),
            },
            success:function(data,response,status){
                if(data){
                    $('#title').val(data.title);
                    $('#editcontent').html(data.content);
                    $('input[name=id]').val(data.id);
                }
            }
        });
    })

    $('#edit_News').click(function(){
        $.ajax({
            url:ThinkPHP['MODULE']+'/New/update',
            type:'POST',
            data:{
                title:$('#title').val(),
                content:$('#editcontent').val(),
                id:$('#id').val(),
            },
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
                    $('#editNews').modal('hide');
                    $('#page-wrapper').html(data);
                }
            }
        });
    });

    $('.News_see').click(function(){
        $.ajax({
            url:ThinkPHP['MODULE']+'/New/detail',
            type:'POST',
            data:{
                id:$(this).attr('xid'),
            },
            success:function(data,response,status){
                $('#page-wrapper').html(data);
            }
        });
    })
});