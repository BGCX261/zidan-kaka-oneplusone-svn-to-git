<?php
/*
	[Phpup.Net!] (C)2009-2011 Phpup.net.
	This is NOT a freeware, use is subject to license terms

	$Id: global.func.php 2010-08-24 10:42 $
*/

if(!defined('IN_PHPUP')) {
	exit('Access Denied');
}
header("content-type:text/html;charset=gbk");
//抓取百度天气预报
function _cityweather($cityname="宁波")
	{
		/*$pat_td = '(?:(?!<\/td>).)+';
		$pat_table = '(?:(?!<\/table>).)+';
		 
		$regex = '/<table cellspacing="0" cellpadding="0" class="al_wt"> <tr id="al_weather_l">  <td class="al_tr" >('.$pat_td.')<\/td> <td class="al_tr al_tl">('.$pat_td.')<\/td> <td class="al_tl">('.$pat_td.')<\/td>/';
		$html = file_get_contents('http://www.baidu.com/s?wd=' .$cityname. '天气');
		if (!preg_match($regex, $html, $matches)) {
			 $regex1 = '/<table cellspacing="0" cellpadding="0" class="al_wt">('.$pat_table.')<\/table>/';
			 $matches=array();
			 if (preg_match($regex1, $html, $matches1))
		     { 
			  $matches = explode("</td>", $matches1[1]);   
			  array_unshift($matches,"");
 
			 }

		}
		print_r($matches);die;echo "test";*/
	    $pat_td = '(?:(?!<\/td>).)+';
		$pat_table = '(?:(?!<\/table>).)+';
	 
		$regex = '/<table cellspacing="0" cellpadding="0" class="al_wt"> <tr id="al_weather_l">  <td class="得到 al_tr" >('.$pat_td.')<\/td> <td class="al_tr al_tl">('.$pat_td.')<\/td> <td class="al_tl">('.$pat_td.')<\/td>/';
		$html = file_get_contents('http://www.baidu.com/s?wd=宁波天气');
		if (!preg_match($regex, $html, $matches)) {
			 $regex1 = '/<table cellspacing="0" cellpadding="0" class="al_wt">('.$pat_table.')<\/table>/';
			 $matches=array();
			 if ( preg_match($regex1, $html, $matches1))
		     { 
			  $matches = explode("</td>", $matches1[1]);   
			  array_unshift($matches,"");
            
			 }

		}
		//print_r($matches);die('AAS');
		return $matches; 
	}
	//格式化百度抓取结果
 function change_htm($htm = "")
 {	
	   $matches = explode("<br>", $htm);
	   if(empty($matches[1])) $matches[1] = 0;
	   $matches1 = explode("/>", $matches[1]);
	   $arr_mat=array();
	   foreach( $matches as $k=>$v)
	   {
		 if(empty($matches1)) $matches1 = array("","","");
	     if($k==1)
		 {
			 if(!empty($matches1[1]))
			 {
		      $arr_mat[] = $matches1[0]."/>".$matches1[1] ."/>";
			   $arr_mat[] = $matches1[2];
			 }else
			 {
				  $arr_mat[] = $matches1[0]."/>";
				   $arr_mat[] = $matches1[1];
			 }
			 //$arr_mat[] = $matches1[2];
		 }
		  
		 else
		 {		 
		   $arr_mat[]=$v;
		 } 
	   }
	   
	   
       $matches ="";  
	   foreach($arr_mat as $k=>$v)
	   {
		 if($k==3)
		 {
			 $matches.=$v."|";  
		  }else
		  {
			$matches.=$v."<br>";  
		  }
		}
	  return  $matches;
 }
	//ip地址分析函数
	function get_ip_place()
	{   
		$ip=file_get_contents("http://fw.qq.com/ipaddress");   
		$ip=str_replace('"',' ',$ip);   
		$ip2=explode("(",$ip);   
		$a=substr($ip2[1],0,-2);   
		$b=explode(",",$a);   
		return $b;   
	}  
