// JavaScript Document
$(function(){
    
  
 
 $('#deal-share-im').toggle(function(){
									 
		 $('#deal-share-im-c').show();
		 },function(){
		 $('#deal-share-im-c').hide();
 
 }); 

	
$('.kuai').mouseover(function(){$(this).css('background','#D9CFC1');});
$('.kuai').mouseout(function(){$(this).css('background-color','transparent');});	
	$("#search_text").click(function(){
		$("#search_text").val("");
	});
	$("#search_text").focus(function(){
		$("#search_text").val("");
	});
	$("#click").click(function(){
		//$("#ceng").hide();
		//$("#ceng2").hide();
	});
	$("#input_btn").click(function(){
		var search_text = $("#search_text").val();
		if(($.trim(search_text)).length <=0)
		{
			alert("请输入你要搜索的内容！");
			return false;
		}
	});
	$(".gougao").click(function(){
		var href=$(".gougao").attr("name");
		if(href !="")
		{
	    	window.open(href);
		}
	})
	$("#add_index").click(function(){
		var lan = window.location;   
		if (document.all) {   
			document.body.style.behavior = 'url(#default#homepage)';   
			var body = document.body;   
			body.setHomePage(lan.href);   
		} else if (window.sidebar) {   
			if (window.netscape) {   
				try {    
					netscape.security.PrivilegeManager.enablePrivilege("UniversalXPConnect");    
				} catch (e) {   
					alert("该操作被浏览器拒绝，如果想启用该功能，请在地址栏内输入 about:config,然后将项 signed.applets.codebase_principal_support 值该为true");    
				}   
			}   
			var prefs = Components.classes['@mozilla.org/preferences-service;1'].getService(Components. interfaces.nsIPrefBranch);   
			prefs.setCharPref('browser.startup.homepage', lan.href);   
		}   
	});
	$("#nav_left_top_1").hide();
	$("#hang_1").hide();
	$("#nav_right_top_1").hide();
	$("#nav_right_bot_1").hide();
	
	$("#nav_left_top_1 #nav_one_1").mouseover(function(){
		$("#nav_left_top_1").hide();
		$("#nav_left_top").show();	
		$("#hang").show();
		$("#hang_1").hide();	
	});	   
	$("#nav_left_top #nav_two").mouseover(function(){
		$("#nav_left_top").hide();
		$("#nav_left_top_1").show();	
		$("#hang").hide();
		$("#hang_1").show();
	});	 
	
	$("#nav_right_top_1 #nav_one_3").mouseover(function(){
		$("#nav_right_top_1").hide();
		$("#nav_right_top").show();
		$("#nav_right_bot_1").hide();
		$("#nav_right_bot").show();
	});
	$("#nav_right_top #nav_two_2").mouseover(function(){
		$("#nav_right_top").hide();
		$("#nav_right_top_1").show();
		$("#nav_right_bot_1").show();
		$("#nav_right_bot").hide();
	});
	
	/*$("#middle_bot_top #nav_two_4").mouseover(function(){
		$("#middle_bot_top_1").show();
		$("#middle_bot_top").hide();
		$("#middle_bot_top_2").hide();
		
		$("#middle_bot_bot").hide();
		$("#middle_bot_bot_1").show();
		$("#middle_bot_bot_2").hide();
	});
	$("#middle_bot_top #nav_three_4").mouseover(function(){
		$("#middle_bot_top_1").hide();
		$("#middle_bot_top").hide();
		$("#middle_bot_top_2").show();
		
		$("#middle_bot_bot").hide();
		$("#middle_bot_bot_1").hide();
		$("#middle_bot_bot_2").show();
	});
	
	$("#middle_bot_top_1 #nav_one_5").mouseover(function(){
		$("#middle_bot_top_1").hide();
		$("#middle_bot_top").show();
		$("#middle_bot_top_2").hide();
		
		$("#middle_bot_bot").show();
		$("#middle_bot_bot_1").hide();
		$("#middle_bot_bot_2").hide();
	});
	$("#middle_bot_top_1 #nav_three_5").mouseover(function(){
		$("#middle_bot_top_1").hide();
		$("#middle_bot_top").hide();
		$("#middle_bot_top_2").show();
		
		$("#middle_bot_bot").hide();
		$("#middle_bot_bot_1").hide();
		$("#middle_bot_bot_2").show();
	});
	
	$("#middle_bot_top_2 #nav_one_6").mouseover(function(){
		$("#middle_bot_top_1").hide();
		$("#middle_bot_top").show();
		$("#middle_bot_top_2").hide();
		
		$("#middle_bot_bot").show();
		$("#middle_bot_bot_1").hide();
		$("#middle_bot_bot_2").hide();
	});
	$("#middle_bot_top_2 #nav_two_6").mouseover(function(){
		$("#middle_bot_top_1").show();
		$("#middle_bot_top").hide();
		$("#middle_bot_top_2").hide();
		
		$("#middle_bot_bot").hide();
		$("#middle_bot_bot_1").show();
		$("#middle_bot_bot_2").hide();
	});
	*/
	//选择地区代码
	
	
		$("#ceng1").hide();
		
		//弹出层可以拖??
	  $(".qiehuan_city").click(function(){
		$("#ceng1").css({
			//大图的位置根据窗口来判断
			"left":($(window).width()/2-250>20?$(window).width()/2-250:20),
			"top":($(window).height()/2-270>30?$(window).height()/2-270:30)
		}).css("border","1px #DF4C18 solid");
		//$("#ceng").fadeIn("slow");
		// 
		$("#ceng1").toggle();
		
				$("#ceng1").hover(
				  function () {
					
				  },
				  function () {
					$("#ceng1").hide();
				  }
				);
		
		//$("#ceng").hide();
	});

//脚步

$(".f3").click(function(){

		$(".footer").fadeOut("slow");
});

    $('#s_website_0').show();
	$('.search_btn a').click(function(){
	  $('.search_btn a').each(function(i){
	    $(this).attr('class','');
		$('#s_website_'+i).css('display','none')
		$(this).attr('value',i);
	  });
	  $(this).attr('class','show_red');
	  var numid=$(this).attr('value');
	  var webname=$('#s_website_'+numid).attr('value');
	  $('#s_website_'+numid).css('display','block')
	  $('#s_logo').css('background','url(/views/default/images/'+webname+'.jpg) no-repeat');
	  $('#s_web').attr('value',webname);
	})	//改变按钮样式选择显示的搜索引擎	
	
	$('.s_btn').click(function(){
	  var s_webname=$('#s_web').val();
	  var keyword=$("input[name='keyword']").val();
	  if(keyword){
	     if(s_webname=='baidu' || s_webname=='soso'){
	        window.open($("input[name='"+ s_webname +"_web']:checked").val()+keyword);
	     }
	     else{
	        window.open($("input[name='"+ s_webname +"_web']:checked").val()+encodeURI(keyword));
	     }
	  }else{
	     alert("请输入搜索关键词！");
	  }
	});	//搜索框JS结束
		
	$('.l_menu_log a').click(function(){
	  $('.l_menu_log a').each(function(i){
	    $(this).attr('class','this_down');
		$('#sitelist_'+i).css('display','none');
	  });
	  var showID=$(this).attr('value');
	  $(this).attr('class','this_up');
	  $('#'+showID).css('display','block');
	});//LOGO列表JS结束

//下面是显示提示的
$("#change").mouseover(function()
		{
			$("#img").show(100);	
		}).mouseout(function()
			{
			$("#img").hide(100);	
			});

$("ul li a").mouseover(function ()
	{
		$(this).css("text-decoration","underline");	
		//$(this).css("background-color","#000");
	}).mouseout(function ()
		{
			$(this).css("text-decoration","none");
			//$(this).css("background-color","");
		});
    

//下面是记住城市的
$("#change").click(function ()
		{
			if($("#change").attr("checked")==true)

			{
				$("#ceng").hide();
				var city = $("#ci_id").val();
				var i = 1;
			}
			else
			{
				$("#ceng").hide();
				var city = $("#ci_id").val();
				var i = 0;	
			}
				var url = "test.php?id="+city+"&i="+i;
				url = encodeURI(url);
				$.get(url,"",function(msg){
				})
		});
			//下面是判断是否选中复选框
		  var cook = $("#cookie_val").val();
		  var city_id = $("#ci_id").val();
		  var type = $("#type").val();
		  if(type == 1)
		  {
			return false; 
		  }
		  
		  else if(type==0 &&(cook != "") && (cook == city_id))
		  {
			  window.location.href="index_city.php?id="+cook;
		  }
	$("#close").click(function ()
		{
			$("#ceng1").hide();
		});
	$(".sort_time").click(function ()
		{
			var sort_time="1";
			window.location.href="index.php?sort="+sort_time;
		});
	
	$(".index").click(function ()
		{
			var sort_time="2";
			window.location.href="index.php?sort="+sort_time;
		});
	$(".sort_asc").click(function ()
		{
			var sort_time="3";
			window.location.href="index.php?sort="+sort_time;
		});
    $(".sort_desc").click(function ()
		{
			var sort_time="4";
			window.location.href="index.php?sort="+sort_time;
		});
	
	 $(".banner_nav li").click(function(){
	  	$(".banner_nav li").removeClass().addClass("nav_2");
		$(this).removeClass().addClass("nav_1");
		var id=$(this).attr('id');
		$(".main_banner_1_list").css("display","none");
		$('#'+id+'_menu').eq(0).css("display","block");
		
	});
	

	
		
});

