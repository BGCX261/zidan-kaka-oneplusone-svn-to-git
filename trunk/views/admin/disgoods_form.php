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
<FORM METHOD="POST" ACTION="index.php?con=admin&act=disgoodsmodify" enctype="multipart/form-data">
<INPUT TYPE="hidden" NAME="updateid" value="<?php echo $goods['id'];?>">
<INPUT TYPE="hidden" NAME="commit" value="1">
<table width="600px" border="0" align="center"  cellpadding="3" cellspacing="1" class="table_style">
<tr>
<td width="70px" class="left_title_1"><span class="left-title">标题：</span></td>
<td><INPUT TYPE="text" class="normal_txt" NAME="title" maxlength="24" value="<?php echo $goods['title'];?>"></td>
</tr>
<tr>
<td width="70px" class="left_title_1"><span class="left-title">链接：</span></td>
<td><INPUT TYPE="text" class="normal_txt" NAME="link"  value="<?php echo $goods['link'];?>"></td>
</tr>
<tr>
<td width="70px" class="left_title_1"><span class="left-title">开始时间：</span></td>
<td><INPUT TYPE="text" class="normal_txt" NAME="starttime"  onfocus="HS_setDate(this);" value="<?php echo date('Y-m-d',$goods['starttime']?$goods['starttime']:time());?>"></td>
</tr>
<tr>
<td width="70px" class="left_title_1"><span class="left-title">结束时间：</span></td>
<td><INPUT TYPE="text" class="normal_txt" NAME="endtime"  onfocus="HS_setDate(this);" value="<?php echo date('Y-m-d',$goods['endtime']?$goods['endtime']:time()+3600*24*30);?>"></td>
</tr>
<tr>
<td width="70px" class="left_title_1"><span class="left-title">图片：</span></td>
<td><INPUT TYPE="file" NAME="thumb"  value=""><?php if($goods['thumb']){?><img src="<?php echo $goods['thumb'];?>" height="100px" onclick="window.open(this.src,'_blank','');"/><?php }?></td>
</tr>
<tr>
<td width="70px" class="left_title_1"><span class="left-title">内容：</span></td>
<td>
<textarea NAME="content"  id="content" style="width:500px;height:100px;" maxlength="80"><?php echo $goods['content'];?></textarea></td>
</tr>
<td colspan="2" align="center"><INPUT TYPE="submit" value="提交" class="normal_button"></td>
</tr>
<tr><td colspan="2"><DIV ID="tempimg"></DIV></td></tr>
</table>
</FORM>

</div>
</body>
</html>