function stripslashes_deep($value) 
{ 
	if (get_magic_quotes_gpc()) 
	{ 
		$value = is_array($value) ? array_map('stripslashes_deep', $value) : stripslashes($value);
	}
	return $value; 
} 
function global_addslashes($string, $force = 1) 
{
	if($force)
	{
		$string=stripslashes_deep($string);
		if(is_array($string)) 
		{
			foreach($string as $key => $val) 
			{
				$string[$key] = global_addslashes($val, $force);
			}
		} 
		else 
		{
			$string = addslashes($string);
		}
	}
	else
	{
		$string=stripslashes_deep($string);
	}
	return $string;
}
//读取当地ip判断城市
function ip2city($ip, $ipdatafile,$currentCity) {

	static $fp = NULL, $offset = array(), $index = NULL;

	$ipdot = explode('.', $ip);
	$ip    = pack('N', ip2long($ip));

	$ipdot[0] = (int)$ipdot[0];
	$ipdot[1] = (int)$ipdot[1];

	if($fp === NULL && $fp = @fopen($ipdatafile, 'rb')) {
		$offset = unpack('Nlen', fread($fp, 4));
		$index  = fread($fp, $offset['len'] - 4);
	} elseif($fp == FALSE) {
		return 0;
	}

	$length = $offset['len'] - 1028;
	$start  = unpack('Vlen', $index[$ipdot[0] * 4] . $index[$ipdot[0] * 4 + 1] . $index[$ipdot[0] * 4 + 2] . $index[$ipdot[0] * 4 + 3]);

	for ($start = $start['len'] * 8 + 1024; $start <$length; $start += 8) {

		if ($index{$start} . $index{$start + 1} . $index{$start + 2} . $index{$start + 3} >= $ip) {
			$index_offset = unpack('Vlen', $index{$start + 4} . $index{$start + 5} . $index{$start + 6} . "\x0");
			$index_length = unpack('Clen', $index{$start + 7});
			break;
		}
	}

	fseek($fp, $offset['len'] + $index_offset['len'] - 1024);
	$cityresult=fread($fp, $index_length['len']);
	if($index_length['len']) {
		if($currentCity)
		{
			foreach($currentCity as $k=>$v)
			{
				if(strpos($cityresult,$v['cityname']))
				{
					return $k;
				}
			}
		}
		else
		{
			return '- '.$cityresult;
		}
	} else {
		return 0;
	}

}
//截取字符串
function sysSubStr($String,$Length,$Append = false)
{
    if (strlen($String)<=$Length )
    {
        return $String;
    }
    else
    {
        $I = 0;
        while ($I <$Length)
        {
            $StringTMP = substr($String,$I,1);
            if ( ord($StringTMP) >=224 )
            {
                $StringTMP = substr($String,$I,3);
                $I = $I + 3;
            }
            elseif( ord($StringTMP) >=192 )
            {
                $StringTMP = substr($String,$I,2);
                $I = $I + 2;
            }
            else
            {
                $I = $I + 1;
            }
            $StringLast[] = $StringTMP;
        }
        $StringLast = implode("",$StringLast);
        if($Append)
        {
            $StringLast .= "...";
        }
        return $StringLast;
    }
} 
//表前缀
function tname($table)
{
	global $dbname,$table_prefix;
	return '`'.$dbname.'`.`'.$table_prefix.$table.'`';
}
//md5加密
function md52($str)
{
	$str=substr(md5($str),3,20);
	return $str;
}


//读取文件内容
function readf($file)
{
	if(function_exists('file_get_contents'))
	{
		$content=file_get_contents($file);
	}
	else
	{
		$fp=fopen($file,'r');
		while(!feof($fp))
		{
			$content=fgets($fp,1024);
		}
		fclose($fp);
	}
	return $content;
}
//判断表单提交
function submitcheck($submitbutton)
{
	if(empty($_REQUEST[$submitbutton]))
	{
		return false;
	}
	else
	{
		return true;
	}
}


//取控制器中的变量
function _T($val)
{
	return isset($GLOBALS['views']->$val)?$GLOBALS['views']->$val:array();
}
//取全局变量
function _G($val)
{
	return isset($GLOBALS[$val])?$GLOBALS[$val]:array();
}
//错误
function messageError($message)
{
	exit($message);
}


