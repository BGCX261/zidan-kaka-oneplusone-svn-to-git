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
<title>链接管理</title>
</head>
<body>
<div class="list">
<TABLE cellpadding="1" cellspacing="1" style="width:700px;margin:auto;">
<TR>
	<TH>标题</TH>
	<TH>地址</TH>
<TH>排序</TH>
	<TH>操作</TH>
</TR>
<TR class="tr1" id="link0">
	<TD width="180px">
	</TD>
	<TD>
	</TD><TD>
	</TD>
	<td width="100px" align="center">
	<A HREF="index.php?con=admin&act=linkmodify">添加</A>
	</td>
</TR>
<?php foreach($linklist['data'] as $key=>$val){?>
<TR class="tr1" id="link<?php echo $val['id'];?>">
	<TD width="180px">
	<div id="title-<?php echo $val['id'];?>" onmouseover="this.style.backgroundColor='#ff8800';" onmouseout="this.style.backgroundColor='';" onclick="modifyValue('titleinput-<?php echo $val['id'];?>');"><?php echo $val['title'];?>
	</div>
	<input class="hideinput" id="titleinput-<?php echo $val['id'];?>" ondblclick="confirmValue('link',this.value,'titleinput-<?php echo $val['id'];?>','id');"/>
	</TD>
	<TD>
	<div id="url-<?php echo $val['id'];?>" onmouseover="this.style.backgroundColor='#ff8800';" onmouseout="this.style.backgroundColor='';" onclick="modifyValue('urlinput-<?php echo $val['id'];?>');"><?php echo $val['url'];?>
	</div>
	<input class="hideinput" id="urlinput-<?php echo $val['id'];?>" ondblclick="confirmValue('link',this.value,'urlinput-<?php echo $val['id'];?>','id');"/>
	</TD>
		<TD>
	<div id="sortorder-<?php echo $val['id'];?>" onmouseover="this.style.backgroundColor='#ff8800';" onmouseout="this.style.backgroundColor='';" onclick="modifyValue('sortorderinput-<?php echo $val['id'];?>');"><?php echo $val['sortorder'];?>
	</div>
	<input class="hideinput" id="sortorderinput-<?php echo $val['id'];?>" ondblclick="confirmValue('link',this.value,'sortorderinput-<?php echo $val['id'];?>','id');"/>
	</TD>
	<td width="100px" align="center">
	<A HREF="index.php?con=admin&act=linkmodify&updateid=<?php echo $val['id'];?>">修改</A>
	<A HREF="javascript:deleteVal('link','<?php echo $val['id'];?>','link<?php echo $val['id'];?>','id')">删除</A>
	</td>
</TR>
<?php }?>
</TABLE>
<ul class="page"><?php echo $linklist['pageinfo'];?></ul>
<SCRIPT LANGUAGE="JavaScript">
<!--
	function fen(page)
	{
		window.location="index.php?con=admin&act=link&page="+page;
	}
//-->
</SCRIPT>
</div>
</body>
</html>
