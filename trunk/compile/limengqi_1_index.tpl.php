<? if(!defined('IN_PHPUP')) exit('Access Denied'); include template('header', '0', ''); ?>   <!--LOGO�����������䡢�ֻ�����ֵ������������ʼ-->
   <div id="web_search">
      <dd class="search">
         <div class="search_btn">
            <a class="show_red"><h5>�ٶ�</h5></a>
            <a><h5>�ȸ�</h5></a>
            <a><h5>�Ż�</h5></a>
            <a><h5>��Ӧ</h5></a>
            <a><h5>�ѹ�</h5></a>
            <a><h5>����</h5></a>
         </div>
         <div class="search_show">
         <!--������-->
         <form method="GET" name="w_search" id="w_search" onsubmit="return false;">
            <input type="hidden" name="s_web" id="s_web" value="baidu" />
            <div class="search_enter">            
               <ul>
                  <li><div id="s_logo"></div></li>
                  <li style="width:400px"><input name="keyword" class="s_input" type="text" value="�����������ؼ���" onclick="if(this.value=='�����������ؼ���'){this.value=''}" onblur="if(this.value==''){this.value='�����������ؼ���'}" onkeydown="if (event.keyCode==13){$('.s_btn').click();}" /></li>
                  <li style="width:70px"><input type="button" name="s_submit" value="" id="s_btn" class="s_btn" /></li>
               </ul>
            </div>
            <div class="clear"></div>
            <!--����ѡ��-->          
            <div class="s_website" id="s_website_0" value="baidu">
               <h4><input name="baidu_web" type="radio" value="http://www.baidu.com/s?wd=" checked="checked" />��ҳ</h4>
               <h4><input name="baidu_web" type="radio" value="http://news.baidu.com/ns?word=" />����</h4>
               <h4><input name="baidu_web" type="radio" value="http://tieba.baidu.com/f?kw=" />����</h4>
               <h4><input name="baidu_web" type="radio" value="http://zhidao.baidu.com/q?ct=17&amp;pn=0&amp;tn=ikaslist&amp;rn=10&amp;word=" />֪��</h4>
               <h4><input name="baidu_web" type="radio" value="http://mp3.baidu.com/m?tn=baidump3&amp;ct=134217728&amp;lm=-1&amp;word=" />MP3</h4>
               <h4><input name="baidu_web" type="radio" value="http://image.baidu.com/i?tn=baiduimage&amp;ct=201326592&amp;lm=-1&amp;cl=2&amp;word=" />ͼƬ</h4>
               <h4><input name="baidu_web" type="radio" value="http://video.baidu.com/v?rn=20&amp;pn=0&amp;db=0&amp;s=21&amp;word=" />��Ƶ</h4>
            </div>
            <div class="s_website" id="s_website_1" value="google">
               <h4><input name="google_web" type="radio" value="http://www.google.com.hk/search?hl=zh-cn&amp;q=" checked="checked" />��ҳ</h4>
               <h4><input name="google_web" type="radio" value="http://www.google.com.hk/search?tbs=nws:1&amp;source=og&amp;q=" />����</h4>
               <h4><input name="google_web" type="radio" value="http://www.google.cn/products?q=" />����</h4>
               <h4><input name="google_web" type="radio" value="http://www.google.cn/music/search?q=" />����</h4>
               <h4><input name="google_web" type="radio" value="http://images.google.com.hk/images?q=" />ͼƬ</h4>
               <h4><input name="google_web" type="radio" value="http://ditu.google.cn/maps?q=" />��ͼ</h4>
               <h4><input name="google_web" type="radio" value="http://www.google.com.hk/search?tbs=vid%3A1&amp;q=" />��Ƶ</h4>
            </div>
            <div class="s_website" id="s_website_2" value="yahoo">
               <h4><input name="yahoo_web" type="radio" value="http://search.cn.yahoo.com/s?p=" checked="checked" />��ҳ</h4>
               <h4><input name="yahoo_web" type="radio" value="http://news.yahoo.cn/s?q=" />����</h4>
               <h4><input name="yahoo_web" type="radio" value="http://music.yahoo.cn/s?q=" />����</h4>
               <h4><input name="yahoo_web" type="radio" value="http://ks.cn.yahoo.com/search/?keywords=" />֪ʶ��</h4>
               <h4><input name="yahoo_web" type="radio" value="http://search.cn.yahoo.com/s?v=image&amp;p=" />ͼƬ</h4>
               <h4><input name="yahoo_web" type="radio" value="http://list.tmall.com/search_product.htm?user_action=initiative&amp;at_topsearch=1&amp;sort=st&amp;prc=1&amp;q=" />�Ա��̳�</h4>
            </div>
            <div class="s_website" id="s_website_3" value="bing">
               <h4><input name="bing_web" type="radio" value="http://cn.bing.com/search?q=" checked="checked" />��ҳ</h4>
               <h4><input name="bing_web" type="radio" value="http://cn.bing.com/news/search?q=" />����</h4>
               <h4><input name="bing_web" type="radio" value="http://dict.bing.com.cn/?q=" />�ʵ�</h4>
               <h4><input name="bing_web" type="radio" value="http://cn.bing.com/images/search?q=" />ͼƬ</h4>
               <h4><input name="bing_web" type="radio" value="http://cn.bing.com/videos/search?q=" />��Ƶ</h4>
            </div>
            <div class="s_website" id="s_website_4" value="sogou">
               <h4><input name="sogou_web" type="radio" value="http://www.sogou.com/web?query=" checked="checked" />��ҳ</h4>
               <h4><input name="sogou_web" type="radio" value="http://news.sogou.com/news?query=" />����</h4>
               <h4><input name="sogou_web" type="radio" value="http://mp3.sogou.com/music.so?query=" />����</h4>
               <h4><input name="sogou_web" type="radio" value="http://pic.sogou.com/pics?query=" />ͼƬ</h4>
               <h4><input name="sogou_web" type="radio" value="http://v.sogou.com/v?query=" />��Ƶ</h4>
               <h4><input name="sogou_web" type="radio" value="http://wenda.sohu.com/search?query=" />�ʴ�</h4>
            </div>
            <div class="s_website" id="s_website_5" value="soso">
               <h4><input name="soso_web" type="radio" value="http://www.soso.com/q?w=" checked="checked" />��ҳ</h4>
               <h4><input name="soso_web" type="radio" value="http://news.soso.com/n.q?w=" />����</h4>
               <h4><input name="soso_web" type="radio" value="http://cgi.music.soso.com/fcgi-bin/m.q?w=" />����</h4>
               <h4><input name="soso_web" type="radio" value="http://image.soso.com/image.cgi?w=" />ͼƬ</h4>
               <h4><input name="soso_web" type="radio" value="http://video.soso.com/search/?w=" />��Ƶ</h4>
               <h4><input name="soso_web" type="radio" value="http://sobar.soso.com/search/" />�Ѱ�</h4>
               <h4><input name="soso_web" type="radio" value="http://blog.soso.com/qz.q?ty=blog&amp;w=" />����</h4>
            </div>
            </form>
         </div>
      </dd>
      <dd class="search_ad"><img src="<?=SITE_ROOT?>/views/<?=TPLDIR?>/images/main_12.gif" /></dd>
   </div>
   <!--�����������в������濪ʼ-->
   <div class="x_jpge_ad"><script language='javascript' src='<?=SITE_ROOT?>/data/cache/centerAD.js'></script></div>
   <!--�в�����������������л���ʼ-->
   <div id="web_list">
      <!--�����վLOGO�б�-->
      <div class="logo_list">
         <div id="l_menu">
            <div class="l_menu_log">
               <a class="this_up" value="sitelist_0"><h4>���������̳�</h4></a><? $i=1; ?>  <? if(is_array($GLOBALS['sitecate'])) { foreach($GLOBALS['sitecate'] as $k => $v) { ?>              <? if($v['sitetype']==1) { ?> 
               <a class="this_down" value="sitelist_<?=$i?>"><h4><?=$v['sitecatename']?></h4></a>	
                 <? $i++; ?>               
              <? } ?>
  <? } } ?>            </div>
            <div class="l_menu_show" id="sitelist_0">
               <ul>
               <? $n=0; ?>              <? if(is_array($site_top)) { foreach($site_top as $k => $v) { ?>                  <? if(is_array($v)) { foreach($v as $key => $val) { ?>                  <? if($val['ctype']==1) { ?> 
                  <? $n++; ?> 
           		  <li><a href="#" onClick="click_b('<?=$val['siteurl']?>','_blank')"><img src="<?=$val['logo']?>" width="96" height="36" alt="<?=$val['sitename']?>" /> <?=$val['sitename']?></a></li>
                  <? if($n==16) { ?> 
                   <? break; ?> 
                  <? } ?>
                  <? } ?>
                  <? } } ?>              <? } } ?>              </ul>
            </div>
  <? $j=1; ?>  <? if(is_array($GLOBALS['sitecate'])) { foreach($GLOBALS['sitecate'] as $k => $v) { ?>              <? if($v['sitetype']==1) { ?> 
            <div class="l_menu_show" id="sitelist_<?=$j?>" style="display:none;">
               <ul>
              <? if(is_array($site_top[$k])) { foreach($site_top[$k] as $key => $val) { ?>           		  <li><a href="#" onClick="click_b('<?=$val['siteurl']?>','_blank')"><img src="<?=$val['logo']?>" width="96" height="36" alt="<?=$val['sitename']?>" /> <?=$val['sitename']?></a></li>
              <? } } ?>              </ul>
            </div>
              <? $j++; ?>               
              <? } ?>
  <? } } ?>         </div>
      </div>
      <!--��LOGO�б�������������б�ʼ-->
      <div class="fourRight">
          <div id="text_list">
              <ul>
              <? $n=1; ?>              <? $showid=0; ?>              <? Ksort($GLOBALS['sitecate']); ?>  <? if(is_array($GLOBALS['sitecate'])) { foreach($GLOBALS['sitecate'] as $k => $v) { ?>              <? $displayStr=''; ?>              <? if($v['sitetype']==2) { ?>    
              <? if($n==1) { ?>
              <? $showid=$k; ?>              <? $displayStr=" class=\"click_this\""; ?>              <? } ?>    
                 <li<?=$displayStr?> id="s_cate_<?=$k?>"><?=$v['sitecatename']?></li> 
              <? $n++; ?>          
              <? } ?>
  <? } } ?>              </ul>
              <div id="textsite_list">
                <? if(is_array($txtsitelist)) { foreach($txtsitelist as $ky => $vl) { ?>                <? if($vl['sitetype']==$showid) { ?>
                    <span><a href="#" onClick="click_b('<?=$vl['siteurl']?>','_blank')"><?=$vl['sitename']?></a></span>
                <? } ?> 
               <? } } ?>               <span><font color="red">[����]..</font></span>
              </div>
          </div>
          <!--�����б��·����-->
          <div class="right_ad"><img src="<?=SITE_ROOT?>/views/<?=TPLDIR?>/images/r_ad1.jpg" alt="վ���б��·����" border="0" /></div>
      </div>
   </div>
   <div class="clear"></div>
   <!--�Ź��Ƽ��б�ʼ-->
   <div id="duangou" class="RoundedCorner">
     <b class="r_top"><b class="r_1"></b><b class="r_2"></b><b class="r_3"></b></b>
     <div class="t">
       <h2 style="float:left;display:inline">�Ź� �� ������</h2>
       <h6><a href="<? echo url('index','grouplist'); ?>">���������Ź����� &gt;&gt;</a></h6>
       <div class="clear" style="border-bottom:1px solid #CCC"></div>
     </div>
     <div class="t" style="height:370px">
     <!--�����Ƽ�1 ��--><? $n=0; ?>  <? if(is_array($indexgroup)) { foreach($indexgroup as $key => $val) { $n++; ?>  
<? if($n==1) { ?>
<div class="item_shop" style="float:left">
<table>
<tr>
<th colspan="2" align="left" class="tit">
<h1><span><A href="javascript:;" onclick='click_c("<?=$val['id']?>","<?=$val['url']?>","_blank")'>��<?=$val['groupsite']?>��</a></span>|<a href="javascript:;" onclick="click_c('<?=$val['id']?>','<?=$val['url']?>','_blank');" title="<?=$val['subject']?>"><?=$val['shortsubject']?></a></h1>
</th>
</tr>
<tr><td class="image" colspan="2"><a href="#" onclick="click_c('<?=$val['id']?>','<?=$val['url']?>','_blank')">
<div><img src="<?=$val['thumb']?>" alt="<?=$GLOBALS['title']?>-<?=$val['subject']?>" /></div></a></td></tr>
<tr><td class="value">ԭ�ۣ���<b><?=$val['oldprice']?></b></td>
<td class="bought"><img src="<?=SITE_ROOT?>/views/<?=TPLDIR?>/images/tip-heart.gif" />&nbsp;&nbsp;<? if($GLOBALS['setting']['site_allow_hits']) { ?>���<i><span id="hits<?=$val['id']?>"><?=$val['hits']?></span></i>��<? } ?>&nbsp;&nbsp;</td></tr>
<tr><td class="price" colspan="2">
<div>&nbsp;�Ź��ۣ���<b><?=$val['nowprice']?></b></div>
</td></tr>
<tr><td class="rebate" colspan="2">�ۿۣ�<b><?=$val['discount']?></b>��</td></tr>
<tr><td class="downtime" colspan="2"><label id="article_<?=$val['id']?>"></label><input type="hidden" id="hid_article_<?=$val['id']?>" value="<?=$val['lasttime']?>" /></td></tr>
</table>
</div>
<div class="shop_list">
 <ul>
<? } if($n>1) { ?>
   <li>
   <table width="100%" border="0" cellspacing="0" cellpadding="2">
  <tr>
    <td class="tit_list"><div style="height:25px; overflow:hidden;"><span><a href="javascript:;" onclick='click_c("<?=$val['id']?>","<?=$val['url']?>","_blank")'>��<?=$val['groupsite']?>��</a></span>|<a href="javascript:;" onclick="click_c('<?=$val['id']?>','<?=$val['url']?>','_blank');" title="<?=$val['subject']?>"><?=$val['shortsubject']?></a></div></td>
  </tr>
  <tr>
    <td class="img_list"><a href="#" onclick="click_c('<?=$val['id']?>','<?=$val['url']?>','_blank')"><div><img src="<?=$val['thumb']?>" alt="<?=$GLOBALS['title']?>-<?=$val['subject']?>" /></div></a></td>
  </tr>
  <tr>
    <td align="center"><span class="value">ԭ�ۣ���<b><?=$val['oldprice']?></b></span> &nbsp; &nbsp; <span class="red_value">�Ź��ۣ���<b><?=$val['nowprice']?></b></span></td>
  </tr>
</table>
   </li>
<? } } } ?> </ul>
</div>
     </div>
     <div class="clear"></div>
     <b class="r_bottom"><b class="r_3"></b><b class="r_2"></b><b class="r_1"></b></b> 
   </div>
   <!--�Ź��Ƽ��б����-->
