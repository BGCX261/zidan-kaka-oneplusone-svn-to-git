<?php
/*
	[Phpup.Net!] (C)2009-2011 Phpup.net.
	This is NOT a freeware, use is subject to license terms

	$Id: session.class.php 2010-08-24 10:42 $
*/

if(!defined('IN_PHPUP')) {
	exit('Access Denied');
}
class session
{
	function session()
	{
	}
	function set($val)
	{
		foreach($val as $k=>$v)
		{
			$_SESSION[$k]=$v;
		}
	}
	function get($key)
	{
		return $_SESSION[$key];
	}
	function get_id()
	{
		return session_id();
	}
	function destroy($key)
	{
		if(empty($key))
		{
			session_destroy();
		}
		else
		{
			foreach($key as $k=>$v)
			{
				unset($_SESSION[$k]);
			}
		}
	}
}