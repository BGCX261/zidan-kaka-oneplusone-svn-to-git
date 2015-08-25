<?php
/*
	[Phpup.Net!] (C)2009-2011 Phpup.net.
	This is NOT a freeware, use is subject to license terms

	$Id: session.class.php 2010-08-24 10:42 $
*/

if(!defined('IN_PHPUP')) {
	exit('Access Denied');
}
$apirep=array(
'zuntu'=>array('最土规则','result-data-teams-team=subject:limengqikey-title,thumb:limengqikey-large_image_url,oldprice:limengqikey-market_price,nowprice:limengqikey-team_price,lasttime:limengqikey-end_date,url:limengqikey-link,cityname:limengqikey-city,nowpeople:limengqikey-current_point,starttime:limengqikey-start_date'),
'fangwei'=>array('方维规则','response-goods=subject:limengqikey-title,cityname:limengqikey-cityname,url:limengqikey-url,nowprice:limengqikey-groupprice,oldprice:limengqikey-marketprice,lasttime:limengqikey-endtime,thumb:limengqikey-bigimg,nowpeople:limengqikey-buycount,starttime:limengqikey-begintime'),
'hao123'=>array('hao123/百度规则','urlset-url=subject:limengqikey-data-display-title,cityname:limengqikey-data-display-city,url:limengqikey-loc,nowprice:limengqikey-data-display-price,oldprice:limengqikey-data-display-value,lasttime:limengqikey-data-display-endTime,thumb:limengqikey-data-display-image,nowpeople:limengqikey-data-display-bought,starttime:limengqikey-data-display-startTime'),
'sohu'=>array('搜狐团规则','response-deals-deal=subject:limengqikey-title,cityname:limengqikey-city_name,url:limengqikey-deal_url,nowprice:limengqikey-price,oldprice:limengqikey-value,lasttime:limengqikey-end_date,thumb:limengqikey-image_url,starttime:limengqikey-StartTime,nowpeople:limengqikey-Bought'),
'meituan'=>array('美团规则','response-deals-deal=subject:limengqikey-title,cityname:limengqikey-division_name,url:limengqikey-deal_url,nowprice:limengqikey-price,oldprice:limengqikey-value,lasttime:limengqikey-end_date,thumb:limengqikey-large_image_url,starttime:limengqikey-start_date,nowpeople:limengqikey-quantity_sold'),);