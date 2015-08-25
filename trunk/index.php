<?php
require('inc/common.inc.php');

if($GLOBALS['setting']['seo_rewrite'])
{
	$var=explode('-',$_GET['repparam']);
	foreach($var as $k=>$v)
	{
		$vt=explode('_',$v);
		$_GET[$vt[0]]=$vt[1];
	}
}
$controller=(empty($_REQUEST['con'])?'index':$_REQUEST['con']);
$action=empty($_REQUEST['act'])?'index':$_REQUEST['act'];

if(!is_file(ROOT_PATH.'/controls/'.$controller.'.class.php'))
{
	$controller='index';
	$action='index';
}

require(ROOT_PATH.'/controls/'.$controller.'.class.php');

$conclass=$controller.'_controller';
$actfunc=$action.'_action';
$views=new $conclass;
$views->$actfunc();
