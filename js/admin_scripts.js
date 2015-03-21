// JavaScript Document

function del()
{
	var x=window.confirm("Are you sure you want to delete this item?")
	if (x)
	return true;
	else
	return false;
}

function RatePost(vote,id_num,ip_num,units) {
		$("#unit_long"+id_num).append('<div class="loadingRating"></div>');
		$.get(BASE_URI+"ratings_rpc",{j:vote,q:id_num,t:ip_num,c:units},function(result){
		$("#unit_long"+id_num+" .loadingRating").remove();
		$("#unit_long"+id_num).replaceWith(result);	
		
	});
}

function goforsearch()
{
	if(document.getElementById('search').value)
	{
		search_var = document.getElementById('search').value;
	}
	else
	{
		search_var = 0;
	}
	
	if(document.getElementById('category').value)
	{
		category_var = document.getElementById('category').value;
	}
	else
	{
		category_var = 0;
	}
	
	document.covers.action = BASE_URI+'admincp/covers/result/'+search_var+'/'+category_var;
	document.covers.submit();
}

function selectAllCheckBoxes(FormName, FieldName, CheckValue)
{
	if(!document.forms[FormName])
		return;
	var objCheckBoxes = document.forms[FormName].elements[FieldName];
	if(!objCheckBoxes)
		return;
	var countCheckBoxes = objCheckBoxes.length;
	if(!countCheckBoxes)
		objCheckBoxes.checked = CheckValue;
	else
		// set the check value for all check boxes
		for(var i = 0; i < countCheckBoxes; i++)
			objCheckBoxes[i].checked = CheckValue;
}