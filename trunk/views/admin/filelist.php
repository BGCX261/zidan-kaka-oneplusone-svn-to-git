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
<title>���й���</title>
</head>
<body>
<div class="list">
<TABLE cellpdisgoodsding="1" cellspacing="1" style="width:700px;margin:auto;">
<TR>
	<TH>�ļ���</TH>
	<TH>��С</TH>
	<TH>��������</TH>
	<TH>����Ŀ¼</TH>
	<TH>����</TH>
</TR>

<?php foreach($filelist['data'] as $key=>$v){?>
<TR class="tr1" id="img<?php echo $key;?>">
	<TD width="110px" align="center">
	<img src="<?php echo $v;?>" style="width:100px;height:61px;"/>
	</TD>
	<TD>
	<?php echo filesize($v);?>
	</TD>
	<TD>
	<?php echo date('Y-m-d H:i:s',filectime($v));?>
	</TD>
	<TD>
	<?php echo dirname($v);?>
	</TD>
	<td width="100px" align="center">
	<A HREF="<?php echo $v;?>" target="_blank">�鿴</A>
	<A HREF="javascript:deleteImg('<?php echo $v;?>','<?php echo $key;?>')">ɾ��</A>
	</td>
</TR>
<?php }?>
</TABLE>
<div style="width:100%;text-align:center;"><?php echo $filelist['pageinfo'];?></div>
</div>
<SCRIPT LANGUAGE="JavaScript">
<!--
	function deleteImg(mimg,k)
	{
		url="index.php?con=admin&act=deleteimg";
		$.get(url,{img:mimg},function(data){
			if(parseInt(data)==1)
			{
				alert('ɾ���ɹ�');
				$('#img'+k).remove();
			}
		}); 
	}
//-->
</SCRIPT>
</body>
</html>
