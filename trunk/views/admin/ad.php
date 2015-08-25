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
<TABLE cellpadding="1" cellspacing="1" style="width:700px;margin:auto;">
<TR>
	<TH>标题</TH>
	<TH>引用地址</TH>
	<TH>操作</TH>
</TR>
<TR class="tr1" id="ad0">
	<TD width="180px">
	</TD>
	<TD>
	</TD>
	<td width="100px" align="center">
	<A HREF="index.php?con=admin&act=admodify">添加</A>
	</td>
</TR>
<?php foreach($ad['data'] as $key=>$val){?>
<TR class="tr1" id="ad<?php echo $val['id'];?>">
	<TD width="180px">
	<div id="title-<?php echo $val['id'];?>" onmouseover="this.style.backgroundColor='#ff8800';" onmouseout="this.style.backgroundColor='';" onclick="modifyValue('titleinput-<?php echo $val['id'];?>');"><?php echo $val['title'];?>
	</div>
	<input class="hideinput" id="titleinput-<?php echo $val['id'];?>" ondblclick="confirmValue('ad',this.value,'titleinput-<?php echo $val['id'];?>','id');"/>
	</TD>
	<TD>
	<?php $adindex=explode('-',$val['adindex']);?>
	<input style="width:300px;" value="<script language='javascript' src='<?php echo SITE_ROOT;?>/data/cache/<?php echo $adindex[1];?>.js'></script>"/>
	</TD>
	<td width="100px" align="center">
	<A HREF="index.php?con=admin&act=admodify&updateid=<?php echo $val['id'];?>">修改</A>
	<A HREF="javascript:deleteVal('ad','<?php echo $val['id'];?>','ad<?php echo $val['id'];?>','id')">删除</A>
	</td>
</TR>
<?php }?>
</TABLE>
<ul class="page"><?php echo $ad['pageinfo'];?></ul>
<SCRIPT LANGUAGE="JavaScript">
<!--
	function fen(page)
	{
		window.location="index.php?con=admin&act=ad&page="+page;
	}
//-->
</SCRIPT>
</div>
</body>
</html>
