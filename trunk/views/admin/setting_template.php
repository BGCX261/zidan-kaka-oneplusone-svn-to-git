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
<title>团购管理</title>
</head>
<body>

<FORM METHOD="POST" ACTION="index.php?con=admin&act=settingdata">
<div id="man_zone">
<TABLE  style="background:none;">
<TR style="width:33%px;">
<?php foreach($tpldir as $k=>$v){?>
<td style="padding:10px;"><table cellspacing="0" cellpadding="0" style="margin-left: 10px; width: 200px;"><tbody><tr><td style="width: 120px;border-top: medium none;">
<p style="margin-bottom: 2px;"><img alt="预览" src="<?php echo $v['thumb'];?>" onclick="window.open('index.php?tplview=<?php echo $v['tplname'];?>','_blank','');"></p>
<input type="text" style="margin-right: 0pt; width:100px;" size="30" value="<?php echo $v['info'];?>"  class="txt"></td>
<td style="padding-left: 17px; width: 80px; border-top: medium none; vertical-align: top;">
<label>默认 <input type="radio" value="<?php echo $v['tplname'];?>" name="site_template_dir" class="radio" <?php echo TPLDIR==$v['tplname']?'checked':'';?>></label><br/>
<?php echo $v['desc'];?>
</td></tr></tbody></table></td>
<?php if(($k+1)%3==0){?></tr><tr><?php }?>
<?php }?>
</TR>
</TABLE>
<DIV ID="" CLASS="" style="padding-left:20px;">
	<INPUT TYPE="hidden" NAME="dotype" value="template">
	<INPUT TYPE="hidden" NAME="commit" value="1">
	<INPUT TYPE="submit" class="normal_button" value="提交">
</DIV>
</div>

</FORM>
</body>
</html>
