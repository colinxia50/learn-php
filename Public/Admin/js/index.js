$(function(){
	$('.navbar-default ul li a').unbind();
	$('.nav-second-level li a').click(function(){
		var link = $(this).attr('href');
		$.ajax({
			url:ThinkPHP['MODULE'] + link,
			type:'POST',
			beforeSend:function(){
				//$('#loadin').show();
			},
			success:function(data,response,status){
				if(data){
					$('#page-wrapper').html(data);
				}
			}
		})
	})
	$('#nav').tree({
		url:ThinkPHP['MODULE']+'/Index/getNav',
		lines:true,  //是否显示虚线
		onLoadSuccess:function(node,data){  //表示数据成功加载之后执行  ps:让图标自动展开
              var _this=this;
              if(data){  //如果有数据则执行
              	$(data).each(function(){
                    if(this.state == 'closed'){
                         $(_this).tree('expandAll');
                    }
              	});
              }else{
            	  $('#nav').tree('remove',node.target);//没有子节点则删除
              }
		},
		onClick : function(node){   //点击时新增一个管理页
          if (node.url) {  //表示如果有链接才能显示面板
			if ($('#tabs').tabs('exists',node.text)){  //判断如果此面板以存在则选则此面板,否则添加面板
	            $('#tabs').tabs('select',node.text);
			}else{
				     $('#tabs').tabs('add',{
	                 title:node.text,
	                 closable:true, //显示关闭的图标
	                 iconCls : node.iconCls,
	                 href:ThinkPHP['MODULE']+'/'+node.url,
	           });
			}
          };
		},

	});

	$('#tabs').tabs({
		border : false,
		fit : true,
	});
});