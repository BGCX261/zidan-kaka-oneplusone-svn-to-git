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
<title>添加商品信息</title>
</head>
<body>
<div id="man_zone">
<FORM METHOD="POST" ACTION="index.php?con=admin&act=productsmodify" enctype="multipart/form-data">
<INPUT TYPE="hidden" NAME="updateid" value="<?php echo $goods['pid'];?>">
<INPUT TYPE="hidden" NAME="commit" value="1">
<table width="600px" border="0" align="center"  cellpadding="3" cellspacing="1" class="table_style">
<tr>
<td width="70px" class="left_title_1"><span class="left-title">商品名称：</span></td>
<td>
<INPUT TYPE="text" class="normal_txt" NAME="title" maxlength="24" value="<?php echo $goods['title'];?>">
 &nbsp; 推荐：<input type="checkbox" name="status" value="1"<?php if($goods['status']==1) echo" checked=\"checked\"";?> />
</td>
</tr>
<tr>
<td width="70px" class="left_title_1"><span class="left-title">商品链接：</span></td>
<td><INPUT TYPE="text" class="normal_txt" NAME="link_url"  value="<?php echo $goods['link_url'];?>"></td>
</tr>
<tr>
<td width="70px" class="left_title_1"><span class="left-title">网站名称：</span></td>
<td><INPUT TYPE="text" class="normal_txt" NAME="webName"  value="<?php echo $goods['webName'];?>"></td>
</tr>
<tr>
<td width="70px" class="left_title_1"><span class="left-title">网站地址：</span></td>
<td><INPUT TYPE="text" class="normal_txt" NAME="webUrl"  value="<?php echo $goods['webUrl'];?>"></td>
</tr>
<tr>
<td width="70px" class="left_title_1"><span class="left-title">商品图片：</span></td>
<td><INPUT TYPE="file" NAME="thumb"  value=""><?php if($goods['pic_url']){?><img src="<?php echo $goods['pic_url'];?>" height="100px" onclick="window.open(this.src,'_blank','');"/><?php }?></td>
</tr>
<tr>
<td width="70px" class="left_title_1"><span class="left-title">商品价格：</span></td>
<td><INPUT TYPE="text" class="normal_txt" NAME="price"  value="<?php echo $goods['price'];?>"></td>
</tr>
<td colspan="2" align="center"><INPUT TYPE="submit" value="提交" class="normal_button"></td>
</tr>
<tr><td colspan="2"><DIV ID="tempimg"></DIV></td></tr>
</table>
</FORM>

</div>
</body>
</html>