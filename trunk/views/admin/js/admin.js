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
							var index=document.getElementById(obj).selectedIndex; //��ţ�ȡ��ǰѡ��ѡ������ 
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
	if(confirm('ȷ��ɾ��������¼��ɾ�����޷��ָ�'))
	{
		var url="index.php?con=admin&act=admin_delete";
		url=url+"&rand="+Math.random();
		$.get(url, {table:mtable,val:primary,key:primarykey},  
				function(data){
					if(parseInt(data)==1)
					{
						alert('ɾ���ɹ�');
						$('#'+actionobj).remove();
					}
					else
					{
						alert('����δ�����仯��ɾ�����ɹ�');
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
