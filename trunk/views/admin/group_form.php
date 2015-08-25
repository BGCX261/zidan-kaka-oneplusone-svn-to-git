<?php


if(!defined('IN_PHPUP')) {
	exit('Access Denied');
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTH XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTH/xhtml1-transitional.dTH">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<link rel="stylesheet" href="views/admin/css/common.css" type="text/css" />
<script language="javascript" src="views/js/jquery.js"></script>
<script language="javascript" src="views/js/calendar.js"></script>
<SCRIPT LANGUAGE="JavaScript" src="views/admin/js/admin.js"></SCRIPT>
<title>团购管理</title>
</head>
<body>
<SCRIPT LANGUAGE="JavaScript">
<!--
$(document).ready(function(){
	$('.normal_txt').focus(function(){$(this).css('background','#F3F8F7');});
	$('.normal_txt').blur(function(){$(this).css('background','');});
}
	);
function addsite()
{
	url="index.php?con=admin&act=sitemodify";
	$.get(url, function(data){
		$('#site_area').html(data);
		$('#site_area').show();
	}); 
}
function modifysite()
{
	var id=$("#siteid").val().split('-');
	url="index.php?con=admin&act=sitemodify&updateid="+id[0];
	$.get(url, function(data){
		$('#site_area').html(data);
		$('#site_area').show();
	}); 
}

function parseMySiteData(data)
{
	var objdata=data;
	
	if(objdata.dotype=='update')
	{
		var obj=document.getElementById('siteid');
		var len=obj.options.length;
		for(i=0;i<len;i++)
		{
			temval=obj.options[i].value.split('-');
			if(objdata.id==temval[0])
			{
				obj.options[i].value=objdata.id+'-'+objdata.sitename;
				obj.options[i].text=objdata.pinyin+':'+objdata.sitename;
				obj.options[i].selected=true;
				$('#site_area').hide();
				return;
			}
			
		}
	}
	else
	{
		$('#siteid').prepend('<option value="'+objdata.id+'-'+objdata.sitename+'">'+objdata.pinyin+':'+objdata.sitename+'</option>');
		document.getElementById('siteid').options.selectedIndex=0;
	}
	$('#site_area').hide();
	
}

function addcate()
{
	url="index.php?con=admin&act=catemodify";
	$.get(url, function(data){
		$('#cate_area').html(data);
		$('#cate_area').show();
	}); 
}
function modifycate()
{
	url="index.php?con=admin&act=catemodify&updateid="+$("#cateid").val();
	$.get(url, function(data){
		$('#cate_area').html(data);
		$('#cate_area').show();
	}); 
}

function parseMyCateData(data)
{
	var objdata=data;
	if(objdata.dotype=='update')
	{
		$('#cateid').children().each(function(i){if(objdata.id==$(this).val()){$(this).attr('text',objdata.catename);$(this).attr('selected',true)}});
	}
	else
	{
		$('#cateid').prepend('<option value="'+objdata.id+'">'+objdata.catename+'</option>');
		document.getElementById('cateid').options.selectedIndex=0;
	}
	
	$('#cate_area').hide();
}
//-->
</SCRIPT>

<div id="man_zone">
   <form enctype="multipart/form-data" action="index.php?con=admin&act=groupmodify" method="post">
	<INPUT TYPE="hidden" NAME="commit" value="1">
  <INPUT TYPE="hidden" NAME="updateid" value="<?php echo $group['id'];?>">
  <table width="99%" border="0" align="center"  cellpadding="3" cellspacing="1" class="table_style">
 
    <tr>
      <td width="18%" class="left_title_1"><span class="left-title">团购项目：</span></td>
      <td width="82%"><INPUT TYPE="text" class="normal_txt"  NAME="subject" id="subject"  size="70" value="<?php echo $group['subject'];?>"><SPAN CLASS="" id="subjecterror"></SPAN></td>
    </tr>
	 <tr>
      <td width="18%" class="left_title_1"><span class="left-title">短标题：</span></td>
      <td width="82%"><INPUT TYPE="text" class="normal_txt"  NAME="shortsubject" id="shortsubject"  size="50" value="<?php echo $group['subject'];?>"><SPAN CLASS="" id="shortsubjecterror"></SPAN></td>
    </tr>
    <tr>
      <td class="left_title_2">结束日期：</td>
      <td> <INPUT TYPE="text" class="normal_txt"  NAME="lasttime"  value="<?php echo date('Y-m-d ',$group['lasttime']?$group['lasttime']:time());?>" onfocus="HS_setDate(this);"></td>
    </tr>
    <tr>
      <td class="left_title_1">所属网站：</td>
      <td><SELECT NAME="siteid" id="siteid">
		<?php if($group['siteid']){?><option value="<?php echo $group['siteid'];?>-<?php echo $group['groupsite'];?>"><?php echo $group['groupsite'];?></option><?php }?>
		
		<?php foreach($GLOBALS['site'] as $key=>$val){?>
		<option value="<?php echo $val['id'];?>-<?php echo $val['sitename'];?>"><?php echo $val['pinyin'];?>:<?php echo $val['sitename'];?></option>
		<?php }?>
      </SELECT><INPUT TYPE="button" VALUE="新增" ONCLICK="addsite();" class="normal_button"> <INPUT TYPE="button" VALUE="修改" ONCLICK="modifysite();" class="normal_button"> 
	 </td>
    </tr>
   <tr>
      <td class="left_title_1">所属城市：</td>
      <td><SELECT NAME="cityid" id="cityid">
		<?php if($group['cityid']){?><option value="<?php echo $group['cityname'];?>"><?php echo $group['cityname'];?></option><?php }?>
		<?php foreach($GLOBALS['city'] as $k=>$v){?>
		<option value="<?php echo $v['cityname'];?>"><?php echo $v['cityname'];?></option>
		<?php }?>
      </SELECT></td>
    </tr>
   <tr>
      <td class="left_title_1">所属分类：</td>
      <td><SELECT NAME="cateid" id="cateid">
	  <?php if($group['grouptype']){?><option value="<?php echo $group['grouptype'];?>"><?php echo $GLOBALS['cate'][$group['grouptype']]['catename'];?></option><?php }?>
		<?php foreach($GLOBALS['cate'] as $k=>$v){?>
		<option value="<?php echo $k;?>"><?php echo $v['catename'];?></option>
		<?php }?>
      </SELECT><INPUT TYPE="button" VALUE="新增" ONCLICK="addcate();" class="normal_button"> <INPUT TYPE="button" VALUE="修改" ONCLICK="modifycate();" class="normal_button"></td>
    </tr>
	<tr>
      <td class="left_title_1">缩略图：</td>
      <td><INPUT TYPE="file" NAME="thumb_img"> <?php if($group['thumb']){?><img onclick="window.open(this.src,'','');" src="<?php echo $group['thumb'];?>" height='100px'/><?php }?></td>
    </tr>
	<tr>
      <td class="left_title_1">访问地址：</td>
      <td><INPUT TYPE="text" class="normal_txt"  NAME="url" value="<?php echo $group['url']?$group['url']:'http://';?>"></td>
    </tr>
	<tr>
      <td class="left_title_1">原价：</td>
      <td>￥<INPUT TYPE="text" class="normal_txt"  NAME="oldprice" value="<?php echo $group['oldprice'];?>"></td>
    </tr>
	<tr>
      <td class="left_title_1">现价：</td>
      <td>￥<INPUT TYPE="text" class="normal_txt"  NAME="nowprice" value="<?php echo $group['nowprice'];?>"></td>
    </tr>
	<tr>
      <td class="left_title_1">通过审核?：</td>
      <td><INPUT TYPE="radio" NAME="ispassed" value="1" checked>通过&nbsp;<INPUT TYPE="radio" NAME="ispassed" value="0">不通过</td>
    </tr>
	<tr>
      <td class="left_title_1">人气：</td>
      <td><INPUT TYPE="text" class="normal_txt"  NAME="hits" value="<?php echo $group['hits'];?>"></td>
    </tr>
	<tr>
      <td class="left_title_1">关键字：</td>
      <td><INPUT TYPE="text" class="normal_txt"  NAME="keyword" value="<?php echo $group['keyword'];?>"></td>
    </tr>
	<tr>
      <td class="left_title_1">排序：</td>
      <td><INPUT TYPE="text" class="normal_txt"  NAME="sortorder" value="<?php echo $group['sortorder']?$group['sortorder']:255;?>"> 数字越大越靠前</td>
    </tr>
	<tr>
      <td></td>
      <td><INPUT TYPE="submit" class="normal_button" value="提交"></td>
    </tr>
  </table>
  </FORM>
</div>
<DIV id="site_area" style="display:none;border:2px solid #ccc;width:500px;position:absolute;left:330px;top:60px;background:#fff;z-index:10px;"></DIV>

<DIV id="cate_area" style="display:none;border:2px solid #ccc;width:300px;position:absolute;left:330px;top:60px;background:#fff;z-index:10px;"></DIV>
</body>
</html>
