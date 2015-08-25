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
<title>城市管理</title>
</head>
<body>
<div class="list">
<TABLE cellpdisgoodsding="1" cellspacing="1" style="width:700px;margin:auto;">
<TR>
	<TH>标题</TH>
	<TH>访问地址</TH>
	<TH>操作</TH>
</TR>
<TR class="tr1" id="disgoods0">
	<TD width="180px">
	</TD>
	<TD>
	</TD>
	<td width="100px" align="center">
	<A HREF="index.php?con=admin&act=disgoodsmodify">添加</A>
	</td>
</TR>
<?php foreach($goodslist['data'] as $key=>$val){?>
<TR class="tr1" id="disgoods<?php echo $val['id'];?>">
	<TD width="180px">
	<div id="title-<?php echo $val['id'];?>" onmouseover="this.style.backgroundColor='#ff8800';" onmouseout="this.style.backgroundColor='';" onclick="modifyValue('titleinput-<?php echo $val['id'];?>');"><?php echo $val['title'];?>
	</div>
	<input class="hideinput" id="titleinput-<?php echo $val['id'];?>" ondblclick="confirmValue('disgoods',this.value,'titleinput-<?php echo $val['id'];?>','id');"/>
	</TD>
	<TD>
	<div id="link-<?php echo $val['id'];?>" onmouseover="this.style.backgroundColor='#ff8800';" onmouseout="this.style.backgroundColor='';" onclick="modifyValue('linkinput-<?php echo $val['id'];?>');"><?php echo $val['link'];?>
	</div>
	<input class="hideinput" id="linkinput-<?php echo $val['id'];?>" ondblclick="confirmValue('disgoods',this.value,'linkinput-<?php echo $val['id'];?>','id');"/>
	</TD>
	<td width="100px" align="center">
	<A HREF="index.php?con=admin&act=disgoodsmodify&updateid=<?php echo $val['id'];?>">修改</A>
	<A HREF="javascript:deleteVal('disgoods','<?php echo $val['id'];?>','disgoods<?php echo $val['id'];?>','id')">删除</A>
	</td>
</TR>
<?php }?>
</TABLE>
<ul class="page"><?php echo $disgoods['pageinfo'];?></ul>
<SCRIPT LANGUAGE="JavaScript">
<!--
	function fen(page)
	{
		window.location="index.php?con=admin&act=disgoods&page="+page;
	}
//-->
</SCRIPT>
</div>
</body>
</html>
