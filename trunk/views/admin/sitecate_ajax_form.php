<iframe src="" name="sitecatemodify" style="display:none"></iframe>
<FORM METHOD="POST" ACTION="index.php?con=admin&act=sitecatemodify" target="sitecatemodify">
<INPUT TYPE="hidden" NAME="updateid" value="<?php echo $sitecate['id'];?>">
<INPUT TYPE="hidden" NAME="commit" value="1">
<table width="300px" border="0" align="center"  cellpadding="3" cellspacing="1" class="table_style">
<tr>
<td width="70px" class="left_title_1"><span class="left-title">分类名称：</span></td>
<td><INPUT TYPE="text" class="normal_txt" NAME="sitecatename"  value="<?php echo $sitecate['sitecatename'];?>"></td>
</tr>
<tr>
<td width="70px" class="left_title_1"><span class="left-title">分类类型：</span></td>
<td><select name="sitetype">
  <option value="1">网购商城</option>
  <option value="2">名站导航</option>
  <option value="3">团购网站</option>
  <option value="4">综合平台</option>
</select></td>
</tr>
<td colspan="2" align="center"><INPUT TYPE="submit" value="提交" class="normal_button"> <INPUT TYPE="button" value="关闭" class="normal_button" onclick="$('#sitecate_area').hide();"></td>
</tr>
</table>
</FORM>