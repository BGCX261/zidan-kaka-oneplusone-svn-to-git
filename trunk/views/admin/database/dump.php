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
<script language="javascript" src="views/js/jquery.js"></script>
<title>数据备份</title>
</head>
<body>
<SCRIPT LANGUAGE="JavaScript">
<!--
	function checkall(obj)
	{
		if($(obj).attr('checked')==true)
		{
			$('.dc').attr('checked',true);
		}
		else
		{
			$('.dc').attr('checked',false);
		}
	}
	function custom()
	{
		if($('#customeradio').attr('checked')==true)
		{
			$('#customdiv').show();
		}
		else
		{
			$('#customdiv').hide();
		}
	}
//-->
</SCRIPT>
<form action="" method="post">
<div class="list">
<table>
  <tbody><tr>
    <th colspan="7">服务器上备份文件</th>
  </tr>
  <tr>
    <th width="48" align="right"><input type="checkbox" onclick="checkall(this.form, 'file[]')" name="chkall">移除</th>
    <th>文件名</th>
    <th>时间</th>
    <th>大小</th>
    <th>卷</th>
    <th>操作</th>
  </tr>
  <?php foreach($list as $k=$v){?>
   <tr>
   <td><input type="checkbox" value="<?php echo $v['name'];?>" name="file[]"></td>
   <td><a href="data/sqldata/<?php echo $v['name'];?>"><?php echo $v['name'];?></a></td>
   <td><?php echo date('Y-m-d H:i:s',filectime('data/sqldata/'.$v['name']));?></td>
   <td><?php echo filesize('data/sqldata/'.$v['name']);?></td>
   <td>vol:<?php echo 1;?></td>
   <td align="center"><a href="index.php?con=database&act=import&file_name=<?php echo $v['name'];?>">[导入]</a></td>
  </tr>
  <?php }?>
    <tr>
    <td align="center" colspan="7"><INPUT TYPE="submit" value="提交">
  </td></tr>
</tbody></table>
</DIV>

</FORM>
</body>
</html>