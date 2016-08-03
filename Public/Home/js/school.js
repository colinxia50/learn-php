$(function(){
	$('#save').click(function(){
		$.ajax({
			url:ThinkPHP['MODULE']+'/school/save',
			type:'POST',
			data:{
				name:$('input[name=school-name]').val(),
				address:$('input[name=school-address]').val(),
				cover:$('input[name=cover]').val(),
				mobile:$('input[name=school-mobile]').val(),
				content:$('textarea[name=school-content]').val(),
			},
			success:function(data,response,status){
				if(data>0){
                	$('#myTishi p').text('修改成功!');
                	$('#myTishi').modal('show');
				}else{
                	$('#myTishi p').text('修改失败!');
                	$('#myTishi').modal('show');
				}
			},
		});
	});
	
	 $('#file').uploadify({
		 swf : ThinkPHP['UPLOADIFY'] + '/uploadify.swf',
		 uploader: ThinkPHP['IMGONE'],
		 width:100,
		 height:100,
		 buttonText:'园长相片',
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
			 $('.face img').attr('src',ThinkPHP['IMG']+"/loading_100.gif");
		 },
		 onUploadSuccess : function(file,data,response){
			 var imageUrl=$.parseJSON(data);
			 $('.face img').attr('src',ThinkPHP['ROOT']+imageUrl);
			 $('input[name=cover]').val(imageUrl);
		 }
	 });
	
	
});