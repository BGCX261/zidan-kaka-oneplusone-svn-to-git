<? if(!defined('IN_PHPUP')) exit('Access Denied'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?=$GLOBALS['charset']?>" />
<meta name="description" content="<?=$GLOBALS['setting']['seo_description']?>" />
<meta content="<?=$GLOBALS['setting']['seo_keyword']?>" name="keywords"/>
<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
<title><? echo $GLOBALS['session']->get('cityid')?$GLOBALS['city'][$GLOBALS['session']->get('cityid')]['cityname']:''; ?> 最专业的购物导航网站 <?=$GLOBALS['title']?> <?=$GLOBALS['seo_title']?> -Power By <?=VERSION?></title>
<script src="<?=SITE_ROOT?>/views/js/jquery.js" type="text/javascript"></script>
<script src="<?=SITE_ROOT?>/views/<?=TPLDIR?>/js/index.js" type="text/javascript"></script>
<script src="<?=SITE_ROOT?>/views/js/common.js" type="text/javascript"></script>
<script src="<?=SITE_ROOT?>/views/<?=TPLDIR?>/js/ajax.js" type="text/javascript"></script>
<link rel="stylesheet" href="<?=SITE_ROOT?>/views/<?=TPLDIR?>/css/index2.css" type="text/css" />
<link href="<?=SITE_ROOT?>/views/<?=TPLDIR?>/css/ceng.css" rel="stylesheet"  type="text/css" />
<link href="<?=SITE_ROOT?>/views/<?=TPLDIR?>/style/main.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div id="BodyContent">
<!--网页内容开始-->
   <div class="top_red_bg">
      <dd style="margin-top:10px; float:left">欢迎访问卡卡101购物导航！ <? if($GLOBALS['session']->get('uid')){ ?><!--a target="_blank" href="<? echo url('user','index'); ?>">用户中心</a>
<a href="<? echo url('user','logout'); ?>">安全退出</a--><? } else{ ?><!--a target="_blank" href="<? echo url('user','register'); ?>">免费注册</a>
<a target="_blank" href="<? echo url('user','login'); ?>">登录网购</a--><? } ?>      </dd>
      <dd style="margin-top:10px; float:right">·<a href="javascript:" style="margin-left: 5px;" id="add_index">设为首页</a> ·<a href="javascript:AddFavorite('http://www.kaka101.com','卡卡101购物导航')">加入收藏</a> ·<a href="https://www.alipay.com/" target="_blank">支付宝</a> ·帮助中心</dd>
   </div>
   <!--头部横幅广告开始-->
   <div class="x_jpge_ad"><script language='javascript' src='<?=SITE_ROOT?>/data/cache/headtop.js'></script></div>
   <!--头部横幅广告结束,LOGO、天气、邮箱、手机、充值开始-->
   <div id="logo_email">
      <ul>
         <li class="logo"><a href="<?=SITE_ROOT?>"><img src="<?=SITE_ROOT?>/views/<?=TPLDIR?>/images/main_07.gif" border="0" width="229" height="80" alt="卡卡101购物导航" /></a></li>
         <li class="weather">
<table width="364" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="16%" align="center" style="padding-top:8px"><h3>宁波</h3><div class="qiehuan_city" style="cursor:pointer">设置</div><div><a style="color:#666; text-decoration:none" href="http://www.weather.com.cn" target="_blank">更多</a></div></td>
    <td width="28%" align="center"><? echo $weatherRow["jtitle"] ?></td>
    <td width="28%" align="center"><? echo $weatherRow["mtitle"] ?></td>
    <td width="28%" align="center"><? echo $weatherRow["htitle"] ?></td>
  </tr>
</table>
</li>
         <!--邮箱登录-->
<form method="get" target="_blank" name="so_99sumail" action='http://so.99su.com/maillogin.php' onsubmit="mails(this)">
         <li class="email_login">
           <div>账号：<input name="user" type="text" style="width:116px" /></div>
           <div>邮箱：<select tabIndex="2" size="1" name="mailwww" style="width:116px"> <option selected>请选择您的邮局</option> <option value="https://ssl.eyou.com/mail_login.php|-|LoginName|-|Password">@eyou.com</option>  <option value="https://www.google.com/accounts/ServiceLoginAuth|-|Email|-|Passwd:o:continue=http://mail.google.com/mail/?ui=html&zy=l|-|service=mail|-|rm=false|-|ltmpl=yj_blanc">@Gmail.com</option>
 <option value="http://mail.sina.com.cn/cgi-bin/login.cgi|-|u|-|psw">@sina.com</option> <option value="http://m113.56.com/mail/mail.56|-|username|-|password">@56.com</option> <option value="http://vip.sina.com/cgi-bin/login.cgi|-|user|-|pass">@vip.sina.com</option> <option value="http://bjweb.163.net/cgi/163/login_pro.cgi|-|user|-|pass">@163.net</option> <option value="http://bjweb.163.net/cgi/163/login_pro.cgi|-|user|-|pass">@Tom.com</option> <option value="http://webmail.21cn.com/NULL/NULL/NULL/NULL/NULL/SignIn.gen|-|LoginName|-|passwd">@21cn.com</option> <option value="http://freemail.263.net/cgi/login|-|user|-|pass">@263.net</option> <option value="http://reg4.163.com/in.jsp?url=http://reg4.163.com/EnterEmail.jsp?username=window.document.mailForm.name.value|-|username|-|password">@163.com</option> <option value="http://vip.163.com/payment/VipLogon.jsp|-|username|-|password">@vip.163.com</option> <option value="http://web.netease.com/cgi/login|-|user|-|pass">@netease.com</option> <option value="http://web.yeah.net/cgi/login|-|user|-|pass">@Yeah.net</option> <option value="http://freemail.china.com/extend/gb/NULL/NULL/NULL/SignIn.gen|-|LoginName|-|passwd">@mail.china.com</option> <option value="http://paymail.china.com/extend/gb/NULL/NULL/NULL/SignIn.gen|-|LoginName|-|passwd">@china.com</option> <option value="http://login.mail.sohu.com/chkpwd.php|-|UserName|-|Password">@sohu.com</option> <option value="http://www.citiz.net/login.jsp.jsp|-|username|-|password">@citiz.net</option> <option value="http://mw1.elong.com/cgi-bin/weblogon.cgi|-|username|-|password">@elong.com</option> <option value="http://mail.fm365.com/cgi-bin/legend/wmaila|-|username|-|password">@FM365.com</option> <option value="http://edit.bjs.yahoo.com/config/login|-|login|-|passwd">@yahoo.com.cn</option> <option value="http://mail.2911.net/cgi-bin/mail/main.pl|-|USERNAME|-|PASSWORD">@2911.net</option> <option value="http://login.etang.com/servlet/login|-|login_name|-|login_password|-|hidden|-|BackURL|-|http://mail.etang.com/cgi/door">@etang.com</option> <option value="http://webmail.21cn.net/nature/gb/NULL/NULL/NULL/SignIn.gen|-|LoginName|-|passwd|-|:o:hidden|-|DomainName|-|21cn.net">@21cn.net</option> <option value="http://login.chinaren.com/zhs/servlet/Login|-|username|-|password|-|(o)hidden|-|url|-|http://mail.chinaren.com">@ChinaRen.com</option> <option value="http://202.106.186.230/extend/newgb1/NULL/NULL/NULL/SignIn.gen|-|LoginName|-|passwd|-|:o:hidden|-|DomainName=email.com.cn">@email.com.cn</option> <option value="https://login.passport.com/ppsecure/post.srf?da=passport.com&amp;svc=mail|-|login|-|passwd|-|:o:suffix=hotmail.com">@hotmail.com</option> <option value="https://login.passport.com/ppsecure/post.srf?da=passport.com&amp;svc=mail|-|login|-|passwd:o:me=zz.com|-|suffix=msn.com">@msn.com</option></select></div>
           <div style="float:left;padding-top:5px">密码：</div><input name="passwd" type="text" style="width:85px; float:left" /><input type="submit" class="red_btn" style="border:none" value="登入" />
         </li></form>
<script language="javascript">function mails(form){var tmp=form.user.value;if(!tmp){alert("帐号不能为空!");return false;}var tmp2=form.passwd.value;if(!tmp2){alert("密码不能为空!");return false;}var tmp3=form.mailwww.value;if(!tmp3){alert("您没有选择信箱!");return false;}return true;}</script>
         <!--手机充值-->
         <li class="mobile_pay"><!--待添加充值API--><li>
      </ul>
   </div>
  <div id="ceng1">
    <ul id="ul">
      <? if(is_array($cityWeather)) { foreach($cityWeather as $k => $v) { ?>  <li><a href="?areaid=<?=$v['id']?>" title="<?=$v['name']?>" name="<?=$k?>"><?=$v['name']?></a></li>
  <? } } ?>    </ul>
  </div>