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
<title>留言管理</title>
</head>
<STYLE TYPE="text/css">
	
</STYLE>
<body>

<div class="list">
<TABLE cellpadding="1" cellspacing="1">
<?php foreach($booklist['data'] as $key=>$val){?>
<TR id="guestbook<?php echo $val['id'];?>">
	<TD style="background:#ffffff">
	<TABLE style="background:#ffffff">
	<TR>
		<TD width="500px"><?php echo $val['title'];?></TD><TD><A HREF="javascript:deleteVal('guestbook','<?php echo $val['id'];?>','guestbook<?php echo $val['id'];?>')">删除</A></TD>
	</TR>
	<TR>
		<TD colspan="2"><TEXTAREA NAME="" ROWS="" COLS="" style="width:100%;height:100px;"><?php echo $val['content'];?></TEXTAREA></TD>
	</TR>
	</TABLE>
	</TD>
</TR>
<?php }?>
</TABLE>
</div>
<ul class="page"><?php echo $booklist['pageinfo'];?></ul>
<SCRIPT LANGUAGE="JavaScript">
<!--
	function fen(page)
	{
		window.location="index.php?con=admin&act=guestbook&page="+page;
	}
//-->
</SCRIPT>
</body>
</html>
