<?php
if(!defined('IN_PHPUP')) {
	exit('Access Denied');
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Frameset//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-frameset.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<link rel="stylesheet" href="views/admin/css/common.css" type="text/css" />
<title>KAKA101��̨����ϵͳ</title>
</head>
<frameset rows="50,*" cols="*" frameborder="no" border="0" framespacing="0">
  <frame src="index.php?con=admin&act=top" name="topFrame" frameborder="no" scrolling="No" noresize="noresize" id="topFrame" title="topFrame" />
  <frameset name="myFrame" id="myFrame" cols="199,7,*" frameborder="no" border="0" framespacing="0">
    <frame src="index.php?con=admin&act=left" name="leftFrame" frameborder="no" scrolling="No" noresize="noresize" id="leftFrame" title="leftFrame" />
	<frame src="index.php?con=admin&act=switch" name="midFrame" frameborder="no" scrolling="No" noresize="noresize" id="midFrame" title="midFrame" />
    <frameset rows="59,*" cols="*" frameborder="no" border="0" framespacing="0">
         <frame src="index.php?con=admin&act=main" name="mainFrame" frameborder="no" scrolling="No"  noresize="noresize" id="mainFrame" title="mainFrame" />
         <frame src="index.php?con=admin&act=admin" name="manFrame" frameborder="no" id="manFrame" title="manFrame" />
     </frameset>
  </frameset>
</frameset>
<noframes><body>
</body>
</noframes>
</html>