//判断缓存时间
function checkfile($file,$cachetime=60)
{
	$file=ROOT_PATH.'/data/cache/'.$file.'.php';
	
	if(is_file($file))
	{
		if((filemtime($file)+$cachetime>time()) || !$cachetime)
		{
			return true; //不更新文件
		}
		else
		{
			return false;  //更新文件
		}
	}
	return false;
}
//写缓存内容
function write($file,$content)
{
	$file=ROOT_PATH.'/data/cache/'.$file.'.php';
	if(is_array($content))
	{
		$content=var_export($content,1);
	}
	else
	{
		$content='array()';
	}
	$content='<?php if(!defined("IN_PHPUP")){?>error<?php }?><?php $content='.$content.';?>';
	if(function_exists('file_put_contents'))
	{
		file_put_contents($file,$content);
	}
	else
	{
		$fp=fopen($file,'w');
		fwrite($fp,$content);
		fclose($fp);
	}
}
//写文件
function writefile($file,$content)
{
	if(function_exists('file_put_contents'))
	{
		return file_put_contents($file,$content);
	}
	else
	{
		$fp=fopen($file,'w');
		return fwrite($fp,$content);
		fclose($fp);
	}
}
//读文件
function read($file)
{
	$file=ROOT_PATH.'/data/cache/'.$file.'.php';
	include($file);
	return $content;
}
//删除文件
function deletef($file)
{
	$file=ROOT_PATH.'/data/cache/'.$file.'.php';
	@unlink($file);
}

//清空缓存
function cleancache($type='php',$mdir='')
{
	$path=$mdir?$mdir:($GLOBALS['cachedir']?$GLOBALS['cachedir']:'./data/cache');
	$path=ROOT_PATH.str_replace(ROOT_PATH,'',$path);
	if(!is_writable($path))
	{
		return 'nowrite';
	}
	$dir=scandir($path);
	$nullfile='';
	if($type)
	{
		foreach($dir as $k=>$v)
		{
			$newfile=$path.'/'.$v;
			if($v!='.' && $v!='..' && is_file($newfile))
			{
				if(strpos($newfile,$type))
				{
					$a=unlink($newfile);
					$nullfile.=$newfile;
				}
			}
		}
	}
	else
	{
		foreach($dir as $k=>$v)
		{
			$newfile=$path.'/'.$v;
			
			if($v!='.' && $v!='..' && is_file($newfile))
			{
				$a=unlink($newfile);
				$nullfile.=$newfile;
			}
		}
	}
	if(empty($nullfile))
	{
		return 'null';
	}
	else
	{
		return $a;
	}
}

//清除js和style
function clearJs($str)
{
	$str=str_replace('<style','<div class="limengqitemp" style="display:none"',$str);
	$str=str_replace('</style>','</div>',$str);
	$str=str_replace('<script','<div class="limengqitemp" style="display:none"',$str);
	$str=str_replace('</script>','</div>',$str);
	$str=str_replace("\n",'',$str);
	$str=str_replace("\r",'',$str);
	return $str;
}

//实现多种字符编码方式
function charset_encode($input,$_output_charset ,$_input_charset ="utf-8" ) {
	$output = "";
	if(!isset($_output_charset) )$_output_charset  = $GLOBALS['charset'];
	if($_input_charset == $_output_charset || $input ==null ) {
		$output = $input;
	} elseif (function_exists("mb_convert_encoding")){
		$output = mb_convert_encoding($input,$_output_charset,$_input_charset);
	} elseif(function_exists("iconv")) {
		$output = iconv($_input_charset,$_output_charset,$input);
	} else die("sorry, you have no libs support for charset change.");
	return $output;
}
//实现多种字符解码方式
function charset_decode($input,$_input_charset ,$_output_charset="utf-8"  ) {
	$output = "";
	if(!isset($_input_charset) )$_input_charset  = $GLOBALS['charset'];
	if($_input_charset == $_output_charset || $input ==null ) {
		$output = $input;
	} elseif (function_exists("mb_convert_encoding")){
		$output = mb_convert_encoding($input,$_output_charset,$_input_charset);
	} elseif(function_exists("iconv")) {
		$output = iconv($_input_charset,$_output_charset,$input);
	} else die("sorry, you have no libs support for charset changes.");
	return $output;
}