function copyToClipboard(theField,isalert)
{
  var obj=document.getElementById(theField);
  if(obj!=null)
  {
    var clipBoardContent=obj.value;
    obj.select();
    window.clipboardData.setData("Text",clipBoardContent); 
    if(isalert!=false)
      alert("复制成功。现在您可以粘贴（Ctrl+v）到QQ中了。");
  }
  else
  {
     alert("Error!");
  }
}


function countDown(){
var i;
var objArray =document.getElementsByTagName("label");
//alert(objArray.length);
for (i=0;i<(objArray.length);i++)
{
	

if (objArray[i].id.indexOf("article_")>-1) 
{

objHid = document.getElementById("hid_article_" + objArray[i].id.substring(objArray[i].id.indexOf("_")+1)); 

//objHid.value就是对应的时间值，然后改下面就行了

var d=Date.parse(objHid.value);

var today=new Date();
var time=d-today;


var 时间=objArray[i];
if(Math.floor(time)<=0){
时间.innerHTML='时间已过期，谢谢您的关注!';

}
else
{
var 天=Math.floor(time/(1000*60*60*24));
var 小时=Math.floor(time/(1000*60*60))%24;
var 分=Math.floor(time/(1000*60))%60;
var 秒=Math.floor(time/1000)%60;
时间.innerHTML=天+"<font style='color:#666;font-size:16px;'>天</font>"+小时+"<font style='color:#666;font-size:16px;'>小时</font>"+分+"<font style='color:#666;font-size:16px;'>分</font>"+秒+"<font style='color:#666;font-size:16px;'>秒</font>";
时间.style.fontSize='16px';
时间.style.color='red';
} 

}
}
setTimeout('countDown()',1000);
}
countDown();
/*document.onclick = clic;
function clic(e)
{
	var event = e || window.event;
	var left1 = event.clientX;//鼠标点击横坐标
	var height1 = event.clientY;//鼠标点击纵坐标
	var top2 = document.getElementById("ceng").offsetTop;//登陆框左边距
	var left2 = document.getElementById("ceng").offsetLeft;//登陆框左边距
	var right2 = document.getElementById("ceng").offsetWidth;//登陆框宽度
	var height2 = document.getElementById("ceng").offsetHeight;//登陆框高度
	if(left1<left2-25 || left1 > (left2+right2))
	{
		document.getElementById("ceng").style.display = 'none';	
	}
	else if(height1 < top2-10 || height1 > (height2+top2))
	{
		document.getElementById("ceng").style.display = 'none';	
	}
}*/
/*function Object_Onclick(){
	if(document.activeElement.id !="new_addr")
	{
	   document.getElementById("ceng").style.display = 'none';	
	}
}
window.document.onclick= Object_Onclick; */

//上面是到计时

function search_button(){
	$("#search_button").click(function(){
	$("#search_button").submit();

	   });
};
//手机号
function isMobile(mobile)
{
    var myreg = /^(((13[0-9]{1})|159|153|158|186|187|188|189)+\d{8})$/;
    return myreg.test(mobile);
}
function isValid()
 {
    var mobile=$("input[name='phone_number']").val();
    var result= isMobile(mobile);
    if(!result)
    {
        $("input[name='phone_number']").addClass("num-input error");
        return result;
    }
    return result;
}