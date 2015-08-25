<?php
if(!defined('IN_PHPUP')) { 
	exit('Access Denied');
}
define('CURSCRIPT','index');
class index_controller
{
	function index_controller() 
	{
		include ROOT_PATH.'./models/common.php';  
		$this->group=new common('groups');
		$this->site=new common('site');
		$this->user=new common('user');
		$this->weather=new common('weather');  
		$this->area=new common('area');
	}
	function index_action()
	{
		if(empty($_REQUEST['ajax']))
		{
			$query=$GLOBALS['db']->query('select id,sitename,siteurl,css,logo,hot from '.tname('site').' where ctype=1 and recommend=1 order by sort desc,hot desc limit 0,16');
			while($rows=$GLOBALS['db']->fetch_array($query)){
			   $site_top_one[]=$rows;
			}
			if(!checkfile('site_top',180)){
				foreach($GLOBALS['sitecate'] as $k=>$v)
				{
					
					$query=$GLOBALS['db']->query('select id,sitename,cityid,siteurl,css,pinyin,sitetype,ctype,logo,hot from '.tname('site').' where sitetype='.$k.' and recommend=1 order by sort desc,hot desc limit 0,30');
					while($rows=$GLOBALS['db']->fetch_array($query))
					{
						$site_top[$rows['sitetype']][]=$rows;
					}
					
				}
				write('site_top',$site_top);
			}
			else
			{
				$site_top=read('site_top');
			}
/*热购商品列表开始*/
				$queryPro=$GLOBALS['db']->query('select pid,title,pic_url,link_url,webUrl,webName,price from '.tname('products').' where status=1 order by uptime desc limit 0,15');
				while($rowsPro=$GLOBALS['db']->fetch_array($queryPro))
				{
					$productslist[]=$rowsPro;
				}
				$productsindex=$productslist;

/*热购商品列表结束*/

/*淘宝商城女装数据调用开始*/
$Taoapi_Config = Taoapi_Config::Init();
$Taoapi = new Taoapi;
//搜索商品信息(taobao.items.get)
$ItemsParam['method'] = 'taobao.items.get';
$ItemsParam['fields'] = 'num_iid,title,detail_url,pic_url,nick,cid,price,type,delist_time,post_fee,score,volume';
$ItemsParam['q'] = '品牌';
$ItemsParam['cid'] = '16';
$ItemsParam['page_no'] = '1';
$ItemsParam['page_size'] = '15';
$ItemsParam['order_by'] = 'volume:desc';
$ItemsParam['ww_status'] = 'true';
$ItemsParam['is_3D'] = 'false';
$ItemsParam['is_mall'] = 'true';
$ItemsParam['genuine_security'] = 'true';
$ItemsParam['stuff_status'] = 'new';
$Taoapi->setUserParam($ItemsParam);//传入参数
$Taoapi->setVersion(2);//1表示 1.0版,2 表示2.0版
$ItemsData = $Taoapi->Send('get','xml')->getArrayData();

//print_r($ItemsData);
//die();
/*淘宝商城女装数据调用结束*/
            $cityWeather=$this->_cityWeather();//加载天气城市
            $weatherRow=$this->_siteweather();//加载天气
			//$citygroup=$this->_citygroup();
			$indexgroup=$this->_indexquanguogroup();
			//$grouplist=$this->_quanguogroup();
			$txtsitelist=$this->_indexCateTosite();
			include template('index');
		}
		elseif($_REQUEST['ajax']==1)
		{
			//$citygroup=$this->_citygroup();			
     		$txtsitelist=$this->_indexCateTosite();
			//$grouplist=$this->_quanguogroup();
			include template('ajax_textsite');			
		}
		else
		{
			$citypage=intval($_REQUEST['citypage']);
			$grouplist=$this->_citygroup(1,$citypage);
			include template('ajax_citygroup');
		}
	}
	function _indexCateTosite(){
		    $sitetype=$_REQUEST['cateid'] ? intval(trim($_REQUEST['cateid'])) :  16 ;
			//echo "<script>alert('".$sitetype."')</ script>";die();
			if(!checkfile('catesite_'.$sitetype))
			{
				$query=$GLOBALS['db']->query("select id,sitename,cityid,siteurl,css,pinyin,sitetype from ".tname('site')." where ctype=2 and sitetype=".$sitetype." order by recommend desc,sort desc limit 0,27");
				while($rows=$GLOBALS['db']->fetch_array($query))
				{
					$site[]=$rows;
				}
				write('catesite_'.$sitetype,$site);
			}
			else
			{
				$site=read('catesite_'.$sitetype);
			}
			return $site;
	}
	