//按指定字数分组
function chunksplit($data)
{
	return chunk_split(base64_encode($data),20);
}
//得到头像
function avatar($uid=0,$type='small',$stuff='jpg')
{
	return is_file($GLOBALS['avatardir'].'/'.$type.'_avatar_'.$uid.'.'.$stuff)?$GLOBALS['avatardir'].'/'.$type.'_avatar_'.$uid.'.'.$stuff:'views/'.$GLOBALS['tpl'].'/images/noavatar_'.$type.'.gif';
}
//从内容中分出图片
function getUploadPic($content)
{
	
	$pattern=preg_match_all('/<img.*src=(.*)?>/im' ,$content,$match );
	return $match[1];
}
//建立目录
function mkdir2($dir)
{
	if(!is_dir(dirname($dir)))
	{
		mkdir2(dirname($dir));
	}
	return mkdir($dir);
}
//单个上传
function _upload($upfile,$uploaddir='',$customfile='',$thumbinfo=array())
{
	include ROOT_PATH.'/inc/upload.class.php';
	$up=new upload($upfile);
	$up->updir=$uploaddir?$uploaddir:$GLOBALS['uploaddir'];
	if($up->checkFile())
	{
		if($file=$up->execute($customfile))
		{
			if($thumbinfo)
			{
				$up->setThumb($file,$file,$thumbinfo['width'],$thumbinfo['height']);
			}
			$thumb=$file;
		}
	}
	return $thumb;
}
//批量上传
function _attach($upfile,$uploaddir='',$thumbinfo=array())
{
	$thumb=array();
	if($_FILES)
	{
		include ROOT_PATH.'/inc/upload.class.php';
		$count=count($_FILES[$upfile]['name']);
		foreach($_FILES[$upfile] as $k=>$v)
		{
			for($i=0;$i<$count;$i++)
			{
				$f['tmpupload'.$i][$k]=$v[$i];
			}
			
		}
		$_FILES=$f;
		
		
		foreach($f as $k=>$v)
		{
			$up=new upload($k);
			$up->updir=$uploaddir?$uploaddir:$GLOBALS['uploaddir'];
			if($up->checkFile())
			{
				if($file=$up->execute())
				{
					if($thumbinfo)
					{
						$up->setThumb($file,$file,$thumbinfo['width'],$thumbinfo['height']);
					}
					$thumb[]=$file;
				}
			}
		}
		
	}
	return $thumb;
}
//执行一般sql
function getData($sql)
{
	$cachefile=md52($sql);
	if(!checkfile($cachefile))
	{
		$data=array();
		$query=$GLOBALS['db']->query($sql);
		while($d=$GLOBALS['db']->fetch_array($query))
		{
			$data[]=$d;
		}
		write($cachefile,$data);
		return $data;
	}
	else
	{
		return read($cachefile);
	}
}
/*取出封面缩略图*/
function thumb($thumb)
{
	$t=explode(',',$thumb);
	return $t[0]?$t[0]:'data/nullproduct.jpg';
}
/*生成url*/
function url($con='index',$act='index',$paramer=array())
{
	$url=SITE_ROOT;
	if($GLOBALS['rewrite'])
	{
		$url.='/'.$con.'/'.$act;
		
		if($paramer)
		{
			$p='';
			foreach($paramer as $k=>$v)
			{
				$p.='-'.$k.'_'.$v;
			}
			$url.='/'.substr($p,1).'.html';
		}
		else
		{
			$url.='/index.html';
		}
	}
	else
	{
		if($con=='index' && $act=='index')
		{
			$url.='/index.php';
		}
		else
		{
			$url.='/index.php?con='.$con.'&act='.$act;
		}
		if($paramer)
		{
			$p='';
			foreach($paramer as $k=>$v)
			{
				$p.='&'.$k.'='.$v;
			}
			if(strpos($url,'?'))
			{
				$url.=$p;
			}
			else
			{
				$url.='?'.substr($p,1);
			}
		}
	}
	return $url;
}
function template($file, $templateid = 0, $tpldir = '') {
	
	$tpldir = $tpldir ? $tpldir : 'views/'.TPLDIR;
	$templateid = $templateid ? $templateid : TEMPLATEID;
	$tplfile = ROOT_PATH.'./'.$tpldir.'/'.$file.'.htm';
	$file == 'header' && CURSCRIPT && $file = 'header_'.CURSCRIPT;
	$filebak = $file;
	$objfile = ROOT_PATH.'./data/'.COMPILEDIR.'/'.STYLEID.'_'.$templateid.'_'.$file.'.tpl.php';
	if($templateid != 1 && !file_exists($tplfile)) {
		$tplfile = ROOT_PATH.'./views/default/'.$filebak.'.htm';
	}
	checktplrefresh($tplfile, $tplfile, filemtime($objfile), $templateid, $tpldir);

	return $objfile;
}

