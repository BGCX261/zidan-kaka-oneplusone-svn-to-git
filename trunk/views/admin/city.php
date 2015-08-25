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
<SCRIPT LANGUAGE="JavaScript">
<!--
	function addcity()
	{
	url="index.php?con=admin&act=citymodify";
	$.get(url, function(data){
		$('#city_area').html(data);
		$('#city_area').show();
	}); 
	}


	function modifycity(id)
	{
		url="index.php?con=admin&act=citymodify&updateid="+id;
		$.get(url, function(data){
			$('#city_area').html(data);
			$('#city_area').show();
		}); 
	}

	function parseMyCityData(data)
{
	var objdata=data;
	if(objdata.dotype=='update')
	{
		$('#cityname-'+objdata.id).html(objdata.cityname);
		$('#pinyin-'+objdata.id).html(objdata.pinyin);
		$('#city_area').hide();
	}
	else
	{
		$('#city0').after('<TR class="tr1" id="city'+objdata.id+'"><TD width="180px">'+objdata.cityname+'</TD><TD width="180px">0</TD><TD width="180px">'+objdata.pinyin+'</TD><TD width="180px" align="center"></TD><td width="70px" align="center"><A HREF="javascript:deleteVal(\'city\',\''+objdata.id+'\',\'city'+objdata.id+'\',\'cityid\')">删除</A></td></TR>');
		$('#city_area').hide();
	}
}
//-->
</SCRIPT>
<div class="list">
<TABLE cellpadding="1" cellspacing="1" style="width:520px;margin:auto;">
<TR>
	<TH>城市</TH>
	<TH>排序</TH>
	<TH>拼音</TH>
	<TH>前台显示</TH>
	<TH>操作</TH>
</TR>
<TR class="tr1" id="city0">
	<TD width="180px">
	</TD>
	<TD width="180px">
	</TD>
	<TD width="180px">
	</TD><TD width="180px">
	</TD>
	<td width="70px" align="center">
	<A HREF="javascript:addcity();">添加</A>
	</td>
</TR>
<?php foreach($GLOBALS['city'] as $key=>$val){?>
<TR class="tr1" id="city<?php echo $val['cityid'];?>">
	<TD width="180px"><?php echo $val['cityname'];?></TD>
	
	<TD width="180px">
	<div id="sortorder-<?php echo $val['cityid'];?>" onmouseover="this.style.backgroundColor='#ff8800';" onmouseout="this.style.backgroundColor='';" onclick="modifyValue('sortorderinput-<?php echo $val['cityid'];?>');"><?php echo $val['sortorder'];?>
	</div>
	<input class="hideinput" id="sortorderinput-<?php echo $val['cityid'];?>" ondblclick="confirmValue('city',this.value,'sortorderinput-<?php echo $val['cityid'];?>','cityid');"/>
	</TD>
	
	<TD width="180px">
	<div id="pinyin-<?php echo $val['cityid'];?>"><?php echo $key;?></div>
	</TD>

	<td width="180px" align="center">
	<div id="isshow-<?php echo $val['cityid'];?>" onmouseover="this.style.backgroundColor='#ff0000';" onmouseout="this.style.backgroundColor='';" onclick="updateVal('city','isshowinput-<?php echo $val['cityid'];?>','cityid','',['显示','不显示']);">
	<?php echo $val['isshow']?'显示':'不显示';?>
	</div>
	<INPUT TYPE="text" class="hideinput" id="isshowinput-<?php echo $val['cityid'];?>" value="<?php echo intval(!$val['isshow']);?>" title='nochange'>
	</td>
	<td width="170px" align="center">
	<A HREF="javascript:deleteVal('city','<?php echo $val['cityid'];?>','city<?php echo $val['cityid'];?>','cityid')">删除</A>
	<A HREF="javascript:modifycity('<?php echo $val['cityid'];?>');">修改</A>
	</td>
</TR>
<?php }?>
</TABLE>
</div>
<DIV id="city_area" style="display:none;border:2px solid #ccc;width:300px;position:absolute;left:260px;top:60px;height:120px;background:#fff;z-index:10px;"></DIV>
</body>
</html>
