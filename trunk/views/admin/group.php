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
<title>�Ź�����</title>
</head>
<STYLE TYPE="text/css">
	
</STYLE>
<body>
<form act="index.php" method="get">
<input type="hidden" value="group" name="act"/>
<input type="hidden" value="admin" name="con"/>
�ؼ��֣�<input type="text" name="keyword" value=""/> ���ࣺ<select name="grouptype">
	<option value="-2">����</option>
	<option value="0">δ����</option>
<?php foreach($GLOBALS['cate'] as $k=>$v){?>
<option value="<?php echo $k;?>"><?php echo $v['catename'];?></option>
<?php }?>
</select>
������վ��
<SELECT NAME="siteid" id="siteid">
<option value="-2">����</option>

<?php foreach($GLOBALS['site'] as $key=>$val){?>
<option value="<?php echo $val['id'];?>-<?php echo $val['sitename'];?>"><?php echo $val['pinyin'];?>:<?php echo $val['sitename'];?></option>
<?php }?>
</SELECT>
���ڳ��У�
<select name="cityid">
<option value="-2">����</option>
	<?php foreach($GLOBALS['city'] as $k=>$v){?>
<option value="<?php echo $k;?>"><?php echo $v['cityname'];?></option>
<?php }?>
</select>
<input type="submit" value="����"/>
</form>
<form action="index.php?con=admin&act=multigroup" method="post">
<input type="hidden" name="commit" value="1"/>
<ul class="submenu" id="submenu"><li class="<?php echo !$selecttype?'focus':'normal';?>" onclick="gotype(0);">ȫ��</li><li class="<?php echo $selecttype==3?'focus':'normal';?>" onclick="gotype(3);">�����</li><li class="<?php echo $selecttype==4?'focus':'normal';?>" onclick="gotype(4);">δ���</li><li class="<?php echo $selecttype==1?'focus':'normal';?>" onclick="gotype(1);">�ѹ���</li><li class="<?php echo $selecttype==2?'focus':'normal';?>" onclick="gotype(2);">δ����</li><li class="<?php echo $selecttype==2?'focus':'normal';?>" onclick="gocommend(1);">�Ƽ�</li></ul>
<div class="list">
<TABLE cellpadding="1" cellspacing="1">
<TR>
	<TH style="width:20px;text-align:center;"><INPUT TYPE="checkbox" NAME="" onclick="checkallgroup(this)"></TH>
	<TH>��Ŀ����</TH>
	<TH>��վ</TH>
	<TH>����</TH>
	<TH>����</TH>
	<TH>ԭ��</TH>
	<TH>�¼�</TH>
	<TH>����</TH>
	<TH>�Ƽ�</TH>
	<TH>״̬</TH>
	<TH>����</TH>
