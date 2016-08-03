$(function(){
	var uploadMin=0;
	var uploadMax=6;
	 $('#file').uploadify({
		 swf : ThinkPHP['UPLOADIFY'] + '/uploadify.swf',
		 uploader: ThinkPHP['IMGURL'],
		 width:100,
		 height:100,
		 buttonText:'添加照片',
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
					alert('只能上传6张图片');
			  }else{
			 $('.content-thumb').append("<div class='content-thumb-pic'><input type='hidden' name='images' class='imagess' value=''/><img src='"+ThinkPHP['IMG']+"/loading_100.gif' alt='图片' class='img-thumbnail growing-img'><span class='color'></span><span class='zt'>删除</span></div>");
			  }
			
		 },
		 onUploadSuccess : function(file,data,response){
			 var imageUrl=$.parseJSON(data);
			 uploadMin++;
			 uploadMax--;
			 thumb(data,imageUrl);
			 $('.min').text(uploadMin);
			 $('.max').text(uploadMax);
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
		
		//学生全选
	 $('#quan').click(function(){
		 if($(this).attr('n')==1){
				$(this).removeClass('btn-default');
				$(this).addClass('btn-success');
				$(this).text('取消全选');	
				$(this).attr('n','2');
				$('.std .hx').show();
				$('.std a').attr('n','2');
		 }else if($(this).attr('n')==2){
				$(this).removeClass('btn-success');
				$(this).addClass('btn-default');
				$(this).text('全选');	
				$(this).attr('n','1');
				$('.std .hx').hide();
				$('.std a').attr('n','1');
		 }
	 });
	 
	 //动态添加点击单个学生选择事件
	 $('.std').on('click','a',function(){
	 	if($(this).attr('n')==1){
			 $(this).attr('n',2);
			 $(this).parent().find('.hx').show();			 
		 }else if($(this).attr('n')==2){
			 $(this).attr('n',1);
			 $(this).parent().find('.hx').hide();				 
		 }
	 })
    //动态添加学生
    $('#ClassStu').change(function(){
    	var id=$(this).val();
    	$.ajax({
          url:ThinkPHP['MODULE']+'/child/allChild',
          type:'POST',
          data:{
          	id:id,
          },
          success:function(data,response,status){
          	if (data) {
          	 $('.std').find('*').remove();
             $.each(data,function(n,value){
                   $('.std').append('<div class="col-md-2"><a class="btn btn-default" n="1" uid="'+value.id+'">'+value.name+' <span class="glyphicon glyphicon-heart hx" style="color:red;display:none;"></span></a></div>');
             })
             };
          }
    	});
    })
  //选择学生
  $('#xzstu').click(function(){
  	    var arr = new Array();
  	    var arr1 = new Array();
  	    var i=0;
        var stu=$('.std a');
        var len=stu.length;
        $('.std a').each(function(){
             if ($(this).attr('n')==2) {
              arr[i]=$(this).attr('uid');
              arr1[i]=$(this).text();
              i++;          	
             };
        });
        var l=arr1.length;
        switch(l){
        	case 0:
        	  alert('请选择至少一名学生');
        	break;
        	case 1:
        	  $('.xzchild').text(arr1.join());
        	break;
        	case 2:
        	  $('.xzchild').text(arr1.join()+'等2名学生..');
        	break;
        	default:
        	  var b=arr1.join();
        	  $('.xzchild').text(b.substr(0,6)+'等'+l+'名学生..');
        	break;
        }

	        $('#myStudent').modal('hide');	        
	        $('input[name=allStu]').val(arr.join());

  });

  //发布宝宝动态
  $('#fbch').click(function(){
	  
	  var img=new Array();
	  var i=0;
	  
	  $('.imagess').each(function(){
		  img[i]=$(this).val();
		  i++;		  
	  });	  
	  if($('input[name=allStu]').val()==''){
	      	$('#myTishi p').text('请选择学生!');
	    	$('#myTishi').modal('show');
      }else if(img.length==0 && $('#info').val().length==0){
	      	$('#myTishi p').text('请输入微博内容!');
	    	$('#myTishi').modal('show');
	  }else if(img.length>0 && $('#info').val().length==0){
		  $('#info').val('分享图片');
		  growing_ajax_send(img);
	  }else{
		  growing_ajax_send(img); 
	  }
  });
	 
   function growing_ajax_send(img){
	      $.ajax({
		      	 url:ThinkPHP['MODULE']+'/growing/addgrowing',
		      	 type:'POST',
		      	 data:{
		      	 	info:$('#info').val(),
		      	 	images:img,
		      	 	cid:$('input[name=allStu]').val(),
		      	 },
				 beforeSend:function(){
					 $('#loading ').modal('show');
				 },
		      	 success:function(data,response,status){
		      	 	if(data>0){
		      	 	 $('#loading ').modal('hide');
		      	 	 $('#success ').modal('show');
		      	 	 
		      	 	 var html='';
		      	 	 switch(img.length){
		      	 	   case 0:
		      	 		   html=$('#ajax-html1').html();
		      	 		   break;
		      	 	   case 1:
		      	 		   html=$('#ajax-html2').html();
		      	 		   img=$.parseJSON(img);
		      	 		   break;
		      	 	   default:
		      	 		$('#ajax-html3 .row').find('*').remove();
		      	 		   for(var i=0;i<img.length;i++){
		      	 			   img_arr=$.parseJSON(img[i]);
		      	 			   $('#ajax-html3').find('.row').append('<div class="col-xs-6 col-md-3 imgs"><a href="javascript:void(0)" class="thumbnail"><img src="'+ThinkPHP['ROOT']+'/'+img_arr['thumb']+'" unfold-src="'+ThinkPHP['ROOT']+'/'+img_arr['unfold']+'" source-src="'+ThinkPHP['ROOT']+'/'+img_arr['source']+'"></a></div>');
		      	 		   }
		      	 	       html=$('#ajax-html3').html();
		      	 	 }
		      	 	 if(html.indexOf('#内容#')){
		      	 		 html=html.replace(/#内容#/g,$('#info').val());
		      	 	 }
		      	 	 if(html.indexOf('#缩略图#')){
		      	 		 html=html.replace(/#缩略图#/g,ThinkPHP['ROOT']+'/'+img['thumb']);
		      	 	 }
		      	 	 if(html.indexOf('#原图#')){
		      	 		 html=html.replace(/#原图#/g,ThinkPHP['ROOT']+'/'+img['source']);
		      	 	 }
		      	 	 if(html.indexOf('#放大图#')){
		      	 		 html=html.replace(/#放大图#/g,ThinkPHP['ROOT']+'/'+img['unfold']);
		      	 	 }		      	 	 
		      	 		setTimeout(function(){
		      	 			$('#success ').modal('hide'); //隐藏正确提示图标
			      	 		$('#info').val('');  //清空内容
			      	 		$('.content-pic').hide();
			      	 		$('.mesg').hide();
			      	 	    $('.content-thumb').find('*').remove();
			      	 		uploadMin=0;
			      	 		uploadMax=6;
				   			$('.min').text(uploadMin);
							$('.max').text(uploadMax);
							$('.xzchild').text('选择学生 ');
							$('.xzchild').append('<span class="glyphicon glyphicon-plus"></span>');
							$('input[name=allStu]').val('');
						    $('.std').find('*').remove();
						    $('.list .z').after(html);
		      	 		},500);
		      	 	}else{
		      	 		$('#loading ').modal('hide');
		      	 		alert('新增失败');
		      	 	}
		      	 }
		      })
   }
    //多图点击放大
     $('.list').on('click','.imgs img',function(){
    	 $('#imgs').modal('show');
    	 $('#imgs a').attr('href',$(this).attr('source-src'));
    	 $('#imgs img').attr('src',$(this).attr('unfold-src'));
     })
    //单图点击放大
    $('.list').on('click','.img-th img',function(){
    	$(this).parent().parent().parent().hide();
    	var img_zoom=$(this).parent().parent().parent().next('.img-zoom');
    	var img=img_zoom.find('img');
    	img_zoom.show();
    	img.attr('src',img.attr('data'));
    })
    //点击图片缩小
    $('.list').on('click','.img-zoom img',function(){
    	$(this).parent().parent().hide();
    	$(this).parent().parent().prev('.img-th').show();
    })
     //点击图片缩小
    $('.in').click(function(){
    	$(this).parent().parent().hide();
    	$(this).parent().parent().prev('.img-th').show();
    })  
    
    	//得到总页码
	$.ajax({
		url : ThinkPHP['MODULE'] + '/Growing/ajaxCount',
		type : 'POST',
		data : {
			
		},
		success: function(data, response, status){
			window.count = parseInt(data);
		}
	});
    
    
    //滚动条拖动
    window.scrollFlag = true;
	window.first = 10;
	window.page = 1;
    $(window).scroll(function(){
    	if (window.page < window.count) {
		    	if (window.scrollFlag) {
			    	if ($(document).scrollTop() >= ($('#loadmore').offset().top + $('#loadmore').outerHeight() - $(window).height() - 20)) {
			    		setTimeout(function(){
							$.ajax({
								url: ThinkPHP['MODULE'] + '/Growing/ajaxlist',
								type: 'POST',
								data: {
									first: window.first,
								},
								success: function(data, response, status){
									$('#loadmore').before(data);
		//							allHeight();
		//							setUrl();
								}
							});
			    			window.scrollFlag = true;
							window.first += 10;
							window.page += 1;
			    		},500);
						window.scrollFlag = false;
			    	 }
		    	}
    	}else{
    		$('#loadmore').html('没有更多数据');
    	}
    });
	 $('#info').focus(function(){
		$('.content-pic').show(); 
		$('.mesg').show();
	 });
	 
	 $.scrollUp({
			scrollName: 'scrollUp', // Element ID
			topDistance: '300', // Distance from top before showing element (px)
			topSpeed: 300, // Speed back to top (ms)
			animation: 'fade', // Fade, slide, none
			animationInSpeed: 200, // Animation in speed (ms)
			animationOutSpeed: 200, // Animation out speed (ms)
			scrollText: '', // Text for element
			activeOverlay: false, // Set CSS color to display scrollUp active
		});
	 
	 
});