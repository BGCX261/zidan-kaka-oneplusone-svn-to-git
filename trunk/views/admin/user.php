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
<SCRIPT LANGUAGE="JavaScript" src="views/js/jquery.js"></SCRIPT>
<SCRIPT LANGUAGE="JavaScript" src="views/admin/js/admin.js"></SCRIPT>
<title>�Ź�����</title>
</head>
<STYLE TYPE="text/css">
	
</STYLE>
<body>

<div class="list">
<TABLE cellpadding="1" cellspacing="1">
<TR>
	<TH>�û���</TH>
	<TH>��վ��</TH>
	<TH>��վ��ַ</TH>
	<TH>��վapi</TH>
	<TH>����</TH>
	<TH>��ϵ��ʽ</TH><TH>ע��ʱ��</TH>
	<TH>����</TH>
	<TH>����</TH>
</TR>
<TR class="tr1">
	<Td></Td>
	<Td></Td>
	<Td></Td>
	<Td></Td>
	<Td></Td>
	<Td></Td>
	<Td></Td>
	<Td></Td>
	<Td align="center"><A HREF="index.php?con=admin&act=usermodify">���</A></Td>
</TR>
<?php foreach($userlist['data'] as $key=>$val){?>
<TR class="tr<?php echo $key%2;?>" id="user<?php echo $val['uid'];?>">
	<TD width="60px">
	<div id="email-<?php echo $val['uid'];?>" onmouseover="this.style.backgroundColor='#ff8800';" onmouseout="this.style.backgroundColor='';" onclick="modifyValue('emailinput-<?php echo $val['uid'];?>');"><?php echo $val['email'];?>
	</div>
	<textarea class="hideinput" id="emailinput-<?php echo $val['uid'];?>" ondblclick="confirmValue('user',this.value,'emailinput-<?php echo $val['uid'];?>','uid');"></textarea>
	</TD>
	<TD width="60px"><div id="sitename-<?php echo $val['uid'];?>" onmouseover="this.style.backgroundColor='#ff8800';" onmouseout="this.style.backgroundColor='';" onclick="modifyValue('sitenameinput-<?php echo $val['uid'];?>');"><?php echo $val['sitename']?$val['sitename']:'---';?>
	</div>
	<textarea class="hideinput" id="sitenameinput-<?php echo $val['uid'];?>" ondblclick="confirmValue('user',this.value,'sitenameinput-<?php echo $val['uid'];?>','uid');"></textarea></TD>
	
	<TD align="center" width="70px"><div id="siteurl-<?php echo $val['uid'];?>" onmouseover="this.style.backgroundColor='#ff8800';" onmouseout="this.style.backgroundColor='';" onclick="modifyValue('siteurlinput-<?php echo $val['uid'];?>');"><?php echo $val['siteurl']?$val['siteurl']:'---';?>
	</div>
	<textarea class="hideinput" id="siteurlinput-<?php echo $val['uid'];?>" ondblclick="confirmValue('user',this.value,'siteurlinput-<?php echo $val['uid'];?>','uid');"></textarea></TD>
	<TD  align="center" width="70px"><div id="siteapi-<?php echo $val['uid'];?>" onmouseover="this.style.backgroundColor='#ff8800';" onmouseout="this.style.backgroundColor='';" onclick="modifyValue('siteapiinput-<?php echo $val['uid'];?>');"><?php echo $val['siteapi'];?>
	</div>
	<input TYPE="text" class="hideinput" id="siteapiinput-<?php echo $val['uid'];?>" ondblclick="confirmValue('user',this.value,'siteapiinput-<?php echo $val['uid'];?>','uid');"/></TD>
	<TD  align="center" width="40px"><?php echo $val['cityid'];?></TD>
	<TD align="center" width="60px"><?php echo $val['connect_type'];?> <?php echo $val['connect_content'];?> <?php echo $val['connect_user'];?></TD>
	<TD align="center" width="60px"><?php echo date('Y-m-d H:i',$val['updatetime']);?></TD>
	<td align="center" width="150px">
	<?php $usertype=array('siteuser'=>'��վ��','normaluser'=>'��Ա','adminuser'=>'����Ա','nulluser'=>'������Ա');?>
	<div id="usertype-<?php echo $val['uid'];?>" onmouseover="this.style.backgroundColor='#ff8800';" onmouseout="this.style.backgroundColor='';" onclick="modifyValue('usertypeinput-<?php echo $val['uid'];?>');"><?php echo $usertype[$val['usertype']];?>
</div>

<select class="hideinput" id="usertypeinput-<?php echo $val['uid'];?>" onchange="confirmValue('user',this.value,'usertypeinput-<?php echo $val['uid'];?>','uid');">
<option value="normaluser"> </option>
<option value="siteuser">��վ��</option>
<option value="adminuser">����Ա</option>
<option value="adminuser">������Ա</option>
<option value="normaluser">��ͨ��Ա</option>
</select>
	</td>
	<TD align="center" width="80px"><A HREF="index.php?con=admin&act=usermodify&updateid=<?php echo $val['uid'];?>">�޸�</A> <A HREF="javascript:deleteVal('user','<?php echo $val['uid'];?>','user<?php echo $val['uid'];?>','uid')">ɾ��</A><?php if(!strpos($val['sitename'],'����')){?> <A HREF="index.php?con=admin&act=addusersite&uid=<?php echo $val['uid'];?>" target="addsite">������վ</A><?php }?></TD>
</TR>
<?php }?>
</TABLE>
</div>
<iframe src="" style="display:none;" name="addsite"></iframe>
<ul class="page"><?php echo $userlist['pageinfo'];?></ul>
<SCRIPT LANGUAGE="JavaScript">
<!--
	function fen(page)
	{
		window.location="index.php?con=admin&act=group&selecttype=<?php echo $selecttype;?>&page="+page;
	}
	function gotype(t)
	{
		window.location="index.php?con=admin&act=group&selecttype="+t;
	}
//-->
</SCRIPT>
</body>
</html>
