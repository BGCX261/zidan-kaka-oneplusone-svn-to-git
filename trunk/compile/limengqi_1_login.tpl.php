<? if(!defined('IN_PHPUP')) exit('Access Denied'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?=$GLOBALS['charset']?>" />
<meta name="description" content="<?=$GLOBALS['setting_seo_description']?>" />
<meta content="<?=$GLOBALS['setting_seo_keyword']?>" name="keywords"/>
<title>�û���¼ҳ��</title>
<link rel="stylesheet" type="text/css" href="<?=SITE_ROOT?>/views/<?=TPLDIR?>/css/login.css" />
</head>
<body>
<div class="body">
<div id="logo"><a href="<?=SITE_ROOT?>" title="<?=$GLOBALS['title']?><?=$GLOBALS['seo_title']?>"><img src="<?=SITE_ROOT?>/<?=$GLOBALS['setting']['site_logo']?>" alt="<?=$GLOBALS['title']?><?=$GLOBALS['seo_title']?>"/></a></div>
  <div class="login_top"> ���ã���ӭ����<?=$GLOBALS['title']?><?=$GLOBALS['seo_title']?> </div>
  <div class="login">
    <ul class="login_top_2">

      <li><a href="<? echo url('user','login'); ?>">�û���½���</a></li>
      <li><a href="<? echo url('user','register'); ?>">�û�ע�����</a></li>
    </ul>
    <div class="login_box">
      <form action="<? echo url('user','login'); ?>" method="post" name="index_login">
  <input name="commit" type="hidden" value="1" />
   <input name="referer" type="hidden" value="<?=$referer?>" />
  
        <div class="login_box_line"><span><b>�û��˺ţ�</b></span>
          <div class="login_input_1">

            <input name="user_name" type="text" />
          </div>
        </div>
        <div class="login_box_line"><span><b>��¼���룺</b></span>
          <div class="login_input_1">
            <input name="pwd" type="password" />
          </div>
        </div>

        <div class="login_input_2">
          <input type="submit" value="" />
          <a href="<? echo url('user','forget'); ?>">�������룿</a></div>
      </form>
      <div class="hr"></div>
      <div class="tishi"> <b>��ܰ��ʾ��</b>�û��˺ž�����ע��ʱ��E-mail�� </div>
    </div>

    <div class="login_bottom_2"></div>
  </div>
  <div class="attr" style="width:300px">
    <p><b>���ﵼ����һƷ�ƣ����ǹ�ͬ��ѡ�񿨿�101��</b></p>
    <p>����������뵽������ۿ۾�Ʒ����</p>
    <p>�ܾ�û�����ܰ�Ǯʡ����ô����������~</p>
  </div>

  <div class="footer">
   <p><b><a target="_blank" href="<? echo url('index','siteadd'); ?>">��վ�ύ</a> | <a target="_blank" href="<? echo url('index','guestbook'); ?>">�������</a> |<a target="_blank" href="<? echo url('index','apiinfo'); ?>">�Ź�API����</a> | <? if($GLOBALS['setting']['site_tel']) { ?>����绰��<?=$GLOBALS['setting']['site_tel']?><? } ?></b> <? if($GLOBALS['setting']['site_worktime']) { ?>(<?=$GLOBALS['setting']['site_worktime']?>)<? } ?></p>
  <p><? if($GLOBALS['setting']['site_qqq']) { ?>�Ź�����QQȺ��<?=$GLOBALS['setting']['site_qqq']?><? } ?> <? if($GLOBALS['setting']['site_qq']) { ?>�ͷ�QQ��<?=$GLOBALS['setting']['site_qq']?><? } ?> <? if($GLOBALS['setting']['site_email']) { ?>E-mail��<a href="mailto:<?=$GLOBALS['setting']['site_email']?>"><?=$GLOBALS['setting']['site_email']?></a><? } ?> <? if($GLOBALS['setting']['site_address']) { ?>��ַ��<?=$GLOBALS['setting']['site_address']?><? } ?></p>
  <p><?=$GLOBALS['setting']['site_copyright']?> <? if($GLOBALS['setting']['site_benai']) { ?><?=$GLOBALS['setting']['site_benai']?><? } ?><?=$GLOBALS['setting']['site_tongji']?>
</p>
  </div>
</div>
</body>
</html>
