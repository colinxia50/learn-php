$(function(){

    var uploadMin=$('input[name=count]').val();
    var uploadMax=6-uploadMin;
    $('#file').uploadify({
        swf : ThinkPHP['UPLOADIFY'] + '/uploadify.swf',
        uploader: ThinkPHP['IMGPST'],
        width:100,
        height:100,
        buttonText:'添加图片',
        buttonCursor:'hand',
        fileTypeDesc:'图片类型',
        fileSizeLimit : '1MB',
        fileTypeExts:'*.jpeg; *.jpg; *.png; *.gif;',
        overrideEvents : ['onSelectError','onSelect','onDialogClose'],
        onSelectError : function(file,errorCode,errorMsg){
            switch(errorCode){
                case -110 :
                    alert('超过指定大小');
                    break;
            }
        },
        onUploadStart : function(){
            if(uploadMin==6){
                $('#file').uploadify('stop');
                $('#myTishi p').text('只能上传6张图片!');
                $('#myTishi').modal('show');
            }else{
                $('.content-thumb').append("<div class='content-thumb-pic'><input type='hidden' name='images' class='imagess' value=''/><img src='"+ThinkPHP['IMG']+"/loading_100.gif' alt='图片' class='img-thumbnail growing-img'><span class='color'></span><span class='zt'>删除</span></div>");
            }

        },
        onUploadSuccess : function(file,data,response){
            var imageUrl=$.parseJSON(data);
            uploadMin++;
            uploadMax--;
            thumb(data,imageUrl);
            hover();
            remove();
        }
    });

    function thumb(data,imageUrl){
        var img=$('.growing-img');
        var inputImg=$('.imagess');
        var len=img.length;
        var inputLen=inputImg.length;
        $(img[len-1]).attr('src',ThinkPHP['ROOT']+imageUrl.thumb);
        $(inputImg[inputLen-1]).val(data);
    }

    function hover(){
        var content=$('.content-thumb-pic');
        var len=content.length;
        $(content[len-1]).hover(function(){
            $(this).find('.color').show();
            $(this).find('.zt').show();
        },function(){
            $(this).find('.color').hide();
            $(this).find('.zt').hide();
        });
    }

    rshover();
    function rshover(){
        var content=$('.content-thumb-pic');
        $(content).hover(function(){
            $(this).find('.color').show();
            $(this).find('.zt').show();
        },function(){
            $(this).find('.color').hide();
            $(this).find('.zt').hide();
        });
    }

    rsremove();
    function rsremove(){
        var remove=$('.content-thumb-pic .zt');
        $(remove).on('click', function () {
            $(this).parent().remove();
            uploadMin--;
            uploadMax++;
            $('.min').text(uploadMin);
            $('.max').text(uploadMax);
        });
    }


    function remove(){
        var remove=$('.content-thumb-pic .zt');
        var len = remove.length;
        $(remove[len - 1]).on('click', function () {
            $(this).parent().remove();
            uploadMin--;
            uploadMax++;
            $('.min').text(uploadMin);
            $('.max').text(uploadMax);
        });
    }


    //新增验证
    $('.editstory').bootstrapValidator({
        message: 'This value is not valid',
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
            title: {
                message: '请输入标题',
                validators: {
                    notEmpty: {
                        message: '标题不得为空'
                    },
                    stringLength: {
                        min: 2,
                        max: 30,
                        message: '标题长度为2到20位之间'
                    },
                }
            },
            content:{
                validators: {
                    notEmpty: {
                        message: '内容不得为空'
                    },
                }
            },
        }
    });

    //新增验证
    $('.editopus').bootstrapValidator({
        message: 'This value is not valid',
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
            title: {
                message: '请输入标题',
                validators: {
                    notEmpty: {
                        message: '标题不得为空'
                    },
                    stringLength: {
                        min: 2,
                        max: 30,
                        message: '标题长度为2到30位之间'
                    },
                }
            },
        }
    });



    //禁用表单自动提交
    $(".editopus").submit(function(e){
        e.preventDefault();
    });

    //修改新闻
    $('#edit-opus').click(function(){
        var img=new Array();
        var i=0;

        $('.imagess').each(function(){
            img[i]=$(this).val();
            i++;
        });

        $.ajax({
            url:ThinkPHP['MODULE']+'/Articles/update',
            type:'POST',
            data:{
                id:$('input[name=id]').val(),
                title:$('input[name=title]').val(),
                content:$('textarea[name=content]').val(),
                images:img,
            },
            success:function(data,response,status){
                if(data>0){
                    $.ajax({
                        url:ThinkPHP['MODULE']+'/Articles/index',
                        type:'POST',
                        data:{
                            id:$('input[name=classid]').val(),
                        },
                        beforeSend:function(){
                            $('.main-right').empty();
                            $('#loadin').show();
                        },
                        success:function(data,response,status){
                            if(data){
                                $('#loadin').hide();
                                $('.main-right').append(data);
                            }
                        }
                    });
                }else{
                    $('#myTishi p').text('未知错误!');
                    $('#myTishi').modal('show');
                    $('#fb-story').attr('disabled',false);
                }
            }
        })


    });
});