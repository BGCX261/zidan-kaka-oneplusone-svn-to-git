<?php
if(!defined('IN_PHPUP')) {
	exit('Access Denied');
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTH XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTH/xhtml1-transitional.dTH">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>


<title><?php echo $GLOBALS['title'];?>-��̨����</title>
<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
<meta content="text/html; charset=gb2312" http-equiv="Content-Type">
<link rel="stylesheet" href="views/admin/css/login.css" type="text/css" />

<meta content="noindex,nofollow" name="robots">
</head><body class="login">

<div class="htbj"> 

<div id="denglu">  
<iframe src="" style="display:none;" name="login"></iframe>
<form method="post" target="login" action="index.php?con=admin&act=login" id="loginform" name="loginform">
	<p>
	  <h2>�û���:</h2>
		<input type="text" tabindex="10" size="20" value="" class="htsrk" id="user_login" name="username"></label>
	</p>
	<p>
	  <h2>�ܡ���:</h2>
		<input type="password" tabindex="20" size="20" value="" class="htsrk" id="user_pass" name="password"></label>
	</p>
	<p class="forgetmenot"></p>
	<p> <input type="reset" tabindex="100" value="ȡ����" id="wp-submit" name="wp-submit" class="dlan">
		<input type="submit" tabindex="100" value="�ǡ�¼" id="wp-submit" name="wp-submit" class="dlan">
       
		<!--input type="button" tabindex="100" value="������ҳ" onclick="window.open('index.php','_self');" class="dlan"-->
		<input type="hidden" value="1" name="commit">
	</p>
</form>

</div>

<div class="bqzi"><a href="http://www.iruna.com.cn" target="_blank">����Ҽ��Ҽ�����������޹�˾</a> ��Ȩ����</div>

</div>

<script type="text/javascript">
try{document.getElementById('user_login').focus();}catch(e){}
</script>
</body></html>