function checktplrefresh($maintpl, $subtpl, $timecompare, $templateid, $tpldir) {
	global $tplrefresh;
	
	if(empty($timecompare) || $tplrefresh == 1 || ($tplrefresh > 1 && !($GLOBALS['timestamp'] % $tplrefresh))) {
		
		if(empty($timecompare) || @filemtime($subtpl) > $timecompare) {
			require_once ROOT_PATH.'./inc/template.func.php';
			parse_template($maintpl, $templateid, $tpldir);
			return TRUE;
		}
	}
	
	return FALSE;
}
function language($var) {
	$vars = explode(':', $var);
	if(count($vars) != 2) {
		return "!$var!";
	}
	elseif(in_array($vars[0], array('templates'))) {
		@include_once ROOT_PATH.'./views/default/'.$vars[0].'.lang.php';
		$lang=$$vars[0];
		return $lang[$vars[1]];
	}
}
function dreferer($default = '') {
	global $referer, $indexname;

	$default = empty($default) ? $indexname : '';
	if(empty($referer) && isset($GLOBALS['_SERVER']['HTTP_REFERER'])) {
		$referer = preg_replace("/([\?&])((sid\=[a-z0-9]{6})(&|$))/i", '\\1', $GLOBALS['_SERVER']['HTTP_REFERER']);
		$referer = substr($referer, -1) == '?' ? substr($referer, 0, -1) : $referer;
	} else {
		$referer = dhtmlspecialchars($referer);
	}

	if(!preg_match("/(\.php|[a-z]+(\-\d+)+\.html)/", $referer) || strpos($referer,url('user','login'))) {
		$referer = $default;
	}
	return $referer;
}

function dhtmlspecialchars($string) {
	if(is_array($string)) {
		foreach($string as $key => $val) {
			$string[$key] = dhtmlspecialchars($val);
		}
	} else {
		$string = preg_replace('/&amp;((#(\d{3,5}|x[a-fA-F0-9]{4}));)/', '&\\1',
		//$string = preg_replace('/&amp;((#(\d{3,5}|x[a-fA-F0-9]{4})|[a-zA-Z][a-z0-9]{2,5});)/', '&\\1',
		str_replace(array('&', '"', '<', '>'), array('&amp;', '&quot;', '&lt;', '&gt;'), $string));
	}
	return $string;
}
function strexists($haystack, $needle) {
	return !(strpos($haystack, $needle)===FALSE);
}
function dexit($message)
{
	exit($message);
}

//页面转向
function sheader($url,$time=0,$message='',$template='redirect',$admin=false)
{
	if($time>0)
	{
		if($admin)
		{
			include(ROOT_PATH.'/views/admin/'.$template.'.php');
		}
		else
		{
			include template($template);
		}
	}
	else
	{
		//header("location:".$url);
		echo '<SCRIPT LANGUAGE="JavaScript">
		<!--
			window.location="'.$url.'";
		//-->
		</SCRIPT>';
	}
	exit;
}

