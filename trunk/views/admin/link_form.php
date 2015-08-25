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

<div id="man_zone">
<FORM METHOD="POST" ACTION="index.php?con=admin&act=linkmodify" enctype="multipart/form-data">
<INPUT TYPE="hidden" NAME="updateid" value="<?php echo $link['id'];?>">
<INPUT TYPE="hidden" NAME="commit" value="1">
<table width="600px" border="0" align="center"  cellpadding="3" cellspacing="1" class="table_style">
<tr>
<td width="70px" class="left_title_1"><span class="left-title">标题：</span></td>
<td><INPUT TYPE="text" class="normal_txt" NAME="title"  value="<?php echo $link['title'];?>"></td>
</tr>
<tr>
<td width="70px" class="left_title_1"><span class="left-title">地址：</span></td>
<td><INPUT TYPE="text" class="normal_txt" NAME="url"  value="<?php echo $link['url'];?>"></td>
</tr>
<tr>
<td width="70px" class="left_title_1"><span class="left-title">类型：</span></td>
<td><INPUT TYPE="radio" NAME="type"  value="1" <?php echo $link['type']==1?'checked':'';?>>文字 <INPUT TYPE="radio" NAME="type"  value="2" <?php echo $link['type']==2?'checked':'';?>>图片</td>
</tr>
<tr>
<td width="70px" class="left_title_1"><span class="left-title">图片：</span></td>
<td><INPUT TYPE="file" name="thumb"><?php if($link['thumb']){?><img src="<?php echo $link['thumb'];?>"/><?php }?></td>
</tr>
<tr>
<td width="70px" class="left_title_1"><span class="left-title">描述：</span></td>
<td>
<textarea NAME="dec"  id="dec" style="width:500px;height:100px;"><?php echo $link['dec'];?></textarea></td>
</tr>
<td colspan="2" align="center"><INPUT TYPE="submit" value="提交" class="normal_button"></td>
</tr>
<tr><td colspan="2"><DIV ID="tempimg"></DIV></td></tr>
</table>
</FORM>

</div>

<DIV id="img_area" style="display:none;border:2px solid #ccc;width:330px;position:absolute;left:330px;top:60px;height:30px;background:#fff;z-index:10px;padding:10px;">

</DIV>
</body>
</html>