	//天气城市设置
	function _cityWeather(){
			   $area_query  =  $GLOBALS['db']-> query("select id,name from ".tname('area')." where flag ='3'");
				while($rows=$GLOBALS['db']->fetch_array($area_query))
				{
					$arealist[]=$rows;
				}		   
			   return $arealist;
	}
				//天气------------开始
				//获取当前ip地址
	function _siteweather(){
			   $ip = get_ip_place();  
			   $area_query  =  $GLOBALS['db']->  query("select id from ".tname('area')." where flag=3 and name='".trim($ip[3])."'");
			   $area_row =  array(); 
			   
			   $area_row =  $GLOBALS['db']->  fetch_array($area_query);   
			   
			   if(empty( $area_row))
			   {
				 //查询省份是否存在
				   $area_qu  =  $GLOBALS['db']->  query("select id from ".tname('area')." where flag=2 and  name='".trim($ip[2])."'");
				   $area_sheng =  array();  
				   $area_sheng =  $GLOBALS['db']->  fetch_array($area_qu); 
					if(empty( $area_sheng))
					{
					
					   $area_date  = array(); 
					   $area_date['name'] = trim($ip[2]);
					   $area_date['fatherid'] = 1;
					   $area_date['flag'] = 2;  
					   $area_fid   =  $this->area->InsertData($area_date);   
					}else
					{
					   $area_fid   = $area_sheng['id'];  
					}
				   $area_date  = array(); 
				   $area_date['name'] = trim($ip[3]);
				   $area_date['fatherid'] = $area_fid;
				   $area_date['flag'] = 3;  
				   $area_id   =  $this->area->InsertData($area_date);   
				 
			   }else
			   {
				 $area_id   = $area_row['id']; 
			   }
			 if(!empty($_REQUEST['areaid'])) 
			 {
			 
			   $area_qu   =  $GLOBALS['db']->  query("select id from ".tname('area')." where id=".$_REQUEST['areaid']);
			   $area      =  array();  
			   $area      =  $GLOBALS['db']->  fetch_array($area_qu );  
			    if(!empty( $area))
			   {
				 $area_id = $_REQUEST['areaid'];
			   } 

			} 
		  
		   $query  =  $GLOBALS['db']->  query("select we.*,ar.name from ".tname('weather')." as we,".tname('area')."  as ar where  ar.id=we.areaid and  areaid=".$area_id);
		   $weatherRow =  array();
		   $weatherRow =  $GLOBALS['db']->  fetch_array($query);  
		  
		    if( empty($weatherRow)||$weatherRow['updated'] < date("Y-m-d 00:00:00"))
			{ 
			 
				   $weather  = _cityweather($row['name']);  
				   $htm1 = strip_tags($weather[1],"<br><img>");
				   $htm2 = strip_tags($weather[2],"<br><img>");
				   $htm3 = strip_tags($weather[3],"<br><img>");
				   $data['areaid']    =  $area_id;  
				   $data['jtitle']    =  change_htm(str_replace("<img ","<img  height='30' ",$htm1));
				   $data['mtitle']    =  change_htm(str_replace("<img ","<img  height='30' ",$htm2));
				   $data['htitle']    =  change_htm(str_replace("<img ","<img  height='30' ",$htm3));	 
				   $data['updated']   =  date("Y-m-d H:i:s");  
				   if((!is_array($weatherRow))||empty($weatherRow))
				   { 
						   $ids  =  $this->weather->InsertData($data);
							
				   } elseif($row['updated'] < date("Y-m-d 00:00:00"))
				   { 
						  $ids  =  $this->weather->UpdateData($data,'and id='.$weatherRow['id']);
						 
				   }
						 

			   $query  =  $GLOBALS['db']->  query("select* from ".tname('weather')." where    areaid=".$area_id);
			   $weatherRow =  array();
			   $weatherRow =  $GLOBALS['db']->  fetch_array($query);  
		   }
		   return $weatherRow;
	}
			//天气------------结束
	//本地团购
	function _citygroup($more=0,$page=0) 
	{
		if(!$GLOBALS['setting']['site_allow_diff_city'])
		{
			return array();
		}
		$pagesize=$GLOBALS['setting']['site_currentcity_num']?$GLOBALS['setting']['site_currentcity_num']:8;
		if($GLOBALS['session']->get('cityid') && $GLOBALS['session']->get('cityid')!='quanguo')
		{
			$t=$this->_setLimit();
			$container=$t['container'];
			$order=$t['order'];
			$container.=' and cityid like "%'.$GLOBALS['session']->get('cityid').'%"';			
			if($more==0 && $GLOBALS['setting']['site_onlyrecommend'])
			{
				$container.=' and recommend=1';
			}
			
			$limit='limit '.($page*$pagesize).','.$pagesize;
			$cacheid='grouplsit_'.md5($container.$order.$page.$pagesize);
			
			if(!checkfile($cacheid))
			{
				$grouplist=$this->group->GetPage(array('isshow'=>0),$container.' and lasttime>='.time(),$limit,array(),$order);
				foreach($grouplist as $k=>$v)
				{
					if(!$v['discount'])
					{
						$grouplist[$k]['discount']=intval(($grouplist[$k]['nowprice']*100)/$grouplist[$k]['oldprice'])/10;
						
					}
					if(empty($v['shortsubject']))
					{
						$grouplist[$k]['shortsubject']=$grouplist[$k]['subject'];
					}
					$grouplist[$k]['thumb']=strpos(','.$grouplist[$k]['thumb'],'http:')?$grouplist[$k]['thumb']:SITE_ROOT.'/'.$grouplist[$k]['thumb'];
					$grouplist[$k]['lasttime']=date("M d Y H:i:s",$grouplist[$k]['lasttime']);
				}
				write($cacheid,$grouplist);
			}
			else
			{
				$grouplist=read($cacheid);
			}
		}
		else
		{
			$grouplist=array();
		}
		return $grouplist;
	}
	//全国团购
	function _quanguogroup()
	{
		$t=$this->_setLimit();
	
		
		$container=$t['container'];
		$order=$t['order'];
		$ext=$t['ext'];
		if(!$GLOBALS['setting']['site_allow_all']) //不只包含全国
		{
			$container.=' and (cityid like "%quanguo%" or cityname like "%全国%")';
		}
		if(!$GLOBALS['setting']['site_allow_diff_city'] && $GLOBALS['session']->get('cityid')!='quanguo')
		{
			$container.=' and cityid like "%'.$GLOBALS['session']->get('cityid').'%"'; //不区别显示城市,并且不是全国
		}
		$pagesize=!empty($GLOBALS['setting']['site_num'])?intval($GLOBALS['setting']['site_num']):16;
		$cacheid='grouplsit_'.md5($container.$order.$_REQUEST['page'].$pagesize);
		
		if(!checkfile($cacheid))
		{
			$showpage=array('isshow'=>1,'currentpage'=>intval($_REQUEST['page']),'pagesize'=>$pagesize,'url'=>url('index','index',$ext),'example'=>1);
			$grouplist=$this->group->GetPage($showpage,$container.' and lasttime>='.time(),'',array(),$order);
			foreach($grouplist['data'] as $k=>$v)
			{
				if(!$v['discount'])
				{
					$grouplist['data'][$k]['discount']=intval(($grouplist['data'][$k]['nowprice']*100)/$grouplist['data'][$k]['oldprice'])/10;
					
				}
				if(empty($v['shortsubject']))
				{
					$grouplist['data'][$k]['shortsubject']=$grouplist['data'][$k]['subject'];
				}
				$grouplist['data'][$k]['thumb']=strpos(','.$grouplist['data'][$k]['thumb'],'http:')?$grouplist['data'][$k]['thumb']:SITE_ROOT.'/'.$grouplist['data'][$k]['thumb'];
				$grouplist['data'][$k]['lasttime']=date("M d Y H:i:s",$grouplist['data'][$k]['lasttime']);
			}
			write($cacheid,$grouplist);
		}
		else
		{
			$grouplist=read($cacheid);
		}
		return $grouplist;
	}
	