//取GB2312字符串首字母,原理是GBK汉字是按拼音顺序编码的.
function get_letter($input)
{
$dict=array(
'a'=>0xB0C4,
'b'=>0xB2C0,
'c'=>0xB4ED,
'd'=>0xB6E9,
'e'=>0xB7A1,
'f'=>0xB8C0,
'g'=>0xB9FD,
'h'=>0xBBF6,
'j'=>0xBFA5,
'k'=>0xC0AB,
'l'=>0xC2E7,
'm'=>0xC4C2,
'n'=>0xC5B5,
'o'=>0xC5BD,
'p'=>0xC6D9,
'q'=>0xC8BA,
'r'=>0xC8F5,
's'=>0xCBF9,
't'=>0xCDD9,
'w'=>0xCEF3,
'x'=>0xD188,
'y'=>0xD4D0,
'z'=>0xD7F9,
);
$str_1 = substr($input, 0, 1);
if ($str_1 >= chr(0x81) && $str_1 <= chr(0xfe)) {
$num = hexdec(bin2hex(substr($input, 0, 2)));
foreach ($dict as $k=>$v){
if($v>=$num)
break;
}
return $k;
}
else{
return $str_1;
}
}



//生成采集规则头
function _mkAttach($data)
{
	global $apirep;
	$rep=array('zuntu'=>'result-data-teams-team','fangwei'=>'response-goods','hao123'=>'urlset-url','sohu'=>'response-deals-deal','lashou'=>'lashou');
	foreach($rep as $k=>$v)
	{
		eval('$rootdata=$data["'.str_replace('-','"]["',$v).'"];');
		if($rootdata)
		{
			return $apirep[$k];
		}
	}
	return false;
}
//采集时分割数组
function _str2arr($str,$data)
{
	$str=explode('-',$str);
	foreach($str as $v)
	{
		$data=$data[$v];
	}
	return $data;
}
//分析采集规则
function _parseAttach($str,$content)
{
	$data='';
	$str=str_replace("\r",'',str_replace("\n",'',$str));
	$str=explode('=',$str);
	
	$root=_str2arr($str[0],$content);
	$count=count($root);
	
	$node=explode(',',$str[1]);
	if(isset($root[0]))
	{
		for($i=0;$i<$count;$i++){
			foreach($node as $k=>$v)
			{
				$p=explode(':',$v);
				$index=str_replace('limengqikey',$i,$p[1]);
				$child=charset_encode(_str2arr($index,$root));
				$data[$i][$p[0]]=$child;
			}
		}
	}
	else
	{
		foreach($node as $k=>$v)
		{
			$p=explode(':',$v);
			//$index=str_replace('-','"]["',str_replace('limengqikey-','',$p[1]));
			$index=str_replace('limengqikey-','',$p[1]);
			$child=charset_encode(_str2arr($index,$root));		
			//eval('$child=charset_encode($root["'.$index.'"]);');
			$data[0][$p[0]]=$child;
		}
	}
	return $data;
}


