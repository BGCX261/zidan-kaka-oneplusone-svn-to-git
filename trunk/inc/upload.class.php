<?php
/*
	[Phpup.Net!] (C)2009-2011 Phpup.net.
	This is NOT a freeware, use is subject to license terms

	$Id: upload.class.php 2010-08-24 10:42 $
*/
/**
 *图片/文件上传类
 *作者:李孟琦(phpup.net)
 *功能:上传间个文件并提示错误
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
	//检查文件
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
	//检查是否有上传的文件
	function checkIsFile()
	{
		if(empty($_FILES[$this->handle]['name']))
		{
			return false;
		}
		return true;
	}
	
	//检查文件类型
	function checkType()
	{
		
		if(!empty($_FILES[$this->handle]['type']) && in_array(strtolower($_FILES[$this->handle]['type']),$this->stuffix))
		{
			$this->error.="";
		}
		else
		{
			$this->error.="不允许上传的文件类型\n".strtolower($_FILES[$this->handle]['type']);
		}
	}
	//检查文件尺寸
	function checkSize()
	{
		if($_FILES[$this->handle]['size']>$this->max_upload)
		{
			$this->error.="文件大小不能超过".($this->max_upload/1024/1024)."M。 \n";
		}
		elseif($_FILES[$this->handle]['size']>0)
		{
			$this->error.="";
		}
	}
	//上传文件
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
				$this->error.="未上传成功可能原因:\n";
				if(!is_dir($this->updir))
				{
					$this->error.=$this->updir."目录不存在\n";
				}
				elseif(!is_writeable($this->updir))
				{
					$this->error.=$this->updir."目录没有写权限\n";
				}
				$this->showmessage();
				return false;
			}
		}
		return false;
	}
	
	//上传错误信息
	function checkStatus()
	{
		switch($_FILES[$this->handle]['error'])
		{
			case 1:
				$this->error.="UPLOAD_ERR_INI_SIZE:上传的文件超过了 php.ini 中 upload_max_filesize 选项限制的值。 \n";
			break;
			case 2:
				$this->error.="UPLOAD_ERR_FORM_SIZE:上传文件的大小超过了 HTML 表单中 MAX_FILE_SIZE 选项指定的值。\n";
			break;
			case 3:
				$this->error.="UPLOAD_ERR_PARTIAL:文件只有部分被上传\n";
			break;
			case 4:
				$this->error.="UPLOAD_ERR_NO_FILE:没有文件被上传。\n";
			break;
			case 6:
				$this->error.="UPLOAD_ERR_NO_TMP_DIR:找不到临时文件夹。\n";
			break;
			case 7:
				$this->error.="UPLOAD_ERR_CANT_WRITE:文件写入失败。\n";
			break;
			default:
				$this->error.="";
			break;
		}
	}
	//输出错误信息
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
	//得到文件后缀
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
	//新建文件名(重复的概率很小)
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
		$this->fname=array(substr($this->fname,0,20),$_FILES[$this->handle]); //返回上传后的文件，和原图片的信息
	}
	//缩略图
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