<?php
require_once 'reader.php';
$data = new Spreadsheet_Excel_Reader();
$data->setOutputEncoding('CP936');
if($_GET["action"]==""){
    echo "�Բ������Ĳ����Ƿ���";
	die();
}
elseif($_GET["action"]=="re" && end(explode(".",trim($_GET["file"])))=="xls"){
$filename=trim($_GET["file"]);
$sid=$_GET["sheetID"]?intval($_GET["sheetID"]):0;
$data->read($filename);	
$displayStr=" style=\"display:none\"";
$sheetNum=count($data->boundsheets);
  if($sheetNum>0){
      $displayStr="";	
  }
?>
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
��ѡ����ļ��еĹ�����:<select name="sheetlist" id="sheetlist" onChange="location.href=newUrl+'&sheetID='+this.value">
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
    <th width="7%" align="center" bgcolor="#EEEEEE">���</th>
    <th width="40%" align="center" bgcolor="#EEEEEE">�浥Ҫ���������Ŀ</th>
    <th width="46%" align="center" bgcolor="#EEEEEE">����Ӧ������Ŀ</th>
    <th width="7%" align="center" bgcolor="#EEEEEE">��ע</th>
  </tr>
  <form method="post" name="form1" action="?action=setprint&file=<?=$filename?>">
  <input type="hidden" name="sheetID" value="<?php echo $sid?>"
  <tr>
    <td align="center" bgcolor="#FFFFFF">1</td>
    <td align="center" bgcolor="#FFFFFF">�ջ�������</td>
    <td bgcolor="#FFFFFF">
<select name="coll_1" id="coll_1">
<?php
echo "<option value=\"0\">--��ѡ���Ӧ���ջ����������ݵ���--</option>\n";
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
    <td align="center" bgcolor="#FFFFFF">�ջ��˵绰</td>
    <td bgcolor="#FFFFFF">
<select name="coll_2" id="coll_2">
<?php
echo "<option value=\"0\">--��ѡ���Ӧ���ջ��˵绰���ݵ���--</option>\n";
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
    <td align="center" bgcolor="#FFFFFF">�ջ��˵�ַ</td>
    <td bgcolor="#FFFFFF">
<select name="coll_3" id="coll_3">
<?php
echo "<option value=\"0\">--��ѡ���Ӧ���ջ��˵�ַ���ݵ���--</option>\n";
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
    <td align="center" bgcolor="#FFFFFF">4</td>
    <td align="center" bgcolor="#FFFFFF">��������</td>
    <td bgcolor="#FFFFFF">
<select name="coll_4" id="coll_4">
<?php
echo "<option value=\"0\">--��ѡ���Ӧ�ķ����������ݵ���--</option>\n";
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
    <td align="center" bgcolor="#FFFFFF">5</td>
    <td align="center" bgcolor="#FFFFFF">��������</td>
    <td bgcolor="#FFFFFF">
<select name="coll_5" id="coll_5">
<?php
echo "<option value=\"0\">--��ѡ���Ӧ�ķ����������ݵ���--</option>\n";
for ($j=1; $j<=$data->sheets[$sid]['numCols'];$j++){
	if($data->sheets[$sid]['cells'][1][$j])
    echo " <option value=".$j.">".$data->sheets[$sid]['cells'][1][$j]."</option>\n";
}
?> 
</select>
<input name="text_5" id="text_5" type="text" style="width:50px" onChange="coll_5.disabled=true;coll_5.options[0].selected=true">
    </td>
    <td align="center" bgcolor="#FFFFFF"><font color="#FF0000">*</font></td>
  </tr>
  <tr>
    <td align="center" bgcolor="#FFFFFF">6</td>
    <td align="center" bgcolor="#FFFFFF">������ע</td>
    <td bgcolor="#FFFFFF">
<select name="coll_6" id="coll_6">
<?php
echo "<option value=\"0\">--��ѡ���Ӧ�ķ�����ע���ݵ���--</option>\n";
for ($j=1; $j<=$data->sheets[$sid]['numCols'];$j++){
	if($data->sheets[$sid]['cells'][1][$j])
    echo " <option value=".$j.">".$data->sheets[$sid]['cells'][1][$j]."</option>\n";
}
?> 
</select>
<input name="text_6" id="text_6" type="text" style="width:50px" onChange="coll_6.disabled=true;coll_6.options[0].selected=true">
    </td>
    <td align="center" bgcolor="#FFFFFF"><font color="#FF0000">*</font></td>
  </tr>
  <tr>
    <td colspan="4" bgcolor="#FFFFFF" style="padding:4px">
<center><input name="submit" type="submit" value="ȫ��ѡ����ˣ���һ��" /></center></td>
  </tr>
  </form>
</table>
</body>
</html>
<?php
}
elseif($_GET["action"]=="setprint" && end(explode(".",trim($_GET["file"])))=="xls"){
$filename=trim($_GET["file"]);
$sid=$_POST["sheetID"] ? intval($_POST["sheetID"]) : 0;
$data->read($filename);
?>
<html xmlns:o="urn:schemas-microsoft-com:office:office"
xmlns:x="urn:schemas-microsoft-com:office:excel"
xmlns="http://www.w3.org/TR/REC-html40">
<head>
<meta http-equiv=Content-Type content="text/html; charset=gb2312">
<meta name=ProgId content=Excel.Sheet>
<meta name=Generator content="Microsoft Excel 11">
<link rel=Stylesheet href=stylesheet.css>
<style>
<!--table
	{mso-displayed-decimal-separator:"\.";
	mso-displayed-thousand-separator:"\,";}
@page
	{margin:.75in .7in .75in .7in;
	mso-header-margin:.3in;
	mso-footer-margin:.3in;}
ruby
	{ruby-align:left;}
rt
	{color:windowtext;
	font-size:9.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:����;
	mso-generic-font-family:auto;
	mso-font-charset:134;
	mso-char-type:none;
	display:none;}
-->
</style>
<style media=print>
.Noprint{display:none;}
.PageNext{page-break-after: always;}
</style>
</head>

<body>
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
    <td align="center"><BUTTON title=��ӡ onclick=printWithAlert()>��ӡ</BUTTON>
      <BUTTON title=ֱ�Ӵ�ӡ onclick=printWithoutAlert()>ֱ�Ӵ�ӡ</BUTTON>
      <input type=button value="��ӡ����" onClick="printSetup()" >
      <button onclick ='printPrieview()' title='��ӡԤ��...' >��ӡԤ��</button></td>
  </tr>
</table>
<?php
$num=0;
$co_1=$_POST["coll_1"];
$co_2=$_POST["coll_2"];
$co_3=$_POST["coll_3"];
$co_4=$_POST["coll_4"];
for ($i = 2; $i <= $data->sheets[$sid]['numRows']; $i++){
$u_name=trim($data->sheets[$sid]['cells'][$i][$co_1]);
$u_phone=trim($data->sheets[$sid]['cells'][$i][$co_2]);
$u_address=trim($data->sheets[$sid]['cells'][$i][$co_3]);
$order_num=trim($data->sheets[$sid]['cells'][$i][$co_4]);
  if(!empty($_POST["text_5"])){
	 $order_name=$_POST["text_5"];
  }elseif($_POST["coll_5"]){
	 $co_5=$_POST["coll_5"];
	 $order_name=trim($data->sheets[$sid]['cells'][$i][$co_5]);
  } 
  if(!empty($_POST["text_6"])){
	 $order_remark=$_POST["text_6"];
  }elseif($_POST["coll_6"]){
	 $co_5=$_POST["coll_6"];
	 $order_remark=trim($data->sheets[$sid]['cells'][$i][$co_5]);
  } 
 if($u_name && $u_phone && $u_address && $order_num){
$num++;
?>
<div class="PageNext" style="margin-top:20mm">
<table x:str border=0 cellpadding=0 cellspacing=0 width=650 style='border-collapse:
 collapse;table-layout:fixed;width:649pt'>
 <col width=84 style='mso-width-source:userset;mso-width-alt:2688;width:63pt'>
 <col width=164 style='mso-width-source:userset;mso-width-alt:5248;width:123pt'>
 <col width=206 style='mso-width-source:userset;mso-width-alt:6592;width:155pt'>
 <col width=64 style='mso-width-source:userset;mso-width-alt:2048;width:48pt'>
 <col width=54 style='mso-width-source:userset;mso-width-alt:1728;width:41pt'>
 <col width=119 style='mso-width-source:userset;mso-width-alt:3808;width:89pt'>
 <tr height=18 style='height:13.5pt'>
  <td colspan=2 height=18 class=xl70 style='height:13.5pt;width:186pt'>�������ţ�</td>
  <td colspan="4" style='width:155pt'>��ҵ绰��<strong><?php echo $u_phone?></strong></td>
  </tr>
 <tr height=18 style='height:13.5pt'>
  <td colspan=2 height=18 class=xl70 style='height:13.5pt'>�ջ���������<strong><?php echo $u_name?></strong></td>
  <td colspan=3>��ݹ�˾��<strong>��ͨ���</strong></td>
 </tr>
 <tr height=18 style='height:13.5pt'>
 <td colspan=5 height=18 class=xl67 style='height:13.5pt'>�ջ��˵�ַ��<strong><?php echo $u_address?></strong></td>
 </tr>
 <tr height=18 style='height:13.5pt'>
  <td width="101" height=18 class=xl66 style='height:13.5pt;border-top:none'>NO</td>
  <td width="190" class=xl66 style='border-top:none;border-left:none'>����</td>
  <td colspan="2" class=xl66 style='border-top:none;border-left:none'>������ע</td>
  <td width="214" class=xl66 style='border-top:none;border-left:none'>����</td>
 </tr>
 <tr height=44 style='mso-height-source:userset;height:35.0pt'>
  <td height=44 class=xl66 style='height:33.0pt;border-top:none' x:num><?php echo $num?></td>
  <td class=xl65 style='border-top:none;border-left:none'>��<?php echo $order_name?></td>
  <td colspan="2" class=xl65 style='border-top:none; border-left:none; text-align: center;'><?php echo $order_remark?></td>
  <td class=xl65 style='border-top:none;border-left:none'>��<?php echo $order_num?></td>
 </tr>
 <tr height=18 style='height:13.5pt'>
  <td colspan=2 height=18 class=xl69 style='height:13.5pt'>���ң�����Ҽ��Ҽ�����������޹�˾</td>
  <td colspan="3" style='mso-ignore:colspan'>&nbsp;&nbsp;&nbsp;��ϵ��ʽ��0574-89017376</td>
  </tr>
 <tr height=18 style='height:13.5pt'>
  <td colspan=5 height=18 style='height:13.5pt'>������˾��ַ���㽭ʡ������۴�ش��1299��۴���̻ᱱ¥10¥</td>
  </tr>
</table>
</div>
<?php
 }
}
?>
</body>
</html>
<?php
}
?>