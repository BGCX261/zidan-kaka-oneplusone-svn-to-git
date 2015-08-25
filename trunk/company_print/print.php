<?php
require_once 'reader.php';
$data = new Spreadsheet_Excel_Reader();
$data->setOutputEncoding('CP936');
error_reporting(E_ALL ^ E_NOTICE);
if($_GET["action"]==""){
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=GB2312" />
<title>物流面单连打-第一步：选择文件</title>
<style>
td{ font-size:12px}
</style>
</head>
<body>
<?php	
 function phpreaddir($dir){   
   $handle=opendir($dir);
   $i=0;
   while($file=readdir($handle)) {
      if (($file!=".")and($file!="..")) {
          $list[$i]=$file;
          $i=$i+1;
     }
   }
   closedir($handle); 
   return $list;
 }
	$files="new_groups_xls";
	if($_GET["files"]) $files=trim($_GET["files"]);
    $filelist=phpreaddir($files);
	echo "<table width=\"80%\" border=\"0\" cellpadding=\"4\" align=\"center\" cellspacing=\"1\" bgcolor=\"#CCCCCC\">";
    foreach($filelist as $key=>$val){
		$filename=trim($filelist[$key]);
		if(end(explode(".",$filename ))=="xls"){
		   echo "<tr bgcolor=\"#FFFFFF\"><td width='80%'>".$filename."</td><td width='20%'><a href='?action=re&file=$files/$filename'>打印物流单</a> &nbsp; &nbsp; <a href='printA.php?action=re&file=$files/$filename'>打印发货单</td></tr>";
		}else{
		   echo "<tr bgcolor=\"#FFFFFF\"><td width='80%'><font color=red>".$filename."(文件夹)</font></td><td width='20%'><a href='?files=$files/$filename'>打开文件夹</a></td></tr>";
		}
	}
	echo "</table>";
?>
</body>
</html>
<?php
}elseif($_GET["action"]=="re" && end(explode(".",trim($_GET["file"])))=="xls"){
$filename=trim($_GET["file"]);
$sid=$_GET["sheetID"]?intval($_GET["sheetID"]):0;
$data->read($filename);	
$displayStr=" style=\"display:none\"";
$sheetNum=count($data->boundsheets);
if($sheetNum>0){
$displayStr="";	
}
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=GB2312" />
<title>物流面单连打-第二步：选择EXCEL文件中匹配发货单的列</title>
<style>
td{ font-size:12px}
</style>
</head>
<body>
<div align="center"<?php echo $dispalyStr?>>
<script>
var thisURL = document.URL;
var urlArray=Array();
var newUrl;
urlArray=thisURL.split('&');
if(urlArray.length>2){
    newUrl=thisURL.replace('&'+urlArray[2],'');	
}else{
    newUrl=thisURL;	
}
</script>
请选择该文件中的工作簿:<select name="sheetlist" id="sheetlist" onChange="location.href=newUrl+'&sheetID='+this.value">
<?php
for($n=0; $n<$sheetNum; $n++){
  $selected=$n==$sid?" selected":"";
  	if($data->sheets[$n]['numCols'])
    echo " <option value=".$n."".$selected.">".($n+1).".".$data->boundsheets[$n]['name']."</option>\n";
}
?>
</select>
</div>
<table width="80%" border="0" align="center" cellspacing="1" bgcolor="#CCCCCC"<?php echo $displayStr?>>
  <tr>
    <th width="7%" align="center" bgcolor="#EEEEEE">序号</th>
    <th width="40%" align="center" bgcolor="#EEEEEE">面单要求的数据项目</th>
    <th width="46%" align="center" bgcolor="#EEEEEE">表格对应的列项目</th>
    <th width="7%" align="center" bgcolor="#EEEEEE">备注</th>
  </tr>
  <form method="post" name="form1" action="?action=setprint&file=<?=$filename?>">
  <input type="hidden" name="sheetID" value="<?php echo $sid?>"
  <tr>
    <td align="center" bgcolor="#FFFFFF">1</td>
    <td align="center" bgcolor="#FFFFFF">收货人姓名</td>
    <td bgcolor="#FFFFFF">
<select name="coll_1" id="coll_1">
<?php
echo "<option value=\"0\">--请选择对应的收货人姓名数据的列--</option>\n";
for ($j=1; $j<=$data->sheets[$sid]['numCols'];$j++){
	if($data->sheets[$sid]['cells'][1][$j])
    echo " <option value=".$j.">".$data->sheets[$sid]['cells'][1][$j]."</option>\n";
}
?> 
</select>
    </td>
    <td align="center" bgcolor="#FFFFFF"><font color="#FF0000">*</font></td>
  </tr>
  <tr>
    <td align="center" bgcolor="#FFFFFF">2</td>
    <td align="center" bgcolor="#FFFFFF">收货人电话</td>
    <td bgcolor="#FFFFFF">
<select name="coll_2" id="coll_2">
<?php
echo "<option value=\"0\">--请选择对应的收货人电话数据的列--</option>\n";
for ($j=1; $j<=$data->sheets[$sid]['numCols'];$j++){
	if($data->sheets[$sid]['cells'][1][$j])
    echo " <option value=".$j.">".$data->sheets[$sid]['cells'][1][$j]."</option>\n";
}
?> 
</select>
    </td>
    <td align="center" bgcolor="#FFFFFF"><font color="#FF0000">*</font></td>
  </tr>
  <tr>
    <td align="center" bgcolor="#FFFFFF">3</td>
    <td align="center" bgcolor="#FFFFFF">收货人地址</td>
    <td bgcolor="#FFFFFF">
<select name="coll_3" id="coll_3">
<?php
echo "<option value=\"0\">--请选择对应的收货人地址数据的列--</option>\n";
for ($j=1; $j<=$data->sheets[$sid]['numCols'];$j++){
	if($data->sheets[$sid]['cells'][1][$j])
    echo " <option value=".$j.">".$data->sheets[$sid]['cells'][1][$j]."</option>\n";
}
?> 
</select>
    </td>
    <td align="center" bgcolor="#FFFFFF"><font color="#FF0000">*</font></td>
  </tr>
  <tr>
    <td colspan="4" bgcolor="#FFFFFF" style="padding:4px">
<center><input name="submit" type="submit" value="全部选择好了，下一步" /></center></td>
  </tr>
  </form>
</table>
</body>
</html>
<?php
}elseif($_GET["action"]=="setprint" && end(explode(".",trim($_GET["file"])))=="xls"){
$filename=trim($_GET["file"]);
$sid=$_POST["sheetID"] ? intval($_POST["sheetID"]) : 0;
$data->read($filename);
?>
<html xmlns:v="urn:schemas-microsoft-com:vml"
xmlns:o="urn:schemas-microsoft-com:office:office"
xmlns:w="urn:schemas-microsoft-com:office:word"
xmlns="http://www.w3.org/TR/REC-html40">
<head>
<meta http-equiv=Content-Type content="text/html; charset=gb2312">
<meta name=ProgId content=Word.Document>
<meta name=Generator content="Microsoft Word 11">
<meta name=Originator content="Microsoft Word 11">
<link rel=File-List href="test.files/filelist.xml">
<title>物流面单连打-第三步：设置页边距和打印</title>
<!--[if gte mso 9]><xml>
 <o:DocumentProperties>
  <o:Author>微软用户</o:Author>
  <o:LastAuthor>微软用户</o:LastAuthor>
  <o:Revision>1</o:Revision>
  <o:TotalTime>12</o:TotalTime>
  <o:LastPrinted>2010-10-25T10:51:00Z</o:LastPrinted>
  <o:Created>2010-10-25T10:40:00Z</o:Created>
  <o:LastSaved>2010-10-25T10:52:00Z</o:LastSaved>
  <o:Pages>1</o:Pages>
  <o:Words>7</o:Words>
  <o:Characters>43</o:Characters>
  <o:Company>微软中国</o:Company>
  <o:Lines>1</o:Lines>
  <o:Paragraphs>1</o:Paragraphs>
  <o:CharactersWithSpaces>49</o:CharactersWithSpaces>
  <o:Version>11.9999</o:Version>
 </o:DocumentProperties>
</xml><![endif]--><!--[if gte mso 9]><xml>
 <w:WordDocument>
  <w:SpellingState>Clean</w:SpellingState>
  <w:GrammarState>Clean</w:GrammarState>
  <w:PunctuationKerning/>
  <w:DrawingGridVerticalSpacing>7.8 磅</w:DrawingGridVerticalSpacing>
  <w:DisplayHorizontalDrawingGridEvery>0</w:DisplayHorizontalDrawingGridEvery>
  <w:DisplayVerticalDrawingGridEvery>2</w:DisplayVerticalDrawingGridEvery>
  <w:ValidateAgainstSchemas/>
  <w:SaveIfXMLInvalid>false</w:SaveIfXMLInvalid>
  <w:IgnoreMixedContent>false</w:IgnoreMixedContent>
  <w:AlwaysShowPlaceholderText>false</w:AlwaysShowPlaceholderText>
  <w:Compatibility>
   <w:SpaceForUL/>
   <w:BalanceSingleByteDoubleByteWidth/>
   <w:DoNotLeaveBackslashAlone/>
   <w:ULTrailSpace/>
   <w:DoNotExpandShiftReturn/>
   <w:AdjustLineHeightInTable/>
   <w:BreakWrappedTables/>
   <w:SnapToGridInCell/>
   <w:WrapTextWithPunct/>
   <w:UseAsianBreakRules/>
   <w:DontGrowAutofit/>
   <w:UseFELayout/>
  </w:Compatibility>
  <w:BrowserLevel>MicrosoftInternetExplorer4</w:BrowserLevel>
 </w:WordDocument>
</xml><![endif]--><!--[if gte mso 9]><xml>
 <w:LatentStyles DefLockedState="false" LatentStyleCount="156">
 </w:LatentStyles>
</xml><![endif]-->
<style>
<!--
 /* Font Definitions */
 @font-face
	{font-family:宋体;
	panose-1:2 1 6 0 3 1 1 1 1 1;
	mso-font-alt:SimSun;
	mso-font-charset:134;
	mso-generic-font-family:auto;
	mso-font-pitch:variable;
	mso-font-signature:3 135135232 16 0 262145 0;}
@font-face
	{font-family:Dotum;
	panose-1:2 11 6 0 0 1 1 1 1 1;
	mso-font-alt:\B3CB\C6C0;
	mso-font-charset:129;
	mso-generic-font-family:swiss;
	mso-font-pitch:variable;
	mso-font-signature:-1342176593 1775729915 48 0 524447 0;}
@font-face
	{font-family:"Roman PS";
	panose-1:0 0 0 0 0 0 0 0 0 0;
	mso-font-alt:Arial;
	mso-font-charset:0;
	mso-generic-font-family:roman;
	mso-font-format:other;
	mso-font-pitch:variable;
	mso-font-signature:3 0 0 0 1 0;}
@font-face
	{font-family:"\@宋体";
	panose-1:2 1 6 0 3 1 1 1 1 1;
	mso-font-charset:134;
	mso-generic-font-family:auto;
	mso-font-pitch:variable;
	mso-font-signature:3 135135232 16 0 262145 0;}
@font-face
	{font-family:"\@Dotum";
	panose-1:2 11 6 0 0 1 1 1 1 1;
	mso-font-charset:129;
	mso-generic-font-family:swiss;
	mso-font-pitch:variable;
	mso-font-signature:-1342176593 1775729915 48 0 524447 0;}
@font-face
	{font-family:华文中宋;
	panose-1:2 1 6 0 4 1 1 1 1 1;
	mso-font-charset:134;
	mso-generic-font-family:auto;
	mso-font-pitch:variable;
	mso-font-signature:647 135200768 16 0 262303 0;}
@font-face
	{font-family:"\@华文中宋";
	panose-1:2 1 6 0 4 1 1 1 1 1;
	mso-font-charset:134;
	mso-generic-font-family:auto;
	mso-font-pitch:variable;
	mso-font-signature:647 135200768 16 0 262303 0;}
@font-face
	{font-family:华康简仿宋;
	panose-1:2 1 6 9 0 1 1 1 1 1;
	mso-font-charset:134;
	mso-generic-font-family:modern;
	mso-font-pitch:fixed;
	mso-font-signature:1 135135232 16 0 262144 0;}
@font-face
	{font-family:"\@华康简仿宋";
	panose-1:2 1 6 9 0 1 1 1 1 1;
	mso-font-charset:134;
	mso-generic-font-family:modern;
	mso-font-pitch:fixed;
	mso-font-signature:1 135135232 16 0 262144 0;}
 /* Style Definitions */
 p.MsoNormal, li.MsoNormal, div.MsoNormal
	{mso-style-parent:"";
	margin:0cm;
	margin-bottom:.0001pt;
	text-align:justify;
	text-justify:inter-ideograph;
	mso-pagination:none;
	font-size:10.5pt;
	mso-bidi-font-size:12.0pt;
	font-family:"Roman PS";
	mso-fareast-font-family:宋体;
	mso-bidi-font-family:"Roman PS";
	mso-font-kerning:1.0pt;}
 /* Page Definitions */
 @page
	{mso-page-border-surround-header:no;
	mso-page-border-surround-footer:no;}
@page Section1
	{size:595.3pt 841.9pt;
	margin:46.75pt 10.75pt 12.45pt 9.0pt;
	mso-header-margin:42.55pt;
	mso-footer-margin:49.6pt;
	mso-paper-source:0;
	layout-grid:15.6pt;}
div.Section1
	{page:Section1;}
div.MsoNormal1 {mso-style-parent:"";
	margin:0cm;
	margin-bottom:.0001pt;
	text-align:justify;
	text-justify:inter-ideograph;
	mso-pagination:none;
	font-size:10.5pt;
	mso-bidi-font-size:12.0pt;
	font-family:"Roman PS";
	mso-fareast-font-family:宋体;
	mso-bidi-font-family:"Roman PS";
	mso-font-kerning:1.0pt;}
li.MsoNormal1 {mso-style-parent:"";
	margin:0cm;
	margin-bottom:.0001pt;
	text-align:justify;
	text-justify:inter-ideograph;
	mso-pagination:none;
	font-size:10.5pt;
	mso-bidi-font-size:12.0pt;
	font-family:"Roman PS";
	mso-fareast-font-family:宋体;
	mso-bidi-font-family:"Roman PS";
	mso-font-kerning:1.0pt;}
p.MsoNormal1 {mso-style-parent:"";
	margin:0cm;
	margin-bottom:.0001pt;
	text-align:justify;
	text-justify:inter-ideograph;
	mso-pagination:none;
	font-size:10.5pt;
	mso-bidi-font-size:12.0pt;
	font-family:"Roman PS";
	mso-fareast-font-family:宋体;
	mso-bidi-font-family:"Roman PS";
	mso-font-kerning:1.0pt;}
-->
</style>
<style media=print>
.Noprint{display:none;}
.PageNext{page-break-after: always;}
</style>
<!--[if gte mso 10]>
<style>
 /* Style Definitions */
 table.MsoNormalTable
	{mso-style-name:普通表格;
	mso-tstyle-rowband-size:0;
	mso-tstyle-colband-size:0;
	mso-style-noshow:yes;
	mso-style-parent:"";
	mso-padding-alt:0cm 5.4pt 0cm 5.4pt;
	mso-para-margin:0cm;
	mso-para-margin-bottom:.0001pt;
	mso-pagination:widow-orphan;
	font-size:10.0pt;
	font-family:"Roman PS";
	mso-ansi-language:#0400;
	mso-fareast-language:#0400;
	mso-bidi-language:#0400;}
table.MsoTableGrid
	{mso-style-name:网格型;
	mso-tstyle-rowband-size:0;
	mso-tstyle-colband-size:0;
	border:solid windowtext 1.0pt;
	mso-border-alt:solid windowtext .5pt;
	mso-padding-alt:0cm 5.4pt 0cm 5.4pt;
	mso-border-insideh:.5pt solid windowtext;
	mso-border-insidev:.5pt solid windowtext;
	mso-para-margin:0cm;
	mso-para-margin-bottom:.0001pt;
	text-align:justify;
	text-justify:inter-ideograph;
	mso-pagination:none;
	font-size:10.0pt;
	font-family:"Roman PS";
	mso-ansi-language:#0400;
	mso-fareast-language:#0400;
	mso-bidi-language:#0400;}
</style>
<![endif]--><!--[if gte mso 9]><xml>
 <o:shapedefaults v:ext="edit" spidmax="2050"/>
</xml><![endif]--><!--[if gte mso 9]><xml>
 <o:shapelayout v:ext="edit">
  <o:idmap v:ext="edit" data="1"/>
 </o:shapelayout></xml><![endif]-->
</head>

<body lang=ZH-CN style='tab-interval:21.0pt;text-justify-trim:punctuation'>
<script language="javascript">          
 function printWithAlert() {        
 document.all.WebBrowser.ExecWB(6,1);     
 }      
 function printWithoutAlert() {       
   document.all.WebBrowser.ExecWB(6,6);      
 }    
 function printSetup() {        
 document.all.WebBrowser.ExecWB(8,1);      
 }     
 function printPrieview() {        
 document.all.WebBrowser.ExecWB(7,1);      
 }      
function printImmediately() {        
document.all.WebBrowser.ExecWB(6,6);       
 window.close();      
 }       
</script>
<OBJECT  id=WebBrowser  classid=CLSID:8856F961-340A-11D0-A96B-00C04FD705A2 style="display:none"></OBJECT>
<table align="center" class=NOPRINT>
  <tr>
    <td align="center"><BUTTON title=打印 onclick=printWithAlert()>打印</BUTTON>
      <BUTTON title=直接打印 onclick=printWithoutAlert()>直接打印</BUTTON>
      <input type=button value="打印设置" onClick="printSetup()" >
      <button onclick ='printPrieview()' title='打印预览...' >打印预览</button></td>
  </tr>
</table>
<?php
$num=0;
$co_1=$_POST["coll_1"];
$co_2=$_POST["coll_2"];
$co_3=$_POST["coll_3"];
for ($i = 2; $i <= $data->sheets[$sid]['numRows']; $i++){
$u_name=trim($data->sheets[$sid]['cells'][$i][$co_1]);
$u_phone=trim($data->sheets[$sid]['cells'][$i][$co_2]);
$u_address=trim($data->sheets[$sid]['cells'][$i][$co_3]);
 if($u_name && $u_phone && $u_address){
$num++;
?>
<div class="PageNext" style="margin-top:20mm">
<table class=MsoTableGrid border=0 cellspacing=0 cellpadding=0
 style='border-collapse:collapse;mso-yfti-tbllook:480;mso-padding-alt:0cm 5.4pt 0cm 5.4pt'>
  <tr style='mso-yfti-irow:0;mso-yfti-firstrow:yes;height:54.9pt'>
    <td width=415 valign=top style='width:311.4pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:54.9pt'><p class=MsoNormal1 style='line-height:18.0pt;mso-line-height-rule:exactly'><b
  style='mso-bidi-font-weight:normal'><span lang=EN-US style='font-size:12.0pt;
  font-family:华康简仿宋;mso-hansi-font-family:华文中宋'>
      <o:p>&nbsp;</o:p>
    </span></b></p></td>
    <td width=324 valign=top style='width:243.0pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:54.9pt'><p class=MsoNormal1 style='text-indent:21.6pt;mso-char-indent-count:1.8;
  line-height:18.0pt;mso-line-height-rule:exactly'><b style='mso-bidi-font-weight:
  normal'><span style='font-size:12.0pt;font-family:华康简仿宋;mso-hansi-font-family:
  华文中宋'><strong><?php echo $u_name?></strong><span lang=EN-US>
      <o:p></o:p>
    </span></span></b></p></td>
  </tr>
  <tr style='mso-yfti-irow:1'>
    <td width=415 valign=top style='width:311.4pt;padding:0cm 5.4pt 0cm 5.4pt'><p class=MsoNormal1 style='line-height:18.0pt;mso-line-height-rule:exactly'><b
  style='mso-bidi-font-weight:normal'><span lang=EN-US style='font-size:12.0pt;
  font-family:华康简仿宋;mso-hansi-font-family:华文中宋'>
      <o:p>&nbsp;</o:p>
    </span></b></p></td>
    <td width=324 valign=top style='width:243.0pt;padding:0cm 5.4pt 0cm 5.4pt; height:50px'><p class=MsoNormal1 style='padding-right:50px;line-height:18.0pt;mso-line-height-rule:exactly'><?php echo $u_address?></p></td>
  </tr>
  <tr style='mso-yfti-irow:2;height:17.9pt'>
    <td width=415 valign=top style='width:311.4pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:17.9pt'><p class=MsoNormal1 style='line-height:18.0pt;mso-line-height-rule:exactly'><b
  style='mso-bidi-font-weight:normal'><span lang=EN-US style='font-size:12.0pt;
  font-family:华康简仿宋;mso-hansi-font-family:华文中宋'>
      <o:p>&nbsp;</o:p>
    </span></b></p></td>
    <td width=324 valign=top style='width:243.0pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:17.9pt'><p class=MsoNormal1 style='line-height:18.0pt;mso-line-height-rule:exactly'><b
  style='mso-bidi-font-weight:normal'><span lang=EN-US style='font-size:12.0pt;
  font-family:华康简仿宋;mso-hansi-font-family:华文中宋'>
      <o:p>&nbsp;</o:p>
    </span></b></p></td>
  </tr>
  <tr style='mso-yfti-irow:3;mso-yfti-lastrow:yes'>
    <td width=415 valign=top style='width:311.4pt;padding:0cm 5.4pt 0cm 5.4pt'><p class=MsoNormal1 style='line-height:18.0pt;mso-line-height-rule:exactly'><b
  style='mso-bidi-font-weight:normal'><span lang=EN-US style='font-size:12.0pt;
  font-family:华康简仿宋;mso-hansi-font-family:华文中宋'>
      <o:p>&nbsp;</o:p>
    </span></b></p></td>
    <td width=324 valign=top style='width:243.0pt;padding:0cm 5.4pt 0cm 5.4pt'><p class=MsoNormal1 style='text-indent:48.4pt;mso-char-indent-count:4.11;
  line-height:18.0pt;mso-line-height-rule:exactly'><b style='mso-bidi-font-weight:
  normal'><span lang=EN-US style='font-size:12.0pt;font-family:Dotum'><strong><?php echo $u_phone?></strong>
                <o:p></o:p>
    </span></b></p></td>
  </tr>
</table>
</div>
<hr size=1 noshadow color=black  class=NOPRINT>
<?php
  }
}
?>
</body>
</html>
<?php
}
?>