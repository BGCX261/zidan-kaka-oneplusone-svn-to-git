<?php


if(!defined('IN_PHPUP')) {
	exit('Access Denied');
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gbk" />
<script language="javascript" src="views/js/jquery.js"></script>
<link rel="stylesheet" href="views/admin/css/common.css" type="text/css" />
<title>������̨����ϵͳ</title>
</head>

<body>
<SCRIPT LANGUAGE="JavaScript">
<!--
	function showDiglog(content)
	{
		$('#showdiglog').html(content);
		$('#showdiglog').show('slow');
		setTimeout(function(){$('#showdiglog').hide('slow');},2000);
	}
//-->
</SCRIPT>

<iframe src="" style="display:none" name="cache"></iframe>
<div class="header_content">
     <div class="logo" align="center"><img src="views/admin/images/man_logo.jpg" alt="<?php echo SITE_ROOT;?>-��վ��̨����ϵͳ" /></div>
	 <div class="right_nav">
	    <div class="text_left"><ul class="nav_list"><li><img src="views/admin/images/direct.gif" width="8" height="21" />��վ��̨����ϵͳ</li></ul>
	    </div>
		<div class="text_right"><div style="display:none;color:#ff0000;font-weight:bold;" id="showdiglog"></div><ul class="nav_return"><li><img src="views/admin/images/return.gif" width="13" height="21" />&nbsp;���ò��� [ <a href="index.php" target="_blank">��վ��ҳ</a> | <a href="index.php?con=admin&act=delcache" target="cache">��ջ���</a> | <a href="index.php?con=admin&act=delcompile" target="cache">���ϵͳ����</a> ] &nbsp; &nbsp; </li>
		</ul>
		</div>
	 </div>
</div>
</body>
</html>
