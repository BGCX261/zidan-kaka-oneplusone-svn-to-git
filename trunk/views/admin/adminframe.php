<?php
if(!defined('IN_PHPUP')) {
	exit('Access Denied');
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<link rel="stylesheet" href="views/admin/css/common.css" type="text/css" />
<title>管理区域</title>
</head>

<body>
<div id="man_zone">
  <table width="99%" border="0" align="center"  cellpadding="3" cellspacing="1" class="table_style">
 
    <tr>
      <td width="18%" class="left_title_1"><span class="left-title">团购总数：</span></td>
      <td width="82%">未审核：<?php echo intval($count['group']['nopassed']);?>　已通过：<?php echo intval($count['group']['ispassed']);?>　已过期：<?php echo intval($count['group']['old']);?>　未过期：<?php echo intval($count['group']['new']);?>　<span class="nav_return"><A HREF="index.php?con=admin&act=group">管理团购</A></span></td>
    </tr>
    <tr>
      <td class="left_title_2">附件总数：</td>
      <td><?php echo $count['filecount'];?>　<span class="nav_return"><A HREF="index.php?con=admin&act=file">管理附件</A></span></td>
    </tr>
    <tr>
      <td class="left_title_1">会员总数：</td>
      <td>网站主：<?php echo intval($count['usercount']['siteuser']);?>　普通会员：<?php echo intval($count['usercount']['normaluser']);?>　<span class="nav_return"><A HREF="index.php?con=admin&act=normaluser">管理会员</A></span></td>
    </tr>
    <tr>
      <td class="left_title_2">网站总数：</td>
      <td>精品团购：<?php echo intval($count['sitecount']['best']);?>　团购名站：<?php echo intval($count['sitecount']['amount']);?>　<span class="nav_return"><A HREF="index.php?con=admin&act=site">管理网站</A></span></td>
    </tr>
   <tr>
      <td class="left_title_1" valign="top">程序简介：</td>
      <td>
	  <DIV ID="" CLASS="">
		技术支持：<A HREF="bbs.iruna.cn" target="_blank">bbs.iruna.cn</A>
	  </DIV>
	  </td>
    </tr>
   <tr>
      <td colspan="2">
	  </td>
   </tr>
  </table>
</div>
</body>
</html>