</TR>
<?php foreach($grouplist['data'] as $key=>$val){?>
<TR class="tr<?php echo $key%2;?>" id="group<?php echo $val['id'];?>">
	<td style="width:20px;text-align:center;">
	<input type="checkbox" value="<?php echo $val['id'];?>" name="gid[]" class="nocheck"/>
	</td>
	<TD width="180px">
	<div id="subject-<?php echo $val['id'];?>" onmouseover="this.style.backgroundColor='#ff8800';" onmouseout="this.style.backgroundColor='';" onclick="modifyValue('subjectinput-<?php echo $val['id'];?>');"><?php echo $val['subject'];?>
	</div>
	<textarea class="hideinput" id="subjectinput-<?php echo $val['id'];?>" ondblclick="confirmValue('groups',this.value,'subjectinput-<?php echo $val['id'];?>','id');"></textarea>
	</TD>
	
	<TD width="60px" align="center"><?php echo $val['groupsite'];?></TD>
	<TD width="60px" align="center"><div id="grouptype-<?php echo $val['id'];?>" onmouseover="this.style.backgroundColor='#ff8800';" onmouseout="this.style.backgroundColor='';" onclick="modifyValue('grouptypeinput-<?php echo $val['id'];?>');"><?php echo $val['grouptype']?$GLOBALS['cate'][$val['grouptype']]['catename']:'δ����';?>
	</div>
	
	<select class="hideinput" id="grouptypeinput-<?php echo $val['id'];?>" onchange="confirmValue('groups',this.value,'grouptypeinput-<?php echo $val['id'];?>','id');">
	<option value="0">δ����</option>
	<?php foreach($GLOBALS['cate'] as $k=>$v){?>
<option value="<?php echo $k;?>"><?php echo $v['catename'];?></option>
<?php }?>
</select>
	
	</TD>

	<TD width="60px" align="center"><?php echo $val['cityname'];?></TD>

	<TD width="35px" align="center"><?php echo $val['oldprice'];?></TD>
	<TD width="35px" align="center"><?php echo $val['nowprice'];?></TD>
	<TD width="35px" align="center"><div id="sortorder-<?php echo $val['id'];?>" onmouseover="this.style.backgroundColor='#ff8800';" onmouseout="this.style.backgroundColor='';" onclick="modifyValue('sortorderinput-<?php echo $val['id'];?>');"><?php echo $val['sortorder'];?>
	</div>
	<input TYPE="text" class="hideinput" id="sortorderinput-<?php echo $val['id'];?>" ondblclick="confirmValue('groups',this.value,'sortorderinput-<?php echo $val['id'];?>','id');"/></TD>
	<td width="70px" align="center">
	<div id="recommend-<?php echo $val['id'];?>" onmouseover="this.style.backgroundColor='#ff0000';" onmouseout="this.style.backgroundColor='';" onclick="updateVal('groups','recommendinput-<?php echo $val['id'];?>','id','',['�Ƽ�','���Ƽ�']);">
	<?php echo $val['recommend']?'�Ƽ�':'���Ƽ�';?>
	</div>
	<INPUT TYPE="text" class="hideinput" id="recommendinput-<?php echo $val['id'];?>" value="<?php echo intval(!$val['recommend']);?>" title='nochange'>
	</td>
	<td width="70px" align="center">
	<div id="ispassed-<?php echo $val['id'];?>" onmouseover="this.style.backgroundColor='#ff0000';" onmouseout="this.style.backgroundColor='';" onclick="updateVal('groups','ispassedinput-<?php echo $val['id'];?>','id','',['�����','δ���']);">
	<?php echo $val['ispassed']?'�����':'δ���';?>
	</div>
	<INPUT TYPE="text" class="hideinput" id="ispassedinput-<?php echo $val['id'];?>" value="<?php echo intval(!$val['ispassed']);?>" title='nochange'>
	</td>
	<TD align="center" width="120px"><A HREF="index.php?con=admin&act=groupmodify&updateid=<?php echo $val['id'];?>">�޸�</A> <A HREF="javascript:deleteVal('groups','<?php echo $val['id'];?>','group<?php echo $val['id'];?>')">ɾ��</A></TD>
</TR>
<?php }?>
</TABLE>
</div>
<div style="clear:both;"><INPUT TYPE="checkbox" NAME="" onclick="checkallgroup(this)"> <input type="submit" class="normal_button" value="����ɾ��" onclick="return confirm('ȷ��ɾ����');" name="confirmbutton"/>
<select name="ispassed">
<option value="1">�����</option>
<option value="0">δ���</option>
</select>
<input type="submit" class="normal_button" value="�������" name="confirmbutton"/>
<input type="submit" class="normal_button" value="ȫ�����" name="confirmbutton"/>
<input type="submit" class="normal_button" value="ȫ��ȡ�����" name="confirmbutton"/>
<select name="cate">
<?php foreach($GLOBALS['cate'] as $k=>$v){?>
<option value="<?php echo $k;?>"><?php echo $v['catename'];?></option>
<?php }?>
</select>

<input type="submit" class="normal_button" value="�����ƶ�" name="confirmbutton"/>
</div>
<ul class="page"><?php echo $grouplist['pageinfo'];?></ul>
</form>

<SCRIPT LANGUAGE="JavaScript">
<!--
	function fen(page)
	{
		window.location="index.php?con=admin&act=group&selecttype=<?php echo $selecttype;?>&page="+page;
	}
	function gotype(t)
	{
		window.location="index.php?con=admin&act=group&selecttype="+t;
	}
	function gocommend(t)
	{
		window.location="index.php?con=admin&act=group&recommend="+t;
	}
//-->
</SCRIPT>
</body>
</html>
