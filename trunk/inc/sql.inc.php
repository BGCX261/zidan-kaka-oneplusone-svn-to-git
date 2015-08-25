<?php
/*
	[Phpup.Net!] (C)2009-2011 Phpup.net.
	This is NOT a freeware, use is subject to license terms

	$Id: sql.inc.php 2010-08-24 10:42 $
*/

if(!defined('IN_PHPUP')) {
	exit('Access Denied');
}
//添加数据
function InsertSql($data,$table,$strict=false,$replace=0)
{
	$f=$v='';
	$field=array();
	$i=0;
	if($strict)
	{
		$field=$GLOBALS['db']->query("select * from ".tname($table)." limit 0,1");
		$field=$GLOBALS['db']->list_fields($field);
	}
	
	foreach($data as $key=>$val)
	{
		if($strict)
		{
			if(in_array($key,$field))
			{
				$d=$i>0?',':'';
				$f.=$d.'`'.$key.'`';
				$v.=$d."'".global_addslashes(trim($val))."'";
				$i++;
			}
		}
		else
		{
			$d=$i>0?',':'';
			$f.=$d.'`'.$key.'`';
			$v.=$d."'".global_addslashes(trim($val))."'";
			$i++;
		}
		
	}
	$type=$replace?'replace':'insert';
	return $type." into ".tname($table)."(".$f.") values(".$v.")";
}
//更新数据
function UpdateSql($data,$table,$where,$strict=false)
{
	$f='';
	$field=array();
	if($strict)
	{
		$field=$GLOBALS['db']->query("select * from ".tname($table)." limit 0,1");
		$field=$GLOBALS['db']->list_fields($field);
		
	}
	foreach($data as $key=>$val)
	{
		if($strict)
		{
			if(in_array($key,$field))
			{
				$d=$i>0?',':'';
				$f.=$d."`".$key."`="."'".global_addslashes(trim($val))."'";
				$i++;
			}
		}
		else
		{
			$d=$i>0?',':'';
			$f.=$d."`".$key."`="."'".global_addslashes(trim($val))."'";
			$i++;
		}
		
	}
	$sql="update ".tname($table)." set ";
	$sql.=$f." where 1 ".$where;
	return $sql;
}
