$(function(){

    $('#addCl').click(function(){
        var classid = $('input[name=classid]').val();
            var term = $('input[name=term]').val();
        alert(classid);
        alert(term);

        $.ajax({
            url:ThinkPHP['MODULE']+'/fee/save',
            type:'POST',
            data:{
                classid:$('input[name=classid]').val(),
                term:$('input[name=term]').val()
            },

            success:function(data,response,status){
                alert(data);
                if(data>0){

                    $('#myTishi p').text('修改成功!');
                    $('#myTishi').modal('show');
                }else{
                    $('#myTishi p').text('修改失败!');
                    $('#myTishi').modal('show');
                }
            }
        });
    });

});

