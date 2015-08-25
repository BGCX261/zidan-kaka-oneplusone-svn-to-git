<?php
/*
	[Phpup.Net!] (C)2009-2011 Phpup.net.
	This is NOT a freeware, use is subject to license terms

	$Id: user.class.php 2010-08-24 10:42 $
*/

if(!defined('IN_PHPUP')) {
	exit('Access Denied');
}
define('CURSCRIPT','member');
class user_controller
{
	function user_controller()
	{
		include ROOT_PATH.'./models/common.php';
		include ROOT_PATH.'./models/email.php';
		$this->user=new common('user');
		$this->group=new common('groups');
		$this->email=new email();
	}
	function index_action()
	{
		include template('member');
	}
	function register_action()
	{
		if(submitcheck('commit'))
		{
			$data['email']=trim($_POST['name']);
			$data['pwd']=md52($_POST['pwd']);
			$data['sitename']=trim($_POST['wang_name']);
			$data['siteurl']=trim($_POST['url']);
			$data['siteapi']=trim($_POST['api_url']);
			$data['cityid']=trim($_POST['cityid']);
			$data['connect_user']=trim($_POST['content_name']);
			$data['connect_type']=trim($_POST['contact1']);
			$data['connect_content']=trim($_POST['contact2']);
			$data['intro']=trim($_POST['info']);
			$data['updatetime']=$GLOBALS['timestamp'];
			$user=$this->user->GetOne('and uid>0');
			if($user)
			{
				$data['usertype']=isset($_POST['check'])?'siteuser':'normaluser';
			}
			else
			{
				$data['usertype']='adminuser';
			}
			if($uid=$this->user->InsertData($data))
			{
				$GLOBALS['session']->set(array('uid'=>$uid,'username'=>$data['email']));
				sheader(url('index'),3,'ע��ɹ�,����ת����ҳ');
			}
			else
			{
				sheader(url('user','register'),3,'δע��ɹ�');
			}
		}
		else
		{
			include template('register');
		}
	}

