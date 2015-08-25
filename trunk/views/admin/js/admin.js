ns4 = (document.layers) ? true : false;
ie4 = (document.all) ? true : false;
function modifyValue(objval)
{
	var obj=objval.replace('input','');
	$("#"+obj).hide();
	$("#"+objval).val($("#"+obj).html());
	$("#"+objval).show();
}


function confirmValue(mytable,mval,obj,key,url)
{
	
	var url=url?url:"index.php?con=admin&act=admin_ajax";
	
	url=url+"&rand="+Math.random();
	var objid=obj.replace('input','');
	var s=objid.split('-');
	var field=s[0];
	var id=s[1];
	

	$.get(url, {table:mytable,field: field,val:mval,primary:id,primarykey:key},
		   function(data){
				if(parseInt(data)==1)
				{
					if(document.getElementById(obj).tagName.toUpperCase()=='SELECT')
					{
							var index=document.getElementById(obj).selectedIndex; //序号，取当前选中选项的序号 
							var textstr=document.getElementById(obj).options[index].text;
							
							$("#"+objid).html(textstr.replace('--','')); 
							return true;
					}
					else
					{
						if($('#'+obj).attr('title')!='nochange')
						{
							$("#"+objid).html(mval);
							return true;
						}
						
					}
					
					
				}
				else
				{
					alert(data);
					return false;
				}
			}
		);
	$("#"+objid).show();
	$("#"+obj).hide();	
	
	return true;
}

function deleteVal(mtable,primary,actionobj,primarykey)
{
	if(confirm('确认删除此条记录？删除后无法恢复'))
	{
		var url="index.php?con=admin&act=admin_delete";
		url=url+"&rand="+Math.random();
		$.get(url, {table:mtable,val:primary,key:primarykey},  
				function(data){
					if(parseInt(data)==1)
					{
						alert('删除成功');
						$('#'+actionobj).remove();
					}
					else
					{
						alert('数据未发生变化，删除不成功');
					}
			});
	}
}
function updateVal(mytable,obj,key,url,mdata)
{
	if(confirmValue(mytable,$('#'+obj).val(),obj,key,url))
	{
	var objid=obj.replace('input','');
	var a=!parseInt($('#'+obj).val())*1;
	$('#'+obj).val(a);
	$('#'+objid).html(mdata[a]);
	}
	
}

function checkallgroup(obj)
{
	if($(obj).attr('checked'))
	{
		$('.nocheck').attr('checked',true);
	}
	else
	{
		$('.nocheck').attr('checked',false);
	}
}
