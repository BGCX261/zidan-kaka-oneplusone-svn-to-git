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
<title>类别管理</title>
</head>
<body>
<SCRIPT LANGUAGE="JavaScript">
<!--
	function addcate()
{
	url="index.php?con=admin&act=catemodify";
	$.get(url, function(data){
		$('#cate_area').html(data);
		$('#cate_area').show();
	}); 
}
function parseMyCateData(data)
{
	var objdata=data;
	$('#cate0').after('<TR class="tr1" id="cate'+objdata.id+'"><TD width="180px">'+objdata.catename+'</TD><TD width="180px">0</TD><td width="70px" align="center"><A HREF="javascript:deleteVal(\'catelist\',\''+objdata.id+'\',\'cate'+objdata.id+'\')">删除</A></td></TR>');
	$('#cate_area').hide();
}
//-->
</SCRIPT>
<div class="list">
<TABLE cellpadding="1" cellspacing="1" style="width:250px;margin:auto;">
<TR>
	<TH>类别</TH>
	<TH>排序</TH>
	<TH>操作</TH>
</TR>
<TR class="tr1" id="cate0">
	<TD width="180px">
	</TD>
	<TD width="180px">
	</TD>
	<td width="70px" align="center">
	<A HREF="javascript:addcate();">添加</A>
	</td>
</TR>
<?php foreach($GLOBALS['cate'] as $key=>$val){?>
<TR class="tr1" id="cate<?php echo $key;?>">
	<TD width="180px">
	<div id="catename-<?php echo $key;?>" onmouseover="this.style.backgroundColor='#ff8800';" onmouseout="this.style.backgroundColor='';" onclick="modifyValue('catenameinput-<?php echo $key;?>');"><?php echo $val['catename'];?>
	</div>
	<input class="hideinput" id="catenameinput-<?php echo $key;?>" ondblclick="confirmValue('catelist',this.value,'catenameinput-<?php echo $key;?>','id');"/>
	</TD>
	<TD width="180px">
	<div id="sortorder-<?php echo $key;?>" onmouseover="this.style.backgroundColor='#ff8800';" onmouseout="this.style.backgroundColor='';" onclick="modifyValue('sortorderinput-<?php echo $key;?>');"><?php echo $val['sortorder'];?>
	</div>
	<input class="hideinput" id="sortorderinput-<?php echo $key;?>" ondblclick="confirmValue('catelist',this.value,'sortorderinput-<?php echo $key;?>','id');"/>
	</TD>
	<td width="70px" align="center">
	<A HREF="javascript:deleteVal('catelist','<?php echo $key;?>','cate<?php echo $key;?>')">删除</A>
	</td>
</TR>
<?php }?>
</TABLE>
</div>
<DIV id="cate_area" style="display:none;border:2px solid #ccc;width:300px;position:absolute;left:260px;top:60px;height:120px;background:#fff;z-index:10px;"></DIV>
</body>
</html>
