$(function(){

	
	
	//简单的事件处理程序，响应自onChange,onSelect事件，按照上面的Jcrop调用
	function showPreview(coords){
		$('#x').val(coords.x);
		$('#y').val(coords.y);
		$('#w').val(coords.w);
		$('#h').val(coords.h);
		if(parseInt(coords.w) > 0){
			//计算预览区域图片缩放的比例，通过计算显示区域的宽度(与高度)与剪裁的宽度(与高度)之比得到
			var rx = $("#preview_box").width() / coords.w; 
			var ry = $("#preview_box").height() / coords.h;
			//通过比例值控制图片的样式与显示
			$("#crop_preview").css({
				width:Math.round(rx * $("#face").width()) + "px",	//预览图片宽度为计算比例值与原图片宽度的乘积
				height:Math.round(rx * $("#face").height()) + "px",	//预览图片高度为计算比例值与原图片高度的乘积
				marginLeft:"-" + Math.round(rx * coords.x) + "px",
				marginTop:"-" + Math.round(ry * coords.y) + "px"
			});
		}
	}
	
	 $('#file').uploadify({
		 buttonClass : 'some-class',
		 swf : ThinkPHP['UPLOADIFY'] + '/uploadify.swf',
		 uploader: ThinkPHP['FACEURL'],
		 width:134,
		 height:34,
		 buttonText:'头像上传',
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
			 $('#loading').modal('show');
		 },
		 onUploadSuccess : function(file,data,response){
			  $('#loading').modal('hide');
			  $('#success').modal('show');
              if(data){
            	  $('#face, #crop_preview').attr('src', ThinkPHP['ROOT'] + '/' + $.parseJSON(data));
            	  $('#preview_box').show();
            	  $('.save,.cancel').show();
            	  $('#url').val($.parseJSON(data));
            	  $('#face').one('load', function () {
	            		jcrop=$.Jcrop('#face',{
	                			onChange:showPreview,
	                		    onSelect:showPreview,
	                			aspectRatio:1,
	            		});
						//设置自动选区
						jcrop.setSelect([0, 0, 200, 200]);
						$('#success').modal('hide');
	            	  $('#file').hide();
            	  });
              }
		 }
	 });
	 
		//取消当前图片裁剪
		$('.cancel').click(function (e) {
			jcrop.destroy();
			if(ThinkPHP['BIGFACE'].length > 0){
				$('#face,#crop_preview').attr('src', ThinkPHP['ROOT'] + '/'+ThinkPHP['BIGFACE']);
			}else{
				$('#face,#crop_preview').attr('src', ThinkPHP['IMG'] + '/big.jpg');
			}
			
			$('#preview_box').hide();
			$('.save,.cancel').hide();
			$('#file').show();
			return nothing(e);
		});
	 
		// 处理程序阻止事件的继续进行，可能不是必须的，但是原作者(Kelly Hallman)很喜欢
		function nothing(e){
			e.stopPropagation();
			e.preventDefault();
			return false;
		};
		
		
		//保存头像
		$('.save').click(function () {
			$.ajax({
				url: ThinkPHP['MODULE'] + '/File/crop',
				type: 'POST',
				data: {
					x : $('#x').val(),
					y : $('#y').val(),
					w : $('#w').val(),
					h : $('#h').val(),
					url : $('#url').val(),
				},
				beforeSend : function () {
					jcrop.destroy();
					$('.save, .cancel').hide();
					$('#loading').modal('show');
				},
				success: function(data, response, status){
					if (data) {
						$('#loading').modal('hide');
						$('#success').modal('show');
						$('#face,#crop_preview').attr('src', ThinkPHP['ROOT'] + $.parseJSON(data)['big'] + '?random=' + Math.random());
						$('#preview_box').hide();
						$('#file').show();
						setTimeout(function(){
							$('#success').modal('hide');
							window.location.reload();//刷新当前页面.
							}, 500);
					}
				}
			});
		});
})