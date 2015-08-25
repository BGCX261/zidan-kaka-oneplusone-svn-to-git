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
	function addsitecate()
{
	url="index.php?con=admin&act=sitecatemodify";
	$.get(url, function(data){
		$('#sitecate_area').html(data);
		$('#sitecate_area').show();
	}); 
}
function parseMysitecateData(data)
{
	var objdata=data;
	$('#sitecate0').after('<TR class="tr1" id="sitecate'+objdata.id+'"><TD width="180px">'+objdata.sitecatename+'</TD><TD width="180px">'+objdata.sitetype+'</TD><TD width="180px">0</TD><td width="70px" align="center"><A HREF="javascript:deleteVal(\'sitecate\',\''+objdata.id+'\',\'sitecate'+objdata.id+'\')">删除</A></td></TR>');
	$('#sitecate_area').hide();
}
//-->
</SCRIPT>
<div class="list">
<TABLE cellpadding="1" cellspacing="1" style="width:430px;margin:auto;">
<TR>
	<TH>类别</TH>
	<TH>类型</TH>
	<TH>排序</TH>
	<TH>操作</TH>
</TR>
<TR class="tr1" id="sitecate0">
	<TD width="180px">
	</TD>
	<TD width="180px">
	</TD>
	<TD width="180px">
	</TD>
	<td width="70px" align="center">
	<A HREF="javascript:addsitecate();">添加</A>
	</td>
</TR>
<?php 
$setting=read('setting');
$sitelogType=$setting['sitelogType'];
foreach($GLOBALS['sitecate'] as $key=>$val){?>
<TR class="tr1" id="sitecate<?php echo $key;?>">
	<TD width="180px">
	<div id="sitecatename-<?php echo $key;?>" onmouseover="this.style.backgroundColor='#ff8800';" onmouseout="this.style.backgroundColor='';" onclick="modifyValue('sitecatenameinput-<?php echo $key;?>');"><?php echo $val['sitecatename'];?>
	</div>
	<input class="hideinput" id="sitecatenameinput-<?php echo $key;?>" ondblclick="confirmValue('sitecate',this.value,'sitecatenameinput-<?php echo $key;?>','id');"/>
	</TD>
	<TD width="180px">
<div id="sitetype-<?php echo $key;?>" onmouseover="this.style.backgroundColor='#ff8800';" onmouseout="this.style.backgroundColor='';" onclick="modifyValue('sitetypeinput-<?php echo $key;?>');"><?php echo $val[sitetype]?$sitelogType[$val[sitetype]]:'';?>
</div>
    <?php
	${"selected_$val[sitetype]"}='selected="selected"';
	?>
  <select class="hideinput" id="sitetypeinput-<?php echo $key;?>" name="sitetype" onchange="confirmValue('sitecate',this.value,'sitetypeinput-<?php echo $key;?>','id');">
  <option value="1" <?php echo $selected_1;?>>网购商城</option>
  <option value="2" <?php echo $selected_2;?>>名站导航</option>
  <option value="3" <?php echo $selected_3;?>>团购网站</option>
  <option value="4" <?php echo $selected_4;?>>综合平台</option>
</select>
    <?php
	unset(${"selected_$val[sitetype]"});
	?>
	
	</TD>
	<TD width="180px">
	<div id="sortorder-<?php echo $key;?>" onmouseover="this.style.backgroundColor='#ff8800';" onmouseout="this.style.backgroundColor='';" onclick="modifyValue('sortorderinput-<?php echo $key;?>');"><?php echo $val['sortorder'];?>
	</div>
	<input class="hideinput" id="sortorderinput-<?php echo $key;?>" ondblclick="confirmValue('sitecate',this.value,'sortorderinput-<?php echo $key;?>','id');"/>
	</TD>
	<td width="70px" align="center">
	<A HREF="javascript:deleteVal('sitecate','<?php echo $key;?>','sitecate<?php echo $key;?>')">删除</A>
	</td>
</TR>
<?php }?>
</TABLE>
</div>
<DIV id="sitecate_area" style="display:none;border:2px solid #ccc;width:300px;position:absolute;left:260px;top:60px;height:120px;background:#fff;z-index:10px;"></DIV>
</body>
</html>
