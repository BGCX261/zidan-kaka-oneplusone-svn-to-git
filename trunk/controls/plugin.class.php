<?php


if(!defined('IN_PHPUP')) {
	exit('Access Denied');
}
define('CURSCRIPT','plugin');
class plugin_controller
{
	function plugin_controller()
	{
		include ROOT_PATH.'/models/common.php';
		$this->pdir=ROOT_PATH.'/plugins';
		$this->plugin=new common('plugins');
		$this->pluginvars=new common('pluginvars');
		$this->pluginhooks=new common('pluginhooks');
		$adminarr=array('list1');
		if(in_array($_REQUEST['act'],$adminarr))
		{
			if(!$GLOBALS['session']->get('adminid'))
			{
				sheader('index.php?con=admin&act=login');
			}
		}
	}
	function index_action()
	{
		if(!checkfile('plugins',0))
		{
			$plugins=$this->plugin->GetPage(array('isshow'=>0));
			foreach($plugins as $k=>$v)
			{
				$v['isinstalled']=1;
				$pluginlist[]=$v;
			}
			$plugins=$this->_getAllPlugins();
			
			foreach($plugins as $k=>$v)
			{
				$v['isinstalled']=0;
				$pluginlist[]=$v;
			}
			write('plugins',$pluginlist);
		}
		else
		{
			$pluginlist=read('plugins');
		}
		
		include ROOT_PATH.'/views/admin/plugin.php';
	}
	
	function install_action()
	{
		$pname=trim($_GET['tag']);
		
		$pinfo=$this->_getAllPlugins($pname);
		if($pinfo)
		{
			$pinfo=$pinfo['root']['Data']['plugin'];
			$data['available']=is_array($pinfo['available'])?$pinfo['available'][0]:$pinfo['available'];
			$data['adminid']=is_array($pinfo['adminid'])?$pinfo['adminid'][0]:$pinfo['adminid'];
			$data['name']=is_array($pinfo['name'])?$pinfo['name'][0]:$pinfo['name'];
			$data['identifier']=is_array($pinfo['identifier'])?$pinfo['identifier'][0]:$pinfo['identifier'];
			$data['description']=is_array($pinfo['description'])?$pinfo['description'][0]:$pinfo['description'];
			$data['datatables']=is_array($pinfo['datatables'])?$pinfo['datatables'][0]:$pinfo['datatables'];
			$data['directory']=is_array($pinfo['directory'])?$pinfo['directory'][0]:$pinfo['directory'];
			$data['copyright']=is_array($pinfo['copyright'])?$pinfo['copyright'][0]:$pinfo['copyright'];
			$data['modules']=serialize($pinfo['modules']['item']);
			$data['version']=is_array($pinfo['version'])?$pinfo['version'][0]:$pinfo['version'];
			
			if($pid=$this->plugin->InsertData($data))
			{
				$vars=$pinfo['vars']['item']['title']?$pinfo['vars']:$pinfo['vars']['item'];
				foreach($vars as $v)
				{
					$vdata['pluginid']=$pid;
					$vdata['displayorder']=is_array($v['displayorder'])?$v['displayorder'][0]:$v['displayorder'];
					$vdata['title']=is_array($v['title'])?$v['title'][0]:$v['title'];
					$vdata['description']=is_array($v['displayorder'])?$v['displayorder'][0]:$v['displayorder'];
					$vdata['variable']=is_array($v['variable'])?$v['variable'][0]:$v['variable'];
					$vdata['type']=is_array($v['type'])?$v['type'][0]:$v['type'];
					$vdata['value']=is_array($v['value'])?$v['value'][0]:$v['value'];
					$vdata['extra']=is_array($v['extra'])?$v['extra'][0]:$v['extra'];
					$this->pluginvars->InsertData($vdata);
				}
				
				$hooks=$pinfo['hooks']['item']['available']?$pinfo['hooks']:$pinfo['hooks']['item'];
				foreach($hooks as $v)
				{
					$hdata['pluginid']=$pid;
					$hdata['available']=intval($v['available']);
					$hdata['title']=is_array($v['title'])?$v['title'][0]:$v['title'];
					$hdata['description']=is_array($v['description'])?$v['description'][0]:$v['description'];
					$hdata['code']=is_array($v['code'])?$v['code'][0]:$v['code'];
					$this->pluginhooks->InsertData($hdata);
				}
				
			}
			if($pinfo['installfile'] && is_file($this->pdir.'/'.$pname.'/'.$pinfo['installfile']))
			{
				//include $this->pdir.'/'.$pname.'/'.$pinfo['installfile'];
			}
			deletef('plugins');
		}
	}
	function uninstall_action()
	{

	}
	function vars_action()
	{
		$id=intval($_GET['id']);
		if(submitcheck('commit'))
		{
		}
		else
		{
			$vars=array();
			if($id)
			{
				$vars=$this->pluginvars->GetPage(array('isshow'=>0),'and pluginid='.$id);
			}
		}
		
		include ROOT_PATH.'/views/admin/vars.php';
	}
	//全部插件目录
	function _getAllPlugins($plugisname='')
	{
		$plugin=array();
		if($plugisname)
		{
			$xmlfile=$this->pdir.'/'.$plugisname.'/phpup_plugin_'.$plugisname.'.xml';
			
			if(is_file($xmlfile))
			{
				$plugin=XML_unserialize(readf($xmlfile),'ISO-8859-1');
			}
		}
		else
		{
			$dir=scandir($this->pdir);
			foreach($dir as $k=>$v)
			{
				if($v!='..' && $v!='.')
				{
					
						$newdir=$this->pdir.'/'.$v;
						$xmlfile=$newdir.'/phpup_plugin_'.$v.'.xml';
						
						if(is_file($xmlfile))
						{
							$data=XML_unserialize(readf($xmlfile),'ISO-8859-1');
							$data=$data['root']['Data']['plugin'];
							$plugin[]=array("pluginid"=> 0,"available"=>intval($data['available']),"adminid"=>intval($data['adminid']),"name"=>$data['name'],"identifier"=>$data['identifier'],"description"=>$data['description'],"datatables"=> $data['datatables'],"directory"=> $data['directory'],"copyright"=>$data['copyright'],"modules"=> serialize($data['modules']['item']),"version"=>$data['version'],"isinstalled"=> 0);
						}
				}
				
			}
		}
		return $plugin;
	}
}