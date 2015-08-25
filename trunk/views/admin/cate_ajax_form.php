<iframe src="" name="catemodify" style="display:none"></iframe>
<FORM METHOD="POST" ACTION="index.php?con=admin&act=catemodify" target="catemodify">
<INPUT TYPE="hidden" NAME="updateid" value="<?php echo $cate['id'];?>">
<INPUT TYPE="hidden" NAME="commit" value="1">
<table width="300px" border="0" align="center"  cellpadding="3" cellspacing="1" class="table_style">
<tr>
<td width="70px" class="left_title_1"><span class="left-title">分类名：</span></td>
<td><INPUT TYPE="text" class="normal_txt" NAME="catename"  value="<?php echo $cate['catename'];?>"></td>
</tr>
<td colspan="2" align="center"><INPUT TYPE="submit" value="提交" class="normal_button"> <INPUT TYPE="button" value="关闭" class="normal_button" onclick="$('#cate_area').hide();"></td>
</tr>
</table>
</FORM>