<?php
/*
	[Phpup.Net!] (C)2009-2011 Phpup.net.
	This is NOT a freeware, use is subject to license terms

	$Id: page.class.php 2010-08-24 10:42 $
*/

if(!defined('IN_PHPUP')) {
	exit('Access Denied');
}
/**
 *���ŷ�ҳ��
 *����:������(phpup.net)
 *����:ͨ�÷�ҳ����
 *------------------------------------------------------------------------------------------------
$sql="select * from ��";
$query=mysql_query($sql);
$nums=mysql_num_rows($query);
$page=new page($nums);
$page->setPage();
$page->url="";
$button=$page->setFormatPage();
$page->parseVal();
$str="����:".$page->count." ��ҳ��:".$page->total." ÿҳ:".$page->pageSize." ��ǰҳ".$page->absolutePage." <A HREF='".$page->url."=0'>��ҳ</A>";
$str.="<A HREF='".$page->url."=".$page->prevPage."'>��һҳ</A>";
foreach($button as $key=>$v)
{
	if($v==$page->absolutePage)
	{
		$str.="<span>".($v+1)."</span>";
	}
	else
	{
		$str.="<a href='".$page->url."=".$v."'>".($v+1)."</a>";
	}
}
$str.="<A HREF='".$page->url."=".$page->nextPage."'>��һҳ</A> <A HREF='".$page->url."=".$page->total."'>βҳ</A>";
echo $str;
 *-------------------------------------------------------------------------------------------------
*/
class page
{
	var $count=0; //�б�������,�����Զ���
	var $total=0; //��ҳ��,���ø���,�Զ�����
	var $absolutePage=0; //��ǰҳ
	var $pageSize=30; //ÿҳ����
	var $getVal='page'; //ͨ���ⲿ�������Ĳ������� 
	var $url=''; //��ַ,�ں�����Զ����ϲ���
	var $pageShowButton=14; //��ʾ������ťҳ������
	function page($count)
	{
		$this->count=$count;
	}
	//���ط�ҳ���
	function setPage()
	{
		$this->pageSize=$this->pageSize>0?$this->pageSize:30;
		$this->absolutePage=abs(intval(!empty($_REQUEST[$this->getVal])?$_REQUEST[$this->getVal]:0));
		$this->total=ceil($this->count/$this->pageSize);
		if($this->absolutePage>0)
		{
			$this->prevPage=$this->absolutePage<$this->total?($this->absolutePage-1<0?0:$this->absolutePage-1):($this->total-1<0?0:$this->total-1);
		}
		else
		{
			$this->prevPage=0;
		}

		if($this->absolutePage<$this->total)
		{
			$this->nextPage=$this->absolutePage+1;
		}
		else
		{
			$this->nextPage=$this->total;
		}
	}
	
	//�õ���ʽ�ֵķ�ҳ
	function setFormatPage()
	{
		$result=array();
		$pageshow=$this->pageShowButton;
		$center=ceil($pageshow/2);
		
		if($this->absolutePage<$center)
		{
			$left=0;
			if($pageshow<=$this->total)
			{
				$right=$pageshow;
			}
			else
			{
				$right=$this->total;
			}
		}
		elseif($this->absolutePage>=$center)
		{
			
			if($this->absolutePage+$center<=$this->total)
			{
				$right=$this->absolutePage+$center;
				$left=$this->absolutePage-$center>0?$this->absolutePage-$center:0;
			}
			elseif($this->absolutePage+$center>$this->total)
			{
				$right=$this->total;
				$left=$this->total-$pageshow>0?$this->total-$pageshow:0;
			}
		}
		for($i=$left;$i<$right;$i++)
		{
			$result[]=$i;
		}
		return $result;
	}
	//����url
	function parseVal()
	{
		if(strpos('a'.$this->url,'?')>0)
		{
			$de='&';
		}
		else
		{
			$de='?';
		}
		$this->url=$this->url.$de.$this->getVal;
	}
	
	
}