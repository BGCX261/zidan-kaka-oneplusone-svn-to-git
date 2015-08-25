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
	function change_img(oldimg,id)
	{
		url="index.php?con=admin&act=imgmodify&oldimg="+oldimg+"&obj="+id;
		$.get(url, function(data){
			$('#img_area').html(data);
			$('#img_area').show();
		}); 
	}

	function parseMyImgData(data,doid)
	{
		$('#'+doid).val(data);
		if($('#adtype').val()=='image')
		{
			$('#'+doid+'_temp').attr('src',data);
		}
		else if($('#adtype').val()=='flash')
		{
			$('#swfdiv').html('<embed src="'+data+'" width="100px"></embed>');
		}
		$('#img_area').hide();
	}
	function inserthtml(obj)
	{
		$('#content').html($('#content').html()+'<img src="'+$(obj).attr('src')+'"/>');
	}
//-->
</SCRIPT>
<div id="man_zone">
<FORM METHOD="POST" ACTION="index.php?con=admin&act=admodify" enctype="multipart/form-data">
<INPUT TYPE="hidden" NAME="updateid" value="<?php echo $ad['id'];?>">
<INPUT TYPE="hidden" NAME="commit" value="1">
<table width="100%" border="0" align="center"  cellpadding="3" cellspacing="1" class="table_style">
<tr>
<td width="100px" class="left_title_1"><span class="left-title">广告类型：</span></td>
<td>
<SELECT NAME="adtype" id="adtype" onchange="changead(this.value);">
	<OPTION VALUE="image">图片
	<OPTION VALUE="html">自定义html
	<OPTION VALUE="flash">flash
</SELECT>
</td>
</tr>
<tr>
<td width="100px" class="left_title_1"><span class="left-title">唯一标志符：</span></td>
<td><INPUT TYPE="text" class="normal_txt" NAME="adindex"  value="<?php echo $ad['ad2'][1];?>"></td>
</tr>
<tr>
<td width="100px" class="left_title_1"><span class="left-title">标题：</span></td>
<td><INPUT TYPE="text" class="normal_txt" NAME="title"  value="<?php echo $ad['title'];?>"></td>
</tr>
<tr id="thumbad">
<td width="100px" class="left_title_1" valign="top"><span class="left-title">图片：</span><INPUT TYPE="button" VALUE="增加" ONCLICK="addthumb();" class="normal_txt"></td>
<td>

<TABLE>
<TR id="thumblist">
	<TD>文件</TD>
	<TD>链接</TD>
	<TD>说明</TD>
	<TD>宽</TD>
	<TD>高</TD>
</TR>
<TR>
	<TD><INPUT TYPE="file" NAME="thumb[]"></TD>
	<TD><INPUT TYPE="text" NAME="url[]" size="15" class="normal_txt"></TD>
	<TD><INPUT TYPE="text" NAME="info[]" size="15" class="normal_txt"></TD>
	<TD><INPUT TYPE="text" NAME="width[]" size="10" class="normal_txt"></TD>
	<TD><INPUT TYPE="text" NAME="height[]" size="10" class="normal_txt"></TD>
</TR>
<?php foreach($ad['content'] as $k=>$v){?>
<TR id="temp<?php echo $k;?>">
	<TD><div id="swfdiv">
	<?php if($ad['ad2'][0]=='flash'){?>
	<embed src="<?php echo $v['img'];?>" width="220px"></embed>
	<?php } else{?>
	<img src="<?php echo $v['img'];?>" id="oldthumb<?php echo $k;?>_temp" width="220px" />
	<?php }?>
	</div>
	<INPUT TYPE="hidden" value="<?php echo $v['img'];?>" name="oldthumb[]" id="oldthumb<?php echo $k;?>">
	<INPUT TYPE="button" VALUE="更新"  ONCLICK="change_img($('#oldthumb<?php echo $k;?>').val(),'oldthumb<?php echo $k;?>');">
	</TD>
	<TD><INPUT TYPE="text" NAME="oldurl[]" size="15" class="normal_txt" value="<?php echo $v['url'];?>"></TD>
	<TD><INPUT TYPE="text" NAME="oldinfo[]" size="15" class="normal_txt" value="<?php echo $v['info'];?>"></TD>
	<TD><INPUT TYPE="text" NAME="oldwidth[]" size="10" class="normal_txt" value="<?php echo $v['width'];?>"></TD>
	<TD><INPUT TYPE="text" NAME="oldheight[]" size="10" class="normal_txt" value="<?php echo $v['height'];?>"><INPUT TYPE="button" VALUE="删除" ONCLICK="$('#temp<?php echo $k;?>').remove();"></TD>
</TR>
<?php }?>
</TABLE>

</td>
</tr>
<tr id="htmlad" style="display:none;">
<td width="100px" class="left_title_1"><span class="left-title">内容：</span></td>
<td>
<textarea NAME="content"  id="content" style="width:500px;height:100px;"><?php echo $ad['content'];?></textarea></td>
</tr>
<td colspan="2" align="center"><INPUT TYPE="submit" value="提交" class="normal_button"></td>
</tr>
<tr><td colspan="2"><DIV ID="tempimg"></DIV></td></tr>
</table>
</FORM>

</div>

<SCRIPT LANGUAGE="JavaScript">
<!--
	var k=0;
	window.onload=function()
	{
		var madtype="<?php echo $ad['ad2'][0];?>";
		$('#adtype').children().each(function(i){if(madtype==$(this).val()){$(this).attr('selected',true)}});
		changead(madtype);
	}
	function changead(madtype)
	{
		
		switch(madtype)
		{
			case 'html':
				$('#htmlad').show();
				$('#thumbad').hide();
			break;
			case 'image':
				$('#thumbad').show();
				$('#htmlad').hide();
			break;
			default:
				$('#thumbad').show();
				$('#htmlad').hide();
			break;
		}
	}
	function addthumb()
	{
		var data='<TR id="atemp'+k+'"><TD><INPUT TYPE="file" NAME="thumb[]"></TD><TD><INPUT TYPE="text" NAME="url[]" size="15" class="normal_txt"></TD><TD><INPUT TYPE="text" NAME="info[]" size="15" class="normal_txt"></TD><TD><INPUT TYPE="text" NAME="width[]" size="10" class="normal_txt"></TD><TD><INPUT TYPE="text" NAME="height[]" size="10" class="normal_txt"><INPUT TYPE="button" VALUE="删除" ONCLICK="$(\'#atemp'+k+'\').remove();"></TD></TR>';
		k++;
		$('#thumblist').after(data);
	}
//-->
</SCRIPT>
<DIV id="img_area" style="display:none;border:2px solid #ccc;width:330px;position:absolute;left:330px;top:60px;height:30px;background:#fff;z-index:10px;padding:10px;">
</DIV>

</body>
</html>