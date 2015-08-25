<? if(!defined('IN_PHPUP')) exit('Access Denied'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?=$GLOBALS['charset']?>" />
<meta name="description" content="<?=$GLOBALS['setting_seo_description']?>" />
<meta content="<?=$GLOBALS['setting_seo_keyword']?>" name="keywords"/>
<title>用户登录页面</title>
<link rel="stylesheet" type="text/css" href="<?=SITE_ROOT?>/views/<?=TPLDIR?>/css/login.css" />
</head>
<body>
<div class="body">
<div id="logo"><a href="<?=SITE_ROOT?>" title="<?=$GLOBALS['title']?><?=$GLOBALS['seo_title']?>"><img src="<?=SITE_ROOT?>/<?=$GLOBALS['setting']['site_logo']?>" alt="<?=$GLOBALS['title']?><?=$GLOBALS['seo_title']?>"/></a></div>
  <div class="login_top"> 您好，欢迎来到<?=$GLOBALS['title']?><?=$GLOBALS['seo_title']?> </div>
  <div class="login">
    <ul class="login_top_2">

      <li><a href="<? echo url('user','login'); ?>">用户登陆入口</a></li>
      <li><a href="<? echo url('user','register'); ?>">用户注册入口</a></li>
    </ul>
    <div class="login_box">
      <form action="<? echo url('user','login'); ?>" method="post" name="index_login">
  <input name="commit" type="hidden" value="1" />
   <input name="referer" type="hidden" value="<?=$referer?>" />
  
        <div class="login_box_line"><span><b>用户账号：</b></span>
          <div class="login_input_1">

            <input name="user_name" type="text" />
          </div>
        </div>
        <div class="login_box_line"><span><b>登录密码：</b></span>
          <div class="login_input_1">
            <input name="pwd" type="password" />
          </div>
        </div>

        <div class="login_input_2">
          <input type="submit" value="" />
          <a href="<? echo url('user','forget'); ?>">忘记密码？</a></div>
      </form>
      <div class="hr"></div>
      <div class="tishi"> <b>温馨提示：</b>用户账号就是您注册时的E-mail！ </div>
    </div>

    <div class="login_bottom_2"></div>
  </div>
  <div class="attr" style="width:300px">
    <p><b>购物导航第一品牌：我们共同的选择卡卡101！</b></p>
    <p>汇聚您所能想到的最低折扣精品消费</p>
    <p>很久没有人能把钱省得这么清新脱俗啦~</p>
  </div>

  <div class="footer">
   <p><b><a target="_blank" href="<? echo url('index','siteadd'); ?>">网站提交</a> | <a target="_blank" href="<? echo url('index','guestbook'); ?>">意见反馈</a> |<a target="_blank" href="<? echo url('index','apiinfo'); ?>">团购API征集</a> | <? if($GLOBALS['setting']['site_tel']) { ?>服务电话：<?=$GLOBALS['setting']['site_tel']?><? } ?></b> <? if($GLOBALS['setting']['site_worktime']) { ?>(<?=$GLOBALS['setting']['site_worktime']?>)<? } ?></p>
  <p><? if($GLOBALS['setting']['site_qqq']) { ?>团购交流QQ群：<?=$GLOBALS['setting']['site_qqq']?><? } ?> <? if($GLOBALS['setting']['site_qq']) { ?>客服QQ：<?=$GLOBALS['setting']['site_qq']?><? } ?> <? if($GLOBALS['setting']['site_email']) { ?>E-mail：<a href="mailto:<?=$GLOBALS['setting']['site_email']?>"><?=$GLOBALS['setting']['site_email']?></a><? } ?> <? if($GLOBALS['setting']['site_address']) { ?>地址：<?=$GLOBALS['setting']['site_address']?><? } ?></p>
  <p><?=$GLOBALS['setting']['site_copyright']?> <? if($GLOBALS['setting']['site_benai']) { ?><?=$GLOBALS['setting']['site_benai']?><? } ?><?=$GLOBALS['setting']['site_tongji']?>
</p>
  </div>
</div>
</body>
</html>
