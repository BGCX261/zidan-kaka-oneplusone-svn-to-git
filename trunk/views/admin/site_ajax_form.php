<iframe src="" name="sitemodify" style="display:none"></iframe>
<FORM METHOD="POST" enctype="multipart/form-data" ACTION="index.php?con=admin&act=sitemodify" target="sitemodify">
<INPUT TYPE="hidden" NAME="updateid" value="<?php echo $site['id'];?>">
<?php


if(!defined('IN_PHPUP')) {
	exit('Access Denied');
}
?>
<INPUT TYPE="hidden" NAME="commit" value="1">
<table width="500px" border="0" align="center"  cellpadding="3" cellspacing="1" class="table_style">
<tr>
<td width="90px" class="left_title_1"><span class="left-title">网站名：</span></td>
<td><INPUT TYPE="text" class="normal_txt" NAME="sitename"  value="<?php echo $site['sitename'];?>"></td>
</tr>
<tr>
<td width="90px" class="left_title_1"></td>
<td>字体颜色：<SELECT NAME="css[color]">
<OPTION VALUE="">选择颜色</option>
	<OPTION VALUE="#ff0000" style="background:#ff0000;">#ff0000</option>
	<OPTION VALUE="#339900" style="background:#339900;">#339900</option>
	<OPTION VALUE="#3300FF" style="background:#3300FF;">#3300FF</option>
	<OPTION VALUE="#990000" style="background:#990000;">#990000</option>
	<OPTION VALUE="#FFFF00" style="background:#FFFF00;">#FFFF00</option>
	<OPTION VALUE="#FF9900" style="background:#FF9900;">#FF9900</option>
	<OPTION VALUE="#660000" style="background:#660000;">#660000</option>
</SELECT>
<input type="checkbox" name="css[font-weight]" value="bold">加粗</td>
</tr>


<tr>
<td width="90px" class="left_title_1"><span class="left-title">所属地区：</span></td>
<td>
<SELECT NAME="sitecity">
	<?php if($site['cityid']){?><option  value="<?php echo $site['cityid'];?>"><?php echo $GLOBALS['city'][$site['cityid']]['cityname'];?></option><?php }?>
	<?php foreach($GLOBALS['city'] as $k=>$v){?>
	<option value="<?php echo $k;?>"><?php echo $v['cityname'];?></option>
	<?php }?>
</SELECT>
</td>
</tr>
<tr>
<td width="90px" class="left_title_1"><span class="left-title">所属类别：</span></td>
<td>
<SELECT NAME="sitetype">
<option value="0">未分类</option>
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
$sitecateid=$site['sitetype'];
foreach($sitelogType as $k=>$v){
  echo "<optgroup label='$v'>";
  foreach($newArray[$k] as $key=>$value){	  
?>
    <option value="<?php echo $value['cid'];?>"<?php if($value['cid']==$sitecateid) echo " selected";?>> -- <?php echo $value['sitecatename'];?></option>
<?php
   }
   echo "</optgroup>";
}?>
</SELECT>
</td>
</tr>
	<tr>
      <td class="left_title_1">缩略图：</td>
      <td><INPUT TYPE="file" NAME="thumb_logo"> <?php if(!empty($site['logo'])){?><img onclick="window.open(this.src,'','');" src="<?php echo $site['logo'];?>" width='100px'/><?php }?></td>
    </tr>
<tr>
<td width="90px" class="left_title_1"><span class="left-title">网站地址：</span></td>
<td><INPUT TYPE="text" class="normal_txt" NAME="siteurl" size="40" value="<?php echo $site['siteurl'];?>"></td>
</tr>
<tr>
<td width="90px" class="left_title_1"><span class="left-title">商品API地址：</span></td>
<td><INPUT TYPE="text" class="normal_txt" NAME="siteapi" size="40" value="<?php echo $site['siteapi'];?>"></td>
</tr>
<?php if($GLOBALS['setting']['site_allow_city']){?>
<tr>
<td width="90px" class="left_title_1"><span class="left-title">城市API地址：</span></td>
<td><INPUT TYPE="text" class="normal_txt" NAME="cityapi" size="40" value="<?php echo $site['cityapi'];?>"></td>
</tr>
<tr>
<td width="90px" class="left_title_1"><span class="left-title">城市API规则：</span></td>
<td><textarea  NAME="cityrep" id="cityrep" class="normal_txta"><?php echo $site['cityrep'];?></textarea></td>
</tr>
<?php }?>
<tr>
<td width="90px" class="left_title_1"><span class="left-title">API类型：</span></td>
<td>
<SCRIPT LANGUAGE="JavaScript">
<!--
	var data=new Array();
	data[0]='';
	<?php foreach($GLOBALS['apirep'] as $k=>$v){?>
	<?php echo "data['".$k."']='".$v[1]."';\n";?>
	<?php }?>
	function changerep(id)
	{
		if(id!='')
		{
			document.getElementById('apirep').value=data[id];
		}
		else
		{
			document.getElementById('apirep').value='';
		}
	}
//-->
</SCRIPT>
<SELECT onchange="changerep(this.value);">
	<OPTION VALUE="" SELECTED>自定义</option>
	<?php foreach($GLOBALS['apirep'] as $k=>$v){?>
	<OPTION VALUE="<?php echo $k;?>"><?php echo $v[0];?></option>
	<?php }?>
</SELECT>
</td>
</tr>
<tr>
<td width="90px" class="left_title_1"><span class="left-title">API规则：</span></td>
<td><textarea  NAME="apirep" id="apirep" class="normal_txta"><?php echo $site['apirep'];?></textarea></td>
</tr>
<tr>
<td colspan="2" align="center"><INPUT TYPE="submit" value="提交" class="normal_button"> <INPUT TYPE="button" value="关闭" class="normal_button" onclick="$('#site_area').hide();"></td>
</tr>
</table>
</FORM>