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
<title>显示/隐藏左侧导航栏</title>
</head>
<script language="JavaScript">
function Submit_onclick(){
	var myframe=parent.document.getElementById('myFrame');
	if(myframe.cols == "199,7,*") {
		myframe.cols="0,7,*";
		document.getElementById("ImgArrow").src="views/admin/images/switch_right.gif";
		document.getElementById("ImgArrow").alt="打开左侧导航栏";
	} else {
		myframe.cols="199,7,*";
		document.getElementById("ImgArrow").src="views/admin/images/switch_left.gif";
		document.getElementById("ImgArrow").alt="隐藏左侧导航栏";
	}
}

function MyLoad() {
	if(window.parent.location.href.indexOf("MainUrl")>0) {
		window.top.midFrame.document.getElementById("ImgArrow").src="views/admin/images/switch_right.gif";
	}
}
</script>
<body onload="MyLoad()">
<div id="switchpic"><a href="javascript:Submit_onclick()"><img src="views/admin/images/switch_left.gif" alt="隐藏左侧导航栏" id="ImgArrow" /></a></div>
</body>
</html>