<div class="clear"></div>
   <div id="duangou" class="RoundedCorner">
     <b class="r_top"><b class="r_1"></b><b class="r_2"></b><b class="r_3"></b></b>
     <div class="t">
       <h2 style="float:left;display:inline">�Ա��̳� �� ������</h2>
       <h6><a href="<? echo url('index','taobaolist'); ?>">�����Ա��̳���Ʒ���� &gt;&gt;</a></h6>
       <div class="clear" style="border-bottom:1px solid #CCC"></div>
     </div>
     <div class="t" style="height:400px">
        <div id="TaobaoList">
           <ul><? if(is_array($ItemsData['items']['item'])) { foreach($ItemsData['items']['item'] as $tkey => $tval) { ?>              <li>
              <center><a href="javascript:;" onclick="click_c('<?=$tval['num_iid']?>','http://item.taobao.com/item.htm?id=<?=$tval['num_iid']?>','_blank');"><img src="<?=$tval['pic_url']?>" alt="<?=$tval['title']?>" /></a></center>
              <div style="height:35px; overflow:hidden;">
                <a href="javascript:;" onclick="click_c('<?=$tval['num_iid']?>','http://item.taobao.com/item.htm?id=<?=$tval['num_iid']?>','_blank');" title="<?=$tval['title']?>"><?=$tval['title']?></a>
              </div>
              </li><? } } ?>           </ul>
        </div>
     </div>
     <b class="r_bottom"><b class="r_3"></b><b class="r_2"></b><b class="r_1"></b></b> 
   </div>
   
