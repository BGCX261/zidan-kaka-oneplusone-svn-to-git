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
<title>�Ź�����</title>
</head>
<body>

<div id="man_zone">
   <form action="index.php?con=admin&act=usermodify" method="post">
	<INPUT TYPE="hidden" NAME="commit" value="1">
  <INPUT TYPE="hidden" NAME="updateid" value="<?php echo $user['uid'];?>">
  <table width="99%" border="0" align="center"  cellpadding="3" cellspacing="1" class="table_style">
 
    <tr>
      <td width="18%" class="left_title_1"><span class="left-title">�ʺţ�</span></td>
      <td width="82%"><INPUT TYPE="text" class="normal_txt" NAME="email" id="email"  size="70" value="<?php echo $user['email'];?>"><SPAN CLASS="" id="emailerror"></SPAN></td>
    </tr>
	 <tr>
      <td width="18%" class="left_title_1"><span class="left-title">���룺</span></td>
      <td width="82%"><INPUT TYPE="text" class="normal_txt" NAME="password" id="password"  size="50" value=""><SPAN CLASS="" id="passworderror"></SPAN></td>
    </tr>
   
   <tr>
      <td class="left_title_1">�û����ͣ�</td>
      <td><?php $usertype=array('siteuser'=>'��վ��','normaluser'=>'��Ա','admin'=>'����Ա');?><SELECT NAME="usertype" id="usertype">

	  
		<?php if($user['usertype']){?><option value="<?php echo $user['usertype'];?>"><?php echo $usertype[$user['usertype']];?></option><?php }?>
		<option value="adminuser">����Ա</option>
		<option value="siteuser">��վ��</option>
		<option value="normaluser">һ���Ա</option>
		<option value="nulluser">��վ�ύ��Ա</option>
      </SELECT>����Ϊ���޸�</td>
    </tr>
	<tr>
      <td class="left_title_1">���У�</td>
      <td><INPUT TYPE="text" class="normal_txt" NAME="sitecity" value="<?php echo $user['cityid'];?>"></td>
    </tr>
	<tr>
      <td class="left_title_1">��վ��</td>
      <td><INPUT TYPE="text" class="normal_txt" NAME="sitename" value="<?php echo $user['sitename'];?>"></td>
    </tr>
  <tr>
      <td class="left_title_1">��վ��ַ��</td>
      <td><INPUT TYPE="text" class="normal_txt" NAME="siteurl" value="<?php echo $user['siteurl']?$user['siteurl']:'http://';?>"></td>
    </tr>
	<tr>
      <td class="left_title_1">��վAPI��</td>
      <td><INPUT TYPE="text" class="normal_txt" NAME="siteapi" value="<?php echo $user['siteapi']?$user['siteapi']:'http://';?>"></td>
    </tr>
	<tr>
      <td class="left_title_1">��ϵ�ˣ�</td>
      <td><INPUT TYPE="text" class="normal_txt" NAME="connect_user" value="<?php echo $user['connect_user'];?>"></td>
    </tr>
	<tr>
      <td class="left_title_1">��ϵ��ʽ��</td>
      <td><INPUT TYPE="text" class="normal_txt" NAME="connect_type" value="<?php echo $user['connect_type'];?>"></td>
    </tr>
	<tr>
      <td class="left_title_1">��ϵ���ݣ�</td>
      <td><INPUT TYPE="text" class="normal_txt" NAME="connect_content" value="<?php echo $user['connect_content'];?>"></td>
    </tr>
	<tr>
      <td class="left_title_1">��飺</td>
      <td><INPUT TYPE="text" class="normal_txt" NAME="intro" value="<?php echo $user['intro'];?>"></td>
    </tr>
	<tr>
      <td></td>
      <td><INPUT TYPE="submit" class="normal_button" value="�ύ"></td>
    </tr>
  </table>
  </FORM>
</div>
<DIV id="site_area" style="display:none;border:2px solid #ccc;width:300px;position:absolute;left:330px;top:60px;height:220px;background:#fff;z-index:10px;"></DIV>
<DIV id="city_area" style="display:none;border:2px solid #ccc;width:300px;position:absolute;left:330px;top:60px;height:120px;background:#fff;z-index:10px;"></DIV>
<DIV id="cate_area" style="display:none;border:2px solid #ccc;width:300px;position:absolute;left:330px;top:60px;height:120px;background:#fff;z-index:10px;"></DIV>
</body>
</html>
