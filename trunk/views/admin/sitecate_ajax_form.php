<iframe src="" name="sitecatemodify" style="display:none"></iframe>
<FORM METHOD="POST" ACTION="index.php?con=admin&act=sitecatemodify" target="sitecatemodify">
<INPUT TYPE="hidden" NAME="updateid" value="<?php echo $sitecate['id'];?>">
<INPUT TYPE="hidden" NAME="commit" value="1">
<table width="300px" border="0" align="center"  cellpadding="3" cellspacing="1" class="table_style">
<tr>
<td width="70px" class="left_title_1"><span class="left-title">�������ƣ�</span></td>
<td><INPUT TYPE="text" class="normal_txt" NAME="sitecatename"  value="<?php echo $sitecate['sitecatename'];?>"></td>
</tr>
<tr>
<td width="70px" class="left_title_1"><span class="left-title">�������ͣ�</span></td>
<td><select name="sitetype">
  <option value="1">�����̳�</option>
  <option value="2">��վ����</option>
  <option value="3">�Ź���վ</option>
  <option value="4">�ۺ�ƽ̨</option>
</select></td>
</tr>
<td colspan="2" align="center"><INPUT TYPE="submit" value="�ύ" class="normal_button"> <INPUT TYPE="button" value="�ر�" class="normal_button" onclick="$('#sitecate_area').hide();"></td>
</tr>
</table>
</FORM>