	//全国团购_首页
	function _indexquanguogroup()
	{
		$pagesize=7;
			$t=$this->_setLimit();
			$container=$t['container'];
			$order=$t['order'];			
			$container.=' and recommend=1';
			$limit='limit 7';
			$cacheid='indexgrouplsit_'.md5($container.$order);
			
			if(!checkfile($cacheid))
			{
				$grouplist=$this->group->GetPage(array('isshow'=>0),$container.' and lasttime>='.time(),$limit,array(),$order);
				foreach($grouplist as $k=>$v)
				{
					if(!$v['discount'])
					{
						$grouplist[$k]['discount']=intval(($grouplist[$k]['nowprice']*100)/$grouplist[$k]['oldprice'])/10;
						
					}
					if(empty($v['shortsubject']))
					{
						$grouplist[$k]['shortsubject']=$grouplist[$k]['subject'];
					}
					$grouplist[$k]['thumb']=strpos(','.$grouplist[$k]['thumb'],'http:')?$grouplist[$k]['thumb']:SITE_ROOT.'/'.$grouplist[$k]['thumb'];
					$grouplist[$k]['lasttime']=date("M d Y H:i:s",$grouplist[$k]['lasttime']);
				}
				write($cacheid,$grouplist);
			}
			else
			{
				$grouplist=read($cacheid);
			}
		return $grouplist;
	}
	
