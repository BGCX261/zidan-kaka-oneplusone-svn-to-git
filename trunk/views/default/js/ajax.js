// JavaScript Document
$(document).ready(function(){
	
	
	 $(".kuai").hover(
	
			 function () {
             $(this).children(".kuai_2").css("background-color","#666");
			 
             },
			  function () {
				$(this).children(".kuai_2").css("background-color","#fff");
			 }
	)
	 

	
	$(".fenlei li").click(function(){
								   
	    
		var clsid=$(this).attr("cid");
		$(".fenlei").attr("cid",clsid);
		$(this).css('background-color','#8D3319').siblings("li").css('background-color','transparent');
		$(this).css("color","#fff").siblings("li").css("color","#000");
		$(this).attr('current',1).siblings("li").attr("current",0);
		var price= $(".price_1").attr("m");
		$.ajax({
   				type: "POST",
   				url: "index.php?con=index&act=grouplist&ajax=1",
				ifModified :false,
				cache:true,
				data: "grouptype="+clsid+"&price="+price,
				beforeSend: function(XMLHttpRequest){
                   $("#gooddata").html("loading....");
                }, 
   				success:function(msg){
					$("#gooddata").html(msg);
					
   				},
				complete: function(XMLHttpRequest, textStatus){
					
					$(".load").hide();
				 }
			});
	})
	$(".fenlei li").mouseover(function(){
							  $(this).css('background-color','#8D3319');
							  $(this).css('color','#fff');
									   })
	$(".fenlei li").mouseout(function(){
							  if($(this).attr('current')==1)
							  {
								  $(this).css('background-color','#8D3319');
								  $(this).css('color','#fff');
								
							  }
							  else
							  {
									$(this).css('background-color','transparent');
									$(this).css('color','#000');
							  }
									   })	
	$(".price_1 ul li").mouseover(function(){
							  if($(this).attr('id')!='allprice')
							{
							  $(this).css('background-color','#8D3319');
							  $(this).css('color','#fff');
							}
									   })
	$(".price_1 ul li").mouseout(function(){
							   if($(this).attr('current')==1)
							  {
								   $(this).css('background-color','#8D3319');
								   $(this).css('color','#fff');
								
							  }
							  else if($(this).attr('id')!='allprice')
							  {
									$(this).css('background-color','transparent');
									$(this).css("color","#9F3712");
							  }
	})
   
   $("#text_list ul li").click(function(){
	   $("#text_list ul li").each(function(){
	     $(this).attr("class","");		
	   });
	   $(this).attr("class","click_this");
	   var cateID=$(this).attr("id");
	   var cID=cateID.replace('s_cate_','');
	   $.ajax({
   				type: "POST",
   				url: "index.php?ajax=1",
				ifModified :false,
				cache:true,
				data: "cateid="+cID,
				beforeSend: function(XMLHttpRequest){
                   $("#textsite_list").html("loading, please waiting....");
                }, 
   				success:function(msg){
					$("#textsite_list").html(msg);					
   				}
		});
   });
   
   
	$(".price_1 li").click(function(){
		
		var va=$(this).html();
		 $(".price_1").attr("m",va);
		 $(this).css('background-color','#8D3319').siblings("li").css('background-color','transparent');
		$(this).css('color','#fff');
		$(this).siblings("li").css("color","#9F3712");
		$(this).attr('current',1).siblings("li").attr("current",0);
		var clsid=$(".fenlei").attr("cid");
		$.ajax({
   				type: "POST",
   				url: "index.php?con=index&act=grouplist&ajax=1",
				data: "grouptype="+clsid+"&price="+va,
				ifModified :false,
				cache:true,
				beforeSend: function(XMLHttpRequest){
                   $("#gooddata").html("loading....");
                }, 
   				success:function(msg){
					$("#gooddata").html(msg);
   				},
				complete: function(XMLHttpRequest, textStatus){
					
					$(".load").hide();
				 }
			});
	});
	
	
	
	$(".paixu li:gt(0)").click(function(){
		
		var va=$(".price_1").attr("m");		
		 var clsid=$(".fenlei").attr("cid");
		var page=$(".page").attr("page");
		var num=$(".page").attr("num");
	    var sor=$(this).attr("tit");
		$("#temppaixu").html(sor)
		$.ajax({
   				type: "POST",
   				url: "index.php?con=index&act=grouplist&ajax=1",
				data: "grouptype="+clsid+"&price="+va+"&sor="+sor,
				ifModified :false,
				cache:true,
				beforeSend: function(XMLHttpRequest){
                   $("#gooddata").html("loading....");
                }, 
   				success:function(msg){
					$("#gooddata").html(msg);
   				},
				complete: function(XMLHttpRequest, textStatus){
					
					$(".load").hide();
				 }
			});
	});
	$(".paixu li").click(function(){
			$(this).css("color","#9F3712").siblings("li").css("color","#000");
	})
	$(".paixu li").mouseover(function(){
									  $(this).css("background","#ff6600");
									  })
	$(".paixu li").mouseout(function(){
									  $(this).css("background","none");
									  })
	

})

function fen(page){

		var clsid=$(".fenlei").attr("cid");
		$(".fenlei").attr("cid",clsid);
		var page=page;
		var num=$(".page").attr("num");
		$(".page2").attr("page",page)
		var price= $(".price_1").attr("m");
		
		$.ajax({
   				type: "POST",
   				url: "index.php?con=index&act=grouplist&ajax=1",
				ifModified :false,
				cache:true,
				data: "grouptype="+clsid+"&price="+price+"&page="+page,
				beforeSend: function(XMLHttpRequest){
                   $("#gooddata").html("loading....");
                }, 
   				success:function(msg){
					$("#gooddata").html(msg);
					
   				},
				complete: function(XMLHttpRequest, textStatus){
					
					$(".load").hide();
				 }
			});

}

function bor(obj){

     $(obj).parent("a").parent(".kuai_2").css("background-color","#666");
 
}
function boro(obj){

     $(obj).parent("a").parent(".kuai_2").css("background-color","#fff");


}
function click_b(url,target){
   
		window.open(url,target,'');
}

function click_c(gid,url,target){
   
		$('#hits'+gid).html(parseInt($('#hits'+gid).html())*1+1);
		$.ajax({
				type: "POST",
				url: "index.php?con=index&act=hit",
			    data: "gid="+gid
		});
		window.open(url,target,'');
}

function getMore()
{
	var va=$(".price_1").attr("m");		
	var clsid=$(".fenlei").attr("cid");
	var sor=$(".paixu li:gt(0)").attr('tit');
	var citypage=parseInt($(".groupmore").attr('id'));
	
	if(citypage>0)
	{

		$.ajax({
				type: "POST",
				url: "index.php?ajax=2",
				data: "grouptype="+clsid+"&price="+va+"&citypage="+citypage+'&sor='+$("#temppaixu").html(),
				ifModified :false,
				cache:true,
				beforeSend: function(XMLHttpRequest){
                   $(".groupmore").attr('disabled','disabled');
                }, 
				success:function(msg){
					if(msg.length>10)
					{
						$(".groupmore").attr('id',citypage*1+1);
						$("#citydata").append(msg);
						$(".groupmore").attr('disabled','');
					}
					else
					{
						$(".groupmore").attr('id',0);
						$(".groupmore").html('没有更多信息了...');
					}
				}
			});
		
	}
}