<div class="clear"></div>
   <div id="duangou" class="RoundedCorner">
     <b class="r_top"><b class="r_1"></b><b class="r_2"></b><b class="r_3"></b></b>
     <div class="t">
       <h2 style="float:left;display:inline">�����ȹ� �� ������</h2>
       <h6><a href="<? echo url('index','hotlist'); ?>">���������ȹ���Ʒ���� &gt;&gt;</a></h6>
       <div class="clear" style="border-bottom:1px solid #CCC"></div>
     </div>
     <div class="t" style="height:390px">
        <div id="TaobaoList">
           <ul><? if(is_array($productsindex)) { foreach($productsindex as $pkey => $pval) { ?>              <li>
              <center><a href="javascript:;" onclick="click_c('<?=$pval['pid']?>','<?=$pval['link_url']?>}','_blank');"><img src="<?=$pval['pic_url']?>" alt="<?=$pval['title']?>" /></a></center>
              <div style="height:30px; margin-top:5px; overflow:hidden;">
                <a href="javascript:;" onclick="click_c('<?=$pval['pid']?>','<?=$pval['link_url']?>}','_blank');"><center><?=$pval['title']?></center></a>
              </div>
              </li><? } } ?>           </ul>
        </div>
     </div>
     <b class="r_bottom"><b class="r_3"></b><b class="r_2"></b><b class="r_1"></b></b> 
   </div>
</div>
<!--��ҳ���ݽ���--><? include template('footer', '0', ''); ?>