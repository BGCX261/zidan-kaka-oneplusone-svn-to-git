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
<body>
<SCRIPT LANGUAGE="JavaScript">
<!--
	function addsite()
	{
		url="index.php?con=admin&act=sitemodify";
		$.get(url, function(data){
			$('#site_area').html(data);
			$('#site_area').show();
		}); 
	}
	function modifysite(id)
	{
		url="index.php?con=admin&act=sitemodify&updateid="+id;
		$.get(url, function(data){
			$('#site_area').html(data);
			$('#site_area').show();
		}); 
	}

	function parseMySiteData(data)
	{
		var objdata=data;
		if(objdata.dotype=='update')
		{
			$('#sitename-'+objdata.id).html(objdata.sitename);
			$('#siteurl-'+objdata.id).html(objdata.siteurl);
			$('#siteapi-'+objdata.id).html(objdata.siteapi);
			$('#sitetype-'+objdata.id).html(objdata.sitecatename);
		}
		else
		{
			$('#site0').after('<TR class="tr1" id="site'+objdata.id+'"><td></td><TD>'+objdata.sitename+'</TD><TD>'+objdata.siteapi+'</TD><TD align="center">'+objdata.sitecatename+'</TD><TD align="center">���Ƽ�</TD><TD align="center">0</TD><td width="100px" align="center"><A HREF="javascript:deleteVal(\'site\',\''+objdata.id+'\',\'site'+objdata.id+'\')">ɾ��</A> <A HREF="javascript:modifysite(\''+objdata.id+'\');">�޸�</A></td></TR>');
		}
		$('#site_area').hide();
	}
