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
	<INPUT TYPE="hidden" NAME="dotype" value="site">
  <table width="99%" border="0" align="center"  cellpadding="3" cellspacing="1" class="table_style">
 
    <tr>
      <td width="18%" class="left_title_1"><span class="left-title">��վ���ƣ�</span></td>
      <td width="82%"><INPUT TYPE="text" class="normal_txt" NAME="site_title" id="title"  size="70" value="<?php echo $GLOBALS['title'];?>"></td>
    </tr>
	<tr>
      <td width="18%" class="left_title_1"><span class="left-title">����Ĭ�ϳ��У�</span></td>
      <td width="82%"><INPUT TYPE="text" class="normal_txt" NAME="site_default_city" id="site_default_city"  size="40" value="<?php echo $GLOBALS['setting']['site_default_city'];?>">��ʹ��ƴ������ �������� Ϊ��˴���beijing,ȷ��������վ����Щ����,���ĺ������������Ч</td>
    </tr>
	 <tr>
      <td width="18%" class="left_title_1"><span class="left-title">��վlogo��</span></td>
      <td width="82%"><INPUT TYPE="file" NAME="site_logo"  value=""><?php if($GLOBALS['setting']['site_logo']){?><img src="<?php echo $GLOBALS['setting']['site_logo'];?>"/><?php }?></td>
    </tr>
	 <tr>
      <td width="18%" class="left_title_1"><span class="left-title">��վ��ַ��</span></td>
      <td width="82%"><INPUT TYPE="text" class="normal_txt" NAME="site_url" id="charset"  size="50" value="<?php echo SITE_ROOT;?>">(���治Ҫ�� "/")</td>
    </tr>
	
    <tr>
      <td class="left_title_1">����Ŀ¼��</td>
      <td><INPUT TYPE="text" class="normal_txt" name="site_cache_dir" VALUE="<?php echo $GLOBALS['cachedir'];?>" >
	  <?php if(is_dir(ROOT_PATH.'/'.$GLOBALS['cachedir']) && is_writable(ROOT_PATH.'/'.$GLOBALS['cachedir'])){?>��д<?php } else{?>����д����<?php }?>
	 </td>
    </tr>
   <tr>
      <td class="left_title_1">�ļ��ϴ�Ŀ¼��</td>
      <td><INPUT TYPE="text" class="normal_txt"  name="site_upload_dir" VALUE="<?php echo $GLOBALS['uploaddir'];?>" >
	  <?php if(is_dir(ROOT_PATH.'/'.$GLOBALS['uploaddir']) && is_writable(ROOT_PATH.'/'.$GLOBALS['uploaddir'])){?>��д<?php } else{?>����д����<?php }?></td>
    </tr>
   <tr>
      <td width="18%" class="left_title_1"><span class="left-title">�Ź�����QQȺ��</span></td>
      <td width="82%"><INPUT TYPE="text" class="normal_txt" NAME="site_qqq" id="charset"  size="50" value="<?php echo $GLOBALS['setting']['site_qqq'];?>"></td>
    </tr>
	<tr>
      <td width="18%" class="left_title_1"><span class="left-title">���䣺</span></td>
      <td width="82%"><INPUT TYPE="text" class="normal_txt" NAME="site_email" id="charset"  size="50" value="<?php echo $GLOBALS['setting']['site_email'];?>"></td>
    </tr>
	<tr>
      <td width="18%" class="left_title_1"><span class="left-title">��ַ��</span></td>
      <td width="82%"><INPUT TYPE="text" class="normal_txt" NAME="site_address" id="charset"  size="50" value="<?php echo $GLOBALS['setting']['site_address'];?>"></td>
    </tr>
	<tr>
      <td width="18%" class="left_title_1"><span class="left-title">����ʱ�䣺</span></td>
      <td width="82%"><INPUT TYPE="text" class="normal_txt" NAME="site_worktime" id="charset"  size="50" value="<?php echo $GLOBALS['setting']['site_worktime'];?>"></td>
    </tr>
	 <tr>
      <td width="18%" class="left_title_1"><span class="left-title">�ͷ�QQ��</span></td>
      <td width="82%"><INPUT TYPE="text" class="normal_txt" NAME="site_qq" id="charset"  size="50" value="<?php echo $GLOBALS['setting']['site_qq'];?>"></td>
    </tr>
	 <tr>
      <td width="18%" class="left_title_1"><span class="left-title">������Ϣ��</span></td>
      <td width="82%"><INPUT TYPE="text" class="normal_txt" NAME="site_benai" id="charset"  size="50" value="<?php echo $GLOBALS['setting']['site_benai'];?>"></td>
    </tr>
	<tr>
      <td width="18%" class="left_title_1"><span class="left-title"> �ͷ��绰��</span></td>
      <td width="82%"><INPUT TYPE="text" class="normal_txt" NAME="site_tel" id="charset"  size="50" value="<?php echo $GLOBALS['setting']['site_tel'];?>"></td>
    </tr>
	<tr>
      <td class="left_title_1">�ײ���Ȩ��Ϣ(HTML)��</td>
      <td><textarea style="width:300px;height:100px;" NAME="site_copyright"><?php echo $GLOBALS['setting']['site_copyright'];?></textarea></td>
    </tr>
	<tr>
      <td class="left_title_1">������ͳ�ƴ��룺</td>
      <td><textarea style="width:300px;height:100px;" NAME="site_tongji"><?php echo $GLOBALS['setting']['site_tongji'];?></textarea></td>
    </tr>
	<tr>
      <td class="left_title_1">��վ�ύЭ�飺</td>
      <td><textarea style="width:300px;height:100px;" NAME="site_applyintro"><?php echo $GLOBALS['setting']['site_applyintro'];?></textarea></td>
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
