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
<title>���ݱ���</title>
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
<TR class="tr1"><th colspan="2">���ݷ�ʽ</th></tr>
<TR class="tr0">
	<TD><INPUT TYPE="radio" NAME="type" value="full" onclick="custom();" checked>ȫ��</TD>
	<TD>�������ݿ����б�</TD>
</TR>
<TR class="tr0">
	<TD><INPUT TYPE="radio" NAME="type" value="min" onclick="custom();">��С</TD>
	<TD>��������վ��</TD>
</TR>
<TR class="tr0">
	<TD><INPUT TYPE="radio" NAME="type" value="stand" onclick="custom();">��׼</TD>
	<TD>���ݳ��õ����ݱ�(��վ,�û����Ź�)</TD>
</TR>
<TR class="tr0">
	<TD><INPUT TYPE="radio" NAME="type" id="customeradio" value="custom" onclick="custom();">�Զ���</TD>
	<TD>��������ѡ�񱸷����ݱ�</TD>
</TR>
<tr class="tr1">
    <th colspan="2">����ѡ��</th>
  </tr>
  <tr class="tr0">
    <td>ʹ����չ����(Extended Insert)��ʽ</td>
    <td><input type="radio" value="1" class="radio" name="ext_insert">��&nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" checked="checked" value="0" class="radio" name="ext_insert">��</td>
  </tr>
  <tr class="tr0">
    <td>�־��� - �ļ���������(kb)</td>
    <td><input type="text" value="5120" name="vol_size"></td>
  </tr>
  <tr class="tr0">
    <td>�����ļ���</td>
    <td><input type="text" value="<?php echo $sql_file_name;?>.sql" name="sql_file_name"></td>
  </tr>
</tbody></table>
</div>
<DIV ID="customdiv" CLASS="list" style="display:none;">
<DIV ID="" CLASS="">
<INPUT TYPE="checkbox" onclick="checkall(this);">ȫѡ
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
<INPUT TYPE="submit" value="�ύ">
</FORM>
</body>
</html>