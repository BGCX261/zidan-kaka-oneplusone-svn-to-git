<?php
/*
	[Phpup.Net!] (C)2009-2011 Phpup.net.
	This is NOT a freeware, use is subject to license terms

	$Id: upload.class.php 2010-08-24 10:42 $
*/
/**
 *ͼƬ/�ļ��ϴ���
 *����:������(phpup.net)
 *����:�ϴ�����ļ�����ʾ����
 *------------------------------------------------------------------------------------------------
 $up=new upload('userfile');
$up->updir="/var/www/html/upload";
if($up->checkFile())
{
	if($file=$up->execute())
	{
		echo "insert into thumb (aid,thumb,pic,pictitle,picsize,pictype,uploaddate) values(NULL,'$up->thumb_file','$file','".$up->fname[1]['name']."','".$up->fname[1]['size']."','".$up->fname[1]['type']."',".time().")";
	}
}
<form enctype="multipart/form-data" action="" method="POST">
    Send this file: <input name="userfile" type="file" />
    <input type="submit" value="Send File" />
</form>
 *-------------------------------------------------------------------------------------------------
*/


if(!defined('IN_PHPUP')) {
	exit('Access Denied');
}
class upload
{
	var $stuffix=array('image/jpg','image/gif','image/png','image/x-png',"image/pjpeg","image/jpeg","application/x-zip-compressed","application/octet-stream","application/x-shockwave-flash");
	var $max_upload=2097152000;
	var $updir='';
	var $handle;
	var $width=60;
	var $height=45;
	function upload($handle)
	{
		$this->handle=$handle;
	}
	//����ļ�
	function checkFile()
	{
		if($this->checkIsFile())
		{
			$this->checkStatus();
			$this->checkType();
			$this->checkSize();
			if(!empty($this->error))
			{
				$this->showmessage();
				return false;
			}
			return true;
		}
		return false;
	}
	//����Ƿ����ϴ����ļ�
	function checkIsFile()
	{
		if(empty($_FILES[$this->handle]['name']))
		{
			return false;
		}
		return true;
	}
	
	//����ļ�����
	function checkType()
	{
		
		if(!empty($_FILES[$this->handle]['type']) && in_array(strtolower($_FILES[$this->handle]['type']),$this->stuffix))
		{
			$this->error.="";
		}
		else
		{
			$this->error.="�������ϴ����ļ�����\n".strtolower($_FILES[$this->handle]['type']);
		}
	}
	//����ļ��ߴ�
	function checkSize()
	{
		if($_FILES[$this->handle]['size']>$this->max_upload)
		{
			$this->error.="�ļ���С���ܳ���".($this->max_upload/1024/1024)."M�� \n";
		}
		elseif($_FILES[$this->handle]['size']>0)
		{
			$this->error.="";
		}
	}
	//�ϴ��ļ�
	function execute($newfile='',$mkdir=true)
	{
		$this->newFileName($newfile);
		if($mkdir && !is_dir($this->updir))
		{
			mkdir2($this->updir);
		}
		$newfile=$newfile?trim(strip_tags($this->updir.'/'.$newfile)):trim($this->updir.'/'.$this->fname[0].'.'.$this->getStuffix());
		if(is_uploaded_file($_FILES[$this->handle]['tmp_name']))
		{
			if(function_exists('move_uploaded_file') && @move_uploaded_file($_FILES[$this->handle]['tmp_name'],$newfile))
			{
				@unlink($_FILES[$this->handle]['tmp_name']);
				return $newfile;
			}
			elseif(@copy($_FILES[$this->handle]['tmp_name'],$newfile))
			{
				@unlink($_FILES[$this->handle]['tmp_name']);
				return $newfile;
			}
			else
			{
				$this->error.="δ�ϴ��ɹ�����ԭ��:\n";
				if(!is_dir($this->updir))
				{
					$this->error.=$this->updir."Ŀ¼������\n";
				}
				elseif(!is_writeable($this->updir))
				{
					$this->error.=$this->updir."Ŀ¼û��дȨ��\n";
				}
				$this->showmessage();
				return false;
			}
		}
		return false;
	}
	
	//�ϴ�������Ϣ
	function checkStatus()
	{
		switch($_FILES[$this->handle]['error'])
		{
			case 1:
				$this->error.="UPLOAD_ERR_INI_SIZE:�ϴ����ļ������� php.ini �� upload_max_filesize ѡ�����Ƶ�ֵ�� \n";
			break;
			case 2:
				$this->error.="UPLOAD_ERR_FORM_SIZE:�ϴ��ļ��Ĵ�С������ HTML ���� MAX_FILE_SIZE ѡ��ָ����ֵ��\n";
			break;
			case 3:
				$this->error.="UPLOAD_ERR_PARTIAL:�ļ�ֻ�в��ֱ��ϴ�\n";
			break;
			case 4:
				$this->error.="UPLOAD_ERR_NO_FILE:û���ļ����ϴ���\n";
			break;
			case 6:
				$this->error.="UPLOAD_ERR_NO_TMP_DIR:�Ҳ�����ʱ�ļ��С�\n";
			break;
			case 7:
				$this->error.="UPLOAD_ERR_CANT_WRITE:�ļ�д��ʧ�ܡ�\n";
			break;
			default:
				$this->error.="";
			break;
		}
	}
	//���������Ϣ
	function showmessage($js=true)
	{
		if($js)
		{
			echo "<script language='javascript'>alert('".global_addslashes(str_replace("\n",'',$this->error))."');</script>";
			exit;
		}
		else
		{
			echo nl2br($this->error);
		}
	}
	//�õ��ļ���׺
	function getStuffix()
	{
		$stuff=strtolower($_FILES[$this->handle]['type']);
		$f=explode('/',$stuff);
		if(isset($f[1]))
		{
			switch($f[1])
			{
				case 'x-shockwave-flash':
					$f[1]='swf';
				break;
				case 'x-zip-compressed':
					$f[1]='zip';
				break;
				default:
					$f[1]=str_replace('x-png','png',str_replace('pjpeg','jpg',$f[1]));;
				break;
			}
		}
		elseif(!empty($f[0]))
		{
			$f[1]=substr($f[0],0,3);
		}
		else
		{
			$f[1]='tmp';
		}
		return $f[1];
	}
	//�½��ļ���(�ظ��ĸ��ʺ�С)
	function newFileName($filename='')
	{
		if($filename=='')
		{
			$this->fname=md5($_FILES[$this->handle]['tmp_name'].$_FILES[$this->handle]['size'].$_FILES[$this->handle]['name'].time());
		}
		else
		{
			$this->fname=$filename;
		}
		$this->fname=array(substr($this->fname,0,20),$_FILES[$this->handle]); //�����ϴ�����ļ�����ԭͼƬ����Ϣ
	}
	//����ͼ
	function setThumb($file,$thumb,$width=0,$height=0)
	{
		$type=getimagesize($file);
		switch($type['mime'])
		{
			case 'image/jpeg':
				$func="imagecreatefromjpeg";
				$func2="imagejpeg";
			break;
			case 'image/gif':
				$func="imagecreatefromgif";
				$func2="imagegif";
			break;
			case 'image/png':
				$func="imagecreatefrompng";
				$func2="imagepng";
			break;
			default:
				$func="imagecreatefromjpeg";
				$func2="imagejpeg";
			break;
		}
		$w=$width?$width:$this->width;
		$h=$height?$height:$this->height;
		$dst=imagecreatetruecolor($w,$h);
		$source=$func($file);
		imagecopyresized($dst,$source,0,0,0,0,$w,$h,$type[0],$type[1]);
		$func2($dst,$thumb);
	}
}