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
	<INPUT TYPE="hidden" NAME="dotype" value="email">
  <table width="99%" border="0" align="center"  cellpadding="3" cellspacing="1" class="table_style">
 
    <tr>
      <td width="18%" class="left_title_1"><span class="left-title">邮箱SMTP：</span></td>
      <td width="82%"><INPUT TYPE="text" class="normal_txt" NAME="email_smtp" id="email_smtp"  size="70" value="<?php echo $GLOBALS['emailinfo']['smtp'];?>"></td>
    </tr>
	 <tr>
      <td width="18%" class="left_title_1"><span class="left-title">邮箱端口：</span></td>
      <td width="82%"><INPUT TYPE="text" class="normal_txt" NAME="email_port" id="email_port"  size="50" value="<?php echo $GLOBALS['emailinfo']['port'];?>">(一般为25)</td>
    </tr>
	 <tr>
      <td width="18%" class="left_title_1"><span class="left-title">邮箱用户名：</span></td>
      <td width="82%"><INPUT TYPE="text" class="normal_txt" NAME="email_user" id="email_user"  size="50" value="<?php echo $GLOBALS['emailinfo']['account'];?>"></td>
    </tr>
    <tr>
      <td class="left_title_2">邮箱密码：</td>
      <td> <INPUT TYPE="password" NAME="email_password" id="email_password"  value="<?php echo $GLOBALS['emailinfo']['pass'];?>"></td>
    </tr>
    <tr>
      <td class="left_title_1">邮箱：</td>
      <td><INPUT TYPE="text" class="normal_txt" name="email" id="email" VALUE="<?php echo $GLOBALS['emailinfo']['email'];?>" >
	 </td>
    </tr>
   
	
	<tr>
      <td></td>
      <td><INPUT TYPE="submit" class="normal_button" value="提交"> <INPUT TYPE="button" onclick="testsend();" class="normal_button" value="测试发信"></td>
    </tr>
  </table>
  </FORM>
</div>
<SCRIPT LANGUAGE="JavaScript">
<!--
	function testsend()
	{
		$('#test_email').val($('#email').val());
		$('#test_email_user').val($('#email_user').val());
		$('#test_email_password').val($('#email_password').val());
		$('#test_email_smtp').val($('#email_smtp').val());
		$('#test_email_port').val($('#email_port').val());
		$('#email_area').show();
	}
//-->
</SCRIPT>
<DIV id="email_area" style="display:none;border:2px solid #ccc;width:320px;position:absolute;left:330px;top:60px;height:30px;background:#fff;z-index:10px;padding:10px;">
<iframe src="" style="display:none" name="testemail"></iframe>
<FORM METHOD="POST" ACTION="index.php?con=admin&act=testmail" target="testemail">
	收件人：<INPUT TYPE="text" class="normal_txt" NAME="get_email">
	<INPUT TYPE="hidden" NAME="test_email" id="test_email">
	<INPUT TYPE="hidden" NAME="test_email_user" id="test_email_user">
	<INPUT TYPE="hidden" NAME="test_email_password" id="test_email_password">
	<INPUT TYPE="hidden" NAME="test_email_smtp" id="test_email_smtp">
	<INPUT TYPE="hidden" NAME="test_email_port" id="test_email_port">
	<INPUT TYPE="submit" class="normal_button" value="发送"><INPUT TYPE="button" class="normal_button" value="关闭" onclick="$('#email_area').hide();">
</FORM>

</DIV>
</body>
</html>
