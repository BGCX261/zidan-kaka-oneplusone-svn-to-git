<?php
if(!defined('IN_PHPUP')) {
	exit('Access Denied');
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<link rel="stylesheet" href="views/admin/css/common.css" type="text/css" />
<title>��������</title>
</head>

<body>
<div id="man_zone">
  <table width="99%" border="0" align="center"  cellpadding="3" cellspacing="1" class="table_style">
 
    <tr>
      <td width="18%" class="left_title_1"><span class="left-title">�Ź�������</span></td>
      <td width="82%">δ��ˣ�<?php echo intval($count['group']['nopassed']);?>����ͨ����<?php echo intval($count['group']['ispassed']);?>���ѹ��ڣ�<?php echo intval($count['group']['old']);?>��δ���ڣ�<?php echo intval($count['group']['new']);?>��<span class="nav_return"><A HREF="index.php?con=admin&act=group">�����Ź�</A></span></td>
    </tr>
    <tr>
      <td class="left_title_2">����������</td>
      <td><?php echo $count['filecount'];?>��<span class="nav_return"><A HREF="index.php?con=admin&act=file">������</A></span></td>
    </tr>
    <tr>
      <td class="left_title_1">��Ա������</td>
      <td>��վ����<?php echo intval($count['usercount']['siteuser']);?>����ͨ��Ա��<?php echo intval($count['usercount']['normaluser']);?>��<span class="nav_return"><A HREF="index.php?con=admin&act=normaluser">�����Ա</A></span></td>
    </tr>
    <tr>
      <td class="left_title_2">��վ������</td>
      <td>��Ʒ�Ź���<?php echo intval($count['sitecount']['best']);?>���Ź���վ��<?php echo intval($count['sitecount']['amount']);?>��<span class="nav_return"><A HREF="index.php?con=admin&act=site">������վ</A></span></td>
    </tr>
   <tr>
      <td class="left_title_1" valign="top">�����飺</td>
      <td>
	  <DIV ID="" CLASS="">
		����֧�֣�<A HREF="bbs.iruna.cn" target="_blank">bbs.iruna.cn</A>
	  </DIV>
	  </td>
    </tr>
   <tr>
      <td colspan="2">
	  </td>
   </tr>
  </table>
</div>
</body>
</html>
