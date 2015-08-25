<?php
if(!defined('IN_PHPUP')) {
	exit('Access Denied');
}
define('CURSCRIPT','admin');
class admin_controller
{
	static $filelist=array();
	function admin_controller()
	{
		//$content=readf(ROOT_PATH.'/views/admin/adminframe.php');
		if($_REQUEST['act']=='admin_ajax' || $_REQUEST['act']=='admin_delete')
		{
			if(!$GLOBALS['session']->get('adminid'))
			{
				exit('δ��¼');
			}
		}
		if($_REQUEST['act']!='login' && $_REQUEST['act']!='logout')
		{
			if(!$GLOBALS['session']->get('adminid'))
			{
				sheader('index.php?con=admin&act=login');
			}
		}
		include ROOT_PATH.'/models/common.php';
		include ROOT_PATH.'/inc/curl.class.php';
		$this->group=new common('groups');
		$this->user=new common('user');
		$this->site=new common('site');
		$this->sitecate=new common('sitecate');
		$this->tempsite=new common('tempsite');
		$this->city=new common('city');
		$this->curl=new curl();
	}
	function login_action()
	{
		if(submitcheck('commit'))
		{
			$user=trim($_POST['username']);
			$password=md52($_POST['password']);
			$container=' and email="'.$user.'" and pwd="'.$password.'" and usertype="adminuser"';
			
			$userinfo=$this->user->GetOne($container);
			
			if($userinfo)
			{
				$GLOBALS['session']->set(array('adminid'=>$userinfo['uid'],'username'=>$userinfo['email']));
				exit('<SCRIPT LANGUAGE="JavaScript">
				<!--
					window.open("index.php?con=admin","_top","");
				//-->
				</SCRIPT>');
			}
			else
			{
				exit('<SCRIPT LANGUAGE="JavaScript">
				<!--
					alert("�û��������벻��ȷ!");
					parent.document.getElementById("user_pass").value="";
				//-->
				</SCRIPT>');
			}
		}
		else
		{
			include ROOT_PATH.'/views/admin/login.php';
		}
	}
	function logout_action()
	{
		$GLOBALS['session']->destroy(array('adminid'=>'','username'=>''));
		sheader('index.php?con=admin&act=login');
	}
	function index_action()
	{
		include ROOT_PATH.'/views/admin/index.php';
	}
	function top_action()
	{
		include ROOT_PATH.'/views/admin/topframe.php';
	}
	function left_action()
	{
		include ROOT_PATH.'/views/admin/leftframe.php';
	}
	function switch_action()
	{
		include ROOT_PATH.'/views/admin/switchframe.php';
	}
	function main_action()
	{
		include ROOT_PATH.'/views/admin/mainframe.php';
	}
	function admin_action()
	{
			
		if(!checkfile('countcache',3600))
			{
				
				$count['group']=$this->_groupCount();
				$dir=ROOT_PATH.'/data/upload';
				$this->_fileCount($dir);
				$count['filecount']=(intval(intval($this->filelist['count'])*1000/1024/1024)/1000).'M';
				$count['usercount']=$this->_userCount();
				$count['sitecount']=$this->_siteCount();
				write('countcache',$count);
			}
		else
		{
			$count=read('countcache');
		}
		include ROOT_PATH.'/views/admin/adminframe.php';
	}
	/**
	*���
	*/
	function ad_action()
	{
		$ad_mod=new common('ad');
		$showpage=array('isshow'=>1,'currentpage'=>intval($_REQUEST['page']),'pagesize'=>20,'url'=>'index.php?con=admin&act=ad','example'=>2);
		$ad=$ad_mod->GetPage($showpage);
		
		include ROOT_PATH.'/views/admin/ad.php';

	}
	/**
	*������
	*/
	function admodify_action()
	{
		$updateid=intval($_REQUEST['updateid']);
		$ad=array();
		$ad_mod=new common('ad');
		if(submitcheck('commit'))
		{
			$data['title']=trim(strip_tags($_POST['title']));
			$jsfile=!empty($_POST['adindex'])?str_replace('-','',$_POST['adindex']):'body';
			$data['adindex']=trim(strip_tags(str_replace('-','',$_POST['adtype']).'-'.$jsfile));
			
			if($_POST['adtype']=='html')
			{
				$content=trim($_POST['content']);
				$data['content']=$content;
			}
			else
			{
				$content="";
				if($_FILES['thumb'])
				{
					$thumb=_attach('thumb','data/upload/tempimg');
					foreach($thumb as $k=>$v)
					{
						$addata[]=array('img'=>$v,'url'=>$_POST['url'][$k],'info'=>$_POST['info'][$k],'width'=>$_POST['width'][$k],'height'=>$_POST['height'][$k]);
					}
				}
				if($_POST['oldthumb'])
				{
					foreach($_POST['oldthumb'] as $k=>$v)
					{
						$addata[]=array('img'=>$v,'url'=>$_POST['oldurl'][$k],'info'=>$_POST['oldinfo'][$k],'width'=>$_POST['oldwidth'][$k],'height'=>$_POST['oldheight'][$k]);
					}
				}
				if($_POST['adtype']=='image')
				{
					foreach($addata as $k=>$v)
					{
						$content.='<a href="'.$v['url'].'"><img border="0" src="'.SITE_ROOT.'/'.$v['img'].'" style="'.($v['width']>0?'width:'.$v['width'].'px;':'').($v['height']>0?'height:'.$v['height'].'px;':'').'" alt="'.$v['info'].'"/></a>';
					}
				}
				elseif($_POST['adtype']=='flash')
				{
					foreach($addata as $k=>$v)
					{
						$content.='<embed src="'.SITE_ROOT.'/'.$v['img'].'" style="'.($v['width']>0?'width:'.$v['width'].'px;':'').($v['height']>0?'height:'.$v['height'].'px;':'').'"></embed>';
					}
					
				}
				$data['content']=serialize($addata);
			}
			writefile(ROOT_PATH.'/data/cache/'.$jsfile.'.js',"document.write('".global_addslashes($content)."');");
			if($updateid)
			{
				if($ad_mod->UpdateData($data,'and id='.$updateid))
				{
					sheader('index.php?con=admin&act=ad',3,'�޸ĳɹ�','redirect',true);
				}
				else
				{
					sheader('index.php?con=admin&act=ad',3,'����δ�����仯���޸�ʧ��','redirect',true);
				}
			}
			else
			{
				if($insertid=$ad_mod->InsertData($data))
				{
					sheader('index.php?con=admin&act=ad',3,'��ӳɹ�','redirect',true);
				}
				else
				{
					sheader('index.php?con=admin&act=ad',3,'���ʧ��','redirect',true);
				}
			}
		}
		else
		{
			if($updateid>0)
			{
				$ad=$ad_mod->GetOne('and id='.$updateid);
			
				$ad['ad2']=explode('-',$ad['adindex']);
				if($ad['ad2'][0]=='image' || $ad['ad2'][0]=='flash')
				{
					$ad['content']=unserialize($ad['content']);
				}
			}
			include ROOT_PATH.'/views/admin/ad_form.php';
		}
	}
	/**
	*��������
	*/
	function file_action()
	{
		$path="data/upload";
		$this->_fileCount($path);
		$filelist=$this->filelist;
		unset($filelist['count']);
		$common=new common('');
		$filelist=$common->ArrayPage(intval($_GET['page']),$filelist,20,'index.php?con=admin&act=file');
		include ROOT_PATH.'/views/admin/filelist.php';
	}
	/**
	*������Ʒ
	*/
	function disgoods_action()
	{
		$disgoods_mod=new common('disgoods');
		$showpage=array('isshow'=>1,'currentpage'=>intval($_REQUEST['page']),'pagesize'=>20,'url'=>'index.php?con=admin&act=disgoods','example'=>2);
		$goodslist=$disgoods_mod->GetPage($showpage,$container);
		include ROOT_PATH.'/views/admin/disgoods.php';
	}
	/**
	*��Ӵ�����Ʒ
	*/
	function disgoodsmodify_action()
	{
		$updateid=$_REQUEST['updateid'];
		$goods=array();
		$disgoods_mod=new common('disgoods');
		if(submitcheck('commit'))
		{
			$data['title']=trim(strip_tags($_POST['title']));
			$data['link']=trim($_POST['link']);
			$data['content']=trim($_POST['content']);
			$data['starttime']=strtotime(trim($_POST['starttime']));
			$data['endtime']=strtotime(trim($_POST['endtime']));
			if($_FILES['thumb']['name'])
			{
				$data['thumb']=_upload('thumb','data/upload/tempimg','',array('width'=>86,'height'=>86));
			}
			if($updateid>0)
			{
				if($disgoods_mod->UpdateData($data,'and id='.$updateid))
				{
					deletef('disgoods');
					sheader('index.php?con=admin&act=disgoods',3,'�޸ĳɹ�','redirect',true);
				}
				else
				{
					sheader('index.php?con=admin&act=disgoods',3,'����δ�����仯���޸�ʧ��','redirect',true);
				}
			}
			else
			{
				if($disgoods_mod->InsertData($data))
				{
					sheader('index.php?con=admin&act=disgoods',3,'��ӳɹ�','redirect',true);
				}
				else
				{
					sheader('index.php?con=admin&act=disgoods',3,'���ʧ��','redirect',true);
				}
			}
		}
		else
		{
			if($updateid)
			{
				$goods=$disgoods_mod->GetOne('and id='.$updateid);
			}
			include ROOT_PATH.'/views/admin/disgoods_form.php';
		}
	}
	/**
	*��Ʒ����
	*/
	function products_action()
	{
		$products_mod=new common('products');
		$showpage=array('isshow'=>1,'currentpage'=>intval($_REQUEST['page']),'pagesize'=>20,'url'=>'index.php?con=admin&act=products','example'=>2);
		$goodslist=$products_mod->GetPage($showpage,$container);
		include ROOT_PATH.'/views/admin/products.php';
	}
	/**
	*�����Ʒ
	*/
	function productsmodify_action()
	{
		$updateid=$_REQUEST['updateid'];
		$goods=array();
		$products_mod=new common('products');
		if(submitcheck('commit'))
		{
			$data['title']=trim(strip_tags($_POST['title']));
			$data['link_url']=trim($_POST['link_url']);
			$data['webUrl']=trim($_POST['webUrl']);
			$data['webName']=trim($_POST['webName']);
			$data['price']=trim($_POST['price']);
			$data['status']=isset($_POST['status']) ? 1: 0;
			$data['uptime']=time();
			if($_FILES['thumb']['name']) $data['pic_url']=_upload('thumb','data/upload/tempimg','',array('width'=>138,'height'=>138));
			if($updateid>0)
			{
				if($products_mod->UpdateData($data,'and pid='.$updateid))
				{
					deletef('products');
					sheader('index.php?con=admin&act=products',3,'�޸ĳɹ�','redirect',true);
				}
				else
				{
					sheader('index.php?con=admin&act=products',3,'����δ�����仯���޸�ʧ��','redirect',true);
				}
			}
			else
			{
				if($products_mod->InsertData($data))
				{
					sheader('index.php?con=admin&act=products',3,'��ӳɹ�','redirect',true);
				}
				else
				{
					sheader('index.php?con=admin&act=products',3,'���ʧ��','redirect',true);
				}
			}
		}else{
			if($updateid)
			{
				$goods=$products_mod->GetOne('and pid='.$updateid);
			}
			include ROOT_PATH.'/views/admin/products_form.php';
		}
	}
	/**
	*�Ź���Ŀ����
	*/
	function group_action()
	{
		$container='';
		$extaurl='';
		
		$selecttype=intval($_GET['selecttype']);
		switch($_GET['selecttype'])
		{
			case 1:
				$container='and lasttime<='.time();
			break;
			case 2:
				$container='and lasttime>'.time();
			break;
			case 3:
				$container='and ispassed=1';
			break;
			case 4:
				$container='and ispassed=0';
			break;
			default:
				$container='';
			break;
			
		}
		$extaurl.='&selecttype='.$_GET['selecttype'];
		if($_GET['recommend']==1)
		{
			$container.=" and recommend=1 ";
			$extaurl.='&recommend=1';
		}
		if(!empty($_GET['keyword']))
		{
			$container.=" and subject like '%".trim($_GET['keyword'])."%'";
			$extaurl.='&keyword='.$_GET['keyword'];
		}
		if(isset($_GET['grouptype']) && intval($_GET['grouptype'])>-1)
		{
			$container.=" and grouptype=".intval($_GET['grouptype']);
			$extaurl.='&grouptype='.$_GET['grouptype'];
		}
		if(isset($_GET['siteid']) && intval($_GET['siteid'])>-1)
		{
			$container.=" and siteid=".intval($_GET['siteid']);
			$extaurl.='&siteid='.$_GET['siteid'];
		}
		if(isset($_GET['cityid']) && $_GET['cityid']>-1)
		{
			$container.=" and cityid like '%".$_GET['cityid']."%'";
			$extaurl.='&cityid='.$_GET['cityid'];
		}
		
		$showpage=array('isshow'=>1,'currentpage'=>intval($_REQUEST['page']),'pagesize'=>20,'url'=>'index.php?con=admin&act=group'.$extaurl,'example'=>2);
		
		$grouplist=$this->group->GetPage($showpage,$container,'',array(),'order by id desc');
		include ROOT_PATH.'/views/admin/group.php';

	}
	/**
	*���������Ź�
	*/
	function multigroup_action()
	{
		if(submitcheck('commit'))
		{
			$gids=implode(',',$_POST['gid']);
			$container=' and id in ('.($gids?$gids:0).')';
			if($_POST['confirmbutton']=='�����ƶ�')
			{
				if($this->group->UpdateData(array('grouptype'=>intval($_POST['cate'])),$container))
				{
					sheader('index.php?con=admin&act=group',3,'�����ƶ�����ɹ�','redirect',true);
				}
				else
				{
					sheader('index.php?con=admin&act=group',3,'�����ƶ�����ʧ��','redirect',true);
				}
			}
			if($_POST['confirmbutton']=='�������')
			{
				if($this->group->UpdateData(array('ispassed'=>intval($_POST['ispassed'])),$container))
				{
					sheader('index.php?con=admin&act=group',3,'������˳ɹ�','redirect',true);
				}
				else
				{
					sheader('index.php?con=admin&act=group',3,'�������ʧ��','redirect',true);
				}
			}
			if($_POST['confirmbutton']=='ȫ�����')
			{
				if($this->group->UpdateData(array('ispassed'=>1),'and id>0'))
				{
					sheader('index.php?con=admin&act=group',3,'ȫ����˳ɹ�','redirect',true);
				}
				else
				{
					sheader('index.php?con=admin&act=group',3,'ȫ�����ʧ��','redirect',true);
				}
			}
			if($_POST['confirmbutton']=='ȫ��ȡ�����')
			{
				if($this->group->UpdateData(array('ispassed'=>0),'and id>0'))
				{
					sheader('index.php?con=admin&act=group',3,'ȫ��ȡ����˳ɹ�','redirect',true);
				}
				else
				{
					sheader('index.php?con=admin&act=group',3,'ȫ��ȡ�����ʧ��','redirect',true);
				}
			}
			if($_POST['confirmbutton']=='����ɾ��')
			{
				if($this->group->DeleteData(' 1 '.$container))
				{
					sheader('index.php?con=admin&act=group',3,'����ɾ���ɹ�','redirect',true);
				}
				else
				{
					sheader('index.php?con=admin&act=group',3,'����ɾ��ʧ��','redirect',true);
				}
			}
		}
	}
	function groupmodify_action()
	{
		$updateid=intval($_REQUEST['updateid']);
		$group=array();
		if(submitcheck('commit'))
		{
			$data['subject']=trim(strip_tags($_POST['subject']));
			$data['lasttime']=strtotime($_POST['lasttime']);
			$site=explode('-',$_POST['siteid']);
			$data['siteid']=intval($site[0]);
			$data['groupsite']=trim($site[1]);
			$data['grouptype']=intval($_POST['cateid']);
			$data['cityid']=Pinyin($_POST['cityid']);
			$data['cityname']=trim($_POST['cityid']);
			$data['shortsubject']=trim(strip_tags($_POST['shortsubject']));
			$data['url']=trim(strip_tags($_POST['url']));
			$data['oldprice']=floatval($_POST['oldprice']);
			$data['nowprice']=floatval($_POST['nowprice']);
			$data['discount']=intval($data['nowprice']*100/$data['oldprice'])/10;
			$data['ispassed']=intval($_POST['ispassed']);
			$data['hits']=intval($_POST['hits']);
			$data['keyword']=trim(strip_tags($_POST['keyword']));
			$data['sortorder']=intval($_POST['sortorder']);
			if($thumb=_upload('thumb_img',$GLOBALS['uploaddir'].'/'.date('Y/m')))
			{
				$data['thumb']=$thumb;
			}
			
			if($updateid)
			{
				if($this->group->UpdateData($data,'and id='.$updateid))
				{
					sheader('index.php?con=admin&act=group',3,'�޸ĳɹ�','redirect',true);
				}
				else
				{
					sheader('index.php?con=admin&act=group',3,'����δ�����仯���޸�ʧ��','redirect',true);
				}
			}
			else
			{
				if($this->group->InsertData($data))
				{
					sheader('index.php?con=admin&act=group',3,'��ӳɹ�','redirect',true);
				}
				else
				{
					sheader('index.php?con=admin&act=group',3,'���ʧ��','redirect',true);
				}
			}
		}
		else
		{
			if($updateid>0)
			{
				$group=$this->group->GetOne('and id='.$updateid);
			}
			include ROOT_PATH.'/views/admin/group_form.php';
		}
	}
	//��վ
	function site_action()
	{
		$container='';
		$extaurl='';
		if($_GET['keyword'])
		{
			$container=' and sitename like "%'.$_GET['keyword'].'%"';
			$extaurl.='&keyword='.$_GET['keyword'];
		}
		if($_GET['sitetype'] && $_GET['sitetype']>-1)
		{
			$container.=' and sitetype='.intval($_GET['sitetype']);
			$extaurl.='&sitetype='.$_GET['sitetype'];
		}
		if($_GET['pinyin'])
		{
			$container.=' and pinyin ="'.$_GET['pinyin'].'"';
			$extaurl.='&pinyin='.$_GET['pinyin'];
		}
		$showpage=array('isshow'=>1,'currentpage'=>intval($_REQUEST['page']),'pagesize'=>20,'url'=>'index.php?con=admin&act=site'.$extaurl,'example'=>2);
		$sitelist=$this->site->GetPage($showpage,$container,'',array(),'order by sort desc,id desc');
		include ROOT_PATH.'/views/admin/site.php';
	}
	//��վ����
	function sitecate_action()
	{
		include ROOT_PATH.'/views/admin/sitecate.php';
	}
		/**
	*�����վ����
	*/
	function sitecatemodify_action()
	{
		$updateid=$_REQUEST['updateid'];
		$sitecate=array();
		if(submitcheck('commit'))
		{
			$data['sitecatename']=trim(strip_tags($_POST['sitecatename']));
			$data['sitetype']=$_POST['sitetype'];
			if($updateid>0)
			{
				if($this->sitecate->UpdateData($data,'and id='.$updateid))
				{
					deletef('sitecate');
					echo "<SCRIPT LANGUAGE='JavaScript'>var objdata={};objdata.dotype='update';objdata.id='$updateid';objdata.sitecatename='".global_addslashes($data['sitecatename'],1)."';objdata.sitetype='".$data['sitetype']."';parent.parseMysitecateData(objdata);</SCRIPT>";
					
				}
			}
			else
			{
				if($id=$this->sitecate->InsertData($data))
				{
					deletef('sitecate');
					echo "<SCRIPT LANGUAGE='JavaScript'>var objdata={};objdata.dotype='add';objdata.id='$id';objdata.sitecatename='".global_addslashes($data['sitecatename'],1)."';objdata.sitetype='".$data['sitetype']."';parent.parseMysitecateData(objdata);</SCRIPT>";
				}
			}
		}
		else
		{
			if($updateid)
			{
				$sitecate=$this->sitecate->GetOne('and id='.$updateid);
			}
			include ROOT_PATH.'/views/admin/sitecate_ajax_form.php';
		}
	}
	function cate_action()
	{
		include ROOT_PATH.'/views/admin/cate.php';
	}
	function city_action()
	{
		include ROOT_PATH.'/views/admin/city.php';
	}
	/**
	*�����վ
	*/
	function sitemodify_action()
	{
		
		$updateid=$_REQUEST['updateid'];
		$site=array();
		if(submitcheck('commit'))
		{
			$data['sitename']=trim(strip_tags($_POST['sitename']));
			$data['siteurl']=strip_tags($_POST['siteurl']);
			$data['siteapi']='http://'.str_replace('http://','',$_POST['siteapi']);
			$data['cityapi']='http://'.str_replace('http://','',$_POST['cityapi']);
			$data['cityrep']=trim(strip_tags($_POST['cityrep']));
			$data['sitetype']=intval($_POST['sitetype']);
			if($data['sitetype']!=0){
		      $ctypeID=$this->sitecate->GetOne(" and id=".$data['sitetype']);
			  $data['ctype']=intval($ctypeID['sitetype']);
			}
			$data['cityid']=trim($_POST['sitecity']);
			$data['pinyin']=get_letter($data['sitename']);
			$style="";
			foreach($_POST['css'] as $k=>$v)
			{
				$style.=';'.$k.':'.$v;
			}
			$data['css']=substr($style,1);
			$data['apirep']=trim(strip_tags($_POST['apirep']));
			if($_FILES['thumb_logo']['name'])
			{
				$data['logo']=_upload('thumb_logo','data/upload/logo');
			}
			if($updateid>0)
			{
				echo "<script>alert(1);</script>";
				if($this->site->UpdateData($data,'and id='.$updateid))
				{
					deletef('site');
					$str="objdata.dotype='update';objdata.id='$updateid';";
				}
			}
			else
			{
				
				$data['isallowed']=0;
			    //$maxSort=$this->site->GetSort('','sort');
				//echo "<script>alert($maxSort);< /script>";
				//$data['sort']=intval($maxSort)+1;
				if($id=$this->site->InsertData($data))
				{
					deletef('site');
					$str="objdata.dotype='add';objdata.id='$id';";
						
				}
			}
			foreach($data as $k=>$v)
			{
				if($k!='apirep')
				
				{
					$str.="objdata.$k='".global_addslashes($v,1)."';";
				
				}
			}
			$str.="objdata.sitecatename='".(intval($_POST['sitetype'])?$GLOBALS['sitecate'][intval($_POST['sitetype'])]['sitecatename']:'δ����')."';";
			echo "<SCRIPT LANGUAGE='JavaScript'>var objdata={};".$str;
			echo "parent.parseMySiteData(objdata);</SCRIPT>";
				
		}
		else
		{
			if($updateid)
			{
				$site=$this->site->GetOne('and id='.$updateid);
			}
			include ROOT_PATH.'/views/admin/site_ajax_form.php';
		}
	}

	/**
	*����������վ
	*/
	function sitedo_action()
	{
		$gids=$_POST['gid'];
		$button=$_POST['confirmbutton'];
		if($gids)
		{
			$gids=implode(',',$gids);
			$container="and id in (".$gids.")";
			if($button=='����ɾ��' && $this->site->DeleteData('1 '.$container))
			{
				deletef('site');
				sheader('index.php?con=admin&act=site',3,'����ɾ�����','redirect',true);
			}
			elseif($button=='�����Ƽ�' && $this->site->UpdateData(array('recommend'=>1),$container))
			{
				deletef('site');
				sheader('index.php?con=admin&act=site',3,'�����Ƽ����','redirect',true);
			}
			elseif($button=='����ȡ���Ƽ�' && $this->site->UpdateData(array('recommend'=>0),$container))
			{
				deletef('site');
				sheader('index.php?con=admin&act=site',3,'����ȡ���Ƽ����','redirect',true);
			}
			elseif($button=='��������' && $this->site->UpdateData(array('isallowed'=>1),$container))
			{
				deletef('site');
				sheader('index.php?con=admin&act=site',3,'�����������','redirect',true);
			}
			elseif($button=='������ֹ' && $this->site->UpdateData(array('isallowed'=>0),$container))
			{
				deletef('site');
				sheader('index.php?con=admin&act=site',3,'������ֹ���','redirect',true);
			}

			else
			{
				sheader('index.php?con=admin&act=site',3,'�����������','redirect',true);
			}
		}
		else
		{
			sheader('index.php?con=admin&act=site',3,'δָ������','redirect',true);
		}
	}
	/**
	*��ӳ���
	*/
	function citymodify_action()
	{
		$this->city=new common('city');
		$updateid=$_REQUEST['updateid'];
		$city=array();
		if(submitcheck('commit'))
		{
			$data['cityname']=trim(strip_tags($_POST['cityname']));
			$data['pinyin']=Pinyin($data['cityname']);
			if($updateid>0)
			{
				if($this->city->UpdateData($data,'and cityid='.$updateid))
				{
					deletef('city');
					echo "<SCRIPT LANGUAGE='JavaScript'>var objdata={}; objdata.dotype='update';objdata.id='$updateid';objdata.cityname='".global_addslashes($data['cityname'],1)."';objdata.pinyin='".$data['pinyin']."';parent.parseMyCityData(objdata);</SCRIPT>";
				}
			}
			else
			{
				if($id=$this->city->InsertData($data))
				{
					deletef('city');
					
					echo "<SCRIPT LANGUAGE='JavaScript'>var objdata={}; objdata.dotype='add';objdata.id='$updateid';objdata.cityname='".global_addslashes($data['cityname'],1)."';objdata.pinyin='".$data['pinyin']."';parent.parseMyCityData(objdata);</SCRIPT>";
				}
			}
		}
		else
		{
			if($updateid)
			{
				$city=$this->city->GetOne('and cityid='.$updateid);
			}
			include ROOT_PATH.'/views/admin/city_ajax_form.php';
		}
	}
	/**
	*���ͼƬ
	*/
	function imgmodify_action()
	{
		
		if(submitcheck('commit'))
		{
			$thumb=_upload('tempimg','data/upload/tempimg');
			@unlink($_POST['oldimg']);
			echo "<SCRIPT LANGUAGE='JavaScript'>parent.parseMyImgData('".$thumb."','".$_POST['doid']."');</SCRIPT>";
		}
		else
		{
			include ROOT_PATH.'/views/admin/img_ajax_form.php';
		}
	}
		/**
	*��ӷ���
	*/
	function catemodify_action()
	{
		$this->cate=new common('catelist');
		$updateid=$_REQUEST['updateid'];
		$cate=array();
		if(submitcheck('commit'))
		{
			$data['catename']=trim(strip_tags($_POST['catename']));
			if($updateid>0)
			{
				if($this->cate->UpdateData($data,'and id='.$updateid))
				{
					deletef('cate');
					echo "<SCRIPT LANGUAGE='JavaScript'>var objdata={}; objdata.dotype='update';objdata.id='$updateid';objdata.catename='".global_addslashes($data['catename'],1)."';parent.parseMyCateData(objdata);</SCRIPT>";
				}
			}
			else
			{
				if($id=$this->cate->InsertData($data))
				{
					deletef('cate');
					echo "<SCRIPT LANGUAGE='JavaScript'>var objdata={}; objdata.dotype='add';objdata.id='$id';objdata.catename='".global_addslashes($data['catename'],1)."';parent.parseMyCateData(objdata);</SCRIPT>";
				}
			}
		}
		else
		{
			if($updateid)
			{
				$cate=$this->cate->GetOne('and id='.$updateid);
			}
			include ROOT_PATH.'/views/admin/cate_ajax_form.php';
		}
	}
	//ͳ���Ź�
	function _groupCount()
	{
		$group=$this->group->GetPage(array('isshow'=>0));
		$groupcount=array();
		foreach($group as $k=>$v)
		{
			if($v['lasttime']>time())
			{
				$groupcount['new']++;
			}
			else
			{
				$groupcount['old']++;
			}
			if($v['ispassed'])
			{
				$groupcount['ispassed']++;
			}
			else
			{
				$groupcount['nopassed']++;
			}
		}
		return $groupcount;
	}
	//�ɼ��Ź�
	function attach_action()
	{
		$showpage=array('isshow'=>1,'currentpage'=>intval($_REQUEST['page']),'pagesize'=>20,'url'=>'index.php?con=admin&act=attach','example'=>2);
		$tempsite=$this->tempsite->GetPage($showpage);
		include ROOT_PATH.'/views/admin/attach.php';
	}
	//�ɼ�����
	function doattach_action()
	{
		if(!empty($_GET['siteid']))
		{
			$id=intval($_GET['siteid']);
			$attach=intval($_GET['attach']);
			
			if($id)
			{
				$paseapi=$this->site->GetOne('and id='.$id);
			}
			else
			{
				$paseapi=$this->site->GetOne('and id>0');
			}
			if($paseapi['apirep'] && $paseapi['isallowed'])
			{
				
				if($GLOBALS['setting']['site_allow_city'] && $paseapi['cityapi'] && $paseapi['cityrep'])
				{	
					set_time_limit(300);
					$citylist=$paseapi['cityapi'];
					$city=$this->curl->get($citylist);
					$city=XML_unserialize($city);
					$str=$paseapi['cityrep'];
					$citydata=_parseAttach($str,$city);
					foreach($citydata as $v)
					{
						$url=str_replace('_limengqicityname',$v['cityname'],str_replace('_limengqicityid',$v['cityid'],$paseapi['siteapi']));
						$cdata=$this->curl->get($url);
						$cdata=XML_unserialize($cdata);
						$cdata=_parseAttach($paseapi['apirep'],$cdata);
						foreach($cdata as $v)
						{
							$rowsdata[]=$v;
						}
						sleep(1);
					}
				}
				else
				{
					set_time_limit(180);
					$data=$this->curl->get($paseapi['siteapi']);
					$data=XML_unserialize($data);  
					$rowsdata=_parseAttach($paseapi['apirep'],$data);
				}
				
				
				if($rowsdata)
				{
					foreach($rowsdata as $rows)
					{
						$subject=trim($rows['subject']);
						if(!empty($subject))
						{
							$rows['url']=empty($rows['url'])?'http://':$rows['url'];
							$rows['siteid']=$paseapi['id'];
							$rows['groupsite']=$paseapi['sitename'];
							$container='and subject="'.$subject.'" and siteid='.$paseapi['id'];
							$oldsiteinfo=$this->tempsite->GetOne($container);
							if(!$oldsiteinfo)
							{
								$insertid=$this->tempsite->InsertData($rows);
								if(!$insertid)
								{
									$fp=fopen(ROOT_PATH.'/views/admin/log/attacherror.log','w');
									fwrite($fp,$paseapi['sitename'].'('.$paseapi['apiurl'].")ʧ��\n");
									fclose($fp);
								}
								elseif($GLOBALS['setting']['site_allow_insert'])
								{
									$this->_autoInsertGroup($insertid);
								}
							}
						}
						else
						{
							continue;
						}
					}
				}
				
			}
			elseif(!$attach && $paseapi['isallowed'])
			{
				sheader('index.php?con=admin&act=attach',3,$paseapi['sitename'].'δ��ӹ���','redirect',true);
			}
			
			if($attach)
			{
				$nextapi=$this->site->GetOne('and id>'.$paseapi['id'].' and isallowed=1',array(),'order by id asc');
				if($nextapi)
				{
					if(empty($paseapi['apirep']))
					{
						$message='��'.$paseapi['sitename'].'��δ��ӹ��� ';
						$showtime=1;
					}
					elseif($paseapi['isallowed'])
					{
						$message='��'.$paseapi['sitename'].'���ɼ���� ';
						$showtime=3;
					}
					else
					{
						$message='��'.$paseapi['sitename'].'����ֹ�ɼ� ';
						$showtime=1;
					}
					sheader('index.php?con=admin&act=doattach&siteid='.$nextapi['id'].'&attach=1',$showtime,$message.'������һ����'.$nextapi['sitename'].'��','redirect',true);
				}
				else
				{
					sheader('index.php?con=admin&act=attach',3,'û����һ����','redirect',true);
				}
			}
			elseif($paseapi['isallowed'])
			{
				
				sheader('index.php?con=admin&act=attach',3,'�ɼ����','redirect',true);
			}
			else
			{
				sheader('index.php?con=admin&act=attach',1,'��ֹ�ɼ�','redirect',true);
			}
			
			
		}
		else
		{
			sheader('index.php?con=admin&act=attach',3,'����Ϊ��','redirect',true);
		}
	}
	//�ɼ�����Ϣ���
	function inserttempsite_action()
	{
		$ids=implode(',',$_POST['tempid']);
		$container='and id in ('.($ids?$ids:0).')';
		if($_POST['dosubmit']=='����ɾ��')
		{
			if($ids)
			{
				$this->tempsite->DeleteData('1 '.$container);
				echo '<SCRIPT LANGUAGE="JavaScript">
				<!--
					alert("ɾ�����");
					window.open("index.php?con=admin&act=attach","_parent","");
				//-->
				</SCRIPT>';
			}
			else
			{
				echo '<SCRIPT LANGUAGE="JavaScript">
				<!--
					alert("��ѡ�����");
					window.open("index.php?con=admin&act=attach","_parent","");
				//-->
				</SCRIPT>';
			}
		}
		elseif($_POST['dosubmit']=='ȫ��ɾ��')
		{
			$this->tempsite->DeleteData('1 and id>0');
				echo '<SCRIPT LANGUAGE="JavaScript">
				<!--
					alert("ɾ�����");
					window.open("index.php?con=admin&act=attach","_parent","");
				//-->
				</SCRIPT>';
		}
		
		else
		{
			
			if($_POST['dosubmit']=='ȫ�����')
			{
				$this->_autoInsertGroup(-1);
			}
			elseif($_POST['dosubmit']=='�������')
			{
				$this->_autoInsertGroup($ids);
			}
		
			echo '<SCRIPT LANGUAGE="JavaScript">
			<!--
				alert("������");
				window.open("index.php?con=admin&act=attach","_parent","");
			//-->
			</SCRIPT>';
		}
		
	}
	//��̨ϵͳ����
	function setting_action()
	{
		
		$type=$_GET['type'];
		switch($type)
		{
			case 'site':
				
				include ROOT_PATH.'/views/admin/setting_site.php';
			break;
			case 'seo':
				include ROOT_PATH.'/views/admin/setting_seo.php';
			break;
			case 'group':
				include ROOT_PATH.'/views/admin/setting_group.php';
			break;
			case 'email':
				include ROOT_PATH.'/views/admin/setting_email.php';
			break;
			case 'attach':
				include ROOT_PATH.'/views/admin/setting_attach.php';
			break;
			case 'template':
				$dir=scandir(ROOT_PATH.'/views');
				foreach($dir as $k=>$v)
				{
					if(is_dir(ROOT_PATH.'/views/'.$v) && $v!='..' && $v!='.' && $v!='admin' && $v!='js')
					{
						if(is_file(ROOT_PATH.'/views/'.$v.'/template.config.php'))
						{
							include ROOT_PATH.'/views/'.$v.'/template.config.php';
							$tpldir[]=array('tplname'=>$v,'thumb'=>'views/'.$v.'/'.$picture,'author'=>$author,'desc'=>$desc,'info'=>$info);
						}
					}
				}
				include ROOT_PATH.'/views/admin/setting_template.php';
			break;
			default:
				include ROOT_PATH.'/views/admin/setting_site.php';
			break;
		}
	}
	//����ϵͳ�ύ����
	function settingdata_action()
	{
		if(submitcheck('commit'))
		{
			$type=$_POST['dotype'];
			unset($_POST['commit'],$_POST['dotype']);
			
			$setting_mod=new common('setting');
			
			if($_FILES['site_logo']['name'])
			{
				$filename=explode('.',$_FILES['site_logo']['name']);
				$container='and variable="site_logo"';
				$data['content']=_upload('site_logo','data/logo','logo.'.$filename[1]);
				$datalist=$setting_mod->GetOne($container);
				
				if($datalist)
				{
					$setting_mod->UpdateData($data,$container);
				}
				else
				{
					$data['variable']='site_logo';
					$setting_mod->InsertData($data);
				}
			}
			
			foreach($_POST as $k=>$v)
			{	
				$container='and variable="'.$k.'"';
				$data['content']=$v;
				$datalist=$setting_mod->GetOne($container);
				if($datalist)
				{
					$updatesql[$k]=$v;
				}
				else
				{
					$insertsql[$k]=$v;
				}
			}
			foreach($insertsql as $key=>$val)
			{
				$setting_mod->InsertData(array('variable'=>$key,'content'=>$val));
			}
			foreach($updatesql as $key=>$val)
			{
				$setting_mod->UpdateData(array('content'=>$val),'and variable="'.$key.'"');
			}
			if($type=='template')
			{
				$dofile=cleancache('','data/compile');
				if(!$dofile)
				{
					echo '<SCRIPT LANGUAGE="JavaScript">
					<!--
						alert("ģ����³ɹ�,���ϵͳ����ʧ��,���ֶ����");
					//-->
					</SCRIPT>';
				}
				else
				{
					echo '<SCRIPT LANGUAGE="JavaScript">
					<!--
						alert("ģ����³ɹ�");
					//-->
					</SCRIPT>';
				}
			}
			deletef('setting');
			sheader('index.php?con=admin&act=setting&type='.$type,3,'�޸ĳɹ�','redirect',true);
		}
	}
	//��Ա�б�
	function normaluser_action()
	{
		$showpage=array('isshow'=>1,'currentpage'=>intval($_REQUEST['page']),'pagesize'=>20,'url'=>'index.php?con=admin&act=normaluser','example'=>2);
		$userlist=$this->user->GetPage($showpage,'and usertype="normaluser"');
		include ROOT_PATH.'/views/admin/user.php';
	}
	//��վ���б�
	function siteuser_action()
	{
		$showpage=array('isshow'=>1,'currentpage'=>intval($_REQUEST['page']),'pagesize'=>20,'url'=>'index.php?con=admin&act=siteuser','example'=>2);
		$userlist=$this->user->GetPage($showpage,'and usertype="siteuser"');
		include ROOT_PATH.'/views/admin/user.php';
	}
	//����Ա�б�
	function adminuser_action()
	{
		$showpage=array('isshow'=>1,'currentpage'=>intval($_REQUEST['page']),'pagesize'=>20,'url'=>'index.php?con=admin&act=adminuser','example'=>2);
		$userlist=$this->user->GetPage($showpage,'and usertype="adminuser"');
		include ROOT_PATH.'/views/admin/user.php';
	}
	//��վ�ύ��Ա�б�
	function nulluser_action()
	{
		$showpage=array('isshow'=>1,'currentpage'=>intval($_REQUEST['page']),'pagesize'=>20,'url'=>'index.php?con=admin&act=nulluser','example'=>2);
		$userlist=$this->user->GetPage($showpage,'and usertype="nulluser"');
		include ROOT_PATH.'/views/admin/user.php';
	}
	//���ɻ�Ա��վ
	function addusersite_action()
	{
		$uid=intval($_GET['uid']);
		if($uid)
		{
			$userinfo=$this->user->GetOne('and uid='.$uid);
			$site=$this->site->GetOne('and sitename="'.$userinfo['sitename'].'"');
			if(!$site && $userinfo['sitename'] && $userinfo['siteurl'])
			{
				$data['sitename']=$userinfo['sitename'];
				$data['siteurl']=substr($userinfo['siteurl'],0,4)=='http'?trim($userinfo['siteurl']):'http://'.$userinfo['siteurl'];
				$data['siteapi']=substr($userinfo['siteapi'],0,4)=='http'?trim($userinfo['siteapi']):'http://'.$userinfo['siteapi'];
				$data['cityid']=Pinyin($userinfo['cityid']);
				$data['pinyin']=get_letter($data['sitename']);
				if($this->site->InsertData($data))
				{
					if($userinfo['usertype']=='nulluser')
					{
						$this->user->DeleteData('1 and uid='.$uid);
					}
					else
					{
						$this->user->UpdateData(array('sitename'=>$userinfo['sitename'].'-�Ѳ���'),'and uid='.$uid);
					}
					deletef('site');
					exit('<SCRIPT LANGUAGE="JavaScript">
			<!--
				alert("��վ��ӳɹ�");
			//-->
			</SCRIPT>');
				}
				else
				{
					exit('<SCRIPT LANGUAGE="JavaScript">
			<!--
				alert("��վ���ʧ��");
			//-->
			</SCRIPT>');
				}
			}
			else
			{
				exit('<SCRIPT LANGUAGE="JavaScript">
			<!--
				alert("���д���վ");
			//-->
			</SCRIPT>');
			}
		}
		else
		{
			exit('<SCRIPT LANGUAGE="JavaScript">
			<!--
				alert("�û���Ϊ��");
			//-->
			</SCRIPT>');
		}
	}
	/**
	*��ӻ�Ա
	*/
	function usermodify_action()
	{
		$updateid=$_REQUEST['updateid'];
		$user=array();
		if(submitcheck('commit'))
		{
			$data['sitename']=trim(strip_tags($_POST['sitename']));
			$data['siteurl']=substr($_POST['siteurl'],0,4)=='http'?trim($_POST['siteurl']):'http://'.$_POST['siteurl'];
			$data['siteapi']=substr($_POST['siteapi'],0,4)=='http'?trim($_POST['siteapi']):'http://'.$_POST['siteapi'];
			$data['cityid']=trim($_POST['sitecity']);
			$data['usertype']=trim($_POST['usertype']);
			$data['email']=trim(strip_tags($_POST['email']));
			
			$data['connect_user']=trim(strip_tags($_POST['connect_user']));
			$data['connect_type']=trim(strip_tags($_POST['connect_type']));
			$data['connect_content']=trim(strip_tags($_POST['connect_content']));
			$data['intro']=trim(strip_tags($_POST['intro']));
			$data['updatetime']=time();
			$usertype=array('adminuser','nulluser','siteuser','normaluser');
			$uback=in_array($_POST['usertype'],$usertype)?$_POST['usertype']:'normaluser';
			if($updateid>0)
			{
				if($_POST['password'])
				{
					$data['pwd']=md52($_POST['password']);
				}
				if($this->user->UpdateData($data,'and uid='.$updateid))
				{
					sheader('index.php?con=admin&act='.$uback,3,'�޸ĳɹ�','redirect',true);
				}
			}
			else
			{
				$data['pwd']=md52($_POST['password']);
				if($this->user->InsertData($data))
				{
					sheader('index.php?con=admin&act='.$uback,3,'��ӳɹ�','redirect',true);
				}
			}
		}
		else
		{
			if($updateid)
			{
				$user=$this->user->GetOne('and uid='.$updateid);
			}
			include ROOT_PATH.'/views/admin/user_form.php';
		}
	}
	//��վ����
	function guestbook_action()
	{
		$guestbook=new common('guestbook');
		$showpage=array('isshow'=>1,'currentpage'=>intval($_REQUEST['page']),'pagesize'=>20,'url'=>'index.php?con=admin&act=guestbook','example'=>2);
		$booklist=$guestbook->GetPage($showpage);
		include ROOT_PATH.'/views/admin/guestbook.php';
	}
//��������
function link_action()
{
	$link=new common('link');
		$showpage=array('isshow'=>1,'currentpage'=>intval($_REQUEST['page']),'pagesize'=>20,'url'=>'index.php?con=admin&act=link','example'=>2);
		$linklist=$link->GetPage($showpage);
		include ROOT_PATH.'/views/admin/link.php';
}
//���������޸�
	function linkmodify_action()
{
	$updateid=$_REQUEST['updateid'];
		$link_mod=new common('link');
		if(submitcheck('commit'))
		{
			$data['title']=trim(strip_tags($_POST['title']));
			$data['url']=substr($_POST['url'],0,4)=='http'?trim($_POST['url']):'http://'.$_POST['url'];
			$data['dec']=trim(strip_tags($_POST['dec']));
			$data['type']=intval($_POST['type']);
			
			if($_FILES['thumb']['name'])
			{
				$data['thumb']=_upload('thumb','data/upload/tempimg');
			}
			if($updateid>0)
			{
				if($link_mod->UpdateData($data,'and id='.$updateid))
				{
					deletef('link');
					sheader('index.php?con=admin&act=link',3,'�޸ĳɹ�','redirect',true);
				}
			}
			else
			{
				if($link_mod->InsertData($data))
				{
					deletef('link');
					sheader('index.php?con=admin&act=link',3,'��ӳɹ�','redirect',true);
				}
			}
		}
		else
		{
			if($updateid)
			{
				$link=$link_mod->GetOne('and id='.$updateid);
			}
			include ROOT_PATH.'/views/admin/link_form.php';
		}
}

	function admin_ajax_action()
	{
		$key=empty($_GET['primarykey'])?'id':$_GET['primarykey'];
		
		if(empty($_GET['table']))
		{
			echo '��������';
			exit;
		}
		elseif(empty($_GET['field']))
		{
			echo '�ֶ�Ϊ��';
			exit;
		}
		
		elseif(intval($_GET['primary'])==0)
		{
			echo '��������Ϊ0';
			exit;
		}
		
		else
		{
			$obj=new common($_GET['table']);
			if(in_array($_GET['table'],array('site','city','link','sitecate')))
			{
				deletef($_GET['table']);
			}
			if($_GET['table']=='catelist')
			{
				deletef('cate');
			}
			$data[$_GET['field']]=charset_encode($_GET['val'],$GLOBALS['charset'],'utf-8');
			$container="and ".$key."=".intval($_GET['primary']);
			
			$group=$obj->GetOne($container);
			
			if($group && $obj->UpdateData($data,$container,true))
			{
				exit('1');
			}
			else
			{
				exit('failed');
			}
		}
	}
	function admin_delete_action()
	{
		$key=empty($_GET['key'])?'id':$_GET['key'];
		if(empty($_GET['table']))
		{
			echo '��������';
			exit;
		}
		elseif(empty($_GET['val']))
		{
			echo '�ֶ�ֵΪ��';
			exit;
		}
		else
		{
			$val=charset_encode($_GET['val'],$GLOBALS['charset'],'utf-8');
			$container="and $key='".trim($val)."'";
			$obj=new common($_GET['table']);
			if(in_array($_GET['table'],array('site','city','sitecate')))
			{
				deletef($_GET['table']);
			}
			if($_GET['table']=='catelist')
			{
				deletef('cate');
			}
			$group=$obj->GetOne($container);
			if($group && $obj->DeleteData('1 '.$container))
			{
				exit('1');
			}
			else
			{
				exit('failed');
			}
		}

	}
	//��ջ���
	function delcache_action()
	{
		$dofile=cleancache();
		if($dofile==='nowrite')
		{
			echo '<SCRIPT LANGUAGE="JavaScript">
			<!--
				parent.showDiglog("'.$GLOBALS['setting']['site_cache_dir'].'Ŀ¼�޸�Ȩ�޲���,����ϵ������");
			//-->
			</SCRIPT>';
		}
		elseif(!$dofile)
		{
			echo '<SCRIPT LANGUAGE="JavaScript">
			<!--
				parent.showDiglog("��ջ���ʧ��,����ftp���ֶ����");
			//-->
			</SCRIPT>';
		}
		else
		{
			echo '<SCRIPT LANGUAGE="JavaScript">
			<!--
				parent.showDiglog("��ջ���ɹ�");
			//-->
			</SCRIPT>';
		}
	}
	//���ϵͳ����
	function delcompile_action()
	{
		$dofile=cleancache('','data/compile');
		if($dofile==='nowrite')
		{
			echo '<SCRIPT LANGUAGE="JavaScript">
			<!--
				parent.showDiglog("data/compileĿ¼�޸�Ȩ�޲���,����ϵ������");
			//-->
			</SCRIPT>';
		}
		elseif(!$dofile)
		{
			echo '<SCRIPT LANGUAGE="JavaScript">
			<!--
				parent.showDiglog("���ϵͳ����ʧ��,����ftp���ֶ����");
			//-->
			</SCRIPT>';
		}
		else
		{
			echo '<SCRIPT LANGUAGE="JavaScript">
			<!--
				parent.showDiglog("���ϵͳ����ɹ�");
			//-->
			</SCRIPT>';
		}
	}
	//�����ʼ�
	function testmail_action()
	{
		include ROOT_PATH.'/models/email.php';
		$email['smtp']=$_POST['test_email_smtp'];
		$email['port']=$_POST['test_email_port'];
		$email['account']=$_POST['test_email_user'];
		$email['pass']=$_POST['test_email_password'];
		$email['email']=$_POST['test_email'];
		
		$email_mod=new email($email);
		if($email_mod->send($_POST['get_email'],$email['email'],'���Ա���','���ã�����'.$GLOBALS['title'].'һ������ʼ�'))
		{
			echo "<script language='javascript'>alert('���ͳɹ�');</script>";
		}
		else
		{
			echo "<script language='javascript'>alert('����ʧ��');</script>";
		}
	}
	
	/**
	*ɾ��ͼƬ
	*/
	function deleteImg_action()
	{
		$val=$_GET['img'];
		if(is_file($val))
		{
			if(unlink($val))
			{
				exit('1');
			}
			else
			{
				exit('�ļ��޷�ɾ��,����Ȩ��');
			}
		}
		else
		{
			exit('�ļ��޷�ɾ��,�����ڴ��ļ�');
		}
	}
	/*--------------------------------------------------------------------
	*����������
	------------------------------------------------------------------------*/
	//�õ���վ����
	function _getSiteCate($cate)
	{
		if(is_int($cate))
		{
			return intval($cate);
		}
		elseif(!empty($cate))
		{
			if($GLOBALS['sitecate'])
			{
				foreach($GLOBALS['sitecate'] as $k=>$v)
				{
					if($v['sitecatename']==$cate)
					{
						return $k;
					}
				}
				return 1;
			}
			return 1;
		}
		return 1;
	}
	//�õ���Ʒ����
	function _getByCate($cate)
	{
		if(is_int($cate))
		{
			return intval($cate);
		}
		elseif(!empty($cate))
		{
			if($GLOBALS['cate'])
			{
				foreach($GLOBALS['cate'] as $k=>$v)
				{
					if($v['catename']==$cate)
					{
						return $k;
					}
				}
				return 0;
			}
			return 0;
		}
		return 0;
	}
	//ͳ�Ƹ���
	function _fileCount($dir)
	{
		$d=scandir($dir);

		foreach($d as $k=>$v)
		{
			if($v!='.' && $v!='..')
			{
				$nd=$dir.'/'.$v;
				if(is_file($nd))
				{
					
					$this->filelist[]=$nd;
					$this->filelist['count']+=filesize($nd);
				}
				elseif(is_dir($nd))
				{
					$this->_fileCount($nd);
				}
			}
		}
	}
	//ͳ�ƻ�Ա
	function _userCount()
	{
		$user=$this->user->GetPage(array('isshow'=>0));
		$usercount=array();
		foreach($user as $k=>$v)
		{
			if($v['usertype']=='siteuser')
			{
				$usercount['siteuser']++;
			}
			else
			{
				$usercount['normaluser']++;
			}
		}
		return $usercount;
	}
	//ͳ����վ��
	function _siteCount()
	{
		$site=$this->site->GetPage(array('isshow'=>0));
		$sitecount=array();
		foreach($site as $k=>$v)
		{
			if($v['sitetype']==1)
			{
				$sitecount['best']++;
			}
			else
			{
				$sitecount['amount']++;
			}
		}
		return $sitecount;
	}
	
	//�Զ����
	function _autoInsertGroup($ids)
	{
		$container=$ids==-1?'and id>0':'and id in ('.($ids?$ids:0).')';
		$data=$this->tempsite->GetPage(array('isshow'=>0),$container);
		set_time_limit(0);
		foreach($data as $k=>$v)
		{
			$o=$v['oldprice']>0?$v['oldprice']:1;
			$data[$k]['discount']=intval($v['nowprice']*100/$v['oldprice'])/10;
			$newtime=explode('+',$v['lasttime']);
			$startnewtime=explode('+',$v['starttime']);
			$data[$k]['grouptype']=$grouptype;
			$data[$k]['cityname']=$v['cityname']?$v['cityname']:'����';
			$data[$k]['cityid']=$v['cityname']?Pinyin($v['cityname']):'qita';
			$lasttime=str_replace('��','',str_replace('��','-',str_replace('��','-',trim($newtime[0]))));
			$lasttime=str_replace('��','',str_replace('��',':',str_replace('ʱ',':',$lasttime)));
			$starttime=str_replace('��','',str_replace('��','-',str_replace('��','-',trim($startnewtime[0]))));
			$starttime=str_replace('��','',str_replace('��',':',str_replace('ʱ',':',$starttime)));
			$data[$k]['lasttime']=strtotime($lasttime)>0?strtotime($lasttime):$lasttime;
			$data[$k]['starttime']=strtotime($starttime)>0?strtotime($starttime):$starttime;
			$data[$k]['ispassed']=$GLOBALS['setting']['site_allow_passed']?1:0;
			if($v['thumb'])
			{
				if($GLOBALS['allowremote'])
				{
					
					$thumb=$this->curl->get($v['thumb']);
					if($thumb)
					{
						$file=explode('.',$v['thumb']);
						$dir='data/upload/'.date('Y/m');
						mkdir2(ROOT_PATH.'/'.$dir);
						$stuff=str_replace('/','',$file[count($file)-1]);
						if(!in_array(substr($stuff,4),array('jpeg','png','jpg','gif')))
						{
							$stuff='jpg';
						}
						$file=md52(microtime()).'.'.$stuff;
						writefile(ROOT_PATH.'/'.$dir.'/'.$file,$thumb);
						$data[$k]['thumb']=$dir.'/'.$file;
					}
					else
					{
						$data[$k]['thumb']=$v['thumb'];
					}
				}
			}
			
		}
		
		foreach($data as $k=>$v)
		{
			$group=$this->group->GetOne('and subject="'.global_addslashes($v['subject']).'" and siteid='.$v['siteid']);
			
			if(!$group)
			{
				unset($v['id']);
				$this->group->InsertData($v);
			}
		}
		$this->tempsite->DeleteData('1 '.$container);
		sleep(1);
	}
}
