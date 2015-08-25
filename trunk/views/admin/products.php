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
<title>商品管理</title>
</head>
<body>
<div class="list">
<TABLE cellpdisgoodsding="1" cellspacing="1" style="width:700px;margin:auto;">
<TR>
	<TH>商品名称</TH>
	<TH>商品图片</TH>
    <TH>商品价格</TH>
    <TH>所属网站</TH>
	<TH>操作</TH>
</TR>
<TR class="tr1" id="disgoods0">
	<TD width="180px"></TD>
	<TD></TD><TD></TD><TD></TD>
	<td width="100px" align="center">
	<A HREF="index.php?con=admin&act=productsmodify">添加</A>
	</td>
</TR>
<?php foreach($goodslist['data'] as $key=>$val){?>
<TR class="tr1" id="disgoods<?php echo $val['pid'];?>" align="center">
	<TD width="180px">
	<div id="title-<?php echo $val['pid'];?>" onmouseover="this.style.backgroundColor='#ff8800';" onmouseout="this.style.backgroundColor='';" onclick="modifyValue('titleinput-<?php echo $val['pid'];?>');"><?php echo $val['title'];?>
	</div>
	<input class="hideinput" id="titleinput-<?php echo $val['pid'];?>" ondblclick="confirmValue('products',this.value,'titleinput-<?php echo $val['pid'];?>','pid');"/>
	</TD>
    <TD><?php if($val['pic_url']){?><img src="<?php echo $val['pic_url'];?>" height="100px" onclick="window.open(this.src,'_blank','');"/><?php }?></TD>
    <TD><?php echo $val['price'];?></TD>
	<TD><?php echo $val['webName'];?></TD>
	<td width="100px" align="center">
	<A HREF="index.php?con=admin&act=productsmodify&updateid=<?php echo $val['pid'];?>">修改</A>
	<A HREF="javascript:deleteVal('products','<?php echo $val['pid'];?>','products<?php echo $val['pid'];?>','pid')">删除</A>
	</td>
</TR>
<?php }?>
</TABLE>
<ul class="page"><?php echo $products['pageinfo'];?></ul>
<SCRIPT LANGUAGE="JavaScript">
<!--
	function fen(page)
	{
		window.location="index.php?con=admin&act=products&page="+page;
	}
//-->
</SCRIPT>
</div>
</body>
</html>
