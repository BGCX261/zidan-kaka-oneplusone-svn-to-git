<? if(!defined('IN_PHPUP')) exit('Access Denied'); ?>
<!--div class="footer"> <img src="<?=SITE_ROOT?>/views/<?=TPLDIR?>/imgs/di_l.gif" />
  <div class="tuan_list">
    <ul>
 <<? if(is_array($GLOBALS['city'])) { foreach($GLOBALS['city'] as $key => $val) { ?>>--
      <!--li><a href="<? echo url('index','index',array('cityid'=>$key)); ?>" style="text-decoration:none;color:#000;" title="" name="32"><?=$val['cityname']?>团购</a></li>
  <<? } } ?>-->
    <!--/ul>
  </div>
   
    <img src="<?=SITE_ROOT?>/views/<?=TPLDIR?>/imgs/di_r.gif" class="f3"/>
 </div-->
<? if($GLOBALS['link_list']['text']) { ?>
<div class="php_link">
<div class="area">
<ul><? if(is_array($GLOBALS['link_list']['text'])) { foreach($GLOBALS['link_list']['text'] as $k => $v) { ?><li><a href="<?=$v['url']?>" target="_blank"><?=$v['title']?></a></li><? } } ?></ul>
</div>
<div style="clear:both;"></div>
</div>
<? } if($GLOBALS['link_list']['image']) { ?>
<div class="php_link">
<div class="area">
<ul><? if(is_array($GLOBALS['link_list']['image'])) { foreach($GLOBALS['link_list']['image'] as $k => $v) { ?><li>
<a href="<?=$v['url']?>" target="_blank"><img src="<?=$v['thumb']?>" alt="<?=$v['title']?>-<?=$v['dec']?>"/></a></li><? } } ?></ul>
</div>
<div class="clear"></div>
</div>
<? } ?>
<div class="footer_2" align="center" style="border-top:#CCC 1px solid;background:url(<?=SITE_ROOT?>/views/<?=TPLDIR?>/images/main_20.gif) repeat-x">
  <br /><b><a target="_blank" href="<? echo url('index','siteadd'); ?>">网站提交</a>  |  <a target="_blank" href="<? echo url('index','guestbook'); ?>">意见反馈</a>  |  <a target="_blank" href="<? echo url('index','apiinfo'); ?>">团购API测试</a>  |  <a target="_blank" href="<? echo url('admin','index'); ?>">管理登录</a>  | <? if($GLOBALS['setting']['site_tel']) { ?>服务电话：<?=$GLOBALS['setting']['site_tel']?><? } ?></b> <? if($GLOBALS['setting']['site_worktime']) { ?>(<?=$GLOBALS['setting']['site_worktime']?>)<? } ?>
  <br /><? if($GLOBALS['setting']['site_qqq']) { ?>团购交流QQ群：<?=$GLOBALS['setting']['site_qqq']?><? } ?> <? if($GLOBALS['setting']['site_qq']) { ?>客服QQ：<?=$GLOBALS['setting']['site_qq']?><? } ?> <? if($GLOBALS['setting']['site_email']) { ?>E-mail：<a href="mailto:<?=$GLOBALS['setting']['site_email']?>"><?=$GLOBALS['setting']['site_email']?></a><? } ?> <? if($GLOBALS['setting']['site_address']) { ?>地址：<?=$GLOBALS['setting']['site_address']?><? } ?>
  <br /><?=$GLOBALS['setting']['site_copyright']?> <? if($GLOBALS['setting']['site_benai']) { ?><?=$GLOBALS['setting']['site_benai']?><? } ?><?=$GLOBALS['setting']['site_tongji']?>
<div id="phpup_version"><A HREF="http://www.kaka101.com/">Www.KaKa101.Com</A> Powered by KaKa101_zidan v1.1&copy; 2010-2011 One plus One E-commerce Co.,Ltd.</div>
</div>
<div class="footer_2_bottom"></div>
</body>
</html>