	//生成搜索条件
	function _setLimit()
	{
		//筛选条件
		$container=' and ispassed=1';
		$order='order by recommend desc,sortorder desc,id desc';
		
		$keyword='';
		if(!empty($_REQUEST['search_text']))
		{	
			$k=addslashes(trim(strip_tags($_REQUEST['search_text'])));
			$container="and subject like '%".$k."%' or groupsite like '%".$k."%'";
		}
		if(!empty($_REQUEST['grouptype']))
		{
			$container.=' and grouptype='.intval($_REQUEST['grouptype']);
			$ext['grouptype']=$_REQUEST['grouptype'];
		}
		if(!empty($_REQUEST['price']))
		{
			$price=explode('-',$_REQUEST['price']);
			$minprice=floatval($price[0]);
			
			if(isset($price[1]))
			{
				$maxprice=floatval($price[1]);
				$container.=' and nowprice>='.$minprice.' and nowprice<='.$maxprice;
			}
			else
			{
				if($minprice==50)
				{
					$container.=' and nowprice<='.$minprice;
				}
				else
				{
					$container.=' and nowprice>='.$minprice;
				}
			}
			$ext['price']=$_REQUEST['price'];
			
		}
		if(!empty($_REQUEST['sor']))
		{
			if(in_array($_REQUEST['sor'],array('newprice0','newprice1','lasttime0','lasttime1','hits0','hits1','discount0','discount1')))
			{
				switch($_REQUEST['sor'])
				{
					case 'newprice0':
						$order='order by nowprice asc';
					break;
					case 'newprice1':
						$order='order by nowprice desc';
					break;
					case 'lasttime0':
						$order='order by lasttime asc';
					break;
					case 'lasttime1':
						$order='order by lasttime desc';
					break;
					case 'hits0':
						$order='order by hits asc';
					break;
					case 'hits1':
						$order='order by hits desc';
					break;
					case 'discount0':
						$order='order by discount asc';
					break;
					case 'discount1':
						$order='order by discount desc';
					break;
				
				}
			}
			$ext['sortorder']=$_REQUEST['sortorder'];
		}

		return array('container'=>$container,'order'=>$order,'ext'=>$ext);
	}
	function grouplist_action()
	{
		$weatherRow=$this->_siteweather();//加载天气
		$grouplist=$this->_quanguogroup();
		if($_REQUEST['ajax']==1){
		  include template('ajax_index');
		}else{
		  include template('grouplist');
		}
	}
	function hit_action()
	{
		$gid=intval($_REQUEST['gid']);
		if($gid>0)
		{
			$this->group->UpdateData(array('field'=>'hits','value'=>1),'and id='.$gid,false,'',true);
		}

	}
	function site_action()
	{
		$sitetype=intval($_GET['sitetype']);
		if($sitetype)
		{
			//缓存网站分类
			if(!checkfile('site_'.$sitetype,0))
			{
				$query=$GLOBALS['db']->query('select id,sitename,cityid,siteurl,css,pinyin from '.tname('site').' where sitetype='.$sitetype.' order by recommend desc,sort desc');
				while($rows=$GLOBALS['db']->fetch_array($query))
				{
					$site[$rows['cityid']][]=$rows;
				}
				write('site_'.$sitetype,$site);
			}
			else
			{
				$site=read('site_'.$sitetype);
			}
		}
		include template('sitelist');
	}
	function siteadd_action()
	{
		if(submitcheck('commit'))
		{
			$data['sitename']=trim(strip_tags($_POST['sitename']));
			$data['siteurl']=trim(strip_tags($_POST['siteurl']));
			$data['siteapi']=trim(strip_tags($_POST['siteapi']));
			$data['connect_user']=trim(strip_tags($_POST['people']));
			$data['cityid']=trim($_POST['cityid']);
			$data['email']='anyone@iruna.com';
			$data['pwd']=md52(microtime());
			$data['intro']='备注为空';
			$data['usertype']='nulluser';
			$data['updatetime']=time();
			$data['connect_type']='联系电话/QQ';
			$data['connect_content']=trim(strip_tags($_POST['tel'])).'/'.trim(strip_tags($_POST['qq']));
			if($this->user->InsertData($data))
			{
				sheader(url('index','siteadd'),3,'网站提交成功,请等待管理员审核');
			}
			else
			{
				sheader(url('index','siteadd'),3,'网站提交失败');
			}
		}
		else
		{
			include template('siteadd');
		}
	}

