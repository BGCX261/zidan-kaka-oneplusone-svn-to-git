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
<title>�Ź�����</title>
</head>
<body>

<div id="man_zone">
   <form enctype="multipart/form-data" action="index.php?con=admin&act=settingdata" method="post">
	<INPUT TYPE="hidden" NAME="commit" value="1">
	<INPUT TYPE="hidden" NAME="dotype" value="attach">
  <table width="99%" border="0" align="center"  cellpadding="3" cellspacing="1" class="table_style">
 
    
    <tr>
      <td class="left_title_1">�ɼ�ʱ��ͼƬ<br/>���浽���أ�</td>
      <td> <INPUT TYPE="text" class="normal_txt" NAME="site_allow_remote"  value="<?php echo $GLOBALS['allowremote'];?>">(1Ϊ������0Ϊ�ر�,���ʱ�ٶȿ�����....)</td>
    </tr>
	<tr>
      <td class="left_title_1">�Ƿ��Զ���⣺</td>
      <td> <INPUT TYPE="text" class="normal_txt" NAME="site_allow_insert"  value="<?php echo $GLOBALS['setting']['site_allow_insert'];?>">(1Ϊ������0Ϊ�ر�)</td>
    </tr>
	<tr>
      <td class="left_title_1">�Ƿ��Զ���ˣ�</td>
      <td> <INPUT TYPE="text" class="normal_txt" NAME="site_allow_passed"  value="<?php echo $GLOBALS['setting']['site_allow_passed'];?>">(1Ϊ������0Ϊ�ر�)</td>
    </tr>
	<tr>
      <td class="left_title_1">�Ƿ���Ӷ���вɼ���</td>
      <td> <INPUT TYPE="text" class="normal_txt" NAME="site_allow_city"  value="<?php echo $GLOBALS['setting']['site_allow_city'];?>">(1Ϊ������0Ϊ�ر�,�ɼ�ʱ�ٶ���)</td>
    </tr>
	
	<tr>
      <td></td>
      <td><INPUT TYPE="submit" class="normal_button" value="�ύ"></td>
    </tr>
  </table>
  </FORM>
</div>
</body>
</html>
