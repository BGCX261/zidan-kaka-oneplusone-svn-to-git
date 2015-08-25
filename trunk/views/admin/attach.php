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
function addsite()
{
	url="index.php?con=admin&act=sitemodify";
	$.get(url, function(data){
		$('#site_area').html(data);
		$('#site_area').show();
	}); 
}
	function modifysite()
{
	var id=$("#siteid").val();
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
		var obj=document.getElementById('siteid');
		var len=obj.options.length;
		for(i=0;i<len;i++)
		{
			temval=obj.options[i].value.split('-');
			if(objdata.id==temval[0])
			{
				obj.options[i].value=objdata.id;
				obj.options[i].text=objdata.pinyin+':'+objdata.sitename;
				obj.options[i].selected=true;
				$('#site_area').hide();
				return;
			}
			
		}
	}
	else
	{
		$('#siteid').prepend('<option value="'+objdata.id+'-'+objdata.sitename+'">'+objdata.pinyin+':'+objdata.sitename+'</option>');
		document.getElementById('siteid').options.selectedIndex=0;
	}
	$('#site_area').hide();
}
function warninfo()
{
	alert('开始操作，请耐心等待.....，可先关闭此提示框哦！');
}
//-->
</SCRIPT>

<div style="clear:both;"></div>
<FORM METHOD="GET" ACTION="index.php">
<INPUT TYPE="hidden" NAME="con" value="admin"><INPUT TYPE="hidden" NAME="act" value="doattach">
	网站：<select name="siteid" id="siteid">
		<?php foreach($GLOBALS['site'] as $key=>$val){
		if($val['isallowed']){
		?>
		<option value="<?php echo $val['id'];?>"><?php echo $val['pinyin'];?>:<?php echo $val['sitename'];?></option>
		<?php }
		}?></select><INPUT TYPE="button" VALUE="修改" ONCLICK="modifysite();" class="normal_button"> <INPUT TYPE="button" VALUE="添加" ONCLICK="addsite();" class="normal_button">　从此处开始批量<SELECT NAME="attach">
		<OPTION VALUE="0" SELECTED>否
		<OPTION VALUE="1">是
	</SELECT><INPUT TYPE="hidden" NAME="commit" value="1"><INPUT TYPE="submit" class='normal_button' value='采集'>
</FORM>
<div class="list">
<iframe src="" style="display:none;" name="myattach"></iframe>
<FORM METHOD="POST" ACTION="index.php?con=admin&act=inserttempsite" target="myattach" onsubmit="warninfo();">
	<TABLE cellpadding="1" cellspacing="1" id="sitearea">
<TR>
	<TH></TH>
	<TH>标题</TH>
	<TH width="100px">地址</TH>
	<TH>网站</TH>
	<TH>当前人数</TH>
	<TH>城市</TH>
	<TH>结束时间</TH>
	<TH>操作</TH>
</TR>
<?php foreach($tempsite['data'] as $key=>$val){?>
<TR class="tr1" id="tempsite<?php echo $val['id'];?>">
	<TD width="10px"><INPUT TYPE="checkbox" NAME="tempid[]" class="mytemp" value="<?php echo $val['id'];?>"></td>
	<TD width="200px">
	<div id="subject-<?php echo $val['id'];?>" onmouseover="this.style.backgroundColor='#ff8800';" onmouseout="this.style.backgroundColor='';" onclick="modifyValue('subjectinput-<?php echo $val['id'];?>');"><?php echo $val['subject'];?>
	</div>
	<input class="hideinput" id="subjectinput-<?php echo $val['id'];?>" ondblclick="confirmValue('tempsite',this.value,'subjectinput-<?php echo $val['id'];?>','id');"/>
	</TD>
	<TD width="100px">
	<div id="url-<?php echo $val['id'];?>" onmouseover="this.style.backgroundColor='#ff8800';" onmouseout="this.style.backgroundColor='';" onclick="modifyValue('urlinput-<?php echo $val['id'];?>');"><?php echo $val['url'];?>
	</div>
	<input class="hideinput" id="urlinput-<?php echo $val['id'];?>" ondblclick="confirmValue('tempsite',this.value,'urlinput-<?php echo $val['id'];?>','id');"/>
	</TD>
	
	
	<TD width="40px" align="center">
	<?php echo $val['groupsite'];?>
	</TD>
	

	<TD>
	<div id="nowpeople-<?php echo $val['id'];?>" onmouseover="this.style.backgroundColor='#ff8800';" onmouseout="this.style.backgroundColor='';" onclick="modifyValue('nowpeopleinput-<?php echo $val['id'];?>');"><?php echo $val['nowpeople'];?>
	</div>
	<input class="hideinput" id="nowpeopleinput-<?php echo $val['id'];?>" ondblclick="confirmValue('tempsite',this.value,'nowpeopleinput-<?php echo $val['id'];?>','id');"/>
	</TD>
	<TD width="60px" align="center"><div id="cityname-<?php echo $val['id'];?>" onmouseover="this.style.backgroundColor='#ff8800';" onmouseout="this.style.backgroundColor='';" onclick="modifyValue('citynameinput-<?php echo $val['id'];?>');"><?php echo $val['cityname'];?>
	</div>
	
	<select class="hideinput" id="citynameinput-<?php echo $val['id'];?>" onchange="confirmValue('groups',this.value,'citynameinput-<?php echo $val['id'];?>','id');">
	<option value="全国">全国</option>
	<?php foreach($GLOBALS['city'] as $k=>$v){?>
<option value="<?php echo $v;?>"><?php echo $v['cityname'];?></option>
<?php }?>
</select>
	
	</TD>
	<TD width="40px" align="center">
	<div id="lasttime-<?php echo $val['id'];?>" onmouseover="this.style.backgroundColor='#ff8800';" onmouseout="this.style.backgroundColor='';" onclick="modifyValue('lasttimeinput-<?php echo $val['id'];?>');"><?php echo $val['lasttime'];?>
	</div>
	<input class="hideinput" id="lasttimeinput-<?php echo $val['id'];?>" ondblclick="confirmValue('tempsite',this.value,'lasttimeinput-<?php echo $val['id'];?>','id');"/>
	</TD>
	<td width="100px" align="center">
	<A HREF="javascript:deleteVal('tempsite','<?php echo $val['id'];?>','tempsite<?php echo $val['id'];?>')">删除</A>
	</td>
</TR>
<?php }?>

</TABLE>
<SCRIPT LANGUAGE="JavaScript">
<!--
	function checkboxall(obj)
	{
		if($(obj).attr('checked')==true)
		{
			$('.mytemp').attr('checked',true);
		}
		else
		{
			$('.mytemp').attr('checked',false);
		}
	}
//-->
</SCRIPT>
<div><INPUT TYPE="checkbox" NAME="" id="checkall" onclick="checkboxall(this)">全选
<INPUT TYPE="submit" value="批量入库" class="normal_button" id="attachbutton" name="dosubmit">
<INPUT TYPE="submit" value="全部入库" class="normal_button" name="dosubmit"  id="attachbuttonall">
<INPUT TYPE="submit" value="批量删除"  name="dosubmit" class="normal_button">
<INPUT TYPE="submit" value="全部删除"  name="dosubmit" class="normal_button"></div>
</FORM>

</div>
<ul class="page"><?php echo $tempsite['pageinfo'];?></ul>
<DIV id="site_area" style="display:none;border:2px solid #ccc;width:500px;position:absolute;left:230px;top:60px;background:#fff;z-index:10px;"></DIV>
</body>
</html>
