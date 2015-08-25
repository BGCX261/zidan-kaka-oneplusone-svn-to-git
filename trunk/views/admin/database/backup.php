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
<div class="list">
<FORM METHOD="POST" ACTION="index.php?con=database&act=dumpsql">
<TABLE cellpadding="1" cellspacing="1">
<TR class="tr1"><th colspan="2">备份方式</th></tr>
<TR class="tr0">
	<TD><INPUT TYPE="radio" NAME="type" value="full" onclick="custom();" checked>全部</TD>
	<TD>备份数据库所有表</TD>
</TR>
<TR class="tr0">
	<TD><INPUT TYPE="radio" NAME="type" value="min" onclick="custom();">最小</TD>
	<TD>仅包括网站表</TD>
</TR>
<TR class="tr0">
	<TD><INPUT TYPE="radio" NAME="type" value="stand" onclick="custom();">标准</TD>
	<TD>备份常用的数据表(网站,用户，团购)</TD>
</TR>
<TR class="tr0">
	<TD><INPUT TYPE="radio" NAME="type" id="customeradio" value="custom" onclick="custom();">自定义</TD>
	<TD>根据自行选择备份数据表</TD>
</TR>
<tr class="tr1">
    <th colspan="2">其他选项</th>
  </tr>
  <tr class="tr0">
    <td>使用扩展插入(Extended Insert)方式</td>
    <td><input type="radio" value="1" class="radio" name="ext_insert">是&nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" checked="checked" value="0" class="radio" name="ext_insert">否</td>
  </tr>
  <tr class="tr0">
    <td>分卷备份 - 文件长度限制(kb)</td>
    <td><input type="text" value="5120" name="vol_size"></td>
  </tr>
  <tr class="tr0">
    <td>备份文件名</td>
    <td><input type="text" value="<?php echo $sql_file_name;?>.sql" name="sql_file_name"></td>
  </tr>
</tbody></table>
</div>
<DIV ID="customdiv" CLASS="list" style="display:none;">
<DIV ID="" CLASS="">
<INPUT TYPE="checkbox" onclick="checkall(this);">全选
</DIV>
<TABLE cellpadding="1" cellspacing="1" style="background:#ffffff;">
<TR>
<?php foreach($tables as $k=>$v){?>
<td><INPUT TYPE="checkbox" NAME="customtables[]" value="<?php echo $v;?>" class="dc"><?php echo $v;?></TD>
	<?php if(($k+1)%6==0){?></tr><TR><?php }?>
<?php }?>
</TR>
</TABLE>
</DIV>
<INPUT TYPE="submit" value="提交">
</FORM>
</body>
</html>