	function guestbook_action()
	{
		if(submitcheck('commit'))
		{
			$guestbook_mod=new common('guestbook');
			$data['title']=trim(strip_tags($_POST['title']));
			$data['content']=trim(strip_tags($_POST['content']));
			if($guestbook_mod->InsertData($data))
			{
				sheader(url('index','guestbook'),3,'意见提交成功');
			}
			else
			{
				sheader(url('index','guestbook'),3,'意见提交失败');
			}
		}
		else
		{
			include template('guestbook');
		}
	}

	function apiinfo_action()
	{
		include template('apiinfo');
	}

	function testapi_action()
	{
		
		include ROOT_PATH.'/inc/curl.class.php';
		$curl=new curl();
		if(!empty($_POST['apiurl']))
		{
			
			$data=$curl->get($_POST['apiurl']);
			$data=XML_unserialize($data);
			//echo "<pre>".var_export($data,1).'</pre>';
			$str=_mkAttach($data);
			if($str)
			{
				exit('<SCRIPT LANGUAGE="JavaScript">
				<!--
					parent.document.getElementById("regurl").value="'.$str[0].'\n建议规则\n'.$str[1].'";
				//-->
				</SCRIPT>');
				}
				else
				{
					exit('<SCRIPT LANGUAGE="JavaScript">
				<!--
					parent.document.getElementById("regurl").value="暂未收录此规则，请到bbs.iruna.cn求规则";
				//-->
				</SCRIPT>');
			}
		}
		else
		{
			exit('url为空，请填写');
		}
	}
	

}
