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
	<INPUT TYPE="hidden" NAME="dotype" value="group">
  <table width="99%" border="0" align="center"  cellpadding="3" cellspacing="1" class="table_style">
	<tr>
      <td class="left_title_1">�Ź�ÿҳ��ʾ������</td>
      <td><INPUT TYPE="text" class="normal_txt" name="site_num" VALUE="<?php echo $GLOBALS['setting']['site_num'];?>" >(���ȫ����Ϣ)
	 </td>
    </tr>
	<tr>
      <td class="left_title_1">�Ƿ���ʾ���У�</td>
      <td> <INPUT TYPE="text" class="normal_txt" NAME="site_allow_showcity"  value="<?php echo $GLOBALS['setting']['site_allow_showcity'];?>">(1Ϊ������0Ϊ�ر�,Ϊÿ����Ʒ����ʾ�ĳ���)</td>
    </tr>
	<tr>
      <td class="left_title_1">�Ƿ���ʾ���������</td>
      <td> <INPUT TYPE="text" class="normal_txt" NAME="site_allow_hits"  value="<?php echo $GLOBALS['setting']['site_allow_hits'];?>">(1Ϊ������0Ϊ�ر�,Ϊÿ����Ʒ����ʾ�ĵ������)</td>
    </tr>
	<tr>
      <td class="left_title_1">�Ƿ�������ʾ��ǰ������Ϣ��</td>
      <td> <INPUT TYPE="text" class="normal_txt" NAME="site_allow_diff_city"  value="<?php echo $GLOBALS['setting']['site_allow_diff_city'];?>">(1Ϊ������0Ϊ�ر�,����Ϊ����,����Ϊȫ��)</td>
    </tr>
	<tr>
      <td class="left_title_1">��ǰ����ֻ��ʾ�Ƽ���</td>
      <td> <INPUT TYPE="text" class="normal_txt" NAME="site_onlyrecommend"  value="<?php echo $GLOBALS['setting']['site_onlyrecommend'];?>">(1Ϊ�ǣ�0Ϊ��,��ǰѡ��ĳ���ֻ��ʾ�Ƽ�����Ʒ,������ʾ���п�������Ч)</td>
    </tr>
	<tr>
      <td class="left_title_1">��ǰ������ʾ������</td>
      <td> <INPUT TYPE="text" class="normal_txt" NAME="site_currentcity_num"  value="<?php echo $GLOBALS['setting']['site_currentcity_num'];?>">(һ���ĸ�,������ʾ���п�������Ч)</td>
    </tr>
	<tr>
      <td class="left_title_1">ȫ���Ƿ����ȫ�����У�</td>
      <td> <INPUT TYPE="text" class="normal_txt" NAME="site_allow_all"  value="<?php echo $GLOBALS['setting']['site_allow_all'];?>">(1Ϊ����ȫ�����е���Ϣ��0Ϊֻ����ȫ������Ϣ)</td>
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
