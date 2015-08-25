<?php
session_start();
error_reporting(1);
define('ROOT_PATH',str_replace('\\','/',substr(dirname(__FILE__),0,-3)));
define('IN_PHPUP',1);
define('STYLEID','limengqi');
define('TEMPLATEID','1');
define('COMPILEDIR','compile');

require(ROOT_PATH.'/data/config.inc.php');
require(ROOT_PATH.'/inc/mysql.class.php');
require(ROOT_PATH.'/inc/global.func.php');
include ROOT_PATH.'/inc/session.class.php';
include ROOT_PATH.'/inc/xml.class.php';
include_once ROOT_PATH.'/inc/Taoapi.php';
//初始化session
$session=new session();
if($_REQUEST)
{
	$_REQUEST['sid']=$session->get_id();
}
//初始化数据连接
$db=new mysql();

$db->connect($dbhost,$dbuser,$dbpw,$dbname);

if(!checkfile('setting',0))
{
	$query=$db->query('select variable,content from '.tname('setting'));
	while($rows=$db->fetch_array($query))
	{
		$setting[$rows['variable']]=$rows['content'];
	}
	//网站类型设定
	$setting['sitelogType']=array(1=>'网购商城',2=>'名站导航',3=>'团购网站',4=>'综合平台');
	write('setting',$setting);
}
else
{
	$setting=read('setting');
}
/*--------------------系统变量--------------------------*/
define('TPLDIR',!empty($_GET['tplview'])?$_GET['tplview']:($setting['site_template_dir']?$setting['site_template_dir']:'default'));
define("SITE_ROOT",'http://'.str_replace('://','',str_replace('http','',$setting['site_url'])));
define('VERSION','KaKa101_zidan v1.1');
$timezone='Asia/Shanghai';
$timestamp=time();
$tplrefresh=5;
$allowremote=intval($setting['site_allow_remote']);
$cachedir=$setting['site_cache_dir'];
$emailinfo=array('email'=>$setting['email'],'pass'=>$setting['email_password'],'account'=>$setting['email_user'],'smtp'=>$setting['email_smtp'],'port'=>intval($setting['email_port']));
$title=$setting['site_title'];
$rewrite=intval($setting['seo_rewrite']);//开启重写
$seo_title=$setting['seo_title'];
$seo_keyword=$setting['seo_keyword'];
$seo_description=$setting['seo_description'];
$uploaddir=$setting['site_upload_dir'];
$timeoffset=8;
$charset='gbk';
/*--------------------系统变量--------------------------*/
$cityid=isset($_GET['cityid'])?$_GET['cityid']:($GLOBALS['session']->get('cityid')?$GLOBALS['session']->get('cityid'):($GLOBALS['setting']['site_default_city']?$GLOBALS['setting']['site_default_city']:'quanguo'));
$GLOBALS['session']->set(array('cityid'=>$cityid));
header("content-type:text/html;charset=".$charset);
require(ROOT_PATH.'/inc/sql.inc.php');
require(ROOT_PATH.'/inc/page.class.php');
require(ROOT_PATH.'/inc/template.func.php');
date_default_timezone_set($timezone);

$mtime = explode(' ', microtime());
$serveru_starttime = $mtime[1] + $mtime[0];



if(PHP_VERSION < '4.1.0') {
	$_GET = &$HTTP_GET_VARS;
	$_POST = &$HTTP_POST_VARS;
	$_COOKIE = &$HTTP_COOKIE_VARS;
	$_SERVER = &$HTTP_SERVER_VARS;
	$_ENV = &$HTTP_ENV_VARS;
	$_FILES = &$HTTP_POST_FILES;
}

if (isset($_REQUEST['GLOBALS']) OR isset($_FILES['GLOBALS'])) {
	exit('Request tainting attempted.');
}
//缓存链接
if(!checkfile('linklist',86400))
{
	$query=$db->query('select * from '.tname('link').' order by sortorder desc');
	while($rows=$db->fetch_array($query))
	{
		$link_list[($rows['type']==1?'text':'image')][]=$rows;
	}
	write('link',$link_list);
}
else
{
	$link_list=read('link');
}

//缓存网站分类
if(!checkfile('sitecate',86400))
{
	$query=$db->query('select * from '.tname('sitecate').' order by sortorder desc');
	while($rows=$db->fetch_array($query))
	{
		$sitecate[$rows['id']]=array('sitecatename'=>$rows['sitecatename'],'sitetype'=>$rows['sitetype'],'sortorder'=>intval($rows['sortorder']));
	}
	write('sitecate',$sitecate);
}
else
{
	$sitecate=read('sitecate');
}

//缓存分类和城市
if(!checkfile('cate',86400))
{
	$query=$db->query('select * from '.tname('catelist').' order by sortorder desc');
	while($rows=$db->fetch_array($query))
	{
		$cate[$rows['id']]=array('catename'=>$rows['catename'],'sortorder'=>intval($rows['sortorder']));
	}
	write('cate',$cate);
}
else
{
	$cate=read('cate');
}
if(!checkfile('city',86400))
{
	$query=$db->query('select * from '.tname('city').' where pinyin!="" order by sortorder desc');
	
	while($rows=$db->fetch_array($query))
	{
		$city[$rows['pinyin']]=array('cityname'=>$rows['cityname'],'sortorder'=>intval($rows['sortorder']),'isshow'=>$rows['isshow'],'cityid'=>$rows['cityid']);
	}
	write('city',$city);
}
else
{
	$city=read('city');
}
if(!checkfile('site',86400))
{
	$query=$db->query('select * from '.tname('site').' order by id asc');
	while($rows=$db->fetch_array($query))
	{
		$site[]=$rows;
	}
	write('site',$site);
}
else
{
	$site=read('site');
}
include ROOT_PATH.'/inc/rep.inc.php'; //采集规则包