function Pinyin($_String, $_Code='gb2312'){  

        $_DataKey = "a|ai|an|ang|ao|ba|bai|ban|bang|bao|bei|ben|beng|bi|bian|biao|bie|bin|bing|bo|bu|ca|cai|can|cang|cao|ce|ceng|cha".  

                        "|chai|chan|chang|chao|che|chen|cheng|chi|chong|chou|chu|chuai|chuan|chuang|chui|chun|chuo|ci|cong|cou|cu|".  

                        "cuan|cui|cun|cuo|da|dai|dan|dang|dao|de|deng|di|dian|diao|die|ding|diu|dong|dou|du|duan|dui|dun|duo|e|en|er".  

                        "|fa|fan|fang|fei|fen|feng|fo|fou|fu|ga|gai|gan|gang|gao|ge|gei|gen|geng|gong|gou|gu|gua|guai|guan|guang|gui".  

                        "|gun|guo|ha|hai|han|hang|hao|he|hei|hen|heng|hong|hou|hu|hua|huai|huan|huang|hui|hun|huo|ji|jia|jian|jiang".  

                        "|jiao|jie|jin|jing|jiong|jiu|ju|juan|jue|jun|ka|kai|kan|kang|kao|ke|ken|keng|kong|kou|ku|kua|kuai|kuan|kuang".  

                        "|kui|kun|kuo|la|lai|lan|lang|lao|le|lei|leng|li|lia|lian|liang|liao|lie|lin|ling|liu|long|lou|lu|lv|luan|lue".  

                        "|lun|luo|ma|mai|man|mang|mao|me|mei|men|meng|mi|mian|miao|mie|min|ming|miu|mo|mou|mu|na|nai|nan|nang|nao|ne".  

                        "|nei|nen|neng|ni|nian|niang|niao|nie|nin|ning|niu|nong|nu|nv|nuan|nue|nuo|o|ou|pa|pai|pan|pang|pao|pei|pen".  

                        "|peng|pi|pian|piao|pie|pin|ping|po|pu|qi|qia|qian|qiang|qiao|qie|qin|qing|qiong|qiu|qu|quan|que|qun|ran|rang".  

                        "|rao|re|ren|reng|ri|rong|rou|ru|ruan|rui|run|ruo|sa|sai|san|sang|sao|se|sen|seng|sha|shai|shan|shang|shao|".  

                        "she|shen|sheng|shi|shou|shu|shua|shuai|shuan|shuang|shui|shun|shuo|si|song|sou|su|suan|sui|sun|suo|ta|tai|".  

                        "tan|tang|tao|te|teng|ti|tian|tiao|tie|ting|tong|tou|tu|tuan|tui|tun|tuo|wa|wai|wan|wang|wei|wen|weng|wo|wu".  

                        "|xi|xia|xian|xiang|xiao|xie|xin|xing|xiong|xiu|xu|xuan|xue|xun|ya|yan|yang|yao|ye|yi|yin|ying|yo|yong|you".  

                        "|yu|yuan|yue|yun|za|zai|zan|zang|zao|ze|zei|zen|zeng|zha|zhai|zhan|zhang|zhao|zhe|zhen|zheng|zhi|zhong|".  

                        "zhou|zhu|zhua|zhuai|zhuan|zhuang|zhui|zhun|zhuo|zi|zong|zou|zu|zuan|zui|zun|zuo";  

        $_DataValue = "-20319|-20317|-20304|-20295|-20292|-20283|-20265|-20257|-20242|-20230|-20051|-20036|-20032|-20026|-20002|-19990".  

                        "|-19986|-19982|-19976|-19805|-19784|-19775|-19774|-19763|-19756|-19751|-19746|-19741|-19739|-19728|-19725".  

                        "|-19715|-19540|-19531|-19525|-19515|-19500|-19484|-19479|-19467|-19289|-19288|-19281|-19275|-19270|-19263".  

                        "|-19261|-19249|-19243|-19242|-19238|-19235|-19227|-19224|-19218|-19212|-19038|-19023|-19018|-19006|-19003".  

                        "|-18996|-18977|-18961|-18952|-18783|-18774|-18773|-18763|-18756|-18741|-18735|-18731|-18722|-18710|-18697".  

                        "|-18696|-18526|-18518|-18501|-18490|-18478|-18463|-18448|-18447|-18446|-18239|-18237|-18231|-18220|-18211".  

                        "|-18201|-18184|-18183|-18181|-18012|-17997|-17988|-17970|-17964|-17961|-17950|-17947|-17931|-17928|-17922".  

                        "|-17759|-17752|-17733|-17730|-17721|-17703|-17701|-17697|-17692|-17683|-17676|-17496|-17487|-17482|-17468".  

                        "|-17454|-17433|-17427|-17417|-17202|-17185|-16983|-16970|-16942|-16915|-16733|-16708|-16706|-16689|-16664".  

                        "|-16657|-16647|-16474|-16470|-16465|-16459|-16452|-16448|-16433|-16429|-16427|-16423|-16419|-16412|-16407".  

                        "|-16403|-16401|-16393|-16220|-16216|-16212|-16205|-16202|-16187|-16180|-16171|-16169|-16158|-16155|-15959".  

                        "|-15958|-15944|-15933|-15920|-15915|-15903|-15889|-15878|-15707|-15701|-15681|-15667|-15661|-15659|-15652".  

                        "|-15640|-15631|-15625|-15454|-15448|-15436|-15435|-15419|-15416|-15408|-15394|-15385|-15377|-15375|-15369".  

                        "|-15363|-15362|-15183|-15180|-15165|-15158|-15153|-15150|-15149|-15144|-15143|-15141|-15140|-15139|-15128".  

                        "|-15121|-15119|-15117|-15110|-15109|-14941|-14937|-14933|-14930|-14929|-14928|-14926|-14922|-14921|-14914".  

                        "|-14908|-14902|-14894|-14889|-14882|-14873|-14871|-14857|-14678|-14674|-14670|-14668|-14663|-14654|-14645".  

                        "|-14630|-14594|-14429|-14407|-14399|-14384|-14379|-14368|-14355|-14353|-14345|-14170|-14159|-14151|-14149".  

                        "|-14145|-14140|-14137|-14135|-14125|-14123|-14122|-14112|-14109|-14099|-14097|-14094|-14092|-14090|-14087".  

                        "|-14083|-13917|-13914|-13910|-13907|-13906|-13905|-13896|-13894|-13878|-13870|-13859|-13847|-13831|-13658".  

                        "|-13611|-13601|-13406|-13404|-13400|-13398|-13395|-13391|-13387|-13383|-13367|-13359|-13356|-13343|-13340".  

                        "|-13329|-13326|-13318|-13147|-13138|-13120|-13107|-13096|-13095|-13091|-13076|-13068|-13063|-13060|-12888".  

                        "|-12875|-12871|-12860|-12858|-12852|-12849|-12838|-12831|-12829|-12812|-12802|-12607|-12597|-12594|-12585".  

                        "|-12556|-12359|-12346|-12320|-12300|-12120|-12099|-12089|-12074|-12067|-12058|-12039|-11867|-11861|-11847".  

                        "|-11831|-11798|-11781|-11604|-11589|-11536|-11358|-11340|-11339|-11324|-11303|-11097|-11077|-11067|-11055".  

                        "|-11052|-11045|-11041|-11038|-11024|-11020|-11019|-11018|-11014|-10838|-10832|-10815|-10800|-10790|-10780".  

                        "|-10764|-10587|-10544|-10533|-10519|-10331|-10329|-10328|-10322|-10315|-10309|-10307|-10296|-10281|-10274".  

                        "|-10270|-10262|-10260|-10256|-10254";  

        $_TDataKey   = explode('|', $_DataKey);  

        $_TDataValue = explode('|', $_DataValue);

        $_Data = array_combine($_TDataKey,  $_TDataValue);

        arsort($_Data);  

        reset($_Data);

        if($_Code!= 'gb2312') $_String = _U2_Utf8_Gb($_String);  

        $_Res = '';  

        for($i=0; $i<strlen($_String); $i++)  {  

                $_P = ord(substr($_String, $i, 1));  

                if($_P>160) { 

                        $_Q = ord(substr($_String, ++$i, 1)); $_P = $_P*256 + $_Q - 65536;

                }  

                $_Res .= _Pinyin($_P, $_Data);  

        }  

        return preg_replace("/[^a-z0-9]*/", '', $_Res);  

}  

function _Pinyin($_Num, $_Data){  

        if($_Num>0 && $_Num<160 ){

                return chr($_Num);

        }elseif($_Num<-20319 || $_Num>-10247){

                return '';

        }else{  

                foreach($_Data as $k=>$v){ if($v<=$_Num) break; }  

                return $k;  

        }  

}

function _U2_Utf8_Gb($_C){  

        $_String = '';  

        if($_C < 0x80){

                $_String .= $_C;

        }elseif($_C < 0x800)  {  

                $_String .= chr(0xC0 | $_C>>6);  

                $_String .= chr(0x80 | $_C & 0x3F);  

        }elseif($_C < 0x10000){  

                $_String .= chr(0xE0 | $_C>>12);  

                $_String .= chr(0x80 | $_C>>6 & 0x3F);  

                $_String .= chr(0x80 | $_C & 0x3F);  

        }elseif($_C < 0x200000) {  

                $_String .= chr(0xF0 | $_C>>18);  

                $_String .= chr(0x80 | $_C>>12 & 0x3F);  

                $_String .= chr(0x80 | $_C>>6 & 0x3F);  

                $_String .= chr(0x80 | $_C & 0x3F);  

        }  

        return charset_encode($_String,'gbk');  

}