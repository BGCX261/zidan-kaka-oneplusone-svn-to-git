<?php


if(!defined('IN_PHPUP')) {
	exit('Access Denied');
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTH XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTH/xhtml1-transitional.dTH">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<script language="javascript" src="views/js/jquery.js"></script>
<link rel="stylesheet" href="views/admin/css/common.css" type="text/css" />
<title>团购管理</title>
</head>
<body>

<div id="man_zone">
   <form action="index.php?con=admin&act=settingdata" method="post">
	<INPUT TYPE="hidden" NAME="commit" value="1">
	<INPUT TYPE="hidden" NAME="dotype" value="seo">
  <table width="99%" border="0" align="center"  cellpadding="3" cellspacing="1" class="table_style">
	 <tr>
      <td width="18%" class="left_title_1"><span class="left-title">伪静态：</span></td>
      <td width="82%"><INPUT TYPE="radio"  NAME="seo_rewrite" id="seo_rewrite" value="1" <?php if($GLOBALS['setting']['seo_rewrite']){?>checked<?php }?>>开启 <INPUT TYPE="radio" NAME="seo_rewrite" id="seo_rewrite" value="0" <?php if(!$GLOBALS['setting']['seo_rewrite']){?>checked<?php }?>>关闭 </td>
    </tr>
    <tr>
      <td width="18%" class="left_title_1"><span class="left-title">SEO标题：</span></td>
      <td width="82%"><INPUT TYPE="text" class="normal_txt" NAME="seo_title" id="seo_title"  size="70" value="<?php echo $GLOBALS['seo_title'];?>"></td>
    </tr>
	 <tr>
      <td width="18%" class="left_title_1"><span class="left-title">关键字：</span></td>
      <td width="82%"><INPUT TYPE="text" class="normal_txt" NAME="seo_keyword" id="seo_keyword"  size="50" value="<?php echo $GLOBALS['seo_keyword'];?>"></td>
    </tr>
	 <tr>
      <td width="18%" class="left_title_1"><span class="left-title">描述：</span></td>
      <td width="82%"><textarea NAME="seo_description" id="seo_description"  style="width:500px;height:200px;"><?php echo $GLOBALS['seo_description'];?></textarea></td>
    </tr>
	<tr>
      <td></td>
      <td><INPUT TYPE="submit" class="normal_button" value="提交"></td>
    </tr>
  </table>
  </FORM>
</div>
</body>
</html>
