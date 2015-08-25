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

<div id="man_zone">
   <form enctype="multipart/form-data" action="index.php?con=admin&act=settingdata" method="post">
	<INPUT TYPE="hidden" NAME="commit" value="1">
	<INPUT TYPE="hidden" NAME="dotype" value="group">
  <table width="99%" border="0" align="center"  cellpadding="3" cellspacing="1" class="table_style">
	<tr>
      <td class="left_title_1">团购每页显示个数：</td>
      <td><INPUT TYPE="text" class="normal_txt" name="site_num" VALUE="<?php echo $GLOBALS['setting']['site_num'];?>" >(针对全国信息)
	 </td>
    </tr>
	<tr>
      <td class="left_title_1">是否显示城市：</td>
      <td> <INPUT TYPE="text" class="normal_txt" NAME="site_allow_showcity"  value="<?php echo $GLOBALS['setting']['site_allow_showcity'];?>">(1为开启，0为关闭,为每个商品上显示的城市)</td>
    </tr>
	<tr>
      <td class="left_title_1">是否显示点击次数：</td>
      <td> <INPUT TYPE="text" class="normal_txt" NAME="site_allow_hits"  value="<?php echo $GLOBALS['setting']['site_allow_hits'];?>">(1为开启，0为关闭,为每个商品上显示的点击次数)</td>
    </tr>
	<tr>
      <td class="left_title_1">是否区别显示当前城市信息：</td>
      <td> <INPUT TYPE="text" class="normal_txt" NAME="site_allow_diff_city"  value="<?php echo $GLOBALS['setting']['site_allow_diff_city'];?>">(1为开启，0为关闭,上面为城市,下面为全国)</td>
    </tr>
	<tr>
      <td class="left_title_1">当前城市只显示推荐：</td>
      <td> <INPUT TYPE="text" class="normal_txt" NAME="site_onlyrecommend"  value="<?php echo $GLOBALS['setting']['site_onlyrecommend'];?>">(1为是，0为否,当前选择的城市只显示推荐的商品,区分显示城市开启后有效)</td>
    </tr>
	<tr>
      <td class="left_title_1">当前城市显示数量：</td>
      <td> <INPUT TYPE="text" class="normal_txt" NAME="site_currentcity_num"  value="<?php echo $GLOBALS['setting']['site_currentcity_num'];?>">(一排四个,区分显示城市开启后有效)</td>
    </tr>
	<tr>
      <td class="left_title_1">全国是否包含全部城市：</td>
      <td> <INPUT TYPE="text" class="normal_txt" NAME="site_allow_all"  value="<?php echo $GLOBALS['setting']['site_allow_all'];?>">(1为包含全部城市的信息，0为只包含全国的信息)</td>
    </tr>
	
	<tr>
      <td></td>
      <td><INPUT TYPE="submit" class="normal_button" value="提交"></td>
    </tr>
  </table>
  </FORM>
</div>
</body>
</html>