//-->
</SCRIPT>
<STYLE TYPE="text/css">
	.normal_txt{height:23px;line-height:23px;border:1px solid #ccc;padding:0px;margin:0px;}
	.normal_button{background-color: #F3F8F7;color:#73938E;font-weight:bold;}

</STYLE>
<FORM METHOD="GET" ACTION="index.php">
<INPUT TYPE="hidden" NAME="con" value="admin"><INPUT TYPE="hidden" NAME="act" value="site">
	��վ����<INPUT TYPE="text" class="normal_txt" NAME="keyword">������ĸ��<INPUT TYPE="text" class="normal_txt" NAME="pinyin"> ���ࣺ<SELECT NAME="sitetype"><OPTION VALUE="-2">����</option><OPTION VALUE="0">δ����</option><?php foreach($GLOBALS['sitecate'] as $k=>$v){?>
	
		<OPTION VALUE="<?php echo $k;?>"><?php echo $v['sitecatename'];?></option>
	
	<?php }?></SELECT><INPUT TYPE="submit" class='normal_button' value='����'>
</FORM>
<FORM METHOD=POST ACTION="index.php?con=admin&act=sitedo">
	<div class="list">
<TABLE cellpadding="1" cellspacing="1" id="sitearea">
<TR>
	<TH style="width:20px;text-align:center;"><INPUT TYPE="checkbox" NAME="" onclick="checkallgroup(this)"></TH>
	<TH>����</TH>
	<TH>API/��ַ</TH>
	<TH>����</TH>
	<TH>�Ƽ�</TH>
	<TH>�ɲɼ�</TH>
	<TH>����</TH>
	<TH>����</TH>
</TR>
<TR class="tr1" id="site0"><TD></TD><TD></TD><TD></TD><TD></TD><TD></TD><TD></TD><TD></TD>
<td width="100px" align="center"><A HREF="javascript:addsite();">���</A>
</td>
</TR>
<?php 
foreach($sitelist['data'] as $key=>$val){?>
<TR class="tr1" id="site<?php echo $val['id'];?>">
	<td style="width:20px;text-align:center;">
	<input type="checkbox" value="<?php echo $val['id'];?>" name="gid[]" class="nocheck"/>
	</td>
	<TD>
	<div id="sitename-<?php echo $val['id'];?>" onmouseover="this.style.backgroundColor='#ff8800';" onmouseout="this.style.backgroundColor='';" onclick="modifyValue('sitenameinput-<?php echo $val['id'];?>');"><?php echo $val['sitename'];?>
	</div>
	<input class="hideinput" id="sitenameinput-<?php echo $val['id'];?>" ondblclick="confirmValue('site',this.value,'sitenameinput-<?php echo $val['id'];?>','id');"/>
	</TD>
	
	<TD>
	<div id="siteapi-<?php echo $val['id'];?>" onmouseover="this.style.backgroundColor='#ff8800';" onmouseout="this.style.backgroundColor='';"><?php echo $val['siteapi']!='http://'?$val['siteapi']:$val['siteurl'];?>
	</div>
    <!-- onclick="modifyValue('siteapiinput-< ? php echo $val['id'];? >');"-->
	<input class="hideinput" id="siteapiinput-<?php echo $val['id'];?>" ondblclick="confirmValue('site',this.value,'siteapiinput-<?php echo $val['id'];?>','id');"/>
	</TD>
	<TD align="center">
<div id="sitetype-<?php echo $val['id'];?>" onmouseover="this.style.backgroundColor='#ff8800';" onmouseout="this.style.backgroundColor='';" onclick="modifyValue('sitetypeinput-<?php echo $val['id'];?>');"><?php echo $val['sitetype']?$GLOBALS['sitecate'][$val['sitetype']]['sitecatename']:'δ����';?>
</div>
<select class="hideinput" id="sitetypeinput-<?php echo $val['id'];?>" onchange="confirmValue('site',this.value,'sitetypeinput-<?php echo $val['id'];?>','id');">
<option value="0">δ����</option>
<?php
$newArray=array();
foreach($GLOBALS['sitecate'] as $k=>$v){
	for($i=0;$i<4;$i++){
		if($v['sitetype']==$i){
			$newArray[$i][]=array('sitecatename'=>$v['sitecatename'],'cid'=>$k);
		}
	}
}
$setting=read('setting');
$sitelogType=$setting['sitelogType'];
$sitecateid=$val['sitetype'];
foreach($sitelogType as $k=>$v){
  echo "<optgroup label='$v'>";
  foreach($newArray[$k] as $key=>$value){	  
?>
    <option value="<?php echo $value['cid'];?>"<?php if($value['cid']==$sitecateid) echo " selected";?>> -- <?php echo $value['sitecatename'];?></option>
<?php
   }
   echo "</optgroup>";
}?>
</select>
</TD>

<td width="70px" align="center">
<div id="recommend-<?php echo $val['id'];?>" onmouseover="this.style.backgroundColor='#ff0000';" onmouseout="this.style.backgroundColor='';" onclick="updateVal('site','recommendinput-<?php echo $val['id'];?>','id','',['�Ƽ�','���Ƽ�']);">
<?php echo $val['recommend']?'�Ƽ�':'���Ƽ�';?>
</div>
<INPUT TYPE="text" class="hideinput" id="recommendinput-<?php echo $val['id'];?>" value="<?php echo intval(!$val['recommend']);?>" title='nochange'>
</td>
<td width="70px" align="center">
<div id="isallowed-<?php echo $val['id'];?>" onmouseover="this.style.backgroundColor='#ff0000';" onmouseout="this.style.backgroundColor='';" onclick="updateVal('site','isallowedinput-<?php echo $val['id'];?>','id','',['����','��ֹ']);">
<?php echo $val['isallowed']?'����':'��ֹ';?>
</div>
<INPUT TYPE="text" class="hideinput" id="isallowedinput-<?php echo $val['id'];?>" value="<?php echo intval(!$val['isallowed']);?>" title='nochange'>
</td>

	<TD width="40px" align="center">
	<div id="sort-<?php echo $val['id'];?>" onmouseover="this.style.backgroundColor='#ff8800';" onmouseout="this.style.backgroundColor='';" onclick="modifyValue('sortinput-<?php echo $val['id'];?>');"><?php echo $val['sort'];?>
	</div>
	<input class="hideinput" id="sortinput-<?php echo $val['id'];?>" ondblclick="confirmValue('site',this.value,'sortinput-<?php echo $val['id'];?>','id');"/>
	</TD>
	<td width="100px" align="center">
	<A HREF="javascript:deleteVal('site','<?php echo $val['id'];?>','site<?php echo $val['id'];?>')">ɾ��</A> <A HREF="javascript:modifysite('<?php echo $val['id'];?>');">�޸�</A>
	</td>
</TR>
<?php }?>
</TABLE>

</div>

<div style="clear:both;"><INPUT TYPE="checkbox" NAME="" onclick="checkallgroup(this)"> <input type="submit" class="normal_button" value="����ɾ��" name="confirmbutton"/> <input type="submit" class="normal_button" value="�����Ƽ�" name="confirmbutton"/> <input type="submit" class="normal_button" value="����ȡ���Ƽ�" name="confirmbutton"/> <input type="submit" class="normal_button" value="��������" name="confirmbutton"/> <input type="submit" class="normal_button" value="������ֹ" name="confirmbutton"/>
</div>
</FORM>
<ul class="page"><?php echo $sitelist['pageinfo'];?></ul>
<SCRIPT LANGUAGE="JavaScript">
<!--
	function fen(page)
	{
		window.location="index.php?con=admin&act=site&page="+page;
	}
//-->
</SCRIPT>

<DIV id="site_area" style="display:none;border:2px solid #ccc;width:500px;position:absolute;left:260px;top:60px;background:#fff;z-index:10px;"></DIV>
</body>
</html>
