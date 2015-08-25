<? if(!defined('IN_PHPUP')) exit('Access Denied'); ?>
                <? if(is_array($txtsitelist)) { foreach($txtsitelist as $k => $v) { ?>                <? if($v['sitetype']==$showid) { ?>
                    <span><a href="javascript:click_b('<?=$v['siteurl']?>','_blank')"><?=$v['sitename']?></a></span>
                <? } ?>
               <? } } ?>               <span><font color="red">[¸ü¶à]..</font></span>