	function login_action()
	{
		if(submitcheck('commit'))
		{
			$data['email']=global_addslashes(trim($_POST['user_name']));
			$data['pwd']=md52($_POST['pwd']);
			$user=$this->user->GetOne('and email="'.$data['email'].'" and pwd="'.$data['pwd'].'" and usertype!="nulluser"');
			if($user)
			{
				if($user['usertype']=='adminuser')
				{
					$GLOBALS['session']->set(array('adminid'=>$user['uid'],'username'=>$user['email']));
					exit('<SCRIPT LANGUAGE="JavaScript">
					<!--
						window.open("index.php?con=admin","_top","");
					//-->
					</SCRIPT>');
				}
				else
				{
				$GLOBALS['session']->set(array('uid'=>$user['uid'],'username'=>$user['email']));
				sheader($_POST['referer']?$_POST['referer']:'index.php',3,'��¼�ɹ�');
				}
			}
			else
			{
				sheader(url('user','login'),3,'��¼ʧ�ܣ������µ�¼');
			}
		}
		else
		{
			$referer=dreferer();
			include template('login');
		}
	}
	function logout_action()
	{
		$GLOBALS['session']->destroy(array('uid'=>$user['uid'],'username'=>$user['email']));
		sheader(url('index','index'),3,'�ɹ��˳�ϵͳ');
	}
	function forget_action()
	{
		
		if(submitcheck('commit'))
		{
			$email=trim($_POST['email']);
			$user=$this->user->GetOne('and email="'.$email.'"');
			$newpassword=substr(md5(microtime()),6,8);
			if($user)
			{
				$content="���ã���л����".$GLOBALS['title']."��֧�֣������������Ϊ".$newpassword.",���¼<A HREF='".SITE_ROOT."' target='_blank'>".SITE_ROOT."</A>,��������";
				$this->email->send($email,'',$GLOBALS['title'].'��Ա�һ�����',$content);
				$this->user->UpdateData(array('pwd'=>md52($newpassword)),'and uid='.$user['uid']);
				sheader(url('user','login'),3,'�����ѷ��͵�������뼰ʱ�鿴');
			}
			else
			{
				sheader(url('user','forget'),3,'û�д��û�');
			}
		}
		else
		{
			include template('forget');
		}
	}
	function addgroup_action()
	{
		if(!$GLOBALS['session']->get('uid'))
		{
			sheader(url('user','login'));
		}
		$updateid=intval($_REQUEST['updateid']);
		$group=array();
		if($updateid)
		{
			$group=$this->group->GetOne('and id='.$updateid);
		}
		
		if(submitcheck('commit'))
		{
			$userinfo=$this->user->GetOne('and uid='.$GLOBALS['session']->get('uid'));
			$data['subject']=strip_tags(trim($_POST['title']));
			$data['groupsite']=$userinfo['sitename'];
			$data['oldprice']=floatval($_POST['yuan_money'])?floatval($_POST['yuan_money']):100;
			$data['nowprice']=floatval($_POST['now_money']);
			$data['url']=strip_tags(trim($_POST['url']));
			$data['discount']=intval($data['nowprice']*100/$data['oldprice'])/10;
			$data['lasttime']=strtotime($_POST['over_date']);
			$data['grouptype']=intval($_POST['class_id']);
			$cityinfo=explode('-',$_POST['city']);
			$data['cityid']=$cityinfo[0];
			$data['cityname']=$cityinfo[1];
			$data['keyword']=strip_tags(trim($_POST['key_word']));
			$data['userid']=$userinfo['uid'];
			if($_FILES['file_img']['error']==0)
			{
				$data['thumb']=_upload('file_img',$GLOBALS['uploaddir'].'/'.date('Y/m'));
				if($group && $group['thumb']){unlink($group['thumb']);}
			}
			if($updateid)
			{
				if($group['userid']==$GLOBALS['session']->get('uid'))
				{
					if($group['ispassed'])
					{
						sheader(url('user','grouplist'),3,'�����ͨ���ˣ��������޸�','member_redirect');
					}
					else
					{
						
						if($this->group->UpdateData($data,'and id='.$updateid))
						{
							sheader(url('user','grouplist'),3,'���ݸ��³ɹ�����ȴ�����Ա���','member_redirect');
						}
						else
						{
							sheader(url('user','grouplist'),3,'����δ���κθı�','member_redirect');
						}
					}
				}
				else
				{
					sheader(url('user','grouplist'),3,'���޴�Ȩ��','member_redirect');
				}
			}
			else
			{
				$data['updatetime']=$GLOBALS['timestamp'];
				if($this->group->InsertData($data))
				{
					sheader(url('user','grouplist'),3,'������ӳɹ�����ȴ�����Ա���','member_redirect');
				}
				else
				{
					sheader(url('user','grouplist'),3,'�������ʧ��','member_redirect');
				}
			}
		}
		else
		{
			if($group && $group['ispassed'])
			{
				sheader(url('user','grouplist'),3,'�����ͨ���ˣ��������޸�','member_redirect');
			}
			if($group && $group['userid']!=$GLOBALS['session']->get('uid'))
			{
				sheader(url('user','grouplist'),3,'���޴�Ȩ��','member_redirect');
			}
			include template('member_tuan');
		}
	}
	function grouplist_action()
	{
		if(!$GLOBALS['session']->get('uid'))
		{
			sheader(url('user','login'));
		}
		$showpage=array('isshow'=>1,'currentpage'=>intval($_REQUEST['page']),'pagesize'=>20,'url'=>url('user','grouplist'),'example'=>1);
		$group=$this->group->GetPage($showpage,'and userid='.$GLOBALS['session']->get('uid'));
		include template('member_tuanlist');
	}
	function baseinfo_action()
	{
		if(!$GLOBALS['session']->get('uid'))
		{
			sheader(url('user','login'));
		}
		$container="and uid=".$GLOBALS['session']->get('uid');
		if(submitcheck('commit'))
		{
			$data['sitename']=trim(strip_tags($_POST['sitename']));
			$data['siteurl']=trim(strip_tags($_POST['siteurl']));
			$data['siteapi']=trim(strip_tags($_POST['siteapi']));
			$data['cityid']=trim(strip_tags($_POST['cityid']));
			$data['connect_user']=trim(strip_tags($_POST['connect_user']));
			$data['connect_type']=trim(strip_tags($_POST['connect_type']));
			$data['connect_content']=trim(strip_tags($_POST['connect_content']));
			$data['intro']=trim(strip_tags($_POST['intro']));
			if($this->user->UpdateData($data,$container))
			{
				sheader(url('user','baseinfo'),3,'�����޸ĳɹ�','member_redirect');
			}
			else
			{
				sheader(url('user','baseinfo'),3,'�����޸�ʧ��','member_redirect');
			}
		}
		else
		{
			$group=$this->user->GetOne($container);
			include template('member_baseinfo');
		}

	}

	function account_action()
	{
		if(!$GLOBALS['session']->get('uid'))
		{
			sheader(url('user','login'));
		}
		$container="and uid=".$GLOBALS['session']->get('uid');
		if(submitcheck('commit') && !empty($_POST['newpassword']))
		{
			if($_POST['newpassword']!=$_POST['newpassword1'])
			{
				sheader(url('user','account'),3,'�����������벻һ��','member_redirect');
			}
			else
			{
				$user=$this->user->GetOne($container.' and pwd="'.md52($_POST['password']).'"');
				if($user)
				{
					$data['pwd']=md52($_POST['newpassword']);
					if($this->user->UpdateData($data,$container))
					{
						sheader(url('user','account'),3,'�����޸ĳɹ�','member_redirect');
					}
					else
					{
						sheader(url('user','account'),3,'�����޸�ʧ��','member_redirect');
					}
				}
				else
				{
					sheader(url('user','account'),3,'�����޸�ʧ��,�û�������','member_redirect');
				}
			}
			
		}
		else
		{
			include template('member_account');
		}

	}

	function deletegroup_action()
	{
		if(!$GLOBALS['session']->get('uid'))
		{
			exit('nouser');
		}
		$delid=intval($_POST['delid']);
		if($delid)
		{
			$group=$this->group->GetOne('and id='.$delid);
			if($group['userid']!=$GLOBALS['session']->get('uid'))
			{
				exit('level');
			}
			if($this->group->DeleteData('1 and id='.$delid))
			{
				if($group && $group['thumb']){unlink($group['thumb']);}
				exit('success');
			}
		}
		else
		{
			exit('failed');
